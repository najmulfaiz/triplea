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
  
<table class="table table-striped">
  <thead>
    <th>Invoice</th>
    <th>Tanggal</th>
    <th>Status</th>
    <th>Total</th>
    <th>Opsi</th>
  </thead>
  <tbody>
  @if ($transaksi->count()!=0)
    {{-- expr --}}
  @foreach ($transaksi as $t)
  <tr>
    <td><a href="{{ url('trx/'.$t->id) }}">{{$t->id}}</a></td>
    <td>{{$t->tgl_transaksi}}</td>
    <td>{!!$t->status_bayar=='0'?'<span class="badge badge-danger">Belum Lunas</span>':'<span class="badge badge-success">Lunas</span>'!!}</td>
    <td>{{number_format($t->harga_akhir,2,',','.')}}</td>
    <td><a style="padding: 10px;" href="{{ url('trx/'.$t->id) }}" class="btn btn-success">Detail</a></td>
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
