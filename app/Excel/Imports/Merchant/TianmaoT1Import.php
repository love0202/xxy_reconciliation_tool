<?php

namespace App\Excel\Imports\Merchant;

use App\Models\File\File;
use App\Models\Merchant\MerchantTianmao;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;

class TianmaoT1Import implements ToModel, WithValidation, WithBatchInserts
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
        if (count($row) != 5) {
            return null;
        }
        $currentRowNumber = $this->getRowNumber();
        if ($currentRowNumber == 1) {
            return null;
        }
        if (empty($row[0])) {
            return null;
        }
        if ($row[4] == 'null') {
            $merchantShopInfo = '【' . $row[2] . '【' . $row[3] . '】' . '】';
        } else {
            $merchantShopInfo = '【' . $row[4] . '【' . $row[3] . '】' . '】';
        }

        return new MerchantTianmao([
            'project_id' => $this->projectId,
            'file_id' => $this->fileId,
            'merchant_shop_info' => $merchantShopInfo,
            'order_number' => $row[1],
            'order_number_son' => $row[0],
            'title' => $row[2],
            'shop_attribute' => $row[4],
            'num' => $row[3],
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
