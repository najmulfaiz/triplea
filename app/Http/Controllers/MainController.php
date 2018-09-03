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

	public function show($name){
		if (empty(session('userid'))) {
			# code...
			return redirect('/login');
		}
		else{
		$this->middleware('login-auth');
		$sessid = session('userid');


		$explode = explode('-', $name);
		$id = end($explode);

		// echo $id;

		// print_r($explode);


// echo $id;
		$user = LoginMember::where('id',$sessid)->first();
		$data = Event::find($id);
		if (is_null($data)) {
			# code...
			$log = new Log;
			$url = url()->current();
			$log->log("User Mengakses Halaman ".$url,$sessid);
			abort(404);
			// echo url()->current();

		}
		return view('detail',compact('data','user'));
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
				$max = 10;
				if ($umur>$max) {
				$success = false;
						$message = "Usia Tidak Boleh Lebih dari ".$max." Tahun ";
				}
				else{
									$success = false;
								$message = "ok";
				}
			}
		}



		if ($success==true) {
			# code...
		$request->session()->put('kategori', $id);
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
					// $kategori_id = $request->session()->get('kategori');
		// $kategori = Kategori::where('id',$kategori_id);
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
				return view('/checkout-multi',compact('group','personal','kategori','kategori_id','jersey','id','event'));

			}
			$eventid = null;
			}
		}
		else{
		$kategori_id = $request->session()->get('kategori');
		$kategori = Kategori::where('id',$kategori_id);
		if ($kategori->count()==0) {
			// echo "string";
			return abort(404);
			# code...
		}
		else{
		$userid = session('userid');
		$personal = PersonalDetail::where('id_login_member',$userid);
		$id_event= $kategori->first()->group->id_event;
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
		return view('/checkout',compact('group','personal','kategori','kategori_id','jersey','id','user','emergency','eventid',''));			
		}

		}
	}


	public function checkoutMulti($request){
		// echo "string";


	}

public function checkoutPost(Request $request){

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

			// return view('invoice/invoice',compact('transaction','detail','dt'));
		// }

		// else{
		// 	echo "string";
		// }



		
		$total = $dt->sum('harga');

		// $code = $transaction->first()-;
		$event = Event::find($transaction->first()->id_event);
		$subject = 	'[#'.$code.'] Pending Payment ATM Transfer FOR '.$event->nama;

		$userdata = LoginMember::where('id',$transaction->first()->id_login_member)->first();

			$to = $userdata->email;
Mail::send('email.invoice', ['transaction'=>$transaction,'detail'=>$detail,'dt'=>$dt,'total'=>$total], function ($message)use(&$to,&$subject) {

        $message->from('no-reply@tripleasport.com', 'Triple A Sport Management');

        $message->to($to)->subject($subject);


    });



	$request->session()->flash('success','Berhasil Melakukan Transaksi');
	return redirect('/trx/'.$code);

}



}
	public function total($id){

	$this->middleware('login-auth');
		$kategori = Kategori::find($id);

		$response = [
		'id'=>$kategori->id,
		'id_group'=>$kategori->group->id,
		'id_event'=>$kategori->group->event->id,
		'harga'=>$kategori->harga,
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
			return view('trx',compact('transaction','detailTransaction','detail','dt','total'));

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
			return view('invoice/invoice',compact('transaction','detail','dt','total'));

			}

			}
	}

	public function profile(){

	$this->middleware('login-auth');
		$userid = session('userid');
		$user = LoginMember::where('id',$userid)->first();
		return view('profile',compact('user'));
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
		$user->nohp = $no_hp;
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

		$kategori = Group::where('id_event',$id_event);
		$jersey = UkuranJersey::where('id_event',$id_event);;


		// return $partisipan->get();
			// print_r($ids);

// 			$products = session()->pull('ids', []); // Second argument is a default value
// if(($key = array_search(2, $products)) !== false) {
//     unset($products[$key]);
// }
// session()->put('ids', $products);
			// $request->session()->forget('arr.id',2);
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

	$this->middleware('login-auth');
		$userid = session('userid');
		$transaksi = Transaction::where('id_login_member',$userid)->orderBy('tgl_transaksi','desc')->get();
		return view('list-transaksi',compact('transaksi'));
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
}