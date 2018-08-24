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

class MainController extends Controller
{

	public function __construct()
	{
		// parent::__construct();
		
	}
	public function index(){


		// $this->sendToken();
		// $userid = session('userid');
		// $user = LoginMember::where('id',$userid)->first();
		$data = Event::all();
		return view('index',compact('data'));
	}

	public function show($id){
		if (empty(session('userid'))) {
			# code...
			return redirect('/login');
		}
		else{
					             $this->middleware('login-auth');

		$sessid = session('userid');
		$user = LoginMember::where('id',$sessid)->first();
		$data = Event::find($id);
		return view('detail',compact('data','user'));
		}

	}

	public function saveIdKategori(Request $request){
		$id = $request->id_kategori;

		$request->session()->put('kategori', $id);

		// echo $request->session()->get('kategori');
		return redirect('/checkout');

	}
	public function checkout(Request $request,$id=null){
if (empty(session('userid'))) {
	# code...
	return redirect('/login');
}
		if ($id!=null) {
			# code...
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


					return view('/checkout-multi',compact('group','personal','kategori','kategori_id','jersey','id','event'));
		}
		else{
					$kategori_id = $request->session()->get('kategori');
		$kategori = Kategori::where('id',$kategori_id);
		$userid = session('userid');
		$personal = PersonalDetail::where('id_login_member',$userid);
		$id_event= $kategori->first()->group->id_event;
		$group = Group::where('id_event',$id_event);
		$jersey = UkuranJersey::where('id_event',$id_event);
		$id = $id_event;
		$user= LoginMember::where('id',session('userid'))->first();



		$personal = PersonalDetail::where('id_login_member',$user->id);
		if ($personal->count() != 0) {
			$personal = $personal->first();
		}
		else{

			$personal = null;
		}


		// $kota = Kota::all();
		// $negara = Negara::all();

		$emergency = EmergencyMedical::where('id_personal_detail',$personal->first()->id);

 // echo $personal->first();
		// return view('personal/detail',compact('personal','kota','negara','id','emergency'));


		return view('/checkout',compact('group','personal','kategori','kategori_id','jersey','id','user','emergency'));
		}
	}


	public function checkoutMulti($request){
		// echo "string";


	}

public function checkoutPost(Request $request){
	// print_r($request->all());
if (empty(session('userid'))) {
	# code...
	$request->session()->flash('danger','Untuk Membeli Anda Harus Login Terlebih dahulu');
	return redirect('/login');
}
else{

	// print_r($request->all());
	$user = LoginMember::where('id',session('userid'))->first();

	$diskon = $request->diskon;
	$total_harga = $request->jumlah_total;

	$transactionCode = Transaction::max('id');
	// misal 'BRG001', akan diambil '001'
// setelah substring bilangan diambil lantas dicasting menjadi integer
$noUrut = (int) substr($transactionCode, 3, 3);

$noUrut++;
$char = date('m');
$code = $char . sprintf("%04s", $noUrut);
	$kategori = $request->kategori;
 $total = $request->total;
 $partisipan = $request->partisipan;


	$unique = mt_rand(1000,9999); 


	if ($user->tipe_akun=='1') {
	$partisipan = $request->partisipan;;
	$jersey = $request->jersey;
	$jml_total  = count($partisipan) * $total;
	$id_kategori = $request->id_kategori;
	$harga = $request->harga;
// echo $code;

	$jml = 0;
	for ($i=0; $i < count($partisipan); $i++) { 
		$part = $partisipan[$i];
		$jers = $jersey[$i];
		$harg = $harga[$i];
		$kat = $id_kategori[$i];
		$jml += $harg;

	$formParticipant = new FormParticipant;
	$formParticipant->id_personal_detail = $part;
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
	$transaction->jumlah_total = $total_harga;
	$transaction->diskon = $diskon;
	$transaction->tgl_transaksi = date('Y-m-d H:i:s');
	$transaction->validasi_no =  $unique;
	$transaction->harga_akhir = $total_harga+$unique;
	$transaction->save();


	}
	else{
$jml_total = $request->total;
	$total = $request->jumlah_total;
	$diskon = $request->diskon;

		$personal = PersonalDetail::where('id_login_member',$user->id)->first();
		$part = $personal->id;
		$jers = $request->jersey;


	$formParticipant = new FormParticipant;
	$formParticipant->id_personal_detail = $part;
	$formParticipant->id_ukuran_jersey = $jers;
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
	$transaction->jumlah_total = $total;
	$transaction->diskon = $diskon;
	$transaction->tgl_transaksi = date('Y-m-d H:i:s');
	$transaction->validasi_no =  $unique;
	$transaction->harga_akhir = $total+$unique;
	$transaction->save();





	}



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

		$userdata = LoginMember::where('id',session('userid'))->first();

			$to = $userdata->email;
$mail=    Mail::send('invoice.invoice', ['transaction'=>$transaction,'detail'=>$detail,'dt'=>$dt,'total'=>$total], function ($message)use(&$to) {

        $message->from('fariswidhiarta123@gmail.com', 'Verifikasi Akun');

        $message->to($to)->subject('Pesanan Anda');


    });


// 	$transactionCode = Transaction::max('id');
// 	// misal 'BRG001', akan diambil '001'
// // setelah substring bilangan diambil lantas dicasting menjadi integer
// $noUrut = (int) substr($transactionCode, 3, 3);

// $noUrut++;
// $char = date('m');
// $code = $char . sprintf("%04s", $noUrut);
	
// 	$userid = session('userid');

// 	$personalDetail = PersonalDetail::where('id_login_member',$userid);

// 	$jersey = $request->jersey;
// 	foreach ($personalDetail->get() as $p) {
// 	$formParticipant = new FormParticipant;
// 	$formParticipant->id_personal_detail = $p->id;
// 	$formParticipant->id_ukuran_jersey = $jersey;
// 	$formParticipant->save();

// 	}

 // echo $total;
// 	$unique = date('h').date('i')+date('s');

// 	// echo $total+$unique;

// 	$transaction = new Transaction;
// 	$transaction->id = $code;
// 	$transaction->jumlah_total = $total;
// 	$transaction->diskon = 0;
// 	$transaction->tgl_transaksi = date('Y-m-d H:i:s');
// 	$transaction->validasi_no =  $unique;
// 	$transaction->harga_akhir = $total+$unique;
// 	$transaction->save();


// 	$kategori = $request->kategori;
// 	$detailTransaction = new DetailTransaction;
// 	$detailTransaction->id_transaction = $code;
// 	$detailTransaction->id_form_participant = $formParticipant->id;
// 	$detailTransaction->id_kategori = $kategori;
// 	$detailTransaction->harga = $total;
// 	$detailTransaction->save();

	$request->session()->flash('success','Berhasil Melakukan Transaksi');
	return redirect('/trx/'.$code);
// echo $kodeBarang;

	// echo $tran;
	// print_r($transactionCode);

}



}
	public function total($id){

		$kategori = Kategori::find($id);

		return $kategori;

	}

	public function trx($id){

		$detailTransaction = DetailTransaction::where('id_transaction',$id);


		// echo $detailTransaction->count();
		if ($detailTransaction->count()>0) {
			# code...
			$detail = $detailTransaction->first();
			$formParticipant = $detail->id_form_participant;
			$kategori = $detail->id_kategori;
// echo "string";
			$transaction = Transaction::where('id',$id);
			// echo "string";
		$dt = DetailTransaction::where('id_transaction',$id);

		$total = $detailTransaction->sum('harga');
			// print_r($transaction->count());
		// echo $total;
			return view('trx',compact('transaction','detailTransaction','detail','dt','total'));
		}
		else{
			echo "string";
		}


	}

	public function invoice($id){

		$detailTransaction = DetailTransaction::where('id_transaction',$id);
		if ($detailTransaction->count()>0) {
			# code...
			$detail = $detailTransaction->first();
			$formParticipant = $detail->id_form_participant;
			$kategori = $detail->id_kategori;
// echo "string";
			$transaction = Transaction::where('id',$id);
			// echo "string";
			// print_r($transaction->count());
					$dt = DetailTransaction::where('id_transaction',$id);

		$total = $detailTransaction->sum('harga');
			return view('invoice/invoice',compact('transaction','detail','dt','total'));
		}
		else{
			echo "string";
		}
	}

	public function profile(){
		$userid = session('userid');
		$user = LoginMember::where('id',$userid)->first();
		return view('profile',compact('user'));
	}

	public function profileUpdate(Request $request){
		// print_r($request->all());
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
			$request->session()->flash('success','Profil Telah Diperbaharui');
		}
		else{

			$request->session()->flash('danger','Profil Gagal Diperbaharui');
		}
		return redirect()->back();

	}

	public function tambahPartisipan($id_event){
		$id = session('userid');
		$partisipan = PersonalDetail::where('id_login_member',$id);
		$kategori = Group::where('id_event',$id_event);
		$jersey = UkuranJersey::where('id_event',$id_event);

		// return $kategori->get();
		return view('partisipan/tambah',compact('partisipan','jersey','kategori'));
	}



	public function kodeDiskon(Request $request){
		$kode_diskon = $request->diskon;
		$diskon = Diskon::whereRaw("BINARY kode=?",[$kode_diskon]);
		if ($diskon->count() > 0) {
			$data= $diskon->first();
			$json = [
			'status'=>'ok',
			'data'=>$data
			];
		}
		else{
			$json = [
			'status'=>'null',
			'data'=>null
			];
		}

		return $json;

	}
}