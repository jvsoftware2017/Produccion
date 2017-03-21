<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAccess extends Model
{
	protected $fillable = ['id_user', 'id_plant', 'id_equipment'];
	protected $table = 'user_access';
	public function user() {
		return $this->belongsTo('App\User', 'id_user');
	}
	
	public function plant() {
		return $this->belongsTo('App\Plant', 'id_plant');
	}
	
	public function equipment() {
		return $this->belongsTo('App\Equipment', 'id_equipment');
	}
}
