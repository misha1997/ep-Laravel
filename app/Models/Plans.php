<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plans extends Model
{
    protected $table = 'education_plans';
    protected $primaryKey = 'id';

    public function departments()
    {
        return $this->belongsTo('App\Models\Departments', 'department_id');
    }
}