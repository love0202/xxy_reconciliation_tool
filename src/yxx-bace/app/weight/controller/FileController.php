<?php
declare (strict_types=1);

namespace app\weight\controller;

use app\common\Controller;
use app\common\YxxExcel;
use think\facade\Db;
use think\Request;
use think\facade\Cache;

class FileController extends Controller
{
    public function list()
    {
        $params = [];

        $query = Db::name('weight_file');
        $list = $query->order('id', 'asc')->paginate([
            'query' => [],
            'list_rows' => 15,
        ]);
        $page = $list->render();
        $list = $list->toArray();

        $params['list'] = $list;
        $params['page'] = $page;
        return view('list', $params);
    }

    public function create()
    {
        $params = [];

        return view('create', $params);
    }

    /**
     * 保存新建的资源
     *
     * @param \think\Request $request
     * @return \think\Response
     */
    public function save(Request $request)
    {
        $params = $request->all();

        $path = 'weight_file';

        $saveName = \think\facade\Filesystem::disk('public')->putFile($path, $params['file'], 'uniqid');

        $insertData = [];
        $insertData['name'] = $params['name'];
        $insertData['filename'] = $params['file']->getOriginalName();
        $insertData['path'] = $saveName;
        $insertData['status'] = 0;
        $insertData['create_time'] = time();

        $ret = Db::name('weight_file')->insert($insertData);
        if ($ret) {
            return redirect((string)url('weight/file/list'));
        } else {
            return redirect((string)url('weight/file/list'));
        }
    }

    public function import()
    {
        $fileId = \request()->param('id');
        $fileInfo = Db::name('weight_file')->where(['id' => $fileId, 'status' => 0])->find();

        if (empty($fileInfo)) {
            echo json_encode(['success' => 0, 'message' => '数据不存在']);
            die();
        }

        $insertData = [];
        $nameArray = $this->setCacheNameArray();

        // 获取 excel 数据
        //0 => "原始重量" 1 => "导出商品详情"
        $colArr = ['A', 'B'];
        $excelModel = new YxxExcel();
        $excelModel->setColArr($colArr);
        $data = $excelModel->read($fileInfo['path'], false);
        foreach ($data as $v) {
            if ($v[1] == null || empty($v[1])) {
                continue;
            }
            if (in_array($v[1], $nameArray)) {
                continue;
            } else {
                $nameArray[] = $v[1];
            }
            $weight = $v[0];
            $str = json_encode($v);
            $insertData[] = [
                "weight_file_id" => $fileId,
                "shopinfo" => $v[1],
                "weight" => $weight,
                "dataJSON" => $str,
            ];
        }

        // 启动事务
        Db::startTrans();
        try {
            if (!empty($insertData)) {
                Db::name('weight_shop')->insertAll($insertData, 1000);
            }
            $updateArr = [];
            $updateArr['status'] = 1;
            $updateArr['num'] = count($insertData);

            Db::name('weight_file')->where(['id' => $fileId])->update($updateArr);
            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            echo json_encode(['success' => 0, 'message' => $e->getMessage()]);
            die();
        }

        echo json_encode(['success' => 1, 'message' => '导入成功']);
        die();
    }


    /**
     * 设置缓存
     */
    public function setCacheNameArray()
    {
        $nameArray = [];

        $data = Db::name('weight_shop')->field('weight,shopinfo')->select();
        foreach ($data as $value) {
            $nameArray[] = $value['shopinfo'];
        }
        // 缓存
//        if (Cache::has('name_array')) {
//            $nameArray = Cache::get('name_array');
//        }
//        Cache::delete('name_array');
//        Cache::set('name_array', $nameArray);
        return $nameArray;

    }
}
