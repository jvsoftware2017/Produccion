<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
	public function equipment() {
		return $this->hasMany('App\Equipment');
	}
}
