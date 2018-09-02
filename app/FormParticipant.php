<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FormParticipant extends Model
{
    //
	protected $table = 'form_participant_id_event';
	public $timestamps = false;

	public function ukuranJersey(){
		return $this->belongsTo('App\UkuranJersey','id_ukuran_jersey');
	}
	public function personalDetail(){
		return $this->belongsTo('App\PersonalDetail','id_personal_detail');
	}
}
