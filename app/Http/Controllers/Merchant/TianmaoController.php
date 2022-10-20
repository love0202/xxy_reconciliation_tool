<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TianmaoController extends Controller
{
    public function file(Request $request)
    {
        $input = $request->only(['sort']);

        $data = [];
        $query = DB::table('file')->where(['theme' => 3, 'merchant_type' => 1]);
        $query->orderBy('created_at', 'desc');
        $list = $query->paginate(10);
        $list->appends($input);
        $data['list'] = $list;
        $data['input'] = $input;
        return view('merchant.tianmao.file', $data);
    }

    public function create()
    {
        return view('merchant.tianmao.create');
    }


    public function ajax_destroy(Request $request)
    {
        $idArr = $request->input('idArr', []);
        if (empty($idArr)) {
            return response()->json([
                'success' => 0,
                'message' => '无删除数据',
                'data' => '',
            ]);
        }
        Weight::whereIn('id', $idArr)->delete();

        return response()->json([
            'success' => 1,
            'message' => '删除成功',
            'data' => '',
        ]);
    }
}
