<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
	protected $fillable = ['name', 'email', 'phone', 'adress', 'status', 'id_city'];
	
	public function city() {
		return $this->belongsTo('App\City', 'id_city');
	}
}
