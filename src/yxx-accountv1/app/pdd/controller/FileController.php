<?php
declare (strict_types=1);

namespace app\pdd\controller;

use app\common\Controller;
use app\common\YxxExcel;
use think\facade\Db;
use think\Request;

class FileController extends Controller
{
    public function list()
    {
        $params = [];

        $query = Db::name('pdd_file');
        $list = $query->order('id', 'asc')->paginate([
            'query' => $params,
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

        $path = 'pdd_file';

        $insertData = [
            'name' => $params['name'],
        ];

        if (empty($params['shop_file']) && empty($params['manual_file'])) {
            dd('上传文件必须有一个不能为空');
        }

        if (!empty($params['shop_file'])) {
            $saveShopName = \think\facade\Filesystem::disk('public')->putFile($path, $params['shop_file'], 'uniqid');
            $insertData['order_shop_filename'] = $params['shop_file']->getOriginalName();
            $insertData['order_shop_path'] = $saveShopName;
        }

        if (!empty($params['manual_file'])) {
            $saveManualName = \think\facade\Filesystem::disk('public')->putFile($path, $params['manual_file'], 'uniqid');
            $insertData['order_manual_filename'] = $params['manual_file']->getOriginalName();
            $insertData['order_manual_path'] = $saveManualName;
        }
        $insertData['status'] = 0;
        $insertData['create_time'] = time();

        $ret = Db::name('pdd_file')->insert($insertData);
        if ($ret) {
            return redirect((string)url('pdd/file/list'));
        } else {
            return redirect((string)url('pdd/file/list'));
        }
    }

    public function import()
    {
        $fileId = \request()->param('id');
        $fileInfo = Db::name('pdd_file')->where(['id' => $fileId, 'status' => 0])->find();

        if (empty($fileInfo)) {
            echo json_encode(['success' => 0, 'message' => '数据不存在']);
            die();
        }

        $insertOrderShopData = [];
        $insertOrderManualData = [];

        // 获取 excel 数据
        //0 => "平台订单号" 1 => "商品简称" 2 => "规格" 3 => "数量" 4 => "快递公司" 5 => "快递单号"
        $colArr = ['D', 'I', 'J', 'L', 'O', 'Q'];
        $excelModel = new YxxExcel();
        $excelModel->setColArr($colArr);
        $orderShopData = $excelModel->read($fileInfo['order_shop_path']);
        foreach ($orderShopData as $v) {
            $str = json_encode($v);
            $shopinfo = '【数量：[' . (int)$v[3] . ']' . $v[2] . '】';

            $insertOrderShopData[] = [
                "pdd_file_id" => $fileId,
                "order_number" => $v[0],
                "title" => $v[1],
                "num" => (int)$v[3],
                "shop_attribute" => $v[2],
                "order_express_number" => $v[5],
                "express_company" => $v[4],
                "member" => $v[0],
                "shopinfo" => $shopinfo,
                "dataJSON" => $str,
            ];
        }

        //0 => "自定义信息" 1 => "快递" 2 => "快递单号" 3 => "订单号" 4 => "导入批次号"
        $colArr = ['G', 'H', 'I', 'J', 'K'];
        $excelModel->setColArr($colArr);
        $orderManualData = $excelModel->read($fileInfo['order_manual_path']);
        foreach ($orderManualData as $v) {
            $str = json_encode($v);
            $shopinfo = '【[手工订单]' . $v[0] . '】';

            $insertOrderManualData[] = [
                "pdd_file_id" => $fileId,
                "order_number" => $v[3],
                "title" => $v[4],
                "num" => 0,
                "shop_attribute" => '',
                "order_express_number" => $v[2],
                "express_company" => $v[1],
                "member" => $v[3],
                "shopinfo" => $shopinfo,
                "dataJSON" => $str,
            ];
        }

        // 启动事务
        Db::startTrans();
        try {
            if (!empty($insertOrderShopData)) {
                Db::name('pdd_order_shop')->insertAll($insertOrderShopData, 1000);
            }
            if (!empty($insertOrderManualData)) {
                Db::name('pdd_order_manual')->insertAll($insertOrderManualData, 1000);
            }
            $updateArr = [];
            $updateArr['status'] = 1;
            $updateArr['num_shop'] = count($insertOrderShopData);
            $updateArr['num_manual'] = count($insertOrderManualData);

            Db::name('pdd_file')->where(['id' => $fileId])->update($updateArr);
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
}
