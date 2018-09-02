<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
	protected $table = 'transaction_id_event';
	public $timestamps = false;
	public $incrementing = false;

	public function event(){
		return $this->belongsTo('App\Event','id_event');
	}
	public function diskon_data(){
		return $this->belongsTo('App\Diskon','diskon');

	}
	public function user(){
		return $this->belongsTo('App\LoginMember','id_login_member');
	}
	public function personal(){
		return $this->hasMany('App\DetailTransaction','id_transaction');
	}
}
