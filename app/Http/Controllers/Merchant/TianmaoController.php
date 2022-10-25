<?php

namespace App\Http\Controllers\Merchant;

use App\Common\WebProject;
use App\Excel\Imports\Merchant\TianmaoT1Import;
use App\Excel\Imports\Merchant\TianmaoT2Import;
use App\Http\Controllers\Controller;
use App\Models\File\File;
use App\Models\Merchant\MerchantTianmao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class TianmaoController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->only(['file_id']);

        $data = [];
        $projectId = WebProject::getProjectId();
        $query = DB::table('merchant_tianmao')->where(['project_id' => $projectId]);
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
        return view('merchant.tianmao.index', $data);
    }

    public function file(Request $request)
    {
        $input = $request->only(['sort']);

        $data = [];
        $projectId = WebProject::getProjectId();
        $query = DB::table('file')->where(['project_id' => $projectId])->where(['theme' => yxx_dict_value('THEME_TYPE','T1'), 'merchant_type' => yxx_dict_value('MERCHANT_TYPE','T2')]);
        $query->orderBy('created_at', 'desc');
        $list = $query->paginate(10);
        $list->appends($input);
        $data['list'] = $list;
        $data['input'] = $input;
        return view('merchant.tianmao.file', $data);
    }

    public function create()
    {
        return view('merchant.tianmao.create');
    }

    public function store(Request $request)
    {
        $type = $request->input('type', 1);
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
        $data['theme'] = yxx_dict_value('THEME_TYPE','T1');
        $data['merchant_type'] = yxx_dict_value('MERCHANT_TYPE','T2');
        $data['file_json'] = json_encode($fileArr);

        $model = new File();
        $ret = $model->create($data);
        $fileId = $ret->id;
        $importData = [
            'fileId' => $fileId,
            'projectId' => $projectId
        ];
        $excelFilePath = Storage::path($fileName);
        if ($type == 1) {
            $importModel = new TianmaoT1Import($importData);
        } elseif ($type == 2) {
            $importModel = new TianmaoT2Import($importData);
        } else {
            $importModel = new TianmaoT1Import($importData);
        }

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
        return redirect()->route('merchant.tianmao.index', ['fileId' => $fileId]);
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
        MerchantTianmao::whereIn('file_id', $idArr)->delete();

        return response()->json([
            'success' => 1,
            'message' => '删除成功',
            'data' => '',
        ]);
    }
}
