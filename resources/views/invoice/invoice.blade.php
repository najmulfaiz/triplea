<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Cetak Invoice</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/clean-blog.min.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/fontawesome/css/all.css') }}">


<style type="text/css">
  .check
{
    opacity:0.5;
  color:#996;
}
.box{
    margin-bottom:5px;
}

@media print {
  
  body{
    -webkit-print-color-adjust: exact;
    background: #fff;
  }
td{
  padding: 10px;
  border: 1px solid #333;
}
table{
  border-collapse: collapse;
}


}

td{
  padding: 10px;
  border: 1px solid #333;
}
table{
  border-collapse: collapse;
}

</style>
  </head>

  <body onload="window.print()">


    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}


        <div >
        <div class="with-margin" style="width: 50%;float: left;">
          <div >
                    <img src="{{ asset('/img/logo.jpg') }}" class="img img-responsive" style="width: 250px;height: 100px;">
            
          </div>
        </div>
        <div class="with-margin" style="width: 50%;float: right;">
<br>
            @if ($transaction->first()->status_bayar=='0')
            <div style="background: #e74c3c;width: 40%;margin:0 auto;text-transform: uppercase;color: #fff;padding: 10px;margin-top: 0px;width: 50%;">
            
              {{-- expr --}}
            <center><h5 style="padding: 0;margin: 0;">Belum Dibayar</h5></center>


            </div>
            @elseif($transaction->first()->status_bayar=='1')

            <div style="background: #26C281;width: 40%;margin:0 auto;text-transform: uppercase;color: #fff;padding: 10px;margin-top: 0px;width: 50%;">
            
              {{-- expr --}}
            <center><h5 style="padding: 0;margin: 0;">Sudah Dibayar</h5></center>


            </div>

            @endif
         
        </div>
        <div class="col-lg-12 with-margin">

        <div style="width: 100%;float: left;margin-top: 30px;">
          
<div class="col-lg-4" style="width: 33.3%;float: left;">
<span style="font-size: 25px;">  <b>INVOICE #{{$transaction->first()->id}}</b> <br></span>
  Tanggal {{date('d-m-y',strtotime($transaction->first()->tgl_transaksi))}} <br>
</div>
<div class="col-lg-4" style="width: 33.3%;float: left;">
  <b>Ditagihkan Kepada</b><br>
    <span>{{$detail->formParticipant->personalDetail->nama_awal.' '.$detail->formParticipant->personalDetail->nama}}</span><br>

    <address>{{$detail->formParticipant->personalDetail->alamat}}</address><br>
</div>
<div class="col-lg-4" style="width: 33.3%;float: left;">
  <b>Bayar Kepada</b><br>
  TripleASport
</div>
        </div>
<div class="card" style="width: 100%;">
<!-- Image -->
<!-- Text Content -->
<div class="card-body " >

{{-- <div style="background-color: #00ffe4; height: 100px; width: 100px;">
Hello, world.
</div> --}}

<table  border="1" style="width: 100%;pad">
<tr style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;background: #fff;" width="40%">
  <td>Event</td><td>{{$transaction->first()->event->nama}}</td>
</tr>
<tr style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;background: #fff;" width="40%">
  <td>Tanggal</td><td>{{date('d-M-Y',strtotime($transaction->first()->event->tanggal))}}</td>
</tr>
<tr style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;background: #fff;" width="40%">
  <td>Kota</td><td>{{$transaction->first()->event->kota->nama}}</td>
</tr>
<tr style="border-top:1px solid rgba(0,0,0,0.12);border-bottom:1px solid rgba(0,0,0,0.12);padding:10px 0;background: #fff;" width="40%">
  <td>Keterangan Bank</td><td>{{$transaction->first()->keterangan_bank}}</td>
</tr>


</table>
<br><br>
<table  border="1" style="width: 100%;pad">
<tr>
  <td style="background-color: #1abc9c;color: #fff; height: 50px;width: 75%;"><center>Partisipan</center></td>
  <td style="background-color: #1abc9c;color: #fff; height: 50px;width: 75%;"><center>Kategori</center></td>
  <td  style="background-color: #1abc9c;color: #fff; height: 50px"><center>Harga (IDR)</center></td>
</tr>

@if ($dt->count()>0)
@foreach ($dt->get() as $detailTransaction)

<tr>
  <td>{{$detailTransaction->formParticipant->personalDetail->nama_awal.' '.$detailTransaction->formParticipant->personalDetail->nama_akhir}}</td>

  <td >{{$detailTransaction->kategori->nama}}</td>
  <td  style="text-align: right;">{{number_format($detailTransaction->harga,2,',','.')}}</td>
</tr>
@endforeach
<tr style="background: #eee">
  <td></td><td></td><td style="text-align: right;"><b> {{number_format($total,2,',','.')}}</b></td>
</tr>
@endif


</table>
<br><br>
<table  border="1" style="width: 100%;">
<tr>
  <td style="background-color: #1abc9c;color: #fff; height: 50px;width: 75%;"><center>Deskripsi</center></td><td  style="background-color: #1abc9c;color: #fff; height: 50px"><center>Harga</center></td>
</tr>
  <tr>
    <td>  Subtotal</td><td  style="text-align: right"> IDR {{number_format($total,2,',','.')}}</td>
  </tr>
  <tr>
    <td>Diskon
{!! !empty($transaction->first()->diskon_data) ? "<span style='background-color:#26A65B;padding:5px;color:#fff'>".$transaction->first()->diskon_data->kode."</span>" :'' !!}

    </td><td  style="text-align: right">{{!empty($transaction->first()->diskon_data) ?($transaction->first()->diskon_data->jenis=='2'? $transaction->first()->diskon_data->potongan.'%':'IDR. '.number_format($transaction->first()->diskon_data->potongan,2,',','.')) : ''}}</td>
  </tr>
  <tr>
    <td>Kode Unik</td><td  style="text-align: right">{{$transaction->first()->validasi_no}}</td>
  </tr>
  <tr style="background: #ccc;">
    <td>Harga Akhir</td><td style="text-align: right"><b>{{number_format($transaction->first()->harga_akhir,2,',','.')}}</b></td>
  </tr>
</table>
<br><br>
@if ($transaction->first()->status_bayar=='0')
  {{-- expr --}}
Lakukan Pembayaran dengan melakukan transfer dana (<b>wajib dengan 3 digit kode unik </b>) ke rekening kami dibawah ini: 
 <div style="width: 30%;height: 100%;">  <br>

          <div style="margin-top:30px;">
            <center>
          <img src="{{ asset('/img/bca.png') }}" class="img img-responsive" style="width: 200px;height: 70px;padding: ">
          </center>

          </div>
          
          <center><b>{{$rekening->bank->nama_bank}}</b><br>
                    {{$rekening->no_rekening}} <br> a/n 

                    {{$rekening->nama_pemilik}}

          </center>

          </div>
@endif
{{-- </p> --}}
</div>
{{-- <div class="card-footer">
</div> --}}

</div>


      
    </div>

    </div>
      </div>
    </div>

</body>
</html>