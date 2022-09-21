<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->only(['name', 'sort']);

        $data = [];
        $query = DB::table('project');
        if (isset($input['name']) && !empty($input['name'])) {
            $query->where('name', 'like', $input['name'] . '%');
        }
        if (isset($input['sort']) && !empty($input['sort'])) {
            if ($input['sort'] == 1) {
                $query->orderBy('created_at', 'asc');
            } elseif ($input['sort'] == 2) {
                $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        $list = $query->paginate(10);
        $list->appends($input);
        $data['list'] = $list;
        return view('project.index', $data);
    }

    public function enter(Request $request)
    {
        return view('project.enter');
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $input = $request->only(['name']);
        $input['guid'] = make_guid(true);
        $model = new Project();
        $ret = $model->create($input);
        if ($ret) {
            return redirect()->route('project.enter', ['guid' => $ret->guid]);
        } else {
            return redirect()->route('project.index');
        }
    }
}
