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
    ];

    public function setSearch($query,$input)
    {
        if (isset($input['name']) && !empty($input['name'])) {
            $query->where(['name'=>$input['name']]);
        }
        if (isset($input['sort']) && !empty($input['sort'])) {
            if ($input['sort'] == 1) {
                $query->orderBy('created_at');
            }else{
                $query->orderByDesc('created_at');
            }
        }else{
            $query->orderByDesc('created_at');
        }
        return $query;
    }
}
