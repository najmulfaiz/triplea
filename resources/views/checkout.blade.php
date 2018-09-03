@extends('main')

@section('content')
  {{-- expr --}}

    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}

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
        <div class="col-lg-8 with-margin">

<div class="card">
<!-- Image -->
<div class="card-header">
  Info Event
</div>
<!-- Text Content -->
<div class="card-body ">
{{-- <p class="card-text"> --}}
<form action="{{ url('/checkout') }}" method="post">
{{csrf_field()}}
<table class="table table-bordered">
  <tr>
    <td>Event</td><td>{{$kategori->first()->group->event->nama}}</td>
  </tr>
  <tr>
    <td>Kota Penyelenggara</td><td>{{$kategori->first()->group->event->kota->nama}}</td>
  </tr>
  <tr>
    <td>Kategori</td><td><select class="form-control" id="kategori" name="kategori">
      <option value="">Pilih Kategori</option>
      @foreach ($group->get() as $g)
        {{-- expr --}}
        @if($g->kategori!=null)
        <option {{$g->id==$kategori_id?'selected':''}} value="{{$g->id}}">{{$g->kategori['nama']}}</option>
        @endif
      @endforeach
    </select></td>
  </tr>
  <tr>
    <td>Harga</td><td class="harga">{{number_format($kategori->first()->harga,2,',','.')}}</td>
  </tr>
      <input type="hidden" id="eventid" name="eventid" value="{{$eventid}}">
  <input type="hidden" name="total" id="total" value="{{$kategori->first()->harga}}">

<input type="hidden" name="jumlah_total" id="input-jumlah-total" value="{{$kategori->first()->harga}}">
<input type="hidden" name="diskon" id="input-diskon" value="0">
<input type="hidden" name="" id="harga_total" value="{{$kategori->first()->harga}}">
<input type="hidden" name="diskon" value="" id="diskon_id">
<input type="hidden" name="" id="diskon_type">
<input type="hidden" name="id_diskon" id="id_diskon">
<input type="hidden" name="" id="diskon_int">
</table>
<div class="row">
<div class="col-lg-6">
<div class="form-group">
<label>Nama BIB</label>
<input type="text" name="nama_bib" class="form-control" id="nama_bib" required="">
  
</div>
  
</div>

  
</div>
  <h4>Jersey</h4>
<div class="row">
@if ($jersey->count() >0 )
  {{-- expr --}}
  @foreach ($jersey->get() as $j)

  <div class="col-lg-3">
    
<input  
  type="radio" name="jersey" 
  id="{{$j->id}}" class="input-hidden" value="{{$j->id}}" required data-text="{{$j->ukuran}}"/>
<label for="{{$j->id}}">
  <img 
    src="{{$j->foto}}" />
</label><br>
<center>
<h4>{{$j->ukuran}}</h4>
</center>
  </div>
  @endforeach
@endif
</div>

<div id="partispan-form">
  
</div>
<div id="ukuran-form">
  
</div>


{{-- </p> --}}
</div>
{{-- <div class="card-footer">
</div> --}}

</div>

<style type="text/css">
  .check
{
    opacity:0.5;
  color:#996;
}
.box{
    margin-bottom:5px;
}

</style>
<style type="text/css"> .content{ padding-top: 100px; } </style>

      
    </div>
    <div class="col-lg-4 with-margin">
      
<div class="card">
<!-- Image -->
<div class="card-header">
  Rincian Harga
</div>
<!-- Text Content -->
<div class="card-body ">
{{-- <p class="card-text"> --}}

<div class="form-group">
  <label>Harga</label>
  <h3>    Rp. <span id="harga-total">{{number_format($kategori->first()->harga,0,',','.')}}</span></h3>
</div>

<div class="form-group">
<label>Kode Diskon</label>
  <input type="text" name="" class="form-control" id="kode_diskon">
</div>
<div class="form-group diskon-wrap" style="display: none;">
  <label>Diskon</label>
  <br>
  <span style="font-size: 20px;" id="diskon"></span>
</div>

<div class="form-group">
  <label>Jumlah Total</label>
  <div class="alert alert-success">
  <h3 >    Rp. <span id="jumlah-total">{{number_format($kategori->first()->harga,0,',','.')}}</span></h3>
  </div>
</div>

{{-- <input type="checkbox" name="" ><label>Saya Set</label> --}}
<button id="buy-btn"  class="btn btn-success form-control">Beli</button>
</form>

{{-- </p> --}}
</div>
{{-- <div class="card-footer">
</div> --}}

</div>
    </div>
    <div class="col-lg-8 with-margin">
          
<div class="card">
<!-- Image -->
<div class="card-header">
  Info Partispan
</div>
<!-- Text Content -->
<div class="card-body ">

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Partisipan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>

{{-- <p class="card-text"> --}}
@if ($user->tipe_akun == '1')
  {{-- expr --}}
<button  data-toggle="modal" data-id="{{$id}}" data-target="#exampleModal" class="btn btn-success btn-modal">Tambah Partisipan</button>
<br><br>

<table class="table table-striped">
<thead>
  <th>Nama</th>
  <th>Jersey</th>
</thead>
<tbody id="partisipan-table">
  <tr id="not-found">
  <td colspan="1"></td>
    <td ><center>Tidak Ada Partisipan</center></td>
  </tr>
</tbody>
  
</table>
@endif


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
  <form id="form" action="{{ url('/update-personal/'.$id) }}" method="post">
  <div class="row">

<div class="col-lg-6">
{{csrf_field()}}
  <div class="form-group">
    <label>NIK</label><br>
    {{$personal->nik}}
  </div>
  <div class="form-group">
    <label>Nama Awal</label><br>
    {{$personal->nama_awal}}  
  </div>
  <div class="form-group">
    <label>Nama Akhir</label><br>
{{$personal->nama_akhir}}
  </div>
  <div class="form-group">
    <label>Jenis Kelamin</label><br>
    {{$personal->jk =='2'? 'Perempuan':'Laki-Laki'}}

  </div>
  <div class="form-group">
    <label>Golongan Darah</label><br>

    {{$personal->gol_darah}}
  </div>
  <div class="form-group">
    <label>Tanggal Lahir</label><br>
    {{$personal==null ? '' : $personal->tgl_lahir}}  
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label>Nomor HP</label><br>
{{$personal==null ? '' : $personal->nohp}}
  </div>
  <div class="form-group">
    <label>Alamat</label><br>
{{$personal==null ? '' : $personal->alamat}}
  </div>
  <div class="form-group">
    <label>Kota</label><br>
  {{!empty($personal->kota) ? $personal->kota->nama : ''}}
  </div>
  <div class="form-group">
    <label>Negara</label><br>
  {{!empty($personal->negara) ? $personal->negara->nama : ''}}
  </div>
  <div class="form-group">
    <label>Kebangsaan</label><br>
  {{!empty($personal->residence_s) ? $personal->residence_s->nama:''}}
  </div>
</div>
  
</div>
<br><br>

</form>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <h3>Emergency Medical</h3>
  <form action="{{ url('/personal/medical/'.$id) }}" method="post">
  {{csrf_field()}}
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Nama</label><br>

{{--         {{$emergency->first()}} --}}
        {{count($emergency) > 0 ? ($emergency->first()->nama==null ? '-':$emergency->first()->nama):'-'}}
      </div>
      <div class="form-group">
        <label>Nomor HP</label><br>
{{count($emergency) > 0 ? ($emergency->first()->nohp == null ? '-':$emergency->first()->nohp):'-'}}
      </div>
      <div class="form-group">
        <label>Kondisi Kesehatan</label><br>
{{count($emergency) > 0 ? ($emergency->first()->kondisi_kesehatan == null ? '-':$emergency->first()->kondisi_kesehatan):'-'}}
      </div>

    </div>
  </div>
  </form>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

  <h3>Event Term</h3>

  </div>
</div>

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
  (function(b,c){var $=b.jQuery||b.Cowboy||(b.Cowboy={}),a;$.throttle=a=function(e,f,j,i){var h,d=0;if(typeof f!=="boolean"){i=j;j=f;f=c}function g(){var o=this,m=+new Date()-d,n=arguments;function l(){d=+new Date();j.apply(o,n)}function k(){h=c}if(i&&!h){l()}h&&clearTimeout(h);if(i===c&&m>e){l()}else{if(f!==true){h=setTimeout(i?k:l,i===c?e-m:e)}}}if($.guid){g.guid=j.guid=j.guid||$.guid++}return g};$.debounce=function(d,e,f){return f===c?a(d,e,false):a(d,f,e!==false)}})(this);
</script>
<script type="text/javascript">

  function rupiah(rupiah){
    var bilangan = rupiah == null ? 0 : rupiah;
  var number_string = bilangan.toString();
  sisa  = number_string.length % 3;
  rupiah  = number_string.substr(0, sisa);
  ribuan  = number_string.substr(sisa).match(/\d{3}/g);
    
if (ribuan) {
  separator = sisa ? '.' : '';
  rupiah += separator + ribuan.join('.');
}

return rupiah
  }

$(document).on('click','#buy-btn',function(){

    var jersey = $('input[name=jersey]:checked').val();
    if(typeof jersey!='undefined'){
      if($("#nama_bib").val().length==0){
      alert("Masukan Nama BIB");        
      }
      else{
        return true;
      }
    }
    else{
      alert("Silahkan Memilih Jersey Terlebih Dahulu");
    }
    // alert(jersey);
});
$("#kode_diskon").keyup(  $.debounce(500,function(){
  var val = $(this).val();
  var harga = $("#harga_total").val();
  if(harga=='0'){
      $(this).val('');
      alert("Silahkan Pilih Partisipan Terlebih Dahulu");
  }
  else{

  $.ajax({
    url: "{{ url('/kode-diskon') }}",
    data: {
      diskon: val,
      id_event: $("#eventid").val()
    },
    method: "GET",
    success:function(res){
      // console(res);

        $(".diskon-wrap").show();
      if(res.status=="ok"){
        $(".diskon-wrap").show();
        $("#diskon_type").val(res.data.diskon_type);
        $("#diskon_id").val(res.data.id);
        $("#diskon_int").val(res.data.diskon_int);

        var tipe = $("#diskon_type").val();
        console.log(tipe);
        if(tipe=='2'){

          var diskon_int = $('#diskon_int').val();
          var total = harga*parseInt(diskon_int)/100;

        $("#diskon").text(res.data.diskon);
        $("#input-diskon").val(res.data.diskon_int);
        // console.log(harga);
        $("#input-jumlah-total").val(parseInt(harga)-total);
        $("#jumlah-total").text(rupiah(parseInt(harga)-total));

        }
        else{
        $("#diskon").text(rupiah(res.data.diskon_int));
        $("#input-diskon").val(res.data.diskon_int);
        // console.log(harga);
        $("#input-jumlah-total").val(parseInt(harga)-parseInt(res.data.diskon_int));
        $("#jumlah-total").text(rupiah(parseInt(harga)-parseInt(res.data.diskon_int)));
        }
        $("#id_diskon").val(res.data.id);
        // console.log("ok");
          $("#kode_diskon").attr('readonly','readonly');

      }
      else{
        $("#input-diskon").val(0);
        $("#input-jumlah-total").val(parseInt(harga));

        $("#jumlah-total").text(rupiah(parseInt(harga)));        
        $(".diskon-wrap").hide()

      }

    }
  }) 
  }
  })
);
$(document).on('change','#kategori',function(){
    // alert("ok");
    var val = $(this).val();
    var diskon = $("#diskon").text();
    // alert("lp");

    var inputDiskon = $("#input-diskon").val();
    // alert(val);
    $.ajax({
      url: "{{ url('/checkout/total/') }}/"+val,
      method: "GET",
      success: function(res){
        // console.log(res);
        $(".harga").text(rupiah(res.harga));
        $("#harga-total").text(rupiah(res.harga));
        $("#total").val(res.harga);
        $("#harga_total").val(res.harga);
        $("#eventid").val(res.id_event);
        var hargaTotal = $("#harga_total").val();
        console.log(inputDiskon);
        if(inputDiskon == 0){
          // console.log()
          console.log(hargaTotal);
          
        $("#input-jumlah-total").val(parseInt(res.harga)-parseInt(inputDiskon));
          
        // $("#harga-total").text(rupiah(parseInt(hargaTotal)-parseInt(diskon)));        
        $("#jumlah-total").text(rupiah(parseInt(hargaTotal)-parseInt(inputDiskon)));
        }
        else{
        var tipe = $("#diskon_type").val();

        if(tipe=='2'){

          console.log('x');
          var harga = $("#harga_total").val();
          var diskon_int = $('#diskon_int').val();
          var total = harga*parseInt(diskon_int)/100;

        // $("#diskon").text(res.data.diskon);
        // $("#input-diskon").val(res.data.diskon_int);
        // console.log(harga);
        $("#input-jumlah-total").val(parseInt(harga)-total);
        $("#jumlah-total").text(rupiah(parseInt(harga)-total));

        }
        else{
        // $("#diskon").text(rupiah(res.data.diskon_int));
        // $("#input-diskon").val(res.data.diskon_int);
        // console.log(harga);
            console.log('x');
          var harga = $("#harga_total").val();
          var diskon_int = $('#diskon_int').val();
          var total = harga;

        // $("#diskon").text(res.data.diskon);
        // $("#input-diskon").val(res.data.diskon_int);
        // console.log(harga);
        $("#input-jumlah-total").val(parseInt(harga)-diskon_int);
        $("#jumlah-total").text(rupiah(parseInt(harga)-diskon_int));

        }
        }


      }

    })
  });
  $(document).on('click','.btn-modal',function(){
    var id = $(this).attr('data-id');
    $.ajax({
      url: "{{ url('/partisipan/tambah/') }}/"+id,
      method: "GET",
      success:function(res){
        // console.log(res);
        $(".modal-body").html(res);
      }
    })
  });

  $(document).on('click','.choose',function(){
    var partisipan = $("#partisipan").val();
    var jersey = $('input[name=jersey]:checked').val();
    var partisipanName = $("#partisipan option:selected").text();
    var jerseyText = $('input[name=jersey]:checked').attr('data-text');

    var html='';

    html += '<tr class="parts">';
    html += '<td>'+partisipanName+'</td>';
    html += '<td>'+jerseyText+'</td>';
    html += '</tr>';

    var input = '<input type="hidden" name="partisipan[]" value="'+partisipan+'">';
    var ukuran = '<input type="hidden" name="jersey[]" value="'+jersey+'">';
    $("#not-found").remove();
    $("#partisipan-table").append(html);
    $("#exampleModal").modal('hide');
    // alert(jersey);
    $("#partispan-form").append(input);
    $("#ukuran-form").append(ukuran);
    // console.log(partisipanName);
    // console.log(jersey);
    total();
    // console.log(total());
 function total(){
    var total = $("#total").val();
    var table = $("#partisipan-table tr").length;

    var jml = total * table;
    console.log(jml);
    $("#jumlah-total").text(jml);
    // console.log(table);
  }

  });

 
</script>
<style type="text/css">
label{
  font-weight: bold;
}
  .input-hidden {
  position: absolute;
  left: -9999px;
}

input[type=radio]:checked + label>img {
  border: 1px solid #fff;
  box-shadow: 0 0 3px 3px #090;
}

/* Stuff after this is only to make things more pretty */
input[type=radio] + label>img {
  border: 1px dashed #444;
  width: 150px;
  height: 150px;
  transition: 500ms all;
}



/*
 | //lea.verou.me/css3patterns
 | Because white bgs are boring.
*/
html {
  background-color: #fff;
  background-size: 100% 1.2em;
  background-image: 
    linear-gradient(
      90deg, 
      transparent 79px, 
      #abced4 79px, 
      #abced4 81px, 
      transparent 81px
    ),
    linear-gradient(
      #eee .1em, 
      transparent .1em
    );
}
</style>

@endpush