<?php

namespace App\Models\Merchant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantPinduoduo extends Model
{
    use HasFactory;

    protected $table = 'merchant_wangdiantong';

    protected $fillable = [
        'project_id',
        'file_id',
        'merchant_number',
        'merchant_shop_info',
        'express_company',
        'express_number',
    ];
}
