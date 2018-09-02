<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    //
	protected $table = 'group';
	public $timestamps = false;

	public function kategori(){
		return $this->hasOne('App\Kategori','id_group');
	}
	public function event(){
		return $this->hasOne('App\Event','id','id_event');

	}
}
