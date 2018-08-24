@extends('main')

@section('content')
  {{-- expr --}}

  <style type="text/css"> .content{ padding-top: 60px; } </style>
    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}
<br><br>
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
    <td>Event</td><td>{{$event->nama}}</td>
  </tr>
  <tr>
    <td>Kota</td><td>{{$event->kota->nama}}</td>
  </tr>
{{--   <tr>
    <td>Kota Penyelenggara</td><td>{{$kategori->first()->group->event->kota->nama}}</td>
  </tr> --}}
  <input type="hidden" name="total" id="total" value="">
<input type="hidden" name="jumlah_total" id="input-jumlah-total" value="0">
<input type="hidden" name="diskon" id="input-diskon" value="0">


</table>

<div id="partispan-form">
  
</div>
<div id="ukuran-form">
  
</div>
<div id="harga-form">
  
</div>

<div id="kategori-form">
  
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
<br>
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
<button type="button"  data-toggle="modal" data-id="{{$id}}" data-target="#exampleModal" class="btn btn-success btn-modal">Tambah Partisipan</button>
<br><br>
<table class="table table-striped" >
<thead>
  <th>Nama</th>
  <th>Jersey</th>
  <th>Kategori</th>
  <th>Harga</th>
</thead>
<tbody id="partisipan-table">
  <tr id="not-found">
  <td colspan="1"></td>
    <td ><center>Tidak Ada Partisipan</center></td>
    <td></td>
    <td></td>
  </tr>
</tbody>
  
</table>

{{-- </p> --}}
</div>
{{-- <div class="card-footer">
</div> --}}

</div>

      
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
    <h3 >    Rp. <span id="harga-total">0</span></h3>
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
  <h3 >    Rp. <span id="jumlah-total">0</span></h3>
  </div>
</div>

{{-- <input type="checkbox" name="" ><label>Saya Set</label> --}}
<button id="buy-btn" class="btn btn-success form-control">Beli</button>
<br>
<span class="badge badge-danger" id="alert" style="display: none;">Silahkan Pilih Partisipan Terlebih Dahulu</span>
</form>

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
function validateBtn(){
    var table = $("#partisipan-table tr.parts").length;
    if(table==0){
      $("#buy-btn").attr('disabled','disabled');
      $("#alert").show();
    }
    else{
      $("#buy-btn").removeAttr('disabled');

      $("#alert").hide();

    }
}
validateBtn();

$("#kode_diskon").keyup(  $.debounce(500,function(){
  var val = $(this).val();
  var harga = $("#harga-total").text();
  if(harga=='0'){
      $(this).val('');
      alert("Silahkan Pilih Partisipan Terlebih Dahulu");
  }
  else{

  $.ajax({
    url: "{{ url('/kode-diskon') }}",
    data: {
      diskon: val
    },
    method: "GET",
    success:function(res){
      // console(res);
      // localStorage.setItem('potongan',potongan);
        $(".diskon-wrap").show();
      if(res.status=="ok"){
        $(".diskon-wrap").show();
        console.log("ok");
        $("#diskon").text(res.data.potongan);
        $("#input-diskon").val(res.data.potongan);
        $("#input-jumlah-total").val(parseInt(harga)-parseInt(res.data.potongan));
        $("#jumlah-total").text(parseInt(harga)-parseInt(res.data.potongan));

      }
      else{
        // console.log(localStorage.getItem('potongan'));
        $(".diskon-wrap").hide();

        $("#input-diskon").val(0);

        $("#input-jumlah-total").val(parseInt(harga));
// alert(parseInt(harga)+parseInt(localStorage.getItem('potongan')));
        $("#jumlah-total").text(harga);

      }

    }
  }) 
  }
  })
)
  $(document).on('change','#kategori',function(){
    // alert("ok");
    var val = $(this).val();
    // alert(val);
    $.ajax({
      url: "{{ url('/checkout/total/') }}/"+val,
      method: "GET",
      success: function(res){
        // console.log(res);
        $(".harga").text(res.harga);
        // $("#total").val(res.harga);

// total();
         function total(){
    var total = $("#total").val();
    var table = $("#partisipan-table tr.parts").length;

    var jml = total * table;
    console.log(jml);
    $("#harga-total").text(jml);
    $("#jumlah-total").text(jml);
    // console.log(table);
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

  $(document).on('click','.remove-btn',function(){
    console.log("ok");
    var id = $(this).attr('data-id');
    var price = $(this).attr('data-price');
    var diskon = $("#input-diskon").val();

    $("#tr-"+id).remove();
    $("#input-"+id).remove();
    $("#ukuran-"+id).remove();
    $("#hargaMass-"+id).remove();
    $("#kategori-"+id).remove();
    // alert(id);



    if(diskon =='0'){
    var totals = $("#harga-total").text();
    totals = parseInt(totals);

    $("#harga-total").text(totals-parseInt(price));
    $("#jumlah-total").text(totals-parseInt(price))
      
    }
    else{
    var table = $("#partisipan-table tr.parts").length;
    if(table==0){
          var totals = $("#harga-total").text();
    totals = parseInt(totals);

    $("#harga-total").text(totals-parseInt(price));
    $("#jumlah-total").text(totals-parseInt(price))


    }
    else{
                var totals = $("#harga-total").text();
    totals = parseInt(totals);

    $("#harga-total").text(totals-parseInt(price));
    $("#jumlah-total").text(totals-parseInt(price)-parseInt(diskon))

    }

    }



  });

  $(document).on('click','.choose',function(){
    var partisipan = $("#partisipan").val();
    var jersey = $('input[name=jersey]:checked').val();
    var partisipanName = $("#partisipan option:selected").text();
    var harga = $("#kategori option:selected").attr('data-price');
    var jerseyText = $('input[name=jersey]:checked').attr('data-text');

    var kategori = $("#kategori option:selected").text();
    var id_kategori = $("#kategori option:selected").val();

    // console.log(harga);
    // alert(id_kategori);
    if(typeof partisipan == 'undefined' || id_kategori=='' || typeof jersey == 'undefined'){
      alert("Silahkan Isi Data Terlebih Dahulu")
    }
    else{
    var html='';
    var math = Math.floor((1 + Math.random()) * 0x10000)
      .toString(16)
      .substring(1);

    html += '<tr class="parts" id="tr-'+math+'">';
    html += '<td>'+partisipanName+'</td>';
    html += '<td>'+jerseyText+'</td>';
    html += '<td>'+kategori+'</td>';
    html += '<td>'+harga+'</td>';
    html += '<td><button data-id="'+math+'" data-price="'+harga+'" class="btn btn-danger remove-btn">Hapus</button></td>';
    html += '</tr>';


    var input = '<input id="input-'+math+'" type="hidden" name="partisipan[]" value="'+partisipan+'">';
    var ukuran = '<input id="ukuran-'+math+'" type="hidden" name="jersey[]" value="'+jersey+'">';
    var hargaMass = '<input id="hargaMass'+math+'" type="hidden" name="harga[]" value="'+harga+'">';
    var kategoriMass = '<input type="hidden" id="kategori-'+math+'" name="id_kategori[]" value="'+id_kategori+'">';

    var totals = $("#harga-total").text();
    totals = parseInt(totals);

    var diskon = $("#input-diskon").val();
    if(diskon =='0'){
    $("#harga-total").text(totals+parseInt(harga));
    $("#jumlah-total").text(totals+parseInt(harga));
      
    }
    else{
          $("#harga-total").text(totals+parseInt(harga));
    $("#jumlah-total").text(totals+parseInt(harga)-parseInt(diskon));
    $("#input-jumlah-total").val(totals+parseInt(harga)-parseInt(diskon));

    }

    // alert(total);
    $("#not-found").remove();
    $("#partisipan-table").append(html);
    $("#exampleModal").modal('hide');
    // alert(jersey);
    $("#partispan-form").append(input);
    $("#ukuran-form").append(ukuran);
    $("#harga-form").append(hargaMass);
    $("#kategori-form").append(kategoriMass);
    // console.log(partisipanName);
    // console.log(jersey);
    // total();
    // console.log(total());
    validateBtn();
 function total(){
    var total = $("#total").val();
    var table = $("#partisipan-table tr").length;

    var jml = total * table;
    // console.log(jml);
    $("#harga-total").text(jml);
    $("#jumlah-total").text(jml);
    // console.log(table);
  }

    }

  });

 
</script>
<style type="text/css">
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