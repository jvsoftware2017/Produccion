<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';
    protected $fillable = ['id_plant', 'id_type', 'name', 'model', 'status', 'urlImg'];
    
    public function Plant() {
    	return $this->belongsTo('App\Plant', 'id_plant');
    }
    public function Type() {
    	return $this->belongsTo('App\Type', 'id_type');
    }
    public static function equipmentsByIdPlant($idPlant){
        return Equipment::where("id_plant","=", $idPlant)->get();
    }
}
