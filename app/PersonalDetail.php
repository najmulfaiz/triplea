<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PersonalDetail extends Model
{
    //
	protected $table = 'personal_detail';
	public $timestamps = false;

	public function kota(){
		return $this->belongsTo('App\Kota','id_kota');
	}
	public function negara(){
		return $this->belongsTo('App\Negara','nasionality');
	}
	public function residence_s(){
		return $this->belongsTo('App\Negara','residence');
	}
	public function provinsi(){
				return $this->belongsTo('App\Provinsi','id_provinsi');

	}
	public function medical(){
		return $this->hasOne('App\EmergencyMedical','id_personal_detail');
	}
}
