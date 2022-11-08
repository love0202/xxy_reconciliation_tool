<?php

namespace App\Http\Controllers\Express;

use App\Excel\Imports\Express\ExpressImport;
use App\Excel\Exports\Express\ExpressExport;
use App\Http\Controllers\Controller;
use App\Models\Express\Express;
use App\Models\File\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Common\WebProject;

class ExpressController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->only(['project_id', 'express_number', 'file_id']);

        $data = [];
        $projectId = WebProject::getProjectId();
        $query = DB::table('express')->where(['project_id' => $projectId]);
        if (isset($input['express_number']) && !empty($input['express_number'])) {
            $query->where('express_number', 'like', $input['express_number'] . '%');
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
        $projectId = WebProject::getProjectId();
        $query = DB::table('file')->where(['project_id' => $projectId])->where(['theme' => yxx_dict_value('THEME_TYPE', 'T2')]);
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
        $type = $request->input('type');
        $file = $request->file('file');
        $fileKey = 'express';
        $originalExtension = $file->getClientOriginalExtension();
        $fileName = $fileKey . '/' . time() . rand(1000, 9999) . '.' . $originalExtension;
        Storage::put($fileName, file_get_contents($file->getRealPath()));
        $fileArr = [
            $fileKey => [
                'path' => $fileName,
                'importNum' => 0,
                'fileType' => 1,
                'originalName' => $file->getClientOriginalName(),
                'originalMimeType' => $file->getClientMimeType(),
                'originalExtension' => $originalExtension,
            ]
        ];
        $projectId = WebProject::getProjectId();
        $data = [];
        $data['project_id'] = $projectId;
        $data['theme'] = yxx_dict_value('THEME_TYPE', 'T2');
        $data['express_type'] = $type;
        $data['file_json'] = json_encode($fileArr);

        $model = new File();
        $ret = $model->create($data);
        $fileId = $ret->id;
        $importData = [
            'fileId' => $fileId,
            'projectId' => $projectId
        ];
        $excelFilePath = Storage::path($fileName);
        $importModel = new ExpressImport($importData);

        try {
            $importModel->import($excelFilePath);
            $importModel->end();
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                dd($failure->errors());
                $failure->row();
                $failure->attribute();
                $failure->errors();
                $failure->values();
            }
        }
        return redirect()->route('express.file', ['fileId' => $fileId]);
    }

    public function ajax_destroy_file(Request $request)
    {
        $idArr = $request->input('idArr', []);
        if (empty($idArr)) {
            return response()->json([
                'success' => 0,
                'message' => '无删除数据',
                'data' => '',
            ]);
        }
        File::whereIn('id', $idArr)->delete();
        Express::whereIn('file_id', $idArr)->delete();

        return response()->json([
            'success' => 1,
            'message' => '删除成功',
            'data' => '',
        ]);
    }

    public function export_file(Request $request)
    {
        $exportTime = $request->input('export_time');
        $exportModel = new ExpressExport();
        $title = '快递对账单' . date('Y-m-d') . '.xlsx';
        app('session')->put('export_time' . $exportTime, ['status' => 1, 'export_time' => $exportTime]);
        return $exportModel->download($title);
    }
}
