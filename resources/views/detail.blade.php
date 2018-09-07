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

@if (session('danger'))
<div class="alert alert-danger">
  
  {{session('danger')}}
</div>
@endif
@if (session('success'))
<div class="alert alert-success">
  
  {{session('success')}}
</div>

  {{-- expr --}}
@endif
<div class="card" style="min-height: 900px;">
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
              <th>Opsi</th>

      </thead>

        <tbody>
@foreach ($data->group as $g)
@foreach ($g->Kategori as $k)
    {{-- expr --}}
@if (!is_null($k->nama))
  {{-- expr --}}
@php
  $earlyBird = App\EarlyBird::where('id_kategori',$k->id);
  if($earlyBird->count()>0){
    $dibeli = DB::select("SELECT count(*) as count FROM `detail_transaction_id_event` a inner join transaction_id_event b on b.id = a.id_transaction where a.id_kategori ='1' and b.status_bayar='".$k->id."'");
    $count = $dibeli;
    $count = $count[0]->count;
    $kuota = $earlyBird->first()->kuota;
    // echo $kuota;
    if($count < $kuota){
      $harga= $earlyBird->first()->harga;
    }
    else{
      $harga = $kharga;
    }

  }
  else{
          $harga = $k->harga;
  }
@endphp
<tr>
  <td>{{$k->nama}}</td>
  <td>{{$harga}}</td>
  <td>
    <form action="{{ url('buy') }}" method="post">
    {{csrf_field()}}  
    <input type="hidden" name="id_kategori" value="{{$k->id}}">

    <button type="submit" class="btn btn-primary">Beli</button>
    </form>
  </td>
</tr>
  </li>
@endif
  @endforeach  
  @endforeach
  </tbody>
      </table>
        
      </div>
    </div>
  </div>
</div>
<h3>Info Event</h3>


<div class="row">
<div class="col-lg-4">
    <img src="{{$data->logo}}" class="rounded img img-responsive" style="width: 100%;">
</div>
<div class="col-lg-4">
  <ul class="list-group">

  <li class="list-group-item"> <i class="fas fa-flag"  ></i><span style="font-size: 15px;margin-left: 2px;">{{$data->nama}}</span></li>
  <li class="list-group-item"><i class="fas fa-calendar-alt"></i><span style="font-size: 15px;margin-left: 2px;"> {{$data->tanggal}}</span></li>
  <li class="list-group-item"><i class="fas fa-map-marker"></i> <span style="font-size: 15px;margin-left: 2px;">{{$data->kota->nama}}</span></li>
  <li class="list-group-item"> <span style="font-size: 15px;margin-left: 2px;">{!!$data->eventDetail!=null ? $data->eventDetail->status_registrasi=='0'? '<span class="badge badge-danger">Close</span>':'<span class="badge badge-success">Open</span>' :''!!}</span></li>
  <li class="list-group-item"></li>
</ul>

</div>  
<div class="col-lg-3">
  
<div class="float-right">
{{-- {{$user->tipe_akun}} --}}

</button>
</div>
</div>
</div>


  
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
{{-- <h3>Deskripsi</h3> --}}
{!!$data->eventDetail!=null ? $data->eventDetail->deskripsi :''!!}
  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
{{--   <h3>Fasilitas</h3> --}}

  {!!$data->fasilitas != null ? $data->fasilitas->deskripsi :''!!}
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
{{-- 
  <h3>Event Term</h3>
 --}}
  {!!$data->eventTerm!=null ? $data->eventTerm->deskripsi:''!!}
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
    display: inline-block;margin-left: 10px;
  }
  .btn-checkout{
    margin: 0;padding: 10px;
    margin-top: 10px;
    float: right;
  }
</style>
<div style="" class="bottom-checkout height-animate" id="btm-checkout">
<div class="container">
  
<div class="row">
  <div class="col-lg-12" class="no-padding-right">


  <i class="fas fa-ticket-alt icon-rotate" ></i> <h3 class="event-name">{{$data->nama}}</h3>
{{-- <div class="float-right"> --}}

@if ($data->eventDetail!=null)
  {{-- expr --}}
  @if ($data->eventDetail->status_registrasi==1)
@if ($user->tipe_akun=='0')
  {{-- expr --}}
{{--   {!!$data->eventDetail!=null ? $data->eventDetail->status_registrasi=='0'? '<span class="badge badge-danger">Close</span>':'<span class="badge badge-success">Open</span>' :''!!} --}}

  <button type="button"  class="btn btn-success btn-checkout"  data-toggle="modal" data-target="#exampleModal" >
  Beli
  </button>
@elseif($user->tipe_akun==1)
<a class="btn btn-success btn-checkout" href="{{ url('/checkout/'.$data->id) }}">beli</a>
@endif
  @else
    <button disabled="" type="button"  class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
  .
  </button>

  @endif
@endif


  {{-- 
</div> --}}

  </div>
</div>
</div>
</div>
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