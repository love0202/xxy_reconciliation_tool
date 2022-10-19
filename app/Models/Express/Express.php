<?php

namespace App\Models\Express;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Express extends Model
{
    use HasFactory;

    protected $table = 'express';

    protected $fillable = [
        'project_id',
        'file_id',
        'order_number',
        'express_weight',
    ];
}
