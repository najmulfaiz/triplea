<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    //
	protected $table = 'detail_transaction_id_event';
	public $timestamps = false;

	public function formParticipant(){
		return  $this->belongsTo('App\FormParticipant','id_form_participant');
	}
	public function kategori(){
		return  $this->belongsTo('App\Kategori','id_kategori');
	}
}
