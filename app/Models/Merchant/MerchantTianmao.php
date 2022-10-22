<?php

namespace App\Models\Merchant;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MerchantTianmao extends Model
{
    use HasFactory;

    protected $table = 'merchant_tianmao';

    protected $fillable = [
        'project_id',
        'file_id',
        'order_number',
        'order_number_son',
        'title',
        'shop_attribute',
        'num',
        'merchant_shop_info',
        'express_company',
        'express_number',
    ];
}
