<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
	protected $table = 'equipo';
	
	public $timestamps = false;
		
	public function Equipment() {
		return $this->belongsTo('App\Equipment', 'id_equipo', 'ID_EQUIPO');
	}
}
