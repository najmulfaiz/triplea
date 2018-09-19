<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginMember;
use Hash;
use App\Token;
use Mail;
use App\Event;
use App\Kategori;
use App\PersonalDetail;
use App\Group;
use App\UkuranJersey;
use App\FormParticipant;
use App\Transaction;
use App\DetailTransaction;
use App\EmergencyMedical;
use DB;
use App\Diskon;
use App\Provinsi;

use App\Kota;
use DNS1D;
use DNS2D;
use QrCode;
use App\Rekening;
use App\EarlyBird;
use App\Notifikasi;

use App\Lib\Log;
class MainController extends Controller
{

	public function __construct()
	{
		// parent::__construct();
	}

	public function mail($code){

	$this->middleware('login-auth');
// 					$to = 'merahkode@gmail.com';
// $mail=    Mail::send('email.invoice', ['transaction'=>'ko'], function ($message)use(&$to) {

//         $message->from('fariswidhiarta123@gmail.com', 'Verifikasi Akun');

//         $message->to($to)->subject('Pesanan Anda');


//     });

// echo '<img src="'.QrCode::format('png')->generate('Embed me into an e-mail!').'">';
		// echo QrCode::format('png')->generate('Embed me into an e-mail!');
		$barcode= QrCode::size(200)->generate('Make me into a QrCode!');
;


// echo DNS1D::getBarcodeSVG("4445645656", "PHARMA2T");
// echo DNS1D::getBarcodeHTML("4445645656", "PHARMA2T");
// echo '<img src="data:image/png,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   />';
// echo DNS1D::getBarcodePNGPath("4445645656", "PHARMA2T");
// echo '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("4", "C39+") . '" alt="barcode"   />';
// echo ;
	}

	public function index(){


		// $this->sendToken();
		// $userid = session('userid');
		// $user = LoginMember::where('id',$userid)->first();
		$data = Event::all();
		$now = date('Y-m-d H:i:s');
		$event = Event::where('tanggal','>',$now)->first();
		// return $event;
		// echo "string";
		$date = str_replace('-', '/', $event->tanggal);
		return view('index',compact('data','event','date'));
	}

	public function show(Request $request,$name){
		if (empty(session('userid'))) {
			# code...
			// return redirect('/login');
			$explode = explode('-', $name);
			$id = end($explode);

			$data = Event::find($id);
			if (is_null($data)) {
				# code...
				$log = new Log;
				$url = url()->current();
				$log->log("User Mengakses Halaman ".$url,$sessid);
				abort(404);

			}
			$request->session()->put('eventid',$id);
			return view('detail',compact('data'));
		}
		else{
			$this->middleware('login-auth');
			$sessid = session('userid');

			$explode = explode('-', $name);
			$id = end($explode);

			$user = LoginMember::where('id',$sessid)->first();
			$data = Event::find($id);
			if (is_null($data)) {
				# code...
				$log = new Log;
				$url = url()->current();
				$log->log("User Mengakses Halaman ".$url,$sessid);
				abort(404);

			}
		$request->session()->put('eventid',$id);
		return view('detail',compact('data','user'));

		// return $data->group->kategori;
		// foreach ($data->group as $g) {
		// 	# code...
		// 	return $g->kategori;
		// }
		}

	}

	public function umur($tanggal_lahir){

    list($year,$month,$day) = explode("-",$tanggal_lahir);
    $year_diff  = date("Y") - $year;
    $month_diff = date("m") - $month;
    $day_diff   = date("d") - $day;
    if ($month_diff < 0) $year_diff--;
        elseif (($month_diff==0) && ($day_diff < 0)) $year_diff--;
    return $year_diff;
	}

	public function saveIdKategori(Request $request){

	$this->middleware('login-auth');
		$id = $request->id_kategori;

		$kategori = Kategori::find($id);
		$id_grup = $kategori->id_group;
		$grup = Group::find($id_grup);
		$nationality = $grup->nationality;
		$userid = session('userid');


		session('id_grup',$id_grup);

		$personal = PersonalDetail::where('id_login_member',$userid)->first();

		// if ($nationality == 1) {
		// 	if ($personal->nationality == $nationality) {
		// 		$state = "ok";
		// 	}
		// 	else{
		// 		$state = "failed";
		// 	}
		// }
		// else{
		// 	$state = "ok";
		// }


		if ($nationality == 1) {
			# code...
			if ($personal->nasionality == $nationality) {
				# code...
				// $response = [
				// 'success'=>true
				// ];
				$success= true;
				$message = "ok";
			}
			else{

				$success = false;
				$message = 'Warga Negara Harus Indonesia';
	// $response = [
	// 			'success'=>false,
	// 			'message'=>'Warga Negara Harus Indonesia'
	// 			];
			}
		}
		else{
	// $response = [
	// 			'success'=>true
	// 			];
			$success = true;
							$message = "ok";
		}
		if ($success==true) {
			# code...
			$ktp = $personal->foto_ktp;
			$medical = $personal->medical;

			// print_r($medical);
			// print_r($medical);
			if (is_null($ktp) || empty($medical->nama)) {
				$message = "KTP / Medical Belum diisi,Silahkan Cek Lagi Data";
				$success = false;
			}
			else{
				$umur = $this->umur($personal->tgl_lahir);
				$max = $kategori->usia_max;
				$min = $kategori->usia_min;
				if ($umur>$max) {
				$success = false;
						$message = "Usia Tidak Boleh Lebih dari ".$max." Tahun ";
				}
				elseif ($umur < $min) {

				$success = false;
						$message = "Usia Tidak Boleh Kurang dari ".$min." Tahun ";
				}
				else{
									$success = true;
								$message = "ok";
				}
			}
		}



		if ($success==true) {
			# code...
		$request->session()->put('kategori', $id);
		$request->session()->put('id_grup', $id_grup);
		return redirect('/checkout');
		}
		else{

		$request->session()->flash('danger',$message);
		return redirect()->back();
		// echo $message;

		}
		// $response = [
		// 'success'=>$success,
		// 'message'=>$message
		// ];
		// return $response;


		// echo $request->session()->get('kategori');

	}
	public function checkout(Request $request,$id=null){

	$this->middleware('login-auth');
if (empty(session('userid'))) {
	# code...
	return redirect('/login');
}
$user = LoginMember::find(session('userid'));
		if ($id!=null) {
			# code...
			if ($user->tipe_akun==0) {
				# code...


				$request->session()->forget('kategori');
		$request->session()->put('kategori', $id);
			
			return redirect('/checkout');
			}
			else{
							// echo "string";
			$event = Event::find($id);
		$kategori_id = $request->session()->get('kategori');
		$id_grup = $request->session()->get('id_grup');
		$kategori = Kategori::where('id',$kategori_id)->get();
		// $userid = session('userid');
		// $personal = PersonalDetail::where('id_login_member',$userid);
		// $id_event= $id;
		// $group = Group::where('id_event',$id_event);
		// $jersey = UkuranJersey::where('id_event',$id_event);
		// $id = $id_event;

			if (count($event)==0) {
				# code...
				return abort(404);
			}
			else{

				$request->session()->forget('ids');
				// return $kategori;
				return view('/checkout-multi',compact('group','personal','kategori','kategori_id','jersey','id','event','user'));

			}
			$eventid = null;
			}
		}
		else{
		$id_grup = $request->session()->get('id_grup');
		$kategori = Kategori::where('id_group',$id_grup);
		if ($kategori->count()==0) {
			// echo "string";
			return abort(404);
			# code...
		}
		else{
		$userid = session('userid');
		$personal = PersonalDetail::where('id_login_member',$userid);
		// print_r($kategori->get()->take(1));
		// $id_event= $kategori->get()[0]->group->id_event;
		// $
		$id_event = session('eventid');
		// Group 
		// $id_event = 
		$group = Group::where('id_event',$id_event);
		$jersey = UkuranJersey::where('id_event',$id_event);
		$id = $id_event;
		$user= LoginMember::where('id',session('userid'))->first();

			$eventid = $id_event;

		$personal = PersonalDetail::where('id_login_member',$user->id);
		if ($personal->count() != 0) {
			$personal = $personal->first();
		}
		else{

			$personal = null;
		}


		// $kota = Kota::all();
		// $negara = Negara::all();

		$emergency = EmergencyMedical::where('id_personal_detail',$personal->id);

 // echo $personal->first();
		// return view('personal/detail',compact('personal','kota','negara','id','emergency'));

// print_r($request->session()->all());
		// echo $personal->first()->id;
		// echo $personal;

		  $earlyBird = EarlyBird::where('id_grup',session('id_grup'));

  if($earlyBird->count()>0){
	    $kategori = Kategori::where('id_group', $earlyBird->first()->id_grup)->first();
	  	$dibeli = DB::select("SELECT count(*) as count FROM `detail_transaction_id_event` a inner join transaction_id_event b on b.id = a.id_transaction where a.id_kategori ='".$kategori->id."' and b.status_bayar='1'");

	    $tgl_awal = $earlyBird->first()->tgl_awal;
	    $tgl_akhir = $earlyBird->first()->tgl_akhir;

	    $count = $dibeli;
	    $count = $count[0]->count;

	    $kuota = $earlyBird->first()->kuota;
    	if($count < $kuota){
    		if(!is_null($tgl_awal) && !is_null($tgl_akhir)) {
    			if((time() > strtotime($tgl_awal)) && (time() < strtotime($tgl_akhir))) {
			    	$harga= $earlyBird->first()->harga;
    	  			$state = "EARLY BIRD";
			    } else {
			    	$harga = $kategori->first()->harga;
           			$state = "";   
			    }
    		} else {
    	  		$harga= $earlyBird->first()->harga;
    	  		$state = "EARLY BIRD";
    		}
    	}else{
          $harga = $kategori->first()->harga;
           $state = "";   
        }
  } else {
        $harga = $kategori->first()->harga;
        $state = ""; 
  }

  $event = Event::find(session('eventid'));

// echo $group->get();
  // echo $kategori->get();

  $kategori = Kategori::where('id_group',session('id_grup'));
		return view('/checkout',compact('group','personal','kategori','kategori_id','jersey','id','user','emergency','eventid','harga','event','state'));			

// echo session('kategori');
  // return Kategori::where('id_group',41)->get();
		}

		}
	}


	public function checkoutMulti($request){
		// echo "string";


	}

public function checkoutPost(Request $request){
	// return $request;
	$this->middleware('login-auth');
	// print_r($request->all());
if (empty(session('userid'))) {
	# code...
	$request->session()->flash('danger','Untuk Membeli Anda Harus Login Terlebih dahulu');
			$log = new Log;
			$url = url()->current();
			$ip = $request->ip();
			// $sessid = session('userid');

			$log->log("User Tidak Bisa Membeli Belum Login | URL = ".$url,null);

	return redirect('/login');
}
else{

	// print_r($request->all());
	$user = LoginMember::where('id',session('userid'))->first();

	$diskon = $request->diskon;
	$total_harga = $request->jumlah_total;

	$transactionCode = Transaction::max('id');

	$eventid = $request->eventid;
	// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($transactionCode, 3, 3);

$noUrut++;
$char = date('m');
$code = $char . sprintf("%04s", $noUrut);
	$kategori = $request->kategori;
 $total = $request->total;
 $partisipan = $request->partisipan;
 $diskon= $request->id_diskon;


	$unique = mt_rand(100,999); 


	if ($user->tipe_akun=='1') {
	$partisipan = $request->partisipan;;
	$jersey = $request->jersey;
	$jml_total  = count($partisipan) * $total;
	$id_kategori = $request->id_kategori;
	$harga = $request->harga;
	$nama_bib = $request->nama_bib;
// echo $code;

	$error = false;
	foreach ($partisipan as $value) {
		if($value == '') {
			$error = true;
		}
	}

	if($error) {
		return back()->with('danger', 'Maaf ada partisipan yang belum terdaftar dalam dashboard komunitas.');
	}

	$jml = 0;
	for ($i=0; $i < count($partisipan); $i++) { 
		$part = $partisipan[$i];
		$jers = $jersey[$i];
		$harg = $harga[$i];
		$kat = $id_kategori[$i];
		$jml += $harg;
		$nm_bib = $nama_bib[$i];

	$formParticipant = new FormParticipant;
	$formParticipant->id_personal_detail = $part;
	$formParticipant->nama_bib = $nm_bib;
	$formParticipant->id_ukuran_jersey = $jers;
	$formParticipant->save();

	$detailTransaction = new DetailTransaction;
	$detailTransaction->id_transaction = $code;

	$detailTransaction->id_form_participant = $formParticipant->id;
	$detailTransaction->id_kategori = $kat;
	$detailTransaction->harga = $harg;
	$detailTransaction->save();




		# code...

	}


// echo $unique;
	$transaction = new Transaction;
	$transaction->id = $code;
	$transaction->id_event = $eventid;
	$transaction->jumlah_total = $total_harga;
	$transaction->diskon = $diskon;
	$transaction->tgl_transaksi = date('Y-m-d H:i:s');
	$transaction->validasi_no =  $unique;
	$transaction->id_login_member =  session('userid');
	$transaction->harga_akhir = $total_harga+$unique;
$transaction->keterangan_bank='-';
	$transaction->save();

	// $tr = Transaction::find($code);
	// $event = Event::find($eventid);

	// $tr->keterangan_bank = "-";
	// $tr->save();



	}
	else{
$jml_total = $request->total;
	$total = $request->jumlah_total;
	$diskon = $request->id_diskon;

		$personal = PersonalDetail::where('id_login_member',$user->id)->first();
		$part = $personal->id;
		$jers = $request->jersey;
		$nm_bib = $request->nama_bib;


	$formParticipant = new FormParticipant;
	$formParticipant->id_personal_detail = $part;
	$formParticipant->id_ukuran_jersey = $jers;
	$formParticipant->nama_bib = $nm_bib;
	$formParticipant->save();

	$detailTransaction = new DetailTransaction;
	$detailTransaction->id_transaction = $code;
	$detailTransaction->id_form_participant = $formParticipant->id;
	$detailTransaction->id_kategori = $kategori;
	$detailTransaction->harga = $jml_total;
	$detailTransaction->save();




		# code...



// echo $unique;

	$transaction = new Transaction;
	$transaction->id = $code;

	$transaction->id_event = $eventid;
	$transaction->jumlah_total = $total;
	$transaction->diskon = $diskon;
	$transaction->tgl_transaksi = date('Y-m-d H:i:s');
	$transaction->validasi_no =  $unique;
	$transaction->keterangan_bank='-';
	$transaction->harga_akhir = $total+$unique;
	$transaction->id_login_member =  session('userid');
	$transaction->save();





	}


			$log = new Log;
			$url = url()->current();
			$sessid = session('userid');
			$log->log("User Checkout Transaksi #".$code,$sessid);


	$detailTransaction = DetailTransaction::where('id_transaction',$code);

			# code...
			$detail = $detailTransaction->first();
			$formParticipant = $detail->id_form_participant;
			$kategori = $detail->id_kategori;
// echo "string";
	$detailTransaction = DetailTransaction::where('id_transaction',$code);

			# code...
			$detail = $detailTransaction->first();
			$formParticipant = $detail->id_form_participant;
			$kategori = $detail->id_kategori;
// echo "string";
			$transaction = Transaction::where('id',$code);
			// echo "string";
			// print_r($transaction->count());
					$dt = DetailTransaction::where('id_transaction',$code);




			$early = strlen($request->early);

		
		$total = $dt->sum('harga');

		// $code = $transaction->first()-;
		$event = Event::find($transaction->first()->id_event);
		$subject = 	'[#'.$code.'] Pending Payment ATM Transfer FOR '.$event->nama;

		$userdata = LoginMember::where('id',$transaction->first()->id_login_member)->first();

			$to = $userdata->email;


		$id_event = $transaction->first()->id_event;
		$rekening =  Rekening::where('id_event',$id_event);
		// return $rekening->first();
		$rekening = $rekening->first();


	Mail::send('email.invoice', ['rekening'=>$rekening,'transaction'=>$transaction,'detail'=>$detail,'dt'=>$dt,'total'=>$total,'early'=>$early], function ($message)use(&$to,&$subject) {

        $message->from('no-reply@tripleasport.com', 'Triple A Sport Management');

        $message->to($to)->subject($subject);

    });

	$trx            = $transaction->first();
	$personalDetail = $trx->personal->first()->formParticipant->personalDetail;
	$email          = $trx->user->email;
	$no_hp          = $trx->user->nohp;
	$nama           = $personalDetail->nama_awal . ' ' . $personalDetail->nama_akhir;
	$invoice        = '#' . strtoupper(substr($trx->event->nama, 0, 2)) . '-' . $trx->id;
	$event          = $trx->event;
	$harga_akhir    = $trx->harga_akhir;
	$rekening       = $trx->event->rekening;
	$tenggat        = date('d-m-Y h:i:s', $expired_time);

    $notifikasi = Notifikasi::where('id_event', $trx->event->id)->where('kategori', 'invoice')->first();
	$pesan      = str_replace('{NAMA}', $nama, $notifikasi->isi_pesan);
	$pesan      = str_replace('{KODE_INVOICE}', $invoice, $pesan);
	$pesan      = str_replace('{TGL_KADALUARSA}', $tenggat, $pesan);
	$pesan      = str_replace('{HARGA_AKHIR}', number_format($harga_akhir, 0, ',', '.'), $pesan);
	$pesan      = str_replace('{NAMA_BANK}', $rekening->bank->nama_bank, $pesan);
	$pesan      = str_replace('{NOREK}', $rekening->no_rekening, $pesan);
	$pesan      = str_replace('{ATAS_NAMA}', $rekening->nama_pemilik, $pesan);
	
	$this->sms($no_hp, $pesan);



	$request->session()->flash('success','Berhasil Melakukan Transaksi');
	return redirect('/trx/'.$code);

}



}
	public function total($id){

	$this->middleware('login-auth');
		$kategori = Kategori::find($id);
		$id_grup = $kategori->id_group;



		  $earlyBird = EarlyBird::where('id_grup',$id_grup);
  if($earlyBird->count()>0){
    $dibeli = DB::select("SELECT count(*) as count FROM `detail_transaction_id_event` a inner join transaction_id_event b on b.id = a.id_transaction where a.id_kategori ='".$id."' and b.status_bayar='1'");
    $count = $dibeli;
    $count = $count[0]->count;
    $kuota = $earlyBird->first()->kuota;
    // echo $kuota;
    if($count < $kuota){
    	  $harga= $earlyBird->first()->harga;
    	  $state = "EARLY BIRD";
    }
    else{
          $harga = $kategori->harga;
           $state = "";   
           }

  }
  else{
          $harga = $kategori->harga;
           $state = "";   

  }
// echo $harga;
		$response = [
		'id'=>$kategori->id,
		'id_group'=>$kategori->group[0]->id,
		'id_event'=>$kategori->group[0]->event->id,
		'harga'=>$harga,
		'kuota'=>$kategori->kuota

		];

		return $response;
// return $kategori;
	}

	public function trx($id){

	$this->middleware('login-auth');
			$transaction = Transaction::where('id',$id);

			$loginid = session('userid');
			if ($transaction->count() ==0) {
				# code...
				$log = new Log;
				$url = url()->current();
				$log->log("User Tidak Menemukan Data Invoice URL=".$url,$loginid);
				return abort(404);
			}
			else{

			$userid = $transaction->first()->id_login_member;


			if ($userid != $loginid) {
				# code...

				$log = new Log;
								$url = url()->current();
				$log->log("User Membuka Invoice Lain URL=".$url,$loginid);
				return abort(404);
			}
			else{
						// echo $detailTransaction->count();

			$detailTransaction = DetailTransaction::where('id_transaction',$id);

		// if ($detailTransaction->count()>0) {
			# code...
			$detail = $detailTransaction->first();
			$formParticipant = $detail->id_form_participant;
			$kategori = $detail->id_kategori;
// echo "string";
			// echo "string";
		$dt = DetailTransaction::where('id_transaction',$id);

		$total = $detailTransaction->sum('harga');
			// print_r($transaction->count());
		// echo $total;

		$eventid = $transaction->first()->id_event;
		// echo $eventid;
		$event = Event::find($eventid);
			return view('trx',compact('transaction','detailTransaction','detail','dt','total','event'));

			}

			}

		// }
		// else{
		// 	echo "string";
		// }


	}

	public function invoice($id){

	$this->middleware('login-auth');
				$transaction = Transaction::where('id',$id);

			$loginid = session('userid');
			if ($transaction->count() ==0) {
				# code...
				$log = new Log;
				$log->log("User Tidak Menemukan Data Invoice",$loginid);
				return abort(404);
			}
			else{

			$userid = $transaction->first()->id_login_member;


			if ($userid != $loginid) {
				# code...

				$log = new Log;
				$log->log("User Membuka Invoice Lain",$loginid);
				return abort(404);
			}
			else{
						// echo $detailTransaction->count();
			$detailTransaction = DetailTransaction::where('id_transaction',$id);

		// if ($detailTransaction->count()>0) {
			# code...
			$detail = $detailTransaction->first();
			$formParticipant = $detail->id_form_participant;
			$kategori = $detail->id_kategori;
// echo "string";
			// echo "string";
		$dt = DetailTransaction::where('id_transaction',$id);

		$total = $detailTransaction->sum('harga');
			// print_r($transaction->count());
		// echo $total;
		// echo $transaction->first();
		$id_event = $transaction->first()->id_event;
		$rekening =  Rekening::where('id_event',$id_event);
		// return $rekening->first();
		$rekening = $rekening->first();
			return view('invoice/invoice',compact('transaction','detail','dt','total','rekening'));

			}

			}
	}

	public function profile(){

		// $this->middleware('login-auth');
		if(empty(session('userid'))){
			return redirect('/login');
		}
		else{
			$userid = session('userid');
		$user = LoginMember::where('id',$userid)->first();
		return view('profile',compact('user'));
		}
	
	}

	public function profileUpdate(Request $request){
		// print_r($request->all());

	$this->middleware('login-auth');
		$email = $request->email;
		$password = $request->password;
		$tipe_akun = $request->tipe_akun;
		$no_hp = $request->no_hp;
		$komunitas = $request->komunitas;
		$jml = $request->jml;

		$id = session('userid');

		$user = LoginMember::find($id);
		$user->email = $email;
		if (!empty($password)) {
			# code...
		$user->password = bcrypt($password);
		}
		$user->tipe_akun = $tipe_akun;
		$user->nohp = '+62' . $no_hp;
		$user->jml_personal = $jml;
		$user->komunitas = $komunitas;
		$save  = $user->save();
		if ($save) {
			
			$log = new Log;
			$url = url()->current();
			$ip = $request->ip();
			$sessid = session('userid');

			$log->log("User Mengubah PersonalDetail ".$id." | userid = ".$sessid,null);

			$request->session()->flash('success','Profil Telah Diperbaharui');
		}
		else{
			$log = new Log;
			$url = url()->current();
			$ip = $request->ip();
			$sessid = session('userid');

			$log->log("User Gagal Mengubah Data PersonalDetail ".$id." | userid = ".$sessid,null);

			$request->session()->flash('danger','Profil Gagal Diperbaharui');
		}
		return redirect()->back();

	}

	public function tambahPartisipan($id_event,Request $request){

	$this->middleware('login-auth');
		$id = session('userid');
		if (empty($request->session()->all()['ids'])) {
			# code...
		$partisipan = PersonalDetail::where('id_login_member',$id);
		}
		else{
		$ids = $request->session()->all()['ids'];
		$partisipan = PersonalDetail::where('id_login_member',$id)->whereNotIn('id',$ids);

		}

		$eventid = session('eventid');
		$kategori = DB::select("SELECT kategori.harga,kategori.nama,kategori.id as id_kategori,kategori.usia_min,kategori.usia_max,group.nama as grup FROM `kategori` inner join `group` on kategori.id_group = group.id inner join event on group.id_event = event.id
WHERE event.id='".$eventid."'
");
  
		// $kategori = Kategori::where('id_group',$id_event);
		$jersey = UkuranJersey::where('id_event',$id_event);


		// return $partisipan->get();
			// print_r($ids);

// 			$products = session()->pull('ids', []); // Second argument is a default value
// if(($key = array_search(2, $products)) !== false) {
//     unset($products[$key]);
// }
// session()->put('ids', $products);
			// $request->session()->forget('arr.id',2);
		// echo "string";
		// return $kategori->get();
		// return $kategori;
		// foreach ($kategori as $k) {
		// 	# code...
		// 	// echo $k;
		// 	print_r($k->nama);
		// }
		return view('partisipan/tambah',compact('partisipan','jersey','kategori'));
	}



	public function kodeDiskon(Request $request){

	$this->middleware('login-auth');
		$id_event = $request->id_event;
		$total = $request->total;
		$kode_diskon = $request->diskon;
		$diskon = Diskon::whereRaw("BINARY kode=?",[$kode_diskon])->where(['id_event'=>$id_event]);
		if ($diskon->count() > 0) {
			$data= $diskon->first();
			$data = [
			'kode'=>$kode_diskon,
			'diskon_int'=>$data->potongan,
			'diskon_type'=>$data->jenis,
			'id'=>$data->id,
			'diskon'=>  $data->jenis==1 ? 'Rp. '.number_format($data->potongan,2,',','.') : $data->potongan.' %',
			'potongan'=> $data->jenis==1 ? $data->potongan : ($data->potongan/100) * $total
			];
			$json = [
			'status'=>'ok',
			'data'=>$data
			];


			$log = new Log;
			$url = url()->current();
			$ip = $request->ip();
			$sessid = session('userid');

			$log->log("User Memasukan Kode Voucher ".$kode_diskon." | userid = ".$sessid,null);

		}
		else{
			$json = [
			'status'=>'null',
			'data'=>null
			];
		}

		return $json;

	}

	public function daftarTransaksi(){

	// $this->middleware('login-auth');
		if(empty(session('userid'))){
			return redirect('/login');
		}
		else{

		$userid = session('userid');
		$transaksi = Transaction::where('id_login_member',$userid)->orderBy('tgl_transaksi','desc')->get();
		return view('list-transaksi',compact('transaksi'));	
		}
	}
	public function provinsi(Request $request){

	$this->middleware('login-auth');
		$id = $request->id;
		$data= Provinsi::all();

		if (count($data)>0) {
		$arr = [];
		foreach ($data as $d) {
			# code...
			$arr[] = [
			'id'=>$d->id,
			'provinsi'=>$d->nama,
			'selected'=>	!empty($id) ? ($id==$d->id ? true : false) : false
			];
		}
		$status = 'ok';
		$data = $arr;

		}
		else{
			$status = null;
			$data = null;
		}

		return [
		'status'=>$status,
		'data'=>$arr
		];


	}

	public function cariKota(Request $request){

	$this->middleware('login-auth');
		$provinsi=$request->id_provinsi;
		$id  = $request->v;
		$kota = Kota::where('id_provinsi',$provinsi);

		if ($kota->count() >0) {

			$arr = [];

			foreach ($kota->get() as $k) {
				$arr[] = [
				'id'=>$k->id,
				'nama'=>$k->nama,
				'selected'=>$k->id==$id ? true: false
				];
			}
			return [
			'status'=>'ok',
			'data'=>$arr
			];
		}
		else{
			return [
			'status'=>null,
			'data'=>null
			];
		}


	}

	public function nik(Request $request){
		
	$this->middleware('login-auth');
		$nik = $request->nik;
		$n =  $request->n;
		$personal = PersonalDetail::where('nik',$nik);

		if ($n==$nik) {
			return [
			'status'=>'ok'
			];
			# code...
		}
		else{
		if ($personal->count()==0) {
			return [
			'status'=>'ok'
			];
		}
		else{

			return [
			'status'=>null
			];

		}			
		}

	}

	public function daftarPeserta() {
		$events = Event::where('tanggal', '>', 'NOW()')->get();

		return view('daftar-peserta', compact('events'));
	}

	public function eventPeserta($id) {
		// $peserta = DB::select('SELECT b.*
		// 						FROM detail_transaction_id_event a 
		// 						INNER JOIN form_participant_id_event b ON b.id = a.id_form_participant
		// 						INNER JOIN personal_detail c ON c.id = b.id_personal_detail
		// 						INNER JOIN transaction_id_event d ON d.id = a.id_transaction
		// 						WHERE d.id_event = "' . $id . '"');

		// $peserta = DB::select('SELECT b.id, d.nama_awal, d.nama_akhir, e.komunitas
		// 						FROM transaction_id_event a
		// 						INNER JOIN detail_transaction_id_event b ON b.id_transaction = a.id
		// 						INNER JOIN form_participant_id_event c ON c.id = b.id_form_participant
		// 						INNER JOIN personal_detail d ON d.id = c.id_personal_detail
		// 						INNER JOIN login_member e ON e.id = d.id_login_member
		// 						WHERE 
		// 							a.id_event = "' . $id . '"
		// 							AND a.status_bayar = 1');

		$peserta = DB::select("SELECT * from detail_transaction_id_event a 
								inner join transaction_id_event b on a.id_transaction = b.id 
								INNER JOIN form_participant_id_event c on a.id_form_participant = c.id 
								INNER JOIN personal_detail d on c.id_personal_detail = d.id 
								inner join ukuran_jersey e ON c.id_ukuran_jersey = e.id 
								LEFT JOIN login_member f ON f.id = d.id_login_member
								where b.id_event='$id' and b.status_bayar='1'");

		return response()->json($peserta);
	}

	public function sms($nohp, $pesan)
    {
        $sms = [
            'nohp' => $nohp,
            'pesan' => $pesan
        ];
         
        // Prepare dan Konfigurasi
        $baseUrl = 'https://reguler.zenziva.net/apps/smsapi.php';
        $config = [
            'userkey' => 'vin7tp',
            'passkey' => 'jlrzuhqd3d'
        ];
        $params = array_merge($config, $sms);
        $uri = $baseUrl . '?' . http_build_query($params);
         
        // Kirim HTTP GET
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_URL, $uri);
        $result = curl_exec($curl);
         
        // Tampilkan Hasil/Response dari Zenziva
        header('Content-type: application/xml');
        return $result;
    }
}