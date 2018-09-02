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

    <!-- Custom styles for this template -->
    <link href="{{ asset('assets/css/clean-blog.min.css') }}" rel="stylesheet">
{{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous"> --}}
<link rel="stylesheet" type="text/css" href="{{ asset('font-awesome/fontawesome/css/all.css') }}">


  </head>

  <body style="font-family: Open Sans;background-color: #f5f5f5;">
    <!-- Navigation -->
 @include('components.nav')
 

    <!-- Page Header -->
    <header class="masthead" style="background-image: url('{{ asset('assets/img/home-bg.jpg') }}');margin-bottom: 0;"  id="masthead">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-10 mx-auto">
            <div class="site-heading">
  <h3 style="padding: 0;margin: 0;">Temukan Event Menarik Kamu Disini</h3>
  <br>
  <!-- Another variation with a button -->
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Search restaurants, spa, events, city, location, vendor">
    <div class="input-group-append">

      <button class="btn btn-secondary" type="button">
        <i class="fa fa-search"></i>
      </button>
    </div>
  </div>
  

            </div>
          </div>
        </div>
      </div>
    </header>

<style type="text/css">

.event-name-index{
  margin-left: 20px;
}
@media (max-width: 768px) {
  .event-icon{
    display: none;
  }  

.event-name-index{
  margin-left: 0;
}

}



</style>
      <div style="background: #D91E18;margin-bottom: 50px;">
      <div class="container">
      <div class="col-lg-9" style="margin: 0 auto;float: none;color: #fff">
      <div style="padding: 15px;">
        

  <div class="form-group" >
<div class="row">
<div class="col-lg-1">
  
</div>
  <div class="col-lg-6 col-sm-12" style="padding-left: 0;">
  <div class="float-left">
       <i class="fas fa-calendar-alt event-icon" style="font-size: 40px;vertical-align: middle;"></i>
    <span class="event-name-index">   {{$event->nama}}</span>

  </div>

    
  </div>

  <div class="col-lg-5 col-sm-12" style="padding-left: 0;">
<center>
    <span data-date="{{$date}}" id="getting-started" style="letter-spacing: 1px;font-size: 25px;"></span>
    </center>
  </div>
</div>

  </div>

      </div>

      </div>
      </div>
</div>
    <!-- Main Content -->
    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}
        <div class="row">
        @foreach ($data as $d)
  <div class="col-lg-4 with-margin" style="height: 500px;">

<div class="card with-box-shadow">
      <a href="{{ url('/'.str_slug($d->nama,'-').'-'.$d->id) }}">

<div id="bg"  class="bg" style="background-image: url('{{$d->logo}}')">

  
</div>
<!-- Image -->

<!-- Text Content -->
<div class="card-body card-padding">
{{-- <p class="card-text"> --}}
  <ul class="list-group">
    <li class="list-group-item"><h4>{{$d->nama}}</h4>
</li>
    <li class="list-group-item prop"><i class="fas fa-map-marker text-danger"></i>  {{$d->kota->nama}}
</li>
  <ul class="list-group">
    <li class="list-group-item prop">
  @foreach ($d->group as $g)
    {{-- expr --}}
    <span class="badge badge-primary">{{$g->nama}}</span>
  @endforeach
</li>
  </ul>
{{-- </p> --}}
</div>
</a>
<div class="card-footer">
  <a href="#">
  <img src="http://bookmyslot.meghinfotech.site/assets/uploads/profiles/5b62d85ad3d30.png" class="auth-img">
  <span class="auth-text">Profile</span>
{{--   <span class="float-right">Rp.1000;</span> --}}

  </a>
<br>

</div>
  <a href="{{ url('/'.str_slug($d->nama,'-').'-'.$d->id) }}" class="btn btn-success btn-block btn-xs">Beli Tiket</a>

</div>



        </div>
        @endforeach
      </div>
    </div>

    <hr>

    <!-- Footer -->
<footer class="footer bg-secondary" style="padding: 20px 0 30px;margin-top: 100px;">
      <div class="container">
        <span style="font-size: 16px;" class="text-white">&copy; {{date('Y')}} Triple A Sport Management</span>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.rawgit.com/hilios/jQuery.countdown/2.2.0/dist/jquery.countdown.min.js"></script>
    <!-- Custom scripts for this template -->
    <script src="{{ asset('assets/js/clean-blog.min.js') }}"></script>


<script type="text/javascript">
  
</script>
<script type="text/javascript">
  $("#getting-started")
  .countdown($("#getting-started").attr('data-date'), function(event) {
    $(this).text(
      event.strftime('%D days %H:%M:%S')
    );
  });
var images = [
  "{{ asset('/img/bg1.jpeg') }}",
  "{{ asset('/img/bg2.jpeg') }}",
  "{{ asset('/img/bg3.jpeg') }}",
];
var imageHead = document.getElementById("masthead");
var i = 0;
setInterval(function() {
      imageHead.style.backgroundImage = "url(" + images[i] + ")";
      i = i + 1;
      if (i == images.length) {
        i =  0;
      }
}, 9000
);
</script>
<style type="text/css">
.masthead{
  -webkit-transition: background-image 0.9s ease-in-out;
transition: background-image 0.9s ease-in-out;
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
@media only screen and (min-width: 768px){
header.masthead .page-heading, header.masthead .post-heading, header.masthead .site-heading {
    padding: 140px 0;
}
.masthead{
  height: 350px;
}

}

</style>
  </body>
</html>
