<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
	public function visits()
	{
		return $this->belongsToMany('App\Visit')->orderBy('date', 'desc');
	}

	public function statuses()
	{
		return $this->hasOne('App\Status');
	}
}
