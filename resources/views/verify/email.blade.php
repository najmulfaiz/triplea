@extends('main')

@section('content')
  {{-- expr --}}

    <div class="container">

        <div class="row">
        <div class="col-lg-12 with-margin">

<div class="card">
<!-- Image -->

<!-- Text Content -->
<div class="card-body ">
{{-- <p class="card-text"> --}}

<center><H3>Verifikasi</H3>
<br>Harap Tunggu Sebentar
</center>

@if (session('danger'))
<div class="alert alert-danger">

{{session('danger')}}  
</div>
  {{-- expr --}}
@endif


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