<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    //
	protected $table = 'kategori';
	public $timestamps = false;

	public function group(){
		return $this->hasOne('App\Group','id','id_group');
	}
}
