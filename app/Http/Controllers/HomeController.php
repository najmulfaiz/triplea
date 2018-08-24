<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoginMember;
use Hash;
use App\Token;
use Mail;
use App\Kota;
use App\Negara;
use App\PersonalDetail;
use App\EmergencyMedical;
class HomeController extends Controller
{
	public function __construct()
	{

             $this->middleware('login-auth');
             // $this->middleware('verify');
	}

	public function index(){


		// $this->sendToken();
		$userid = session('userid');
		$user = LoginMember::where('id',$userid)->first();


		$kota = Kota::all();
		$negara = Negara::all();
		$personal = PersonalDetail::where('id_login_member',$userid);
		if ($personal->count() != 0) {
			$personal = $personal->first();
		}
		else{

			$personal = null;
		}

		return view('dashboard',compact('user','kota','negara','personal'));
	}

	public function detail($id){

		$personal = PersonalDetail::where('id',$id);
		if ($personal->count() != 0) {
			$personal = $personal->first();
		}
		else{

			$personal = null;
		}

		$kota = Kota::all();
		$negara = Negara::all();

		$emergency = EmergencyMedical::where('id_personal_detail',$id);

		return view('personal/detail',compact('personal','kota','negara','id','emergency'));

	}
	public function updatePersonal(Request $request){
		// print_r($request->all());
		$nik = $request->nik;
		$nama_awal = $request->nama_awal;
		$nama_akhir = $request->nama_akhir;
		$kelamin = $request->kelamin;
		$gol_darah = $request->gol_darah;
		$tgl_lahir = $request->tgl_lahir;
		$no_hp = $request->no_hp;
		$alamat = $request->alamat;
		$kota = $request->kota;
		$negara = $request->negara;
		$tempat_tinggal = $request->tempat_tinggal;

		$userid = session('userid');

		if (!empty($nik) || !empty($nama_awal) || !empty($nama_akhir) || !empty($kelamin) || !empty($tgl_lahir) || !empty($no_hp) || !empty($alamat) || !empty($kota) || !empty($negara) || !empty($tempat_tinggal)) {

		// cek data
			$personal_data = PersonalDetail::where('id_login_member',$userid);
		if ($personal_data->count() == 0) {

		$personal = new PersonalDetail;
		$personal->id_login_member = $userid;
		$personal->nik = $nik;
		$personal->nama_awal = $nama_awal;
		$personal->nama_akhir = $nama_akhir;
		$personal->jk = $kelamin;
		$personal->gol_darah = $gol_darah;
		$personal->tgl_lahir = $tgl_lahir;
		$personal->nohp = $no_hp;
		$personal->alamat = $alamat;
		$personal->id_kota = $kota;
		$personal->nasionality = $negara;
		$personal->residence = $tempat_tinggal;
		$personal->save();
		}
		else{
		$id = $personal_data->first()->id;
		$personal = PersonalDetail::find($id);
		$personal->id_login_member = $userid;
		$personal->nik = $nik;
		$personal->nama_awal = $nama_awal;
		$personal->nama_akhir = $nama_akhir;
		$personal->jk = $kelamin;
		$personal->gol_darah = $gol_darah;
		$personal->tgl_lahir = $tgl_lahir;
		$personal->nohp = $no_hp;
		$personal->alamat = $alamat;
		$personal->id_kota = $kota;
		$personal->nasionality = $negara;
		$personal->residence = $tempat_tinggal;
		$personal->save();
		}
		$request->session()->flash('success', 'Berhasil Memperbagarui Profil');
		return redirect()->back();
			# code...
		}
		else{
		$request->session()->flash('danger', 'Sepertinya ada data yang belum diisi');
		return redirect()->back();
		}
	}

	public function hapusPartisipan($id,Request $request){
		$personal = PersonalDetail::find($id);
		$delete = $personal->delete();

		if ($delete) {

		$request->session()->flash('danger', 'Data Berhasil Dihapus');
		return redirect()->back();
		}

	}

	public function updateProfileById(Request $request,$id){
		$nik = $request->nik;
		$nama_awal = $request->nama_awal;
		$nama_akhir = $request->nama_akhir;
		$kelamin = $request->kelamin;
		$gol_darah = $request->gol_darah;
		$tgl_lahir = $request->tgl_lahir;
		$no_hp = $request->no_hp;
		$alamat = $request->alamat;
		$kota = $request->kota;
		$negara = $request->negara;
		$tempat_tinggal = $request->tempat_tinggal;

		// $id = $personal_data->first()->id;
		$personal = PersonalDetail::find($id);
		$personal->nik = $nik;
		$personal->nama_awal = $nama_awal;
		$personal->nama_akhir = $nama_akhir;
		$personal->jk = $kelamin;
		$personal->gol_darah = $gol_darah;
		$personal->tgl_lahir = $tgl_lahir;
		$personal->nohp = $no_hp;
		$personal->alamat = $alamat;
		$personal->id_kota = $kota;
		$personal->nasionality = $negara;
		$personal->residence = $tempat_tinggal;
		$save = $personal->save();

		if ($save) {
			$request->session()->flash('success','Data Berhasil Diubah');
		}
		else{

			$request->session()->flash('danger','Data Gagal Diubah');
		}
		
			return redirect()->back();
	}



	public function tambahPersonal(){

		// $personal = PersonalDetail::where('id',$id);
		// if ($personal->count() != 0) {
		// 	$personal = $personal->first();
		// }
		// else{

		// 	$personal = null;
		// }

		$kota = Kota::all();
		$negara = Negara::all();

		return view('personal/tambah',compact('personal','kota','negara','id'));

	}

	public function tambahPersonalPost(Request $request){

		$nik = $request->nik;
		$nama_awal = $request->nama_awal;
		$nama_akhir = $request->nama_akhir;
		$kelamin = $request->kelamin;
		$gol_darah = $request->gol_darah;
		$tgl_lahir = $request->tgl_lahir;
		$no_hp = $request->no_hp;
		$alamat = $request->alamat;
		$kota = $request->kota;
		$negara = $request->negara;
		$tempat_tinggal = $request->tempat_tinggal;

			$personal = new PersonalDetail;
		$personal->id_login_member = session('userid');
		$personal->nik = $nik;
		$personal->nama_awal = $nama_awal;
		$personal->nama_akhir = $nama_akhir;
		$personal->jk = $kelamin;
		$personal->gol_darah = $gol_darah;
		$personal->tgl_lahir = $tgl_lahir;
		$personal->nohp = $no_hp;
		$personal->alamat = $alamat;
		$personal->id_kota = $kota;
		$personal->nasionality = $negara;
		$personal->residence = $tempat_tinggal;
		$save = $personal->save();

		if ($save) {
			$request->session()->flash('success','Data Berhasil Disimpan');
		}
		else{

			$request->session()->flash('danger','Data Gagal Disimpan');
		}
		
			return redirect()->back();
	}

	public function tambahPersonalMedical(Request $request,$id){
		$emergency = EmergencyMedical::where('id_personal_detail',$id);

		if ($emergency->count() > 0) {
			$id_num = $emergency->first()->id;

		$emergencyMedical = EmergencyMedical::find($id_num);
		$emergencyMedical->nama = $request->nama;
		$emergencyMedical->id_personal_detail = $id;
		$emergencyMedical->nohp = $request->no_hp;
		$emergencyMedical->kondisi_kesehatan = $request->kondisi;
		$save = $emergencyMedical->save();

		$msg = "Mengubah";
		}
		else{
		$emergencyMedical = new EmergencyMedical;
		$emergencyMedical->nama = $request->nama;
		$emergencyMedical->id_personal_detail = $id;
		$emergencyMedical->nohp = $request->no_hp;
		$emergencyMedical->kondisi_kesehatan = $request->kondisi;
		$save = $emergencyMedical->save();
		$msg = "Menyimpan";
		// print_r($request->all());

		}
			if ($save) {
			$request->session()->flash('success','Berhasil '.$msg.' Data');
		}
		else{

			$request->session()->flash('danger','Gagal '.$msg.' Data');
		}

		return redirect()->back();

	}


}