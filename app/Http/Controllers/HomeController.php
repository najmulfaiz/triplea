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
use Request as Req;
use App\Http\Controllers\AuthController;
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
		if ($user->tipe_akun == '0') {
			if ($personal->count()>0) {
			$personal = $personal->first();
				# code...
				$emergency = EmergencyMedical::where('id_personal_detail',$personal->id);
			}
			else{
				$personal= null;
				$emergency=null;
			}
		}
		else{

			$personal = $personal;
		}
		

		// echo Req::ip();
		// echo count($personal->get());
		// echo ;
		// var_dump($emergency->count());
		// echo $emergency->first();
		return view('dashboard',compact('user','kota','negara','personal','emergency'));
	}

	public function reverify(Request $request){
		$userid = session('userid');

		$auth = new AuthController;
		$d =$auth->sendToken($userid);
// print_r($d);

		$request->session()->flash('success','Berhasil Mengirim');
		return redirect()->back();

	}
	public function detail(Request $request, $id){
		$tab_selected = $request['type'];
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

		return view('personal/detail',compact('personal','kota','negara','id','emergency', 'tab_selected'));

	}
	public function updatePersonal(Request $request){
		// return $request->image;
		// $this->validate($request, [
		// 	'image' => 'required',
  //           'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:500'
		// ]);
		
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

		$provinsi = $request->provinsi;

		$userid = session('userid');
		$file = $request->file('image');

// print_r($request->all());
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
		$personal->id_provinsi = $provinsi;
				if (!empty($file)) {

		$ext = $file->getClientOriginalExtension();
			$file->move(public_path('uploads'),time().session('userid').'.'.$ext);
			$personal->foto_ktp = time().session('userid').'.'.$ext;

		}
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
			if (!empty($file)) {	
				
		$ext = $file->getClientOriginalExtension();
			$file->move(public_path('uploads'),time().session('userid').'.'.$ext);
			$personal->foto_ktp = time().session('userid').'.'.$ext;

		}
		$personal->gol_darah = $gol_darah;
		$personal->tgl_lahir = $tgl_lahir;
		$personal->nohp = $no_hp;
		$personal->alamat = $alamat;
		$personal->id_provinsi = $provinsi;
		$personal->id_kota = $kota;
		$personal->nasionality = $negara;
		$personal->residence = $tempat_tinggal;
		$personal->save();
		}
		$request->session()->flash('success', 'Berhasil Memperbaharui Profil');
		return redirect()->back();
			# code...
		}
		else{
		$request->session()->flash('danger', 'Sepertinya ada data yang belum diisi');
		return redirect()->back();
		}
	}

public function updateEmergency(Request $request){
    $nama = $request->nama;
    $no_hp = $request->no_hp;
    $kondisi = $request->kondisi;
    $userid = session('userid');
    $personal_data = PersonalDetail::where('id_login_member',$userid)->first();
    // $personal = PersonalDetail::find($id)    ;
    
    $emergencyMedicalData = EmergencyMedical::where('id_personal_detail',$personal_data->id);
    if($emergencyMedicalData->count()>0){
        $id = $emergencyMedicalData->first()->id;
        
        $emergency = EmergencyMedical::find($id);
        $emergency->nama = $nama;
        $emergency->nohp = $no_hp;
        $emergency->kondisi_kesehatan = $kondisi;
        $emergency->save();
		$request->session()->flash('success', 'Berhasil Mengubah Data');
    }
    else{
        
        $emergency = new EmergencyMedical;
        $emergency->id_personal_detail = $personal_data->id;
        $emergency->nama = $nama;
        $emergency->nohp = $no_hp;
        $emergency->kondisi_kesehatan = $kondisi;
        $emergency->save();
        
		$request->session()->flash('success', 'Berhasil Menyimpan Data');
    }
    
		return redirect()->back();
    
    
}
	public function hapusPartisipan($id,Request $request){
		$userid = session('userid');
		$data = PersonalDetail::where('id_login_member',$userid);

		if ($data->count()==1) {
		$request->session()->flash('danger', 'Data Gagal Dihapus, Minimum 1 Peserta');
		}
		else{
		$personal = PersonalDetail::find($id);
		$delete = $personal->delete();

		if ($delete) {

		$request->session()->flash('success', 'Data Berhasil Dihapus');
		}
		else{
					$request->session()->flash('danger', 'Data Gagal Dihapus,Terjadi Galat');
		}
		}

		return redirect()->back();

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
		$provinsi = $request->provinsi;
		$tempat_tinggal = $request->tempat_tinggal;


		$file = $request->file('image');

		// $id = $personal_data->first()->id;
		$personal = PersonalDetail::find($id);
		$personal->nik = $nik;
		$personal->nama_awal = $nama_awal;
		$personal->nama_akhir = $nama_akhir;
		$personal->jk = $kelamin;
		$personal->gol_darah = $gol_darah;
		$personal->tgl_lahir = $tgl_lahir;
		$personal->nohp = $no_hp;
		if (!empty($file)) {
			
		$ext = $file->getClientOriginalExtension();
			$file->move(public_path('uploads'),time().session('userid').'.'.$ext);
			$personal->foto_ktp = time().session('userid').'.'.$ext;

		}
		$personal->alamat = $alamat;
		$personal->id_kota = $kota;
		$personal->nasionality = $negara;
		$personal->id_provinsi = $provinsi;
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

		$sessid = session('userid');
		$user = LoginMember::where('id',$sessid)->first();
		$personal = PersonalDetail::where('id_login_member',$sessid)->count();
		if ($personal+1 > $user->jml_personal) {
			# code...

			$request->session()->flash('danger','Data Gagal Disimpan, Jumlah Personal Melebihi Batas');
		}
		else{

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
		$provinsi = $request->provinsi;
		$file = $request->file('image');

// print_r($request->all())		;

			$personal = new PersonalDetail;
		$personal->id_login_member = session('userid');
		$personal->nik = $nik;
		$personal->nama_awal = $nama_awal;
		$personal->nama_akhir = $nama_akhir;
		$personal->jk = $kelamin;
		$personal->id_provinsi = $provinsi;
		$personal->gol_darah = $gol_darah;
		$personal->tgl_lahir = $tgl_lahir;
		if (!empty($file)) {

		$ext = $file->getClientOriginalExtension();
			$file->move(public_path('uploads'),time().session('userid').'.'.$ext);
			$personal->foto_ktp = time().session('userid').'.'.$ext;

		}
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

	public function addPartisipan(Request $request){
		$p = $request->p;

		// $request->session()->put('id', $p);
		$request->session()->push('ids', $p);
		// print_r($request->session()->all());
		// $request->session()->forget('key');
	}

	public function removePartisipanFromCart(Request $request){
		$id = $request->id;
		$products = session()->pull('ids', []); // Second argument is a default value
if(($key = array_search($id, $products)) !== false) {
    unset($products[$key]);
}
session()->put('ids', $products);

	}


}