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
use App\Fasilitas;
use App\Provinsi;
use App\EventDetail;

use App\Kota;
use DNS1D;
use App\EventTerm;
use DNS2D;
use QrCode;
use App\Rekening;
use App\Bank;
use Yajra\Datatables\Datatables;


class EventController extends Controller
{


private $folder = 'admin/event';
public function index(){

return view($this->folder.'/index');

}
public function data(Request $request){
  $crud = Event::get();
            return Datatables::of($crud)->addColumn('action',function($data)use(&$request){
                $html ='';
                $html .= '<a  href='.url($request->segment(1).'/event/'.$data->id.'/edit').' class="btn btn-success btn-sm btn-modal" ><i class="fa fa-info"></i></a> ';
                // $html .= csrf_field();
                // $html .= method_field("DELETE");
                $html .= '<button data-url="'.url('crud/'.$data->id).'" class="btn btn-delete btn-danger btn-sm"><i class="fa fa-trash"></i>';
                return $html;
            })
            ->make(true);



}

public function create(){
    $kota =  Kota::all();
    $rekening = Rekening::all();
    $bank = Bank::all();
    return view($this->folder.'/create',compact('kota','rekening','bank'));
}

public function store(Request $request){
    // print_r($request->all());
    // Event
    $nama_event = $request->nama_event;
    $tgl = $request->tanggal;
    $kota = $request->kota;
    $logo = $request->file('logo');
    $bank   = $request->bank;
    $nama_pemilik = $request->nama_pemilik;
    $no_rekening = $request->no_rekening;

    $event = new Event;
    $event->nama = $nama_event;
    $event->tanggal = $tgl;
    $event->id_kota = $kota;
    if (!empty($logo)) {

            $ext = $logo->getClientOriginalExtension();
            $encevent = md5(session('userid').$nama_event);
            $logo->move(public_path('event'),$encevent.'.'.$ext);
            $event->logo = $encevent.'.'.$ext;

    }
    $event->save();



    // Rekening
    $eventid= $event->id;
    $Rekening = new Rekening;
    $Rekening->kode_bank = $bank;
    $Rekening->nama_pemilik = $nama_pemilik;
    $Rekening->no_rekening = $no_rekening;
    $Rekening->id_event = $eventid;
    $Rekening->save();


    // Event Detail 
    $status_registrasi = $request->status_registrasi;
    $deskripsi_event_detail = $request->deskripsi_event_detail;
    // echo $deskripsi;


    $eventDetail = new EventDetail;
    $eventDetail->id_event = $eventid;
    $eventDetail->status_registrasi = $status_registrasi;
    $eventDetail->deskripsi = $deskripsi_event_detail;
    $eventDetail->save();

    // Event Term
    $event_term = $request->event_term;
    $evenTerm =  new EventTerm;
    $evenTerm->deskripsi = $event_term;
    $evenTerm->id_event= $event->id;
    $evenTerm->save();

    // Fasilitas
    $fasilitas = $request->Fasilitas;
    $eventFasilitas = new Fasilitas;
    $eventFasilitas->deskripsi = $fasilitas;
    $eventFasilitas->id_event = $event->id;
    $eventFasilitas->save();
    // Group
    $nama_grup = $request->nama_grup;
    $status_grup = $request->status_grup;
    $lokasi_grup = $request->lokasi_grup;
    $kuota = $request->kuota;
    for ($i=0; $i < count($nama_grup) ; $i++) { 
        # code...
        $nama_grup_i= $nama_grup[$i];
        $status_grup_i= $status_grup[$i];
        $lokasi_grup_i= $lokasi_grup[$i];
        $kuota_i= $kuota[$i];

        // echo $nama_grup_i."<br>";   
        $nm = explode('-',$nama_grup_i);
        $end = end($nm);
        // echo $nm;
        $nm = $nm[0];
        // echo $nm;

        $grup = new Group;
        $grup->nama = $nm;
        $grup->id_event =$event->id;
        $grup->status = $status_grup_i;
        $grup->nationality = $lokasi_grup_i;
        $grup->flag =  $end;
        $grup->kuota =  $kuota_i;
        $grup->save();
        // echo $end;

    }



    // Jersey 
    $jersey = $request->file('jersey');
    $deskripsi_jersey = $request->deskripsi_jersey;
    $ukuran = $request->ukuran;

    for ($i=0; $i < count($jersey) ; $i++) { 

        $jersey_i = $jersey[$i];
        $deskripsi_jersey_i = $deskripsi_jersey[$i];
        $ukuran_i = $ukuran[$i];

            $ext = $jersey_i->getClientOriginalExtension();
            $encevent = md5('jersey'.time());
            $jersey_i->move(public_path('uploads'),$encevent.'.'.$ext);
            // $event->logo = $encevent.'.'.$ext;
            $UkuranJersey  = new UkuranJersey;
            $UkuranJersey->ukuran = $ukuran_i;
            $UkuranJersey->foto = $encevent.'.'.$ext;
            $UkuranJersey->deskripsi = $deskripsi_jersey_i;
            $UkuranJersey->id_event = $eventid;
            $UkuranJersey->save();
    }
    // $jersey = 

    // Kategori 
    $nama_kategori  = $request->nama_kategori;
    $kategori_group = $request->kategori_group;
    $harga_kategori = $request->harga_kategori;
    $usia_min = $request->usia_min;
    $usia_max = $request->usia_max;
    $kuota_kategori  = $request->kuota_kategori;
    // $kuota = $request->kuota;
    $deskripsi = $request->deskripsi;

    for ($i=0; $i < count($nama_kategori) ; $i++) { 

    $nama_kategori_i  = $nama_kategori[$i];
    $kategori_group_i = $kategori_group[$i];
    $harga_kategori_i = $harga_kategori[$i];
    $usia_min_i = $usia_min[$i];
    $usia_max_i = $usia_max[$i];
    $kuota_kategori_i = $kuota_kategori[$i];
    // $kuota_i = $kuota[$i];
    $deskripsi_i = $deskripsi[$i];


    $nm_kategori = explode('-', $nama_kategori_i);
    $end = end($nm_kategori);
    $nm = $nm_kategori[0];
    // echo $nama_kategori_i."<br>";

// print_r($end);
    $grup = Group::where('flag',$end)->first();
    $grup_id = $grup->id;

    $kategori = new Kategori;
    $kategori->nama = $nm;
    $kategori->id_group = $grup_id;
    $kategori->harga = $harga_kategori_i;
    $kategori->usia_min = $usia_min_i;
    $kategori->usia_max = $usia_max_i;
    $kategori->deskripsi = $deskripsi_i;
/*    $kategori->kuota = $kuota_i;*/
    $kategori->save();
    // $kategori


    }

    // Group::update(['flag'=>NULL]);
    DB::table('group')->update(['flag'=>null]);
    // print_r($request->deskripsi);

    // print_r($request->all());
    $request->session()->flash('success','Berhasil Menambah Data');
return redirect('admin/event');
}

public function edit($id){

    $kota =  Kota::all();
    $rekening = Rekening::all();
    $bank = Bank::all();

    $event = Event::find($id);
    $eventDetail = EventDetail::where('id_event',$id);
    $eventTerm = EventTerm::where('id_event',$id);
    $fasilitas = Fasilitas::where('id_event',$id);
    $group = Group::where('id_event',$id);
    // $kategori = 

    // var_dump($eventTerm);

// echo $eventDetail->first();
    // echo "string";
    // echo $evenTerm->get();
    return view($this->folder.'/edit',compact('kota','rekening','bank','eventDetail','eventTerm','fasilitas','group','event'));
    // echo $evenTerm->first();
}


}