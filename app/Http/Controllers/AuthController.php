<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginMember;
use Hash;
use App\Token;
use Mail;

class AuthController extends Controller
{
    //
	public function register() {
      if (!empty(session('userid'))) {
			# code...
      	return redirect('/dashboard');
		}
		else{
		return view('register');			
		}

	}

	public function registerPost(Request $request){
		// echo "string";
			print_r($request->all());
			$email = $request->email;
			$password = $request->password;
			$re_password= $request->re_password;
			$tipe = $request->tipe;
			$no_hp = $request->no_hp;

			if (empty($email) || empty($password) || empty($re_password) || !is_numeric($tipe) || empty($no_hp)) {
				$danger = true;
				$msg = "Email Tidak Boleh Kosong";
				$request->session()->flash('danger','Terdapat Data yang belum diisi');

				return redirect()->back();
			}
			else{

				if ($re_password != $password) {
					# code...

					$request->session()->flash('danger','Konfirmasi Password Tidak Sama');

					return redirect()->back();
				}

				else{
					$user = LoginMember::where('email',$email);

					if ($user->count()==0) {

				$id = mt_rand(100000,999999); 
				$validate = LoginMember::where('id',$id)->count();
				if ($validate == 0) {
					$userid = $id;
				}
				else{
					$userid = mt_rand(100000,999999); 
				}

				// echo $userid;
				$create = new LoginMember;
				$create->id = $userid;
				$create->email = $email;
				$create->password = bcrypt($password);
				$create->tipe_akun = $tipe;
				$create->nohp = $no_hp;
				$save = $create->save();
				if ($save) {
					$request->session()->flash('success','Berhasil Mendaftar,Silahkan Login');
					$this->sendToken($userid);
					// $request->session()->put('userid', $userid);
					return redirect('/login');
				}
				else{

					return redirect()->back();
				}	
					}				

					else{

					$request->session()->flash('danger','Email Sudah digunakan, silahkan memakai email yang lain');
					// $request->session()->put('userid', $userid);
					return redirect('/register');
					}
				}







			}

	}	


	public function login() {
      if (!empty(session('userid'))) {
			# code...
      	return redirect('/dashboard');
		}
		else{
		return view('login');			
		}
	}
	public function loginPost(Request $request) {
		// return view('login');
		// print_r($request->all());
		$email = $request->email;
		$password = $request->password;
		$user = LoginMember::where('email',$email);

		if ($user->count()==1) {
			# code...
			$passwordVerify = $user->first()->password;

       if (Hash::check($password, $passwordVerify)) {
       	// echo "ok";
       	$request->session()->put('userid',$user->first()->id);
       	return redirect('dashboard');

       }
       else{

					$request->session()->flash('danger','Password Salah');
					// $request->session()->put('userid', $userid);
					return redirect()->back();
				
       }
		}
		else{

					$request->session()->flash('danger','Tidak ada akun yang terkait');
					// $request->session()->put('userid', $userid);
					return redirect()->back();
	}
		}



public function logout(Request $request){
		$request->session()->flush();
		return redirect('/login');
}

	public function sendToken($userid){
		// $userid = session('userid');
			$user= LoginMember::where('id',$userid);
	    $to = $user->first()->email;


	    $token = Token::where('userid',$userid);

	    $token_str = str_random(40);
	    if ($token->count()==0) {
	    	# code...
	    	$token = new Token;
	    	$token->token = $token_str;
	    	$token->userid= $userid;
	    	$token->save();
	    }
	    else{
	    	$tokenid = $token->first()->id;
	    	$token = Token::find($id);
	    	$token->token = $token_str;
	    	$token->userid= $userid;
	    	$token->save();

	    }
    // $data = ["data"=>"ok"];

$mail=    Mail::send('email.verify', ['token'=>$token_str,'email'=>$to], function ($message)use(&$to) {

        $message->from('fariswidhiarta123@gmail.com', 'Verifikasi Akun');

        $message->to($to)->subject('Verifikasi Akun');


    });

// print_r($mail);
    // return redirect('/request/'.$id);


}





	}


