<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
	protected $table = 'reports';
	
	public static function getValuesToGraphic($variable, $id_equipo, $month, $anio){
		return Report::where("variable", "=", $variable)->where("id_equipo", "=", $id_equipo)->whereYear('created_at', '=', $anio)->whereMonth('date', '=', $month)->get();
	}
}
