<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->all();

        $data = [];
        $list = Project::paginate(10);
        $data['list'] = $list;
        $list->appends($input);
//        dd($list->total());
        return view('dashboard.index', $data);
    }
}
