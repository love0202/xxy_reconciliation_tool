<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();

        $data = [];
        $list = DB::table('project');
        $data['list'] = $list;
        $list->appends($input);
        return view('dashboard.index', $data);
    }
}
