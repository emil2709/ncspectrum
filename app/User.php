<?php

namespace App;

class User extends Model
{
	public function visits()
	{
		return $this->belongsToMany('App\Visit');
	}

	public function statuses()
	{
		return $this->hasMany('App\Status');
	}
}
