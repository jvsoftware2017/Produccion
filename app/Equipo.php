<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
	protected $table = 'equipo';
		
	public function Equipment() {
		return $this->belongsTo('App\Equipment', 'ID_EQUIPO', 'id_equipo');
	}
}
