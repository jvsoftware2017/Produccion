<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';
    protected $fillable = ['id_plant', 'id_type', 'name', 'model', 'status', 'urlImg', 'id_equipo'];
    
    public function Plant() {
    	return $this->belongsTo('App\Plant', 'id_plant');
    }
    public function Type() {
    	return $this->belongsTo('App\Type', 'id_type');
    }
    public static function equipmentsByIdPlant($idPlant){
        return Equipment::where("id_plant","=", $idPlant)->get();
    }
    
    public function Equipo() {
    	return $this->hasOne('App\Equipo', 'ID_EQUIPO', 'id_equipo');
    }
    
    public function Users() {
    	return $this->belongsToMany('App\User', 'user_access', 'id_equipment', 'id_user');
    }
}
