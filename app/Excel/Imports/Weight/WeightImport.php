<?php

namespace App\Excel\Imports\Weight;

use App\Models\File\File;
use App\Models\Weight\Weight;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class WeightImport implements ToModel, WithValidation, WithBatchInserts
{
    use Importable;
    use RemembersRowNumber;
    public $importData = [];
    public $fileId;

    public function __construct($importData)
    {
        $this->importData = $importData;
        $this->fileId = isset($importData['fileId']) ? $importData['fileId'] : 0;
    }

    public function model(array $row)
    {
        $currentRowNumber = $this->getRowNumber();
        if ($currentRowNumber == 1) {
            return null;
        }

        return new Weight([
            'file_id' => $this->fileId,
            'shop_info' => $row[1],
            'weight' => $row[0],
        ]);
    }

    public function rules(): array
    {
        return [
            '0' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('重量不能为空');
                }
            },
            '1' => function ($attribute, $value, $onFailure) {
                if (empty($value)) {
                    $onFailure('商品详情不能为空');
                }
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
        $fileKey = 'weight';
        if ($fileModel) {
            $fileJsonArr = json_decode($fileModel->file_json, true);
            $fileJsonArr[$fileKey]['importNum'] = $insertNum;
            $fileModel->file_json = json_encode($fileJsonArr);
            $fileModel->save();
        }
    }
}
