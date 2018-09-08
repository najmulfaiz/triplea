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
use Yajra\Datatables\Datatables;


class EventController extends Controller
{


private $folder = 'admin/event';
public function index(){

return view($this->folder.'/index');

}
public function data(){
  $crud = Provinsi::get();
            return Datatables::of($crud)->addColumn('action',function($data){
                $html ='';
                $html .= '<button  data-source='.url('crud/'.$data->id.'/edit').' class="btn btn-success btn-sm btn-modal" data-title="Edit Data" data-toggle="modal" data-target="#modal" data-button="Update"><i class="material-icons">edit</i></button> ';
                // $html .= csrf_field();
                // $html .= method_field("DELETE");
                $html .= '<button data-url="'.url('crud/'.$data->id).'" class="btn btn-delete btn-danger btn-sm"><i class="material-icons">delete_outline</i>';
                return $html;
            })
            ->make(true);



}

public function create(){
    $kota =  Kota::all();
    return view($this->folder.'/create',compact('kota'));
}

public function store(Request $request){
    // print_r($request->all());
    // Event
    $nama_event = $request->nama_event;
    $tgl = $request->tanggal;
    $kota = $request->kota;
    $logo = $request->logo;


    // Event Detail 
    $status_registrasi = $request->status_registrasi;
    $deskripsi_event_detail = $request->deskripsi_event_detail;
    // echo $deskripsi;

    // Event Term
    $event_term = $request->event_term;

    // Fasilitas
    $fasilitas = $request->fasilitas;

    // Group
    $nama_grup = $request->nama_grup;
    $status_grup = $request->status_grup;
    $lokasi_grup = $request->lokasi_grup;
    for ($i=0; $i < count($nama_grup) ; $i++) { 
        # code...
        $nama_grup_i= $nama_grup[$i];
        $status_grup_i= $status_grup[$i];
        $lokasi_grup_i= $lokasi_grup[$i];

        $nm = explode('-',$nama_grup_i);
        $end = end($nm);
        // echo $nm;
        $nm = $nm[0];
        // echo $nm;

        // echo $end;

    }



    // Kategori 
    $nama_kategori  = $request->nama_kategori;
    $kategori_group = $request->kategori_group;
    $harga_kategori = $request->harga_kategori;
    $usia_min = $request->usia_min;
    $usia_max = $request->usia_max;
    $kuota = $request->kuota;
    $deskripsi = $request->deskripsi;

    for ($i=0; $i < count($nama_kategori) ; $i++) { 

    $nama_kategori_i  = $nama_kategori[$i];
    $kategori_group_i = $kategori_group[$i];
    $harga_kategori_i = $harga_kategori[$i];
    $usia_min_i = $usia_min[$i];
    $usia_max_i = $usia_max[$i];
    $kuota_i = $kuota[$i];
    $deskripsi_i = $deskripsi[$i];

    echo $kategori_group_i;

    }
    // print_r($request->deskripsi);

    // print_r($request->all());

}
}