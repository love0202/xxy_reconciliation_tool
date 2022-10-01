<?php

namespace App\Http\Controllers\Project;

use App\Http\Controllers\Controller;
use App\Models\Project\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Common\WebProject;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->only(['name', 'sort', 'year']);

        $year = $request->input('year', date('Y'));
        $input['year'] = $year;
        $data = [];
        $query = DB::table('project')->where(['year'=>$year]);
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
        $data['input'] = $input;
        return view('project.index', $data);
    }

    public function create()
    {
        return view('project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
        ]);

        $input = $request->only(['name']);
        $input['guid'] = make_guid(true);
        $input['year'] = date('Y');
        $input['adminName'] = Auth::user()->name;
        $input['adminId'] = Auth::user()->id;
        $model = new Project();
        $ret = $model->create($input);
        return redirect()->route('project.index');
    }

    public function enter(Request $request)
    {
        $id = $request->input('id', 0);

        $ret = WebProject::enter($id);
        if ($ret){
            return redirect()->route('project.index');
        }else{
            return redirect()->route('project.index');
        }
    }

    public function quit()
    {
        WebProject::quit();
        return redirect()->route('project.index');
    }
}
