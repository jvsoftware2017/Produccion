<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function plant(){
        return $this->hasMany('App\Plant');
    }

    protected $fillable = ['name', 'email', 'status', 'urlLogo', 'maxUsers', 'validity'];

    public function user() {
        return $this->hasMany('App\User', 'id_client');
    }

}

