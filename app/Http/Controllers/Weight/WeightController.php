<?php

namespace App\Http\Controllers\Weight;

use App\Excel\Imports\Weight\WeightImport;
use App\Http\Controllers\Controller;
use App\Models\File\File;
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
        $query = DB::table('file')->where(['theme' => 3]);
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
        $originalName = $file->getClientOriginalName();
        $originalMimeType = $file->getClientMimeType();
        $originalExtension = $file->getClientOriginalExtension();
        $fileName = 'weight/' . time() . rand(1000, 9999) . '.' . $originalExtension;
        Storage::put($fileName, file_get_contents($file->getRealPath()));
        $fileArr = [
            [
                'path' => $fileName,
                'importNum' => 0,
                'fileType' => 1,
                'originalName' => $originalName,
                'originalMimeType' => $originalMimeType,
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
        $importModel->import($excelFilePath);
        return redirect()->route('weight.file');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
