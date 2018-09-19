@extends('main')

@section('content')

  <style type="text/css"> .content{ padding-top: 90px; } </style>
  {{-- expr --}}

    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}

<br>
<form action="{{ url('login') }}" method="post">
{{csrf_field()}}

  <div class="row">
    <div class="col-lg-12" style="margin: 0 auto;float: none;">
    @if (session('danger'))
    <div class="alert alert-danger">
      {{session('danger')}}
    </div>
      {{-- expr --}}
    @endif
    @if (session('success'))
    <div class="alert alert-success">
      {{session('success')}}
    </div>
      {{-- expr --}}
    @endif
      <div class="card">
      <!-- <div class="card-header">
                  <h3>Login</h3>
      </div> -->
        <div class="card-body">
          <div class="row mt-3 mb-3">
            <div class="col-md-7 pl-5">
              <h6 class="font-weight-bold">Petunjuk Login</h6>
              <ol class="mt-3 pl-3">
                <li class="pb-3">Masukkan Email dan Password</li>
                <li class="pb-3">Klik Login</li>
                <li class="pb-3">Jika ada kendala saat login silahkan Hub Kami melalui WA untuk Reset Password</li>
              </ol>
              <a class="btn btn-outline-success btn-sm" href="http://api.whatsapp.com/send?phone=6281333110906"><img src="https://cdn.icon-icons.com/icons2/840/PNG/512/Whatsapp_icon-icons.com_66931.png" alt="Whatsapp Image" height="25px">&nbsp; +6281333110906</a>
            </div>
        <div class="col-md-5 pr-5">
          <h4 class="text-center">Login</h4>
          <hr>
          <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control" autocomplete="off">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control">
        </div>
       
          <button class="btn btn-success form-control">Login</button>
          <br>
          <br>
          <center>
          Belum Punya Akun? <a style="color: blue" href="{{ url('/register') }}">Daftar</a></center>
        </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  </form>
       </div>
    </div>
<br><br><br>
@endsection