<?php

namespace App;

class Status extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
