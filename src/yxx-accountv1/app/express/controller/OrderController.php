<?php

declare(strict_types=1);

namespace app\express\controller;

use think\facade\Db;
use app\common\Controller;
use think\Request;

class OrderController extends Controller
{
    public function list(Request $request)
    {
        $params = $request->all();


        $expressTypeEname = yxx_config_ename('EXPRESS_TYPE', $params['type']);
        $dbTableName = 'express_' . $expressTypeEname;
        $query = Db::name($dbTableName);

        $query->where('express_file_id', $params['fileId']);
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

    /**
     * 合并数据
     */
    public function merge()
    {
        $expressTypeList = yxx_config_list('EXPRESS_TYPE', 'ename');
        // 启动事务
        Db::startTrans();
        try {
            // 商品明细-数据源
            $tianmaoTable = Db::name('tianmao_order_shop')->getTable();
            $pddTable = Db::name('pdd_order_shop')->getTable();
            $pddManualTable = Db::name('pdd_order_manual')->getTable();
            $wangdiantongTable = Db::name('wangdiantong_order')->getTable();

            // 快递
            foreach ($expressTypeList as $key => $value) {
                $dbTableName = 'express_'.$value;
                $expressTable = Db::name($dbTableName)->getTable();
                $sqlUpdate = <<<EOT
                    UPDATE {$expressTable} AS express
                    LEFT JOIN (
                    SELECT order_express_number, member AS  member_str, GROUP_CONCAT(shopinfo) AS shopinfo_str
                    FROM {$tianmaoTable}
                    WHERE order_express_number != ''
                    GROUP BY order_express_number
                    UNION ALL
                    SELECT order_express_number, GROUP_CONCAT(order_number) AS  member_str, GROUP_CONCAT(shopinfo) AS shopinfo_str
                    FROM {$pddTable}
                    WHERE order_express_number != ''
                    GROUP BY order_express_number
                    UNION ALL
                    SELECT order_express_number, GROUP_CONCAT(order_number) AS  member_str, GROUP_CONCAT(shopinfo) AS shopinfo_str
                    FROM {$pddManualTable}
                    WHERE order_express_number != ''
                    GROUP BY order_express_number) AS store ON express.order_number = store.order_express_number SET 
                    express.shopinfo = store.shopinfo_str,express.member = store.member_str;
EOT;
                $ret = Db::execute($sqlUpdate);
            }

            // 快递
            foreach ($expressTypeList as $key => $value) {
                $dbTableName = 'express_'.$value;
                $expressTable = Db::name($dbTableName)->getTable();
                $sqlUpdate = <<<EOT
                    UPDATE {$expressTable} AS express
                    LEFT JOIN {$wangdiantongTable} AS store ON express.order_number = store.order_express_number SET 
                    express.weight = store.weight,express.member = store.express_address,express.shopinfo = store.express_company
                    WHERE store.order_express_number != '';
EOT;
                $ret = Db::execute($sqlUpdate);
            }

            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            dd($e->getMessage());
        }
        // 统计未取得商品信息的运单总数
        $this->updateExpressFileStatistics();

        return redirect((string)url('express/file/list'));
    }

    /**
     * 合并数据
     */
    public function mergeWeight()
    {
        $expressTypeList = yxx_config_list('EXPRESS_TYPE', 'ename');
        // 启动事务
        Db::startTrans();
        try {
            // 重量商品明细-数据源
            $weightTable = Db::name('weight_shop')->getTable();

            // 快递
            foreach ($expressTypeList as $key => $value) {
                $dbTableName = 'express_'.$value;
                $expressTable = Db::name($dbTableName)->getTable();
                $sqlUpdate = <<<EOT
            UPDATE {$expressTable} AS express, {$weightTable} AS weight 
            SET express.weight = weight.weight
            WHERE express.shopinfo = weight.shopinfo;
EOT;
                $ret = Db::execute($sqlUpdate);
            }

            // 提交事务
            Db::commit();
        } catch (\Exception $e) {
            // 回滚事务
            Db::rollback();
            dd($e->getMessage());
        }

        return redirect((string)url('express/file/list'));
    }

    /**
     * 更新文件的统计信息
     */
    public function updateExpressFileStatistics()
    {
        $all = Db::name('express_file')->limit(0,100)->select();
        foreach ($all as $row) {
            $expressTypeEname = yxx_config_ename('EXPRESS_TYPE', $row['type']);
            $dbTableName = 'express_' . $expressTypeEname;
            $count = Db::name($dbTableName)->where(['express_file_id' => $row['id'], 'shopinfo' => '', 'weight' => ''])->count();

            $updateArr['num_no'] = $count;
            $ret = Db::name('express_file')->where(['id' => $row['id']])->update($updateArr);
        }
    }
}
