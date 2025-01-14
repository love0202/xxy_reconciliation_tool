<?php
declare (strict_types=1);

namespace app\tianmao\controller;

use app\common\Controller;
use app\common\YxxCsv;
use app\common\YxxExcel;
use think\facade\Db;
use think\Request;

class FileController extends Controller
{
    public function list()
    {
        $params = [];

        $query = Db::name('tianmao_file');
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

        $path = 'tianmao_file';

        if (empty($params['shop_file']) && empty($params['order_file'])) {
            dd('上传文件都不能为空');
        }

        $saveShopName = \think\facade\Filesystem::disk('public')->putFile($path, $params['shop_file'], 'uniqid');
        $saveOrderName = \think\facade\Filesystem::disk('public')->putFile($path, $params['order_file'], 'uniqid');

        $insertData = [];
        $insertData['name'] = $params['name'];
        $insertData['order_shop_filename'] = $params['shop_file']->getOriginalName();
        $insertData['order_shop_path'] = $saveShopName;
        $insertData['order_filename'] = $params['order_file']->getOriginalName();
        $insertData['order_path'] = $saveOrderName;
        $insertData['status'] = 0;
        $insertData['create_time'] = time();

        $ret = Db::name('tianmao_file')->insert($insertData);
        if ($ret) {
            return redirect((string)url('tianmao/file/list'));
        } else {
            return redirect((string)url('tianmao/file/list'));
        }
    }

    // 删除
    public function delete(Request $request)
    {
        $params = $request->all();
        if (!isset($params['id']) || empty($params['id'])) {
            dd('请检查参数id');
        }
        $fileId = $params['id'];
        Db::name('tianmao_file')->where('id', $fileId)->delete();
        Db::name('tianmao_order')->where('tianmao_file_id', $fileId)->delete();
        Db::name('tianmao_order_shop')->where('tianmao_file_id', $fileId)->delete();

        return redirect((string)url('tianmao/file/list'));
    }

    public function import()
    {
        $fileId = \request()->param('id');
        $fileInfo = Db::name('tianmao_file')->where(['id' => $fileId, 'status' => 0])->find();

        if (empty($fileInfo)) {
            echo json_encode(['success' => 0, 'message' => '数据不存在']);
            die();
        }

        $insertOrderData = [];
        $insertOrderShopData = [];

        // 获取 excel 数据
        //0 => "订单编号" 1 => "联系手机" 2 => "物流单号 " 3 => "物流公司"
        $colArr = ['A', 'Q', 'W', 'X'];
        $excelModel = new YxxExcel();
        $excelModel->setColArr($colArr);
        $orderData = $excelModel->read($fileInfo['order_path']);
        foreach ($orderData as $v) {
            $insertOrderData[] = [
                "tianmao_file_id" => $fileId,
                "order_number" => $v[0],
                "member" => $v[1],
                "order_express_number" => str_replace('No:', '', $v[2]),
                "express_company" => $v[3],
                "dataJSON" => json_encode($v),
            ];
        }

        // 获取 csv 数据
        //    0 => "子订单编号" 1 => "主订单编号" 2 => "标题" 3 => "价格" 4 => "购买数量" 5 => "外部系统编号"
        //    6 => "商品属性" 7 => "套餐信息" 8 => "备注" 9 => "订单状态" 10 => "商家编码" 11 => "支付单号"
        //    12 => "买家应付货款" 13 => "买家实际支付金额" 14 => "退款状态" 15 => "退款金额" 16 => "订单创建时间"
        //    17 => "订单付款时间"
        $colArr = [];
        $csvModel = new YxxCsv();
        $csvModel->setColArr($colArr);
        $orderShopData = $csvModel->read($fileInfo['order_shop_path']);
        foreach ($orderShopData as $v) {
            $str = json_encode($v);
            $numSon = preg_replace('/[^0-9]/', '', $v[0]);
            $num = preg_replace('/[^0-9]/', '', $v[1]);
            $shopinfo = '';
            if ($v[6] == 'null') {
                $shopinfo = '【数量：[' . $v[4] . ']' . $v[2] . '】';
            } else {
                $shopinfo = '【数量：[' . $v[4] . ']' . $v[6] . '】';
            }
            $insertOrderShopData[] = [
                "tianmao_file_id" => $fileId,
                "order_number_son" => $numSon,
                "order_number" => $num,
                "title" => $v[2],
                "num" => $v[4],
                "shop_attribute" => $v[6],
                "shopinfo" => $shopinfo,
                "dataJSON" => $str,
            ];
        }

        // 启动事务
        Db::startTrans();
        try {
            $retOrder = Db::name('tianmao_order')->insertAll($insertOrderData, 1000);
            $retOrderShop = Db::name('tianmao_order_shop')->insertAll($insertOrderShopData, 1000);
            if (!empty($retOrder) && !empty($retOrderShop)) {
                $updateArr = [];
                $updateArr['status'] = 1;
                $updateArr['num_order'] = count($insertOrderData);
                $updateArr['num_shop'] = count($insertOrderShopData);

                Db::name('tianmao_file')->where(['id' => $fileId])->update($updateArr);
            }
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
