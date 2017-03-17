<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
	public function visits()
	{
		return $this->belongsToMany('App\Visit')->orderBy('updated_at', 'desc');
	}

	public function statuses()
	{
		return $this->hasOne('App\Status');
	}

	public function employeesVisits()
	{
		return $this->hasMany('App\Visit', 'employee_id');
	}
}
