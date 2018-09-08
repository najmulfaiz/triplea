<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\LoginMember as Crud;
class MemberCOntroller extends Controller
{
    protected $folder = 'admin/member';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view($this->folder.'/index');
    }

    public function data(){
   $crud = Crud::get();
            return Datatables::of($crud)->
            addColumn('tipe_akun_icon',function($d){
                if ($d->tipe_akun=='0') {
                    $state = '<i class="fa fa-users"></i> Komunitas';
                }
                else{
                    $state = '<i class="fa fa-user"></i> Personal';
                }
                return $state;
            })
            ->addColumn('verified_icon',function($d){
                if ($d->verified=='0') {
                    $state = '<i class="fa fa-times"></i> Belum Diverifikasi';
                }
                else{
                    $state = '<i class="fa fa-check"></i> Terverifikasi';
                }
                return $state;
            })->
            addColumn('status_icon',function($d){
                if ($d->status=='1') {
                    $state = '<label class="label label-success">Aktif</label>';
                }
                else{
                    $state = '<label class="label label-danger">Belum Aktif</label>';
                }
                return $state;
            })
            ->addColumn('action',function($data){
                $html ='';
                $html .= '<button  data-source='.url('admin/member/'.$data->id.'/edit').' class="btn btn-success btn-sm btn-modal" data-title="Edit Data" data-toggle="modal" data-target="#modal" data-button="Update"><i class="fa fa-info"></i></button> ';
                $html .= csrf_field();
                $html .= method_field("DELETE");
                $html .= '<button data-url="'.url('admin/member/'.$data->id).'" class="btn btn-delete btn-danger btn-sm"><i class="fa fa-trash"></i>';
                return $html;
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view($this->folder.'/create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // print_r($request->all());


        $email = $request->email;
        $password = $request->password;
        $komunitas = $request->komunitas;
        $tipe_akun = $request->tipe_akun;
        $verified = $request->verified;
        $no_hp = $request->no_hp;
        $status = $request->status_aktif;

        // validation
        if (empty($email)) {
            $title = "Gagal!";
            $message = 'Data Kosong';
            $type = 'danger';
        }
        else{

                $id = mt_rand(100000,999999); 
                $validate = Crud::where('id',$id)->count();
                if ($validate == 0) {
                    $userid = $id;
                }
                else{
                    $userid = mt_rand(100000,999999); 
                }
        $crud  = new Crud;
        $crud->id = $id;
        $crud->email = $email;
        $crud->password = bcrypt($password);
        $crud->tipe_akun = $tipe_akun;
        $crud->komunitas = $komunitas;
        $crud->verified = $verified;
        $crud->status = $status;
        $crud->nohp = $no_hp;

        $save = $crud->save();
        if ($save) {
            $title = "Sukses";
            $message = 'Berhasil Menyimpan Data';
            $type = 'success';
        }
        else{
            $title = "Gagal";
            $message = 'Gagal Menyimpan Data';
            $type = 'danger';
        }
        }
        $json = [
        'title'=>$title,
        'message'=>$message,
        'type'=>$type,
        'state'=>'show'
        ]  ;
        return $json;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $data = Crud::find($id);
        return view($this->folder.'/edit',compact('data'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
      
        $email = $request->email;
        $password = $request->password;
        $komunitas = $request->komunitas;
        $tipe_akun = $request->tipe_akun;
        $verified = $request->verified;
        $no_hp = $request->no_hp;
        $status = $request->status_aktif;

        // validation
        if (empty($email)) {
            $title = "Gagal!";
            $message = 'Data Kosong';
            $type = 'danger';
        }
        else{

        $crud  = Crud::find($id);
        $crud->id = $id;
        $crud->email = $email;
        if (!empty($password)) {
            # code...
        $crud->password = bcrypt($password);
        }
        $crud->tipe_akun = $tipe_akun;
        $crud->komunitas = $komunitas;
        $crud->verified = $verified;
        $crud->status = $status;
        $crud->nohp = $no_hp;

        $save = $crud->save();
        if ($save) {
            $title = "Sukses";
            $message = 'Berhasil Mengubah Data';
            $type = 'success';
        }
        else{
            $title = "Gagal";
            $message = 'Gagal Mengubah Data';
            $type = 'danger';
        }
        }
        $json = [
        'title'=>$title,
        'message'=>$message,
        'type'=>$type,
        'state'=>'show'
        ]  ;
        return $json;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $crud  = Crud::find($id);
        if (count($crud) > 0 ) {
        $delete = $crud->delete();
        if ($delete) {
            $title = "Success";
            $message = 'Deleted Data Successfully';
            $type = 'success';
        }
                else{
            $title = "Failed";
            $message = 'Failed to Delete Data';
            $type = 'danger';
        }
        }
        else{
            $title = "Failed";
            $message = 'Failed to Delete Data';
            $type = 'danger';
        }
        $json = [
        'title'=>$title,
        'message'=>$message,
        'type'=>$type,
        'state'=>'show'
        ]  ;
        return $json;
    }
}