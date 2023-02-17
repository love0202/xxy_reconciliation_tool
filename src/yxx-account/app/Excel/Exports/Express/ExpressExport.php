<?php

namespace App\Excel\Exports\Express;

use App\Models\Express\Express;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExpressExport implements FromArray, WithHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            '（快递）单号',
            '（快递）重量',
            ' 核对情况',
        ];
    }

    public function array(): array
    {
        $all = Express::select('express_number', 'express_weight')->where('file_id', 1)->get()->toArray();
        $data = [];
        foreach ($all as $key => $value) {
            $temp = [];
            $temp['express_number'] = ',' . $value['express_number'];
            $temp['express_weight'] = $value['express_weight'];
            $temp['check_result'] = '已核对';
            $data[] = $temp;
        }
        return $data;
    }
}
