<?php

namespace App\Models\File;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'file';

    protected $fillable = [
        'project_id',
        'theme',
        'merchant_type',
        'express_type',
        'file_json',
    ];
}
