<?php

namespace App\Models\Project;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'project';

    protected $fillable = [
        'guid',
        'name',
        'adminName',
        'year',
        'adminId',
    ];
    protected $attributes = [
        'name' => '测试',
    ];
}
