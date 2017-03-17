<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function users()
    {
    	return $this->belongsToMany('App\User');
    }

    public function employeesUsers()
    {
    	return $this->belongsTo('App\User');
    }
}
