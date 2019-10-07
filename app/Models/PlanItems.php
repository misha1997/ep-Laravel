<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanItems extends Model
{
    protected $table = 'education_items';
    protected $primaryKey = 'education_item_id';

    public function plan()
	{
		return $this->belongsTo('App\Models\Plans', 'education_plans_id');
    }
    
    public function subjects()
	{
		return $this->belongsTo('App\Models\Subjects', 'subject_id');
	}

	public function hours()
	{
		return $this->hasMany('App\Models\DistributionHours', 'education_item_id');
	}
}
