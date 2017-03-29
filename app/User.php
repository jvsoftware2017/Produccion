<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\PasswordReset;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    		'name', 'email', 'password', 'id_client', 'id_plant','id_role', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function client() {
        return $this->belongsTo('App\Client', 'id_client');
    }

    public function role() {
        return $this->belongsTo('App\Role', 'id_role');
    }
    
    public function Equipments() {
    	return $this->belongsToMany('App\Equipment', 'user_access', 'id_user', 'id_equipment');
    }
    
    public function plant() {
    	return $this->belongsTo('App\Plant', 'id_plant');
    }
    
       /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
    	$this->notify(new PasswordReset($token));
    }
    
    
}
