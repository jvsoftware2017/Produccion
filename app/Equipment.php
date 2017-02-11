<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    protected $table = 'equipments';
    
    public function Plant() {
    	return $this->belongsTo('App\Plant', 'id_plant');
    }
    public function Type() {
    	return $this->belongsTo('App\Type', 'id_type');
    }
    
}
