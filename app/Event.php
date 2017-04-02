<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $table = 'events';
	
	public function state(){
		return $this->belongsTo('App\State', 'id_state');
	}
}
