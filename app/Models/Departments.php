<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departments extends Model
{
    protected $table = 'departments';
    protected $primaryKey = 'department_id';

	public function subdivisions()
	{
		return $this->belongsTo('App\Models\Subdivisions', 'subdivision_id');
	}
}
