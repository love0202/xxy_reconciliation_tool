<?php
declare (strict_types=1);

namespace app\pdd\controller;

use app\common\Controller;
use think\facade\Db;

class ShopController extends Controller
{
    public function list()
    {
        $params = [];

        $query = Db::name('pdd_order_shop');
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
}
