<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Categories;

class Cycles extends Model
{
    protected $table = 'cycles';
    protected $primaryKey = 'cycles_id';

    public function categories()
	{
		return $this->hasMany('App\Models\Categories', 'cycles_id');
    }
}
