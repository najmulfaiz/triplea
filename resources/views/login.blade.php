@extends('main')

@section('content')
  {{-- expr --}}

    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}

<br>
<form action="{{ url('login') }}" method="post">
{{csrf_field()}}

  <div class="row">
    <div class="col-lg-4" style="margin: 0 auto;float: none;">
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
      <div class="card-header">
                  <h3>Login</h3>
      </div>
        <div class="card-body">
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
  </form>
       </div>
    </div>
<br><br><br>
@endsection