<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginMember extends Model
{
    //
	protected $table = 'login_member';
	public $timestamps = false;
	protected $hidden = ['password'];

	public function personal_detail()
	{
		return $this->hasMany('App\PersonalDetail', 'id_login_member');
	}

}
