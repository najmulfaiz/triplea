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
class ApiController extends Controller
{
	public function cekPartisipan(Request $request){
		$id = $request->id;
		$pid = $request->pid;

		$personal = PersonalDetail::find($pid);
		$group = Group::find($id);

		$id_nationality = $group->nationality;
		$nasionality = $personal->nasionality;



		if ($id_nationality == 1) {
			# code...
			if ($nasionality == $id_nationality) {
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
			$succces = true;
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
				$success = true;
								$message = "ok";
			}
		}

		$response = [
		'success'=>$success,
		'message'=>$message
		];
		return $response;
		// return $personal;

	}
	
	public function detailTransaksi(Request $request){
		// $str = "2018-08-30|1|08982382323";
		$id = $request->trx;
		$decode = base64_decode($id);
		// echo $decode;
		$explode = explode('|', $decode);

// print_r($explode);
		// echo count($explode);
		if (count($explode)==3) {
			# code...
			$tgl = $explode[0];
			$event = $explode[1];
			$hp = $explode[2];

			$loginMember = LoginMember::where('nohp',$hp);

			if ($loginMember->count()==0) {
				# code...
				$status ="failedx";
				$data =null;

			}

			else{
// $this->middleware('login-auth');
			$userid = $loginMember->first()->id;
			$tgl = date('Y-m-d',strtotime($tgl));

			$tr = Transaction::whereDate('tgl_transaksi',$tgl)->where('id_event',$event)->where('id_login_member',$userid);

			if ($tr->count() == 0) {

				$status ="failed";
				$data =null;
				
			}
			else{

			$id = $tr->first()->id;
			$transaction = Transaction::find($id);

			$loginid = session('userid');
			if (count($transaction) ==0) {
				# code...
				// $log = new Log;
				// $url = url()->current();
				// $log->log("User Tidak Menemukan Data Invoice URL=".$url,$loginid);
				// return abort(404);
				$status = "failed";
				$data = null;
			}
			else{

			$userid = $transaction->first()->id_login_member;


			// if ($userid != $loginid) {
			// 	# code...

			// 	$log = new Log;
			// 					$url = url()->current();
			// 	$log->log("User Membuka Invoice Lain URL=".$url,$loginid);
			// 	return abort(404);
			// }
			// else{
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
			// return view('trx',compact('transaction','detailTransaction','detail','dt','total'));
// return $transaction;
		$status ="ok";

		$user = $transaction->personal;

		$pers = [];

		foreach ($user as $u) {
			# code...
			$personal = $u->formParticipant->personalDetail;
			$pers[] = [
			'nama'=>$personal->nama_awal.' '.$personal->nama_akhir,

			];
		}
		// print_r($pers);

		// $data
		$data = [
		'id'=>$transaction->id,
		'tgl'=>$transaction->tgl_transaksi,
		'jml_total'=>number_format($transaction->jumlah_total,2,',','.'),
		'diskon'=>$transaction->diskon_data != null ? $transaction->diskon_data->kode:null,
		'potongan'=>$transaction->diskon_data != null ? $transaction->diskon_data->potongan:null,
		'harga_akhir'=>number_format($transaction->harga_akhir,2,',','.'),
		'status_bayar'=>$transaction->status_bayar,
		'personal'=>$pers


		];

		// echo $trx;
	}			
			}
	

			}

		}
		else{
			$status = null;
			$data=null;
		}
	
		return [
	'status'=>$status,
	'data'=>$data,
	];
	}

}