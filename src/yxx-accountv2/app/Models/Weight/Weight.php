<?php

namespace App\Models\Weight;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $table = 'weight';

    protected $fillable = [
        'file_id',
        'shop_info',
        'weight',
    ];
}
