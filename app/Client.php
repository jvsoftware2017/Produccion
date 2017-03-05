<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function plant(){
        return $this->hasMany('App\Plant');
    }

    protected $fillable = ['name', 'email', 'phone', 'adress', 'status', 'id_city'];

    public function city() {
        return $this->belongsTo('App\City', 'id_city');
    }

    public function user() {
        return $this->hasMany('App\User', 'id_client');
    }

}

