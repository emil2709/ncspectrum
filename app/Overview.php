<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overview extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function visit()
    {
    	return $this->belongsTo(Visit::class);
    }
}
