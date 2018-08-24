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

<div class="card">
<!-- Image -->

<!-- Text Content -->
<div class="card-body card-padding">
{{-- <p class="card-text"> --}}


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Daftar Kategori</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <table class="table table-striped">
      <thead>
              <th>Nama</th>
              <th>Harga</th>
              <th>Kuota</th>
              <th>Opsi</th>

      </thead>

        <tbody>
@foreach ($data->group as $g)

@if (!is_null($g->kategori['nama']))
  {{-- expr --}}

<tr>
  <td>{{$g->kategori['nama']}}</td>
  <td>{{$g->kategori['harga']}}</td>
  <td>{{$g->kategori['kuota']}}</td>
  <td>
    <form action="{{ url('buy') }}" method="post">
    {{csrf_field()}}  
    <input type="hidden" name="id_kategori" value="{{$g->kategori['id']}}">
    <button type="submit" style="padding: 5px 5px;" class="btn btn-primary">Beli</button>
    </form>
  </td>
</tr>
  </li>
@endif
  @endforeach
  </tbody>
      </table>
        
      </div>
    </div>
  </div>
</div>
<h3>Info Event</h3>
<div class="float-right">
{{-- {{$user->tipe_akun}} --}}
@if ($user->tipe_akun=='0')
  {{-- expr --}}
  <button type="button"  class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
@elseif($user->tipe_akun==1)
<a class="btn btn-primary" href="{{ url('/checkout/'.Request::segment(1)) }}">Beli</a
@endif
  Beli Tiket
</button>
</div>


<ul class="list-group">
  <li class="list-group-item"> <i class="fas fa-calendar-alt"></i> {{$data->nama}}</li>
  <li class="list-group-item"><i class="fas fa-map-marker"></i> {{$data->kota->nama}}</li>
  <li class="list-group-item"></li>
</ul>


  
{{-- </p> --}}
{{-- </p> --}}
<br><br>
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Detail</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Fasilitas</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Event Term</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
<br>
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    
  <h3>Detail</h3>
  <table class="table table-bordered">
    <tr>
      <td>Status Registrasi</td><td>{!!$data->eventDetail->status_registrasi=='0'? '<span class="badge badge-danger">Close</span>':'<span class="badge badge-success">Open</span>'!!}</td>
    </tr>
    <tr>
      <td>Deskripsi</td><td>{{$data->eventDetail->deskripsi}}</td>
    </tr>
  </table>
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <h3>Fasilitas</h3>

  {!!$data->fasilitas->deskripsi!!}
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

  <h3>Event Term</h3>

  {!!$data->eventTerm->deskripsi!!}
  </div>
</div>
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