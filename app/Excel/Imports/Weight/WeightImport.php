<?php

namespace App\Excel\Imports\Weight;

use App\Models\Weight\Weight;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WeightImport implements ToModel, WithHeadingRow
{
    use Importable;
    public $importData = [];

    public function __construct($importData)
    {
        $this->importData = $importData;
    }

    public function model(array $row)
    {
        if (!isset($row[0])) {
            return null;
        }

        return new Weight([
            'file_id' => $this->importData['fileId'],
            'shop_info' => $row[1],
            'weight' => $row[0],
        ]);
    }

    public function headingRow()
    {
        return 0;
    }
}
