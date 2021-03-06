<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Triple A Sport Management</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="{{ asset('assets/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/clean-blog.min.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/fontawesome/css/all.css') }}">
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />


  </head>

  <body style="font-family: 'Muli', sans-serif;background-color: #f5f5f5;font-size: 15px;">
    <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top is-fixed-custom is-visible" id="mainNav">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Booking Online</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fa fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
           
            @if (empty(session('userid')))
 <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/daftar-peserta') }}">Daftar Peserta</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/login') }}">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/register') }}">Register</a>
            </li>
            @else
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/daftar-peserta') }}">Daftar Peserta</a>
            </li>
              <li class="nav-item">
                    <a class="btn btn-primary" href="{{ url('/') }}"><span style="color: #fff;">Beli</span></a>
            </li>
                                    <li class="nav-item">
                    <a class="nav-link" href="{{ url('/profile') }}">Profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/dashboard') }}">Data Partisipan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/transaksi') }}">Transaksi {!!$jml_transaksi!=0?'<span class="badge badge-success">'.$jml_transaksi.'</span>':''!!}</a>
            </li>

                        <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
            </li>
            @endif

          </ul>
        </div>
      </div>
    </nav>


<style type="text/css">
@media only screen and (min-width: 992px){
#mainNav.is-fixed-custom {
    position: fixed;
    top: -72px;
    -webkit-transition: -webkit-transform .2s;
    -moz-transition: -moz-transform .2s;
    transition: transform .2s;
    border-top: 5px solid #fff;
    background-color: #3bafda;
}
}
</style>
    <!-- Page Header -->
    <div class="content">
    @yield('content')
    <!-- Footer -->
<footer class="footer bg-secondary" style="padding: 20px 0 30px;margin-top: 100px;">
      <div class="container text-center">
        <span class="text-white">&copy; {{date('Y')}} Booking Online</span>
      </div>
    </footer>
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('/js/jquery.debounce.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <!-- Custom scripts for this template -->
<!--     <script src="{{ asset('assets/js/clean-blog.min.js') }}"></script> -->
<script type="text/javascript" src="http://opoloo.github.io/jquery_upload_preview/assets/js/jquery.uploadPreview.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js
"></script>


<style type="text/css">

#image-preview {
  width: 300px;
  height: 150px;
  position: relative;
  overflow: hidden;
  background-color: #ffffff;
  color: #ecf0f1;
}
#image-preview input {
  line-height: 200px;
  font-size: 200px;
  position: absolute;
  opacity: 0;
  z-index: 10;
}
#image-preview label {
  position: absolute;
  z-index: 5;
  opacity: 0.8;
  cursor: pointer;
  background-color: #bdc3c7;
  width: 200px;
  height: 50px;
  font-size: 20px;
  line-height: 50px;
  text-transform: uppercase;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  margin: auto;
  text-align: center;
}

@media (min-width: 1200px){
.container {
    max-width: 90%;
}
}

.auth-text{
  font-family: Open Sans;
}
.with-margin{
  margin-bottom: 30px;
}
.bg{
  width: 100%;height: 230px;background-size: cover;background-image: url('https://www.quackit.com/pix/samples/12s.jpg');
}

.card-padding{
  padding: 0.8rem;
}

 .auth-img {
    margin-right: 6px;
    height: 30px;
    width: 30px;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    border: 1px solid;
}
.with-box-shadow{
  box-shadow: 0 1px 5px rgba(0,0,0,0.2);
}
  .card:hover{
    box-shadow: 0 1px 2px rgba(0,0,0,0.2);
  }
  .card:hover a{
    text-decoration: none;
    text-decoration-color: none;
    color: none;
  }
  a:hover{
    color: #333;
  }
  .prop{
    font-size: 15px;
  }

  .list-group-item{
  border: none;
padding: .40rem 1rem;
  }
  .marker {max-width: 256px;max-height: 256px;background-image: url(data:image/svg+xml;utf8;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/Pgo8IS0tIEdlbmVyYXRvcjogQWRvYmUgSWxsdXN0cmF0b3IgMTkuMC4wLCBTVkcgRXhwb3J0IFBsdWctSW4gLiBTVkcgVmVyc2lvbjogNi4wMCBCdWlsZCAwKSAgLS0+CjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxuczp4bGluaz0iaHR0cDovL3d3dy53My5vcmcvMTk5OS94bGluayIgdmVyc2lvbj0iMS4xIiBpZD0iTGF5ZXJfMSIgeD0iMHB4IiB5PSIwcHgiIHZpZXdCb3g9IjAgMCA1MTEuOTk5IDUxMS45OTkiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUxMS45OTkgNTExLjk5OTsiIHhtbDpzcGFjZT0icHJlc2VydmUiIHdpZHRoPSI1MTJweCIgaGVpZ2h0PSI1MTJweCI+CjxwYXRoIHN0eWxlPSJmaWxsOiNFRTM4NDA7IiBkPSJNNDU0Ljg0OCwxOTguODQ4YzAsMTU5LjIyNS0xNzkuNzUxLDMwNi42ODktMTc5Ljc1MSwzMDYuNjg5Yy0xMC41MDMsOC42MTctMjcuNjkyLDguNjE3LTM4LjE5NSwwICBjMCwwLTE3OS43NTEtMTQ3LjQ2NC0xNzkuNzUxLTMwNi42ODlDNTcuMTUzLDg5LjAyNywxNDYuMTgsMCwyNTYsMFM0NTQuODQ4LDg5LjAyNyw0NTQuODQ4LDE5OC44NDh6Ii8+CjxwYXRoIHN0eWxlPSJmaWxsOiNGRkUxRDY7IiBkPSJNMjU2LDI5OC44OWMtNTUuMTY0LDAtMTAwLjA0MS00NC44NzktMTAwLjA0MS0xMDAuMDQxUzIwMC44MzgsOTguODA2LDI1Niw5OC44MDYgIHMxMDAuMDQxLDQ0Ljg3OSwxMDAuMDQxLDEwMC4wNDFTMzExLjE2NCwyOTguODksMjU2LDI5OC44OXoiLz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPGc+CjwvZz4KPC9zdmc+Cg==)}

.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}
</style>
@stack('script')
  </body>
</html>
