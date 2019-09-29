<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';

	public function cycles()
	{
		return $this->belongsTo('App\Models\Cycles', 'cycles_id');
	}
}
