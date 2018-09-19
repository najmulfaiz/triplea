@extends('main')

@section('content')
  {{-- expr --}}

    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}

  <style type="text/css"> .content{ padding-top: 90px; } </style>
<form action="{{ url('register') }}" method="post">
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
        <div class="card-body">
        <div class="row mt-3 mb-3">
          <div class="col-lg-7 pl-5">
          <h6 class="font-weight-bold">Petunjuk Pendaftaran</h6>
          <ol class="mt-3 pl-3">
            <li class="pb-3">Isikan Email dan NoHP dengan benar (Valid)</li>
            <li class="pb-3">Setelah berhasil mendaftar, silahkan cek email untuk verifikasi</li>
            <li class="pb-3">Lengkapi Profil Partisipan</li>
            <li class="pb-3">Lakukan Transaksi Pembelian Tiket</li>
            <li class="pb-3">Invoice dan Bukti Bayar akan dikirim melalui Email yang didaftarkan</li>
            <li class="pb-3">Invoice berlaku hanya 1 x 24 Jam. Lakukan pembayaran segera</li>
          </ol>
        </div>  
        <div class="col-lg-5 pr-5">
          <div class="form-group">
          <label>Email</label>
          <input type="email" name="email" class="form-control">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
          <label>Ulangi Password</label>
          <input type="password" name="re_password" class="form-control">
        </div>
        <div class="form-group">
          <label>Tipe Akun</label>
<br>
<div class="custom-control custom-radio" style="display: inline-block;">
  <input type="radio" id="customRadio1" name="tipe" class="custom-control-input" value="0">
  <label class="custom-control-label" for="customRadio1">Personal</label>
</div>
<div class="custom-control custom-radio" style="display: inline-block;">
  <input type="radio" id="customRadio2" name="tipe" class="custom-control-input" value="1">
  <label class="custom-control-label" for="customRadio2">Komunitas</label>
</div>

        </div>
        <div class="form-group">
          <label>Nomor HP</label>
          <input type="text" name="no_hp" class="form-control">
        </div>

          <button class="btn btn-success form-control">Register</button>
          <br>
          <br>
          <center>
          Punya Akun? <a style="color: blue" href="{{ url('/login') }}">Login</a></center>
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

@push('script')
  {{-- expr --}}
@endpush