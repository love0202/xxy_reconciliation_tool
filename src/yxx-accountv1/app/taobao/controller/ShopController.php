<?php
declare (strict_types=1);

namespace app\taobao\controller;

use app\common\Controller;
use think\facade\Db;

class ShopController extends Controller
{
    public function list()
    {
        $params = [];

        $query = Db::name('taobao_order_shop');
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

    /**
     * 合并数据-更新商品表里面的运单号和商品详情
     */
    public function merge()
    {
        $tmOrderTable = Db::name('taobao_order')->getTable();
        $tmOrderShopTable = Db::name('taobao_order_shop')->getTable();
        $sql = <<<EOT
UPDATE 
{$tmOrderShopTable} AS tmOrderShop
LEFT JOIN {$tmOrderTable} AS tmOrder 
ON tmOrderShop.order_number = tmOrder.order_number SET 
tmOrderShop.member = tmOrder.member
WHERE tmOrderShop.member = '' AND tmOrderShop.member is NULL;
EOT;
        $ret = Db::execute($sql);

        return redirect((string)url('taobao/shop/list'));
    }
}
