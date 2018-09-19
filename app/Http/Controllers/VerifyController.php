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
			// echo $userid;
			$user = LoginMember::find($userid);				// echo "string";
			if (count($user)==0) {
				# code...
				// echo "string";
			$request->session()->flash('danger','User Tidak Ditemukan');
			return redirect('login/');								
			}
			else{
				if ($user->status == 0) {
			$user->status = 1;
			if (session('userid') == null) {

			return redirect('/login');
			}
			else{


			$user->save();				
						$request->session()->flash('success','Email Berhasil diaktifkan');
					return redirect('dashboard');
			}
				}
				else{
				$request->session()->flash('danger','Kode Verifikasi sudah kadaluarsa');
							return redirect('/login');
	
				}

			}


		}
		else{
			$request->session()->flash('danger','Kode Verifikasi Salah');
			return redirect('/login');;
		}
		return view('verify/email');
	}

}