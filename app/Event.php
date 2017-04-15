<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
	protected $table = 'events';
	
	public function state(){
		return $this->belongsTo('App\State', 'id_state');
	}
	
	public static function getCountEventByReports($variable, $id_equipo, $month){
		return Event::where("id_state", "=", $variable)->where("id_equipo", "=", $id_equipo)->whereMonth('created_at', '=', $month)->select(\DB::raw('DATE(created_at) as date'), \DB::raw('count(*) as total'))->groupBy('date')->get();
	}
}
