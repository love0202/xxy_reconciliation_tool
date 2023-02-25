<?php

namespace App\Models\Merchant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantWangdiantong extends Model
{
    use HasFactory;

    protected $table = 'merchant_wangdiantong';

    protected $fillable = [
        'project_id',
        'file_id',
        'express_company',
        'express_number',
        'express_weight',
    ];
}
