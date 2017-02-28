<?php

namespace App;

class User extends Model
{
	public function status()
	{
		return $this->hasMany(Status::class);
	}

	public function overviews()
	{
		return $this->hasMany(Overview::class);
	}
}
