<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategories extends Model
{
    protected $table = 'sub_categories';
    protected $primaryKey = 'sub_category_id';
    
	public function categories()
	{
		return $this->belongsTo('App\Models\Categories', 'category_id');
	}
}
