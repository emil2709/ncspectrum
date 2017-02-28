<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function visits()
    {
    	return $this->hasMany(Overview::class);
    }
}
