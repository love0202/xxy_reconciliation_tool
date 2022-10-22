<?php

namespace App\Excel\Imports\Merchant;

use App\Models\File\File;
use App\Models\Merchant\MerchantWangdiantong;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;

class WangdiantongImport implements ToModel, WithValidation, WithBatchInserts
{
    use Importable;
    use RemembersRowNumber;
    public $importData = [];
    public $fileId;
    public $projectId;

    public function __construct($importData)
    {
        $this->importData = $importData;
        $this->fileId = isset($importData['fileId']) ? $importData['fileId'] : 0;
        $this->projectId = isset($importData['projectId']) ? $importData['projectId'] : 0;
    }

    public function model(array $row)
    {
        $currentRowNumber = $this->getRowNumber();
        if ($currentRowNumber == 1) {
            return null;
        }
        if (empty($row[0])) {
            return null;
        }

        return new MerchantWangdiantong([
            'project_id' => $this->projectId,
            'file_id' => $this->fileId,
            'express_number' => $row[0],
            'express_weight' => $row[1],
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => function ($attribute, $value, $onFailure) {

            },
            '1' => function ($attribute, $value, $onFailure) {

            },
        ];
    }

    public function batchSize(): int
    {
        return 1000;
    }

    public function end()
    {
        $currentRowNumber = $this->getRowNumber();
        $insertNum = $currentRowNumber - 1;

        $fileModel = File::find($this->fileId);
        $fileKey = 'Merchant';
        if ($fileModel) {
            $fileJsonArr = json_decode($fileModel->file_json, true);
            $fileJsonArr[$fileKey]['importNum'] = $insertNum;
            $fileModel->file_json = json_encode($fileJsonArr);
            $fileModel->save();
        }
    }
}
