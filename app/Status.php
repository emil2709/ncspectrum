<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    public function user()
    {
    	return $this->hasOne(User::class);
    }
}
