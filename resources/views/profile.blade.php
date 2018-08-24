@extends('main')

@section('content')
  {{-- expr --}}
  <style type="text/css"> .content{ padding-top: 90px; } </style>
    <div class="container">

        <div class="row">
        <div class="col-lg-12 with-margin">

<div class="card">
<!-- Image -->

<!-- Text Content -->
<div class="card-body ">
{{-- <p class="card-text"> --}}
<center><h3>Profil</h3></center>
<div class="row">
<div class="col-lg-6">
@if (session('success'))
<div class="alert alert-success">
{{session('success')}}
</div>
  {{-- expr --}}
@endif

@if (session('danger'))
<div class="alert alert-danger">
{{session('danger')}}
</div>
  {{-- expr --}}
@endif
<form action="{{ url('/profile') }}" method="post">
{{csrf_field()}}
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" class="form-control" value="{{$user->email}}"> 
  </div>
  <div class="form-group">
    <label>Password</label>
    <input type="text" name="password" class="form-control"> 
  </div>
  <div class="form-group">
    <label>Tipe Akun</label>
  <select class="form-control" name="tipe_akun" id="tipe_akun">
  <option value="">Tipe Akun</option>
  <option {{$user->tipe_akun=='0'?'selected':''}} value="0">Personal</option>
  <option  {{$user->tipe_akun=='1'?'selected':''}}  value="1">Komunitas</option>
    
  </select>
  </div>
  <div id="addition" {!!$user->tipe_akun=='0'?'style="display: none"':''!!}>
  <div class="form-group" >
    <label>Nama Komunitas</label>
    <input type="text" name="komunitas" class="form-control" value="{{$user->komunitas}}"> 
  </div>
  <div class="form-group" >
    <label>Jumlah Personal</label>
    <input type="text" name="jml" class="form-control" value="{{$user->jml_personal}}">  
  </div>
  </div>

  <div class="form-group">
    <label>NO HP</label>
    <input type="text" name="no_hp" class="form-control" value="{{$user->nohp}}"> 
  </div>
  <center><button type="submit" class="btn btn-primary">Ubah</button></center>
  </div>

</div>
</form>
  
</div>
<br><br>

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
  $(document).on('change','#tipe_akun',function(){
    var val = $(this).val();
      if(val=='1'){
        $("#addition").show();
      }
      else{
        $("#addition").hide();

      }
  });
</script>
  {{-- expr --}}
@endpush