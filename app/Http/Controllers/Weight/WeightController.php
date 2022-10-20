<?php

namespace App\Http\Controllers\Weight;

use App\Excel\Imports\Weight\WeightImport;
use App\Http\Controllers\Controller;
use App\Models\File\File;
use App\Models\Weight\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WeightController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->only(['project_id', 'title']);

        $data = [];
        $query = DB::table('weight');
        if (isset($input['project_id']) && !empty($input['project_id'])) {
            $query->where(['project_id' => $input['project_id']]);
        }
        if (isset($input['title']) && !empty($input['title'])) {
            $query->where('title', 'like', $input['title'] . '%');
        }
        $query->orderBy('created_at', 'desc');
        $list = $query->paginate(10);
        $list->appends($input);
        $data['list'] = $list;
        $data['input'] = $input;
        return view('weight.index', $data);
    }

    public function file(Request $request)
    {
        $input = $request->only(['sort']);

        $data = [];
        $query = DB::table('file')->where(['theme' => 3, 'merchant_type' => 0]);
        $query->orderBy('created_at', 'desc');
        $list = $query->paginate(10);
        $list->appends($input);
        $data['list'] = $list;
        $data['input'] = $input;
        return view('weight.file', $data);
    }

    public function create()
    {
        return view('weight.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimetypes:text/csv,application/xml,application/zip,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel',
        ]);
        $file = $request->file('file');
        $fileKey = 'weight';
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
        $data = [];
        $data['project_id'] = 0;
        $data['theme'] = 3;
        $data['file_json'] = json_encode($fileArr);

        $model = new File();
        $ret = $model->create($data);
        $importData = [
            'fileId' => $ret->id
        ];
        $excelFilePath = Storage::path($fileName);
        $importModel = new WeightImport($importData);

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
        return redirect()->route('weight.index');
    }

    public function edit($id)
    {
        $model = Weight::find($id);
        return view('weight.edit', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        //
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
