<?php
declare (strict_types=1);

namespace app\tianmao\controller;

use app\common\Controller;
use think\facade\Db;

class ShopController extends Controller
{
    public function list()
    {
        $params = [];

        $query = Db::name('tianmao_order_shop');
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
        $tmOrderTable = Db::name('tianmao_order')->getTable();
        $tmOrderShopTable = Db::name('tianmao_order_shop')->getTable();
        $sql = <<<EOT
UPDATE 
{$tmOrderShopTable} AS tmOrderShop
LEFT JOIN {$tmOrderTable} AS tmOrder 
ON tmOrderShop.order_number = tmOrder.order_number SET 
tmOrderShop.member = tmOrder.member,
tmOrderShop.express_company = tmOrder.express_company,
tmOrderShop.order_express_number = tmOrder.order_express_number;
EOT;
        $ret = Db::execute($sql);

        return redirect((string)url('tianmao/shop/list'));
    }
}
