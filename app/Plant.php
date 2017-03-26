<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    protected $fillable = ['id_city', 'id_client', 'name', 'adress', 'phone', 'status'];

    public function city(){
        return $this->belongsTo('App\City', 'id_city');
    }
    public function client(){
        return $this->belongsTo('App\Client', 'id_client');
    }
    public function equipment() {
    	return $this->hasMany('App\Equipment');
    }
}
