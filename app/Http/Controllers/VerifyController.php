<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginMember;
use Hash;
use App\Token;
use Mail;
class VerifyController extends Controller
{

	public function verify($token,Request $request){
		$data = Token::where('token',$token);

		if ($data->count()!=0) {
			$userid = $data->first()->userid;
			$user = LoginMember::find($userid);
			$user->status =1;
			$user->save();
			$request->session()->flash('success','Email Berhasil diaktifkan');
			if (session('userid') == null) {

			return redirect('/login');
			}
			else{
					return redirect('dashboard');
			}
		}
		else{
			$request->session()->flash('danger','Kode Verifikasi Salah');
			return redirect('verify/'.$token);
		}
		return view('verify/email');
	}

}