<?php

namespace App\Http\Controllers\Merchant;

use App\Common\WebProject;
use App\Excel\Imports\Merchant\WangdiantongImport;
use App\Http\Controllers\Controller;
use App\Models\File\File;
use App\Models\Merchant\MerchantWangdiantong;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class WangdiantongController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->only(['file_id']);

        $data = [];
        $projectId = WebProject::getProjectId();
        $query = DB::table('merchant_wangdiantong')->where(['project_id' => $projectId]);
        if (isset($input['file_id']) && !empty($input['file_id'])) {
            $query->where(['file_id' => $input['file_id']]);
        }
        if (isset($input['title']) && !empty($input['title'])) {
            $query->where('title', 'like', $input['title'] . '%');
        }
        $query->orderBy('created_at', 'desc');
        $list = $query->paginate(10);
        $list->appends($input);
        $data['list'] = $list;
        $data['input'] = $input;
        return view('merchant.wangdiantong.index', $data);
    }

    public function file(Request $request)
    {
        $input = $request->only(['sort']);

        $data = [];
        $projectId = WebProject::getProjectId();
        $query = DB::table('file')->where(['project_id' => $projectId])->where(['theme' => 3, 'merchant_type' => 4]);
        $query->orderBy('created_at', 'desc');
        $list = $query->paginate(10);
        $list->appends($input);
        $data['list'] = $list;
        $data['input'] = $input;
        return view('merchant.wangdiantong.file', $data);
    }

    public function create()
    {
        return view('merchant.wangdiantong.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimetypes:text/csv,application/xml,application/zip,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel',
        ]);
        $file = $request->file('file');
        $fileKey = 'Merchant';
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
        $projectId = WebProject::getProjectId();;
        $data = [];
        $data['project_id'] = $projectId;
        $data['theme'] = 3;
        $data['merchant_type'] = 4;
        $data['file_json'] = json_encode($fileArr);

        $model = new File();
        $ret = $model->create($data);
        $fileId = $ret->id;
        $importData = [
            'fileId' => $fileId,
            'projectId' => $projectId
        ];
        $excelFilePath = Storage::path($fileName);
        $importModel = new WangdiantongImport($importData);

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
        return redirect()->route('merchant.wangdiantong.index', ['fileId' => $fileId]);
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
        MerchantWangdiantong::whereIn('file_id', $idArr)->delete();

        return response()->json([
            'success' => 1,
            'message' => '删除成功',
            'data' => '',
        ]);
    }
}
