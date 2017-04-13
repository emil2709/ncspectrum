<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	public function visits()
	{
		return $this->belongsToMany('App\Visit');
	}

	public function status()
	{
		return $this->hasOne('App\Status');
	}
}
