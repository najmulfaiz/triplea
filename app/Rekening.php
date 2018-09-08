<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekening extends Model
{
    //
	protected $table = 'rekening';
	
	public $timestamps = false;
	public $incrementing = false;

	public function bank(){
		return $this->belongsTo('App\Bank','kode_bank','kode_bank');
	}
}
