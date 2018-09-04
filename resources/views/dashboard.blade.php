@extends('main')

@section('content')
  {{-- expr --}}
  <style type="text/css"> .content{ padding-top: 90px; } </style>

    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}
@if ($user->status==0)
  {{-- expr --}}

    <div class="alert alert-warning">
      Email Anda Belum diverifikasi, silahkan cek email untuk mengaktifkan akun
      <b>atau</b>
      <form action="{{ url('reverify') }}" method="post" style="display: inline-block;">
      {{csrf_field()}}
      <button style="background-color: none;border: none;cursor: pointer;" > Kirim Ulang</button>
        
      </form>
    </div>
@endif
@if (session('success'))
  {{-- expr --}}
  <div class="alert alert-success">

  {{session('success')}}  
  </div>
@endif
@if (session('danger'))
  {{-- expr --}}
  <div class="alert alert-danger">

  {{session('danger')}}  
  </div>
@endif
        <div class="row">
        <div class="col-lg-12 with-margin">

<div class="card">
<!-- Image -->

<!-- Text Content -->
<div class="card-body ">
{{-- <p class="card-text"> --}}


@if ($user->tipe_akun==1)
<center><h3>Daftar Anggota</h3></center>
  {{-- expr --}}
<button  style="padding: 10px 10px;" class="btn btn-success btn-modal-add" data-toggle="modal" data-target="#exampleModal">+ Tambah</button> 
<br>
<div class="table-responsive">

<table class="table table-striped">
  <thead>
    <th>#</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Tanggal Lahir</th>
    <th>Golongan Darah</th>
    <th>KTP</th>
    <th>Medical</th>
    <th>Opsi</th>
  </thead>
  <tbody>

    @if(count($personal->get()) > 0)
    @foreach ($personal->get() as $p)
      {{-- expr --}}
      <tr>
        <td>{{$p->nik}}</td>
        <td>{{$p->nama_awal.' '.$p->nama_akhir}}</td>
        <td>{{$p->jk=='1'?'Laki-Laki':'Perempuan'}}</td>
        <td>{{$p->tgl_lahir}}</td>
        <td>{{$p->gol_darah}}</td>

             <td>{!! !is_null($p->foto_ktp) ? '<span class="badge badge-success">Ok</span>':'<span class="badge badge-danger">Belum</span>'!!}</td></td>
        <td>{!! !is_null($p->medical) ? ($p->medical->nama != null ? '<span class="badge badge-success">Ok</span>' :'<span class="badge badge-danger">Belum</span>'):'<span class="badge badge-danger">Belum</span>'!!}</td>
        <td><button data-id="{{$p->id}}" style="padding: 10px 10px;" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-eye"></i></button> 
        <form action="{{ url('/partisipan/'.$p->id.'/') }}" method="post" style="display: inline-block;">
      {{csrf_field()}}
      
          <button type="submit"  style="padding: 10px 10px;"  class="btn btn-danger"><i class="fas fa-trash"></i></button>
        </form>
        </td>
      </tr>
    @endforeach
    @else
    <tr>
    <td></td>
    <td colspan="7">
    <center>Belum Ada Anggota</center>
    </td>
    </tr>
    @endif
  </tbody>
</table>

</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info Personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
@else
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal Detail</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Kondisi Kesehatan</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
<br>
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    
  <h3>Profil</h3>

  <div class="row">
<div class="col-lg-6">
<form action="{{ url('/update-personal') }}" method="post" enctype="multipart/form-data">
{{csrf_field()}}


  <div class="form-group">
    <label>NIK</label>
    <input type="text" name="nik" data-id="{{$personal==null ? '' : $personal->nik}}" class="form-control" value="{{$personal==null ? '' : $personal->nik}}" id="nik">  
  </div>
  <div class="form-group">
    <label>KTP</label>
      <div id="image-preview" class="image-preview-2" style="background-image: url('uploads/{{!empty($personal) ? $personal->foto_ktp : ""}}');background-position: center center; background-size: cover;">
  <label class="image-label-2" for="image-upload" id="image-label">ID Card</label>
  <input class="image-upload-2" type="file" name="image" id="image-upload" />
</div>
<p id="error1" style="display:none; color:#FF0000;">
Format Gambar Harus JPG, JPEG, PNG or GIF.
</p>
<p id="error2" style="display:none; color:#FF0000;">
Maksimal Ukuran Gambar 200KB
</p>

  </div>
  <div class="form-group">
    <label>Nama Awal</label>
    <input type="text" name="nama_awal" class="form-control" value="{{empty($personal) ? '' : $personal->nama_awal}}">  
  </div>
  <div class="form-group">
    <label>Nama Akhir</label>
    <input type="text" name="nama_akhir" class="form-control" value="{{$personal==null ? '' : $personal->nama_akhir}}"> 
  </div>
  <div class="form-group">
    <label>Jenis Kelamin</label>
<div class="custom-control custom-radio">
  <input  {{$personal!=null ? ($personal->jk =='1'? 'checked':'') :''}}  type="radio" id="customRadio1" name="kelamin" class="custom-control-input" value="1">
  <label class="custom-control-label" for="customRadio1">Laki - Laki</label>
</div>
<div class="custom-control custom-radio">
  <input {{$personal!=null ? ($personal->jk =='2'? 'checked':'') :''}} type="radio" id="customRadio2" name="kelamin" class="custom-control-input" value="2">
  <label class="custom-control-label" for="customRadio2">Perempuan</label>
</div>

  </div>
  <div class="form-group">
    <label>Golongan Darah</label>
  <select class="form-control" name="gol_darah">
    <option {{$personal==null ? 'selected' : ''}} value="">Tidak Diketahui</option>
    <option {{$personal!=null ? ($personal->gol_darah =='A'? 'selected':'') :''}} value="A">A</option>
    <option  {{$personal!=null ? ($personal->gol_darah =='B'? 'selected':'') :''}}  value="B">B</option>
    <option  {{$personal!=null ? ($personal->gol_darah =='AB'? 'selected':'') :''}} value="AB">AB</option>
    <option  {{$personal!=null ? ($personal->gol_darah =='O'? 'selected':'') :''}} value="O">O</option>
  </select>
  </div>
  <div class="form-group">
    <label>Tanggal Lahir</label>
    <input type="date" name="tgl_lahir" class="form-control" value="{{empty($personal) ? '' : $personal->tgl_lahir}}">  
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label>Nomor HP</label>
    <input type="text" name="no_hp" class="form-control" value="{{empty($personal) ? '' : $personal->nohp}}"> 
  </div>
  <div class="form-group">
    <label>Alamat</label>
    <textarea class="form-control" name="alamat">{{empty($personal) ? '' : $personal->alamat}}</textarea>
  </div>

  <div class="form-group">
    <label>Kebangsaan</label>

  <select class="form-control" name="negara" required="">
  <option value="">Pilih Negara</option>
          @foreach ($negara as $n)
      <option {{$personal!=null ? ($personal->nasionality ==$n->id ? 'selected':'') :''}}  value="{{$n->id}}">{{$n->nama}}</option>
        {{-- expr --}}
      @endforeach
  </select>
  </div>
  <div class="form-group" >
    <label>Negara Tempat Tinggal</label>
    <select class="form-control" name="tempat_tinggal" required="" id="negara-tempat" data-value="{{!is_null($personal)?$personal->residence:''}}> 
      
  <option value="">Pilih Tempat Tinggal</option>
      @foreach ($negara as $n)
      <option {{$personal!=null ? ($personal->residence ==$n->id ? 'selected':'') :''}}  value="{{$n->id}}">{{$n->nama}}</option>
        {{-- expr --}}
      @endforeach
    </select>
  </div>
    {{-- expr --}}

  <div class="form-group" id="provinsi-data" style="{!!$personal->residence!='1'? "display:none":"";!!}">
  <label>Provinsi</label>
  <select class="form-control select2" name="provinsi" id="provinsi" data-value="{{!is_null($personal)?$personal->id_provinsi:''}}">
    
  </select>
    
  </div>
  <div class="form-group" id="kota-data" style="{!!$personal->residence!='1'? "display:none":"";!!}">
    <label>Kota</label>
    <select class="form-control select2" name="kota" id="kota" data-value="{{!is_null($personal)?$personal->id_kota:''}}">
      <option value="">Pilih Provinsi Terlebih Dahulu</option>
    </select>
  </div>


</div>
  
</div>
<div class="msg">
  
</div>
<br><br>
<br><br>
<center><button type="submit"  class="btn btn-primary submit-profil">Simpan</button></center>
</form>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <h3>Emergency Medical</h3>
  @if (!empty($personal))
    {{-- expr --}}
    @if ($personal->count() != 0)
 <form action="{{url('/update-emergency')}}" method="post">
      {{csrf_field()}}
      
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{!empty($emergency) ? ($emergency->count()>0 ? $emergency->first()->nama :''):''}}">
      </div>
      <div class="form-group">
        <label>Nomor HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{!empty($emergency) ? ($emergency->count()>0 ? $emergency->first()->nohp :''):''}}">
      </div>
      <div class="form-group">
        <label>Kondisi Kesehatan</label>
        <textarea class="form-control" name="kondisi">{{!empty($emergency) ? ($emergency->count()>0 ? $emergency->first()->kondisi_kesehatan :''):''}}</textarea>
      </div>
      <button class="btn btn-primary">Simpan</button>
    </div>
  </div>
  </form>
  @else
  <br>
{{--   {{$emergency->count()}} --}}

  <center><h5>Silahkan Tambahkan Personal Detail Dulu</h5></center>

    @endif
  @else
  <br>
  <center><h5>Silahkan Tambahkan Personal Detail Dulu</h5></center>
  @endif
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

  <h3>Event Term</h3>

  </div>
</div>
@endif




{{-- </p> --}}
</div>
{{-- <div class="card-footer">
</div> --}}

</div>

      
    </div>
    <!-- Main Content -->



        </div>
      </div>
    </div>

@endsection

@push('script')
<script type="text/javascript">
  // alert("ok");

  // $("#nik").keyup(  $.debounce(500,function(){
  //   alert("ok");
  // });
  // )};
  function select2(){

  $(".select2").select2({
    width:'100%',

  });

  $("select").select2({
    width:'100%',

  });
  }

  select2();
  $(document).on('change','#negara-tempat',function(){
    var val = $(this).val();
    if(val !='1'){
      $("#provinsi-data").hide();
      $("#kota-data").hide();
    }
    else{

      $("#provinsi-data").show();
      $("#kota-data").show();

    }
  });

  $(document).on('change','.negara-tempat',function(){
    var val = $(this).val();
    if(val !='1'){
      $(".provinsi-data").hide();
      $(".kota-data").hide();
    }
    else{

      $(".provinsi-data").show();
      $(".kota-data").show();

    }
  });
cariAlamat('index');
function cariAlamat(ref){
    $.ajax({
    url: "{{ url('/provinsi') }}",
    method: "GET",
    dataType: "JSON",
    data:{
      id: $("#provinsi").attr('data-value')
    },
    success:function(res){
      // console.log(res.status);
      if(res.status == "ok"){
        // console.log("ok");
        var select = "";
        var option ="";
        for (var i = 0; i < res.data.length; i++) {
            // console.log(res.data[i].id);
            var id = res.data[i].id;
            var provinsi = res.data[i].provinsi;
            var selected = res.data[i].selected == true ? 'selected' :'';

            option += "<option  "+selected+" value='"+id+"'>";
            option += provinsi;
            option += "</option>";
        }
        // var ref = '';
          $("#provinsi").append(option);
          console.log(ref);
          // if(ref=='edit'){

          // $("#provinsi").trigger('change');
          // }
          var provinsi = $("#provinsi").attr('data-value');
          var kota = $("#kota").attr('data-value');
          // $("#provinsi").val(provinsi).trigger('change');
          // $("#kota").val(kota).trigger('change');
        // $("#provinsi").append(option);

      }
    }
  });

    var val = $("#provinsi").attr('data-value');
    console.log(val);
    // }
    var v = $("#kota").attr('data-value');
    $.ajax({
      url: "{{ url('/cari-kota') }}",
      method: "GET",
      data: {
        id_provinsi: val,
        v:v
      },
      dataType: "JSON",
      success:function(res){
        // console.log(res);
        var status = res.status;
        if(status == "ok"){
          var option = "";
          for (var i = 0; i <res.data.length; i++) {
            var nama = res.data[i].nama;
            var id = res.data[i].id;
            var selected = res.data[i].selected == true ? 'selected' :'';

            option += "<option  "+selected+" value='"+id+"'>";
            option += nama;
            option += "</option>";
          }
          $("#kota option").remove();
          $("#kota").append(option);
        }
      }
    })

}


  $(document).on('change','#provinsi',function(){
    // alert($(this).val());
    // if(ref=='edit'){
    //   var val = $("#provinsi").attr('data-value');
    // }
    // else{

    var val = $(this).val();
    // }
    var v = $("#kota").attr('data-value');
    $.ajax({
      url: "{{ url('/cari-kota') }}",
      method: "GET",
      data: {
        id_provinsi: val,
        v:v
      },
      dataType: "JSON",
      success:function(res){
        // console.log(res);
        var status = res.status;
        if(status == "ok"){
          var option = "";
          for (var i = 0; i <res.data.length; i++) {
            var nama = res.data[i].nama;
            var id = res.data[i].id;
            var selected = res.data[i].selected == true ? 'selected' :'';

            option += "<option  "+selected+" value='"+id+"'>";
            option += nama;
            option += "</option>";
          }
          $("#kota option").remove();
          $("#kota").append(option);
        }
      }
    })
  });

  $(document).on('change','#nik',function(){
      var val = $(this).val();
      var n = $(this).attr('data-id');
      // alert(val.length);
      if (val.length < 16) {
        $(".msg").html('<span class="badge badge-danger">NIK Harus 16 Digit</span>');
        $(".submit-profil").attr('disabled','disabled');
      }else{
        if(val.length ==16){
          $.ajax({
            url: "{{ url('/nik') }}",
            method: "GET",
            data: {
              nik: val,
              n: n
            },
            success:function(res){
              if(res.status=="ok"){
                $(".msg span").remove();
                        $(".submit-profil").removeAttr('disabled');
              }
              else{

        $(".submit-profil").attr('disabled','disabled');
            $(".msg").html('<span class="badge badge-danger">NIK sudah digunakan</span>');
              }
            }
          })
        }
        else{

      if (val.length > 16) {
        $(".msg").html('<span class="badge badge-danger">NIK Harus 16 Digit</span>');
        $(".submit-profil").attr('disabled','disabled');
      }
      else{

        $(".msg span").remove();
        $(".submit-profil").removeAttr('disabled'); 
      }
        }
      }
    });

  $(document).on('click','.btn-modal',function(){
    var id = $(this).attr('data-id');
    // alert(id);
    $.ajax({
      url: "{{ url('/personal/') }}/"+id,
      method: "GET",
      success:function(res){
        $(".modal-body").html(res);

        cariAlamat('edit');
select2();

$(function(){


    $.uploadPreview({
    input_field: ".image-upload-2",   // Default: .image-upload
    preview_box: ".image-preview-2",  // Default: .image-preview
    label_field: ".image-label-2",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Ubah ID Card",  // Default: Ubah ID Card
    no_label: false                 // Default: false
  });
  });
var a=0;

$('#submit').prop("disabled", true);

$('#image-upload').bind('change', function() {
if ($('input:submit').attr('disabled',false)){
  $('input:submit').attr('disabled',true);
  }
var ext = $('#image-upload').val().split('.').pop().toLowerCase();
if ($.inArray(ext, ['gif','jpg','jpeg','png']) == -1){

  alert("xs");
  $('#error1').slideDown("slow");
  $('#error2').slideUp("slow");
  a=0;
  }else{
  var picsize = (this.files[0].size);
  if (picsize > 200000){
  $('#error2').slideDown("slow");
  a=0;
  }else{
    // alert('l');
  a=1;
  $('#error2').slideUp("slow");
  }
  $('#error1').slideUp("slow");
  if (a==1){
    // alert("okokoo");
    $('#submit').attr('disabled',false);
    }
}
});
      }
    })
  });
  $(document).on('click','.btn-modal-add',function(){
    var id = $(this).attr('data-id');
    // alert(id);
    $.ajax({
      url: "{{ url('/personal/tambah/') }}/",
      method: "GET",
      success:function(res){
        $(".modal-body").html(res);
        cariAlamat('add');
select2();
$(document).ready(function(){
    $.uploadPreview({
    input_field: ".image-upload",   // Default: .image-upload
    preview_box: ".image-preview",  // Default: .image-preview
    label_field: ".image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Ubah ID Card",  // Default: Ubah ID Card
    no_label: false                 // Default: false
  });


    $.uploadPreview({
    input_field: ".image-upload-2",   // Default: .image-upload
    preview_box: ".image-preview-2",  // Default: .image-preview
    label_field: ".image-label-2",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Ubah ID Card",  // Default: Ubah ID Card
    no_label: false                 // Default: false
  });
  });

var a=0;
$('#submit').prop("disabled", true);

$('#image-upload').bind('change', function() {
if ($('input:submit').attr('disabled',false)){
  $('input:submit').attr('disabled',true);
  }
var ext = $('#image-upload').val().split('.').pop().toLowerCase();
if ($.inArray(ext, ['gif','jpg','jpeg','png']) == -1){

  alert("xs");
  $('#error1').slideDown("slow");
  $('#error2').slideUp("slow");
  a=0;
  }else{
  var picsize = (this.files[0].size);
  if (picsize > 200000){
  $('#error2').slideDown("slow");
  a=0;
  }else{
    // alert('l');
  a=1;
  $('#error2').slideUp("slow");
  }
  $('#error1').slideUp("slow");
  if (a==1){
    // alert("okokoo");
    $('#submit').attr('disabled',false);
    }
}
});
//   $.validator.addMethod('filesize', function (value, element, param) {
//     return this.optional(element) || (element.files[0].size <= param)
// }, "Hahaha");

    // $('#form').validate({
    //     rules: {
    //         image: {
    //             required: true,
    //             extension: "jpg,jpeg",
    //             filesize: 5,
    //             message: "xas"
    //         }
    //     },
    // });


      }
    })
  });



$(function(){


    $.uploadPreview({
    input_field: ".image-upload-2",   // Default: .image-upload
    preview_box: ".image-preview-2",  // Default: .image-preview
    label_field: ".image-label-2",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Ubah ID Card",  // Default: Ubah ID Card
    no_label: false                 // Default: false
  });
  });


</script>
<script type="text/javascript">
  $('input[type="submit"]').prop("disabled", true);
var a=0;
//binds to onchange event of your input field

</script>


  {{-- expr --}}
@endpush