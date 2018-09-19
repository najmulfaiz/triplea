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
  Daftar Transaksi
</div>
<!-- Text Content -->
<div class="card-body ">
<div class="table-responsive">
  <div class="alert alert-primary">
    <i class="fa fa-info-circle"></i>&nbsp; Segera lunasi tagihan anda. invoice berlaku 1x24 jam dari tanggal pemesanan.
  </div>
<table class="table table-striped">
  <thead>
    <th>INVOICE</th>
    <th>Tanggal</th>
    <th>Nama</th>
    <th>Partisipan</th>
    <th>Total</th>
    <th>Status</th>
    <th>Detail</th>
  </thead>
  <tbody>
  @if ($transaksi->count()!=0)
    {{-- expr --}}
  @foreach ($transaksi as $t)
  <tr>
    <td><a href="{{ url('trx/'.$t->id) }}">{{ strtoupper(substr($t->event->nama, 0, 2)) . '-' . $t->id}}</a></td>
    <td>{{$t->tgl_transaksi}}</td>
    <td>
      {{ $t->event->nama }}
      <br><span class="text-muted" style="font-size: 10px;"><em>{{ $t->event->kota->nama }} - {{ date('d-m-Y', strtotime($t->event->tanggal)) }}</em></span>
    </td>
    <td>{{ count($t->personal) }}</td>
    <td class="text-right">{{number_format($t->harga_akhir,0,',','.')}}</td>
    <td>
    	@if($t->status_bayar == '1')
    		<span class="badge badge-success">Lunas</span>
    	@elseif($t->status_bayar == '9')
    		<span class="badge badge-secondary">Expired</span>
    	@else
    		<span class="badge badge-danger">Belum Lunas</span>
    	@endif

    	{{-- {!!$t->status_bayar=='0'?'<span class="badge badge-danger">Belum Lunas</span>':'<span class="badge badge-success">Lunas</span>'!!} --}}
    </td>
    <td><a style="padding: 10px;" href="{{ url('trx/'.$t->id) }}" class="btn btn-success"><i class="fa fa-search"></i></a></td>
  </tr>
    {{-- expr --}}
  @endforeach
  @else
  <tr>
  <td ></td>
    <td colspan="3"><center>Belum Ada Transaksi</center></td>
  <td></td>
  </tr>
  @endif
    
  </tbody>
</table>
</div>
{{-- <p class="card-text"> --}}
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
