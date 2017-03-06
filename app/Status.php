<?php

namespace App;

class Status extends Model
{
    public function users()
    {
    	return $this->belongsTo('App\User');
    }
}
