<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function plant(){
        return $this->hasMany('App\Plant');
    }
	public function clients() {
		return $this->hasMany('App\Client');
	}
}
