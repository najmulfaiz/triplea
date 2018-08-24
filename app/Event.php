<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
	protected $table = 'event';
	public $timestamps = false;

	public function kota(){
		return $this->belongsTo('App\Kota','id_kota');
	}
	public function group(){
		return $this->hasMany('App\Group','id_event');
	}
	public function eventDetail(){
		return $this->hasOne('App\EventDetail','id_event');
	}
	public function fasilitas(){
		return $this->hasOne('App\Fasilitas','id_event');
	}
	public function eventTerm(){
		return $this->hasOne('App\EventTerm','id_event');
	}
}
