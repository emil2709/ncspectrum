<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function visit()
    {
    	return $this->hasMany(Overview::class);
    }
}
