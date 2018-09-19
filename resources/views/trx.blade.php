@extends('main')

@section('content')
  {{-- expr --}}

  <style type="text/css">
    .content{
      padding-top: 100px;
    }
  </style>

    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}

        <div class="row">
        <div class="col-lg-10 with-margin" style="float: none;margin: 0 auto;">

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
<div class="card">
<!-- Image -->
<div class="card-header">
  Info Transaksi
</div>
<!-- Text Content -->
<div class="card-body ">
<div class="row">

  <div class="col-lg-7">
    {{-- <p class="card-text"> --}}
      <div class="form-group">
      <label><b>INVOICE</b></label><br>
      {{strtoupper(substr($event->nama, 0, 2)) . '-' . $transaction->first()->id}}
    </div>
    <div class="form-group">
      <label>
        <b>Event</b>
      </label><br>
      {{$event->nama}}

    </div>
    <div class="form-group">
      <label><b>Lokasi</b></label><br>
      {{$event->kota->nama}}
    </div>
    <div class="form-group">
      <label><b>Keterangan</b></label><br>
      {{$transaction->first()->keterangan_bank}}
    </div>
    <div class="form-group">
      <label><b>Status</b></label><br>
    <!-- {!!$transaction->first()->status_bayar=='0' ? '<span class="badge badge-danger">Belum Lunas</span>':'<span class="badge badge-success">Lunas</span>'!!} -->
      @if($transaction->first()->status_bayar == '1')
        <span class="badge badge-success">Lunas</span>
      @elseif($transaction->first()->status_bayar == '9')
        <span class="badge badge-secondary">Expired</span>
      @else
        <span class="badge badge-danger">Belum Lunas</span>
      @endif
    </div>
  </div>
  <div class="col-lg-5">
    <div class="row">
      <div class="col-lg-12 text-right">
        @if($transaction->first()->status_bayar != '9')
        <a target="_blank" href="{{ url('/invoice/'.(string)$detail->id_transaction) }}" class="btn btn-info">Cetak Invoice</a>
        @endif
      </div>
      <div class="col-lg-12 text-right mt-5">
        @if($transaction->first()->status_bayar=='0')
          <p class="mb-0 mt-2">Jatuh Tempo: {{ date('d-m-Y h:i:s', strtotime('+1 days', strtotime($transaction->first()->tgl_transaksi))) }}</p>

          <p class="mb-0 mt-2">
            Silahkan transfer ke: <br/>
            <span class="font-weight-bold">{{ $event->rekening->bank->nama_bank }}</span> ({{ $event->rekening->bank->kode_bank }}) <br/>
            No. Rekening <span class="font-weight-bold">{{ $event->rekening->no_rekening }}</span> <br/>
            a.n. <span class="font-weight-bold">{{ $event->rekening->nama_pemilik }}</span>
          </p>

          <p class="mb-0 mt-2">
            Total Transfer : <span class="font-weight-bold">Rp. {{ number_format(substr($transaction->first()->harga_akhir, 0, -3), 0, ',', '.') }}.<span style="color: orange;">{{ $transaction->first()->validasi_no }}</span></span><br />
            <span class="mt-1" style="background-color: #FFC200; padding: 3px 3px;"><span class="font-weight-bold">PENTING!</span> Mohon transfer sampai 3 digit terakhir</span>
          </p>
        @elseif($transaction->first()->status_bayar == '1')
          @php
          $tgl       = $transaction->first()->tgl_transaksi;
          $tgl       = date('d-m-Y',strtotime($tgl));
          $nohp      = $transaction->first()->user->nohp;
          $id_event  = $transaction->first()->id_event;

          $output    = $tgl.'|'.$id_event.'|'.$nohp;
          $encrypted = base64_encode($output);
          @endphp
          <img src="{{ asset('barcode/' . md5($encrypted) . '.png') }}" alt='barcode'/>
        @endif
      </div>
    </div>
  </div>
</div>

<div class="form-group">
  <label><b>Partisipan</b></label><br>
{{-- {{$detail->formParticipant->ukuranJersey->ukuran}} --}}
<table class="table table-bordered">
<thead>
  <th>Nama</th>
  <th>Kategori</th>
  <th>Harga</th>
</thead>
@if ($dt->count()>0)
@foreach ($dt->get() as $detailTransaction)
<tr>
  <td>{{$detailTransaction->formParticipant->personalDetail!=null ? $detailTransaction->formParticipant->personalDetail->nama_awal.' '.$detailTransaction->formParticipant->personalDetail->nama_akhir : 'Data Peserta Tidak Ada'}}</td><td>{{$detailTransaction->kategori->nama}}</td>
  <td  style="text-align: right;">{{number_format($detailTransaction->harga,2,',','.')}}</td>
</tr>
@endforeach
<tr style="background: #eee">
  <td></td><td></td><td style="text-align: right;">{{number_format($total,2,',','.')}}</td>
</tr>

  {{-- expr --}}
{{--   {{$detailTransaction->get()}} --}}
@endif
</table>
</div>
<h4><b>Harga</b></h4>
<table class="table table-bordered">
  <tr>
    <td style="width: 75%;">Harga Total</td><td style="text-align: right;">{{number_format($total,2,',','.')}}</td>
  </tr>
  <tr>
    <td>Diskon

{!! !empty($transaction->first()->diskon_data) ? "<span style='background-color:#26A65B;padding:5px;color:#fff'>".$transaction->first()->diskon_data->kode."</span>" :'' !!}
</td><td style="text-align: right;">{{!empty($transaction->first()->diskon_data) ? ($transaction->first()->diskon_data->jenis=='2'? $transaction->first()->diskon_data->potongan.'%':' '.number_format($transaction->first()->diskon_data->potongan,2,',','.')) : ''}}</td>
  </tr>
  <tr>
    <td>Kode Unik</td><td style="text-align: right;">{{$transaction->first()->validasi_no}}</td>
  </tr>
<tr style="background: #eee">
    <td>Harga Akhir</td><td style="text-align: right;">{{number_format($transaction->first()->harga_akhir,2,',','.')}}</td>
  </tr>
</table>
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

      
    </div>

    </div>
      </div>
    </div>


<style type="text/css">
  .bottom-checkout{
    position: fixed;bottom: 0;background: #fff;box-shadow: 0px -5px 5px  rgba(0,0,0,0.2);padding: 20px;width: 100%;
  }
  .no-padding-right{
    padding-right: 0;
  }
    @media (max-width: 768px) {
    .icon-rotate{
      display: none;
    }
    .event-name{
      font-size: 18px;
    }

  .btn-checkout{
    margin: 0;padding: 10px;
/*    float: right;*/
width: 100%;
  }


  .height-animate{
  bottom: 0;
transition: bottom 0.8s ease-in-out;
  }
  .hide-animate{
    transition: bottom 0.8s ease-in-out;
    bottom: -10000px;
  }
  }
  .icon-rotate{
    font-size: 35px;margin-top:10px;-webkit-transform: rotate(-35deg);

/* Firefox */
-moz-transform: rotate(-35deg);

/* IE */
-ms-transform: rotate(-35deg);

/* Opera */
-o-transform: rotate(-35deg);

/* Internet Explorer */
filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=3);
  }
  .event-name{
    display: inline-block;margin-left: 10px;margin-bottom: 10px;
  }
  .btn-checkout{
    margin: 0;padding: 10px;
    margin-top: 10px;
    float: right;
  }
</style>

@if(count($event->eventWa))
<div style="" class="bottom-checkout height-animate" id="btm-checkout">
  <div class="container">
    <div class="row">
      <div class="col-lg-12" class="no-padding-right align-middle">


      <h3 class="event-name">Butuh Bantuan CS kami?</h3>

      <a class="btn btn-outline-success btn-checkout" href="http://api.whatsapp.com/send?phone={{ $event->eventWa->no_wa }}"><img src="https://cdn.icon-icons.com/icons2/840/PNG/512/Whatsapp_icon-icons.com_66931.png" alt="Whatsapp Image" height="25px">&nbsp; +{{ $event->eventWa->no_wa }}</a>

      </div>
    </div>
  </div>
</div>
@endif

@endsection

@push('script')
<script type="text/javascript">
    // $("#btm-checkout").hide();

    $("#btm-checkout").removeClass('height-animate');
    $("#btm-checkout").addClass('hide-animate');
$(window).scroll(function(){
  if($(window).scrollTop()>1){
    $("#btm-checkout").addClass('height-animate');
    $("#btm-checkout").removeClass('hide-animate');    
  }
  else{
    $("#btm-checkout").removeClass('height-animate');
    $("#btm-checkout").addClass('hide-animate');

  }
})
</script>
  {{-- expr --}}
@endpush
