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


class AdminController extends Controller
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
}