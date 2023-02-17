<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->only(['year']);

        $data = [];
        $query = DB::table('project');
        $list = $query->paginate(10);
        $data['list'] = $list;
        return view('dashboard.index', $data);
    }
}
