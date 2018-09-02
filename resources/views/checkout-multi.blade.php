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
    <input type="hidden" id="eventid" name="eventid" value="{{Request::segment(2)}}">
    <input type="hidden" name="total" id="total" value="">
  <input type="hidden" name="jumlah_total" id="input-jumlah-total" value="0">
  <input type="hidden" name="diskon" id="input-diskon" value="0">
  <input type="hidden" name="" id="harga_total">


  </table>

  <div id="partispan-form">
    
  </div>
  <div id="ukuran-form">
    
  </div>
  <div id="harga-form">
    
  </div>

  <div id="kategori-form">
    
  </div>

  <div id="nama_bib-form">
    
  </div>

  <div id="">
    <input type="hidden" id="id_diskon" value="0" name="id_diskon">
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
  <div class="alert alert-warning">
    Diharapkan untuk memasukan data peserta terlebih dahulu sebelum memasukan kode diskon (bila ada)
  </div>
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
  <div class="table-responsive">
    
  <table class="table table-striped" >
  <thead>
    <th>Nama</th>
    <th>Jersey</th>
    <th>Kategori</th>
    <th>Nama BIB</th>
    <th>Harga</th>
    <th>Opsi</th>
  </thead>
  <tbody id="partisipan-table">
    <tr id="not-found">
    <td colspan="1"></td>
      <td></td>
      <td ><center>Tidak Ada Partisipan</center></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
    
  </table>
  </div>

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
    <span  style="font-size: 20px;" id="diskon"></span>
  </div>
  <div class="form-group">
    <label>Jumlah Total</label>
    <div class="alert alert-success">
    <h3 >    Rp. <span id="jumlah-total">0</span></h3>
    </div>
  </div>

  {{-- <input type="checkbox" name="" ><label>Saya Set</label> --}}
  <button id="buy-btn" class="btn btn-success form-control">Selesaikan Pesanan</button>
  <br>
  <center>
  <span class="badge badge-danger" id="alert" style="display: none;">Silahkan Pilih Partisipan Terlebih Dahulu</span>
  </center>
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

  {{-- <script type="text/javascript">


  </script> --}}
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

    var harga = $("#input-jumlah-total").val();
    var harga_total = $("#harga_total").val();
    if(harga=='0'){
        $(this).val('');
        alert("Silahkan Pilih Partisipan Terlebih Dahulu");
    }
    else{

    $.ajax({
      url: "{{ url('/kode-diskon') }}",
      data: {
        diskon: val,
        total: harga,
        id_event: $("#eventid").val()
      },
      method: "GET",
      success:function(res){
        // console(res);
        // localStorage.setItem('potongan',potongan);
          $(".diskon-wrap").show();
        if(res.status=="ok"){
          $(".diskon-wrap").show();
          console.log("ok");
          $("#diskon").text(res.data.diskon);
          $("#diskon").attr('data-diskon',res.data.diskon_int);
          $("#diskon").attr('data-tipe-diskon',res.data.diskon_type);
          $("#input-diskon").val(res.data.diskon_int);
          $("#input-diskon").attr('data-type',res.data.diskon_type);
          $("#input-jumlah-total").val(parseInt($("#input-jumlah-total").val())-parseInt(res.data.potongan));
          $("#jumlah-total").text(rupiah(harga_total-parseInt(res.data.potongan)));
          $("#id_diskon").val(res.data.id);
          $("#kode_diskon").attr('readonly','readonly');

        }
        else{
          // console.log(localStorage.getItem('potongan'));
          $(".diskon-wrap").hide();

          $("#input-diskon").val(0);
          // $("#kode_diskon").val('');
          $("#input-jumlah-total").val(harga_total);
  // alert(parseInt(harga)+parseInt(localStorage.getItem('potongan')));
          $("#jumlah-total").text(rupiah(harga_total));
            $("#id_diskon").val(0);

        }

      }
    }) 
    }
    })
  );
  $(document).on('change','#partisipan',function(){
    var id = $("#partisipan option:selected").attr('data-id');
    var pid = $(this).val();

    $.ajax({
      url: "{{ url('/api/v1/cek-partisipan') }}",
      data: {
        id:id,
        pid:pid,
      },
      method:"GET",
      dataType: "JSON",
      success:function(res){
        if(res.success==false){
          alert(res.message);
          $(".choose").attr('disabled','disabled');
          $("#kategori").attr('data-continue','false');
        }
        else{

          $(".kategori-data").removeAttr('data-continue');
        }

      }
    })
    // alert(id+'x'+pid);
  });
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
      var val = $(this).attr('data-val');

      $("#tr-"+id).remove();
      $("#input-"+id).remove();
      $("#ukuran-"+id).remove();
      $("#hargaMass-"+id).remove();
      $("#kategori-"+id).remove();
      // alert(id);



      $.ajax({
        url: "{{ url('/delete-cart') }}",
        data: {
          id: val
        },
        method: "GET",
        success:function(){

        }
      })
      if(diskon =='0'){
      var totals = $("#input-jumlah-total").val();
      totals = parseInt(totals);

      $("#harga-total").text(rupiah(totals-parseInt(price)));
      $("#jumlah-total").text(rupiah(totals-parseInt(price)));
      $("#input-jumlah-total").val(totals-parseInt(price));
      $("#harga_total").val(totals-parseInt(price));
        
      }
      else{
      var table = $("#partisipan-table tr.parts").length;
      console.log(table);
      if(table==1){
        // console.log('okxxx');
     

     var tipe = $("#input-diskon").attr('data-type');
      var v = $("#input-diskon").val();



      if(tipe=='2'){
        console.log("haasss");
      var h = $("#harga_total").val();


      // var i = $("#harga_total").val
      // $("#jumlah-total").text(rupiah(h-parseInt(price)));


      
      var persen = (v/100) ;
      $("#harga-total").text(rupiah(h-parseInt(price)));


      $("#input-jumlah-total").val((h-parseInt(price))-(persen*(h-parseInt(price))));

      $("#harga_total").val(h-parseInt(price));
      
      $("#jumlah-total").text((rupiah(h-parseInt(price))-(persen*(h-parseInt(price)))));


      }
      else{
        // alert("madang");
         var totals = $("#input-jumlah-total").val();
      totals = parseInt(totals);

      var a = $("#input-diskon").val();
      var b = $("#input-jumlah-total").val();
      $("#harga-total").text(rupiah(parseInt(a)+parseInt(b)));
      // $("#harga-total").text(rupiah(totals-parseInt(price)));
      $("#jumlah-total").text(rupiah(totals-parseInt(price)))

      $("#input-jumlah-total").val(totals-parseInt(price));
      $("#harga_total").val(totals-parseInt(price));



      }


      }
      else{


      var totals = $("#input-jumlah-total").val();
      totals = parseInt(totals);


      console.log("masuk");

      // $("#harga-total").text(rupiah(h-parseInt(price)));

     var tipe = $("#input-diskon").attr('data-type');
      var v = $("#input-diskon").val();

      console.log(tipe);
      if(tipe=='2'){
        console.log("haa");
      var h = $("#harga_total").val();


      // var i = $("#harga_total").val
      // $("#jumlah-total").text(rupiah(h-parseInt(price)));


      var persen = (v/100) ;
      $("#harga-total").text(rupiah(h-parseInt(price)));


      $("#input-jumlah-total").val((h-parseInt(price))-(persen*(h-parseInt(price))));

      $("#harga_total").val(h-parseInt(price));
      
      $("#jumlah-total").text((rupiah(h-parseInt(price))-(persen*(h-parseInt(price)))));

       var a = $("#input-diskon").val();
      var b = $("#input-jumlah-total").val();


      }
      else{

      var h = $("#harga_total").val();

      $("#harga_total").val(h-parseInt(price));
      $("#input-jumlah-total").val(h-parseInt(price));
      
       var a = $("#input-diskon").val();
      var b = $("#input-jumlah-total").val();

      $("#harga-total").text(rupiah(parseInt(a)+parseInt(b)));


      $("#jumlah-total").text(rupiah(h-parseInt(price)-(h-parseInt(price))));

      }



      }

      }
      if($("#input-jumlah-total").val()==0){
        $("#buy-btn").attr('disabled','disabled');
        $("#alert").show();
      }else{
        $("#buy-btn").removeAttr('disabled');

        $("#alert").hide();
      }


    });


    $(document).on('change','.kategori-data',function(){

      var price = $(".kategori-data option:selected").attr('data-price');
      var choose = $(".choose");
        var continu = $(this).attr('data-continue');
      // alert(price);
      if(price===undefined){

        choose.attr('disabled','disabled');
      $("#pilih").text(" ");
      }
      else{
        // $("#pilih").show();
if (continu=='false') {

          alert("Event Hanya Diperuntukan Oleh Warga Indonesia");
        choose.attr('disabled','disabled');
      $("#pilih").text("Pilih");


}
else{
      

      $("#pilih").text(" "+rupiah(parseInt(price)));
        choose.removeAttr('disabled');
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
      var nama_bib = $("#nama_bib").val();


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
      html += '<td>'+nama_bib+'</td>';
      html += '<td>'+rupiah(harga)+'</td>';
      html += '<td><button data-val="'+partisipan+'" data-id="'+math+'" data-price="'+harga+'" class="btn btn-danger remove-btn"><i class="fas fa-trash-alt"></i></button></td>';
      html += '</tr>';


      var input = '<input id="input-'+math+'" type="hidden" name="partisipan[]" value="'+partisipan+'">';
      var ukuran = '<input id="ukuran-'+math+'" type="hidden" name="jersey[]" value="'+jersey+'">';
      var hargaMass = '<input id="hargaMass-'+math+'" type="hidden" name="harga[]" value="'+harga+'">';
      var kategoriMass = '<input type="hidden" id="kategori-'+math+'" name="id_kategori[]" value="'+id_kategori+'">';
      var namaBib = '<input type="hidden" id="nama_bib-'+math+'" name="nama_bib[]" value="'+nama_bib+'">';

      var totals = $("#input-jumlah-total").val();
      totals = parseInt(totals);

      var diskon = $("#input-diskon").val();
      harga = parseInt(harga);
      $("#partisipan-table .parts").each(function(){
        var td = $(this).find('td:eq(3) button').text();
        console.log(td);
      });
      if(diskon =='0'){
          // console.log("pk");
          // console.log();
          var h = $("#harga_total").val();
            // console.log(h+harga);
            var jml = totals+harga;
            // console.log(jml);
      $("#harga-total").text(rupiah(jml));
      $("#jumlah-total").text(rupiah(totals+harga));
      $("#input-jumlah-total").val(totals+harga);
      $("#harga_total").val(totals+harga);
        
      }
      else{


      var tipe = $("#diskon").attr('data-tipe-diskon');
      // if()
      console.log(tipe);
      if(tipe=='2'){
        var diskon = $("#diskon").attr('data-diskon');
        diskon = parseInt(diskon);

      var t = (totals+(harga*(diskon/100)));
        console.log(t);
     $("#jumlah-total").text(rupiah(t));
      $("#input-jumlah-total").val(t);      
      $("#harga-total").text(rupiah(parseInt($("#harga_total").val())+harga));    
      $("#harga_total").val(parseInt($("#harga_total").val())+harga);



      }
      else{
      $("#jumlah-total").text(rupiah(totals+harga));
      $("#input-jumlah-total").val(totals+harga);       
      $("#harga_total").val(totals+harga);
      $("#harga-total").text(rupiah(parseInt($("#input-jumlah-total").val())+parseInt($("#input-diskon").val()))); 
      }
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
      $("#nama_bib-form").append(namaBib);
      // console.log(partisipanName);
      // console.log(jersey);
      // total();
      // console.log(total());
      $.ajax({
        url:"{{ url('/partisipan-add') }}",
        method: "GET",
        data: {
          p: partisipan
        },
        success:function(){

        }
      });
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