<?php

namespace App\Http\Controllers\Express;

use App\Http\Controllers\Controller;
use App\Models\File\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Common\WebProject;

class ExpressController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->only(['project_id', 'title']);

        $data = [];
        $query = DB::table('express');
        if (isset($input['order_number']) && !empty($input['order_number'])) {
            $query->where('order_number', 'like', $input['order_number'] . '%');
        }
        $query->orderBy('created_at', 'desc');
        $list = $query->paginate(10);
        $list->appends($input);
        $data['list'] = $list;
        $data['input'] = $input;
        return view('express.index', $data);
    }

    public function file(Request $request)
    {
        $input = $request->only(['sort']);

        $data = [];
        $query = DB::table('file')->where(['theme' => 2]);
        $query->orderBy('created_at', 'desc');
        $list = $query->paginate(10);
        $list->appends($input);
        $data['list'] = $list;
        $data['input'] = $input;
        return view('express.file', $data);
    }

    public function create()
    {
        return view('express.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'file' => 'required|mimetypes:text/csv,application/xml,application/zip,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel',
        ]);
        $file = $request->file('file');
        $originalName = $file->getClientOriginalName();
        $originalMimeType = $file->getClientMimeType();
        $originalExtension = $file->getClientOriginalExtension();
        $path = Storage::put('weight', $file);
        $fileArr = [
            [
                'path' => $path,
                'importNum' => 0,
                'fileType' => 1,
                'originalName' => $originalName,
                'originalMimeType' => $originalMimeType,
                'originalExtension' => $originalExtension,
            ]
        ];
        $data = [];
        $data['project_id'] = WebProject::getProjectId();
        $data['theme'] = 2;
        $data['file_json'] = json_encode($fileArr);

        $model = new File();
        $ret = $model->create($data);
        return redirect()->route('express.file');
    }

    public function destroy($id)
    {
        //
    }
}
