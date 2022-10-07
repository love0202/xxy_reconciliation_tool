<?php

namespace App\Excel\Imports\Weight;

use App\Models\Weight\Weight;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;

class WeightImport implements ToModel, WithValidation, SkipsOnError
{
    use Importable, SkipsErrors;

    public function model(array $row)
    {
        return new Weight([
            'shop_info' => $row[2],
            'weight' => $row[0],
        ]);
    }

    public function rules(): array
    {
        return [
            'shop_info' => [
                'required',
            ],
            'weight' => [
                'required',
            ],
        ];
    }

    public function customValidationAttributes()
    {
        return ['0' => 'weight','2' => 'shop_info'];
    }
    public function headingRow()
    {
        return 2;
    }
}
