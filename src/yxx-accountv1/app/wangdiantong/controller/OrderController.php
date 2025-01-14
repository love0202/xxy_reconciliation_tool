<?php

declare(strict_types=1);

namespace app\wangdiantong\controller;

use think\facade\Db;
use app\common\Controller;
use think\Request;

class OrderController extends Controller
{
    public function list(Request $request)
    {
        $params = $request->all();

        $dbTableName = 'wangdiantong_order';
        $query = Db::name($dbTableName);

        $query->where('wangdiantong_file_id', $params['fileId']);
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
}
