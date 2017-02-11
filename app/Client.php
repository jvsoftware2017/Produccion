<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    //
    public function plant(){
        return $this->hasMany('App\Plant');
    }
}
