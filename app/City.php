<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
	public function clients() {
		return $this->hasMany('App\Client', 'id_city');
	}
}
