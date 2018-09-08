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
<div class="float-right">
  <a target="_blank" href="{{ url('/invoice/'.(string)$detail->id_transaction) }}" class="btn btn-info">Cetak Invoice</a>
</div>
{{-- <p class="card-text"> --}}
<div class="form-group">
  <label>
    <b>Event</b>
  </label><br>
  {{$event->nama}}

</div>
<div class="form-group">
  <label>
    <b>Kategori</b>
  </label><br>
{{--   {{$event->kategori->nama}}
 --}}
</div>
<div class="form-group">
  <label><b>Lokasi</b></label><br>
{{--   {{$event->kota->nama}} --}}
</div>
<div class="form-group">
  <label><b>Keterangan</b></label><br>
  {{$transaction->first()->keterangan_bank}}
</div>
<div class="form-group">
  <label><b>Status</b></label><br>
{!!$transaction->first()->status_bayar=='0' ? '<span class="badge badge-danger">Belum Lunas</span>':'<span class="badge badge-success">Lunas</span>'!!}
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

@endsection
