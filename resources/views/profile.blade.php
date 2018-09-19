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
<form action="{{ url('/profile') }}" method="post" id="form_profile">
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
    <input type="text" name="komunitas" id="komunitas" class="form-control" value="{{$user->komunitas}}"> 
  </div>
  <div class="form-group" >
    <label>Jumlah Personal</label>
    <input type="text" name="jml" id="jml" class="form-control" value="{{$user->jml_personal}}">  
  </div>
  </div>

  <div class="form-group">
    <label>NO HP</label>
    <div class="input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">+62</span>
      </div>
      <input type="text" name="no_hp" class="form-control" value="{{ ltrim(str_replace('+62', '', $user->nohp), '0') }}" autocomplete="off"> 
    </div>
  <small class="text-muted"><em>Masukkan nomor tanpa awalan 0</em></small>
  </div>
  <center><button type="submit" id="submit" class="btn btn-primary">Ubah</button></center>
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
      if(val.length ==0){
        $("#submit").attr('disabled','disabled');
      }
      else{
       $("#submit").removeAttr('disabled');
      if(val=='1'){
        $("#addition").show();
      }
      if(val=='0'){
        $("#addition").hide();

      }
      }
      // alert(val);
  });

  $(document).on("keydown", "input[name=jml]", function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

   $(document).on("keydown", "input[name=no_hp]", function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A, Command+A
            (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
             // Allow: home, end, left, right, down, up
            (e.keyCode >= 35 && e.keyCode <= 40)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

   $(document).on("keyup", "input[name=no_hp]", function(e){
    if($(this).val()[0] == 0) {
      var trimmed = $(this).val().substring(1);
      $(this).val(trimmed);
    }
   });

  $(document).on("submit", '#form_profile', function(e){
    var tipe_akun = $('#tipe_akun').val();
    var jml       = $('#jml').val();
    var no_hp     = $('input[name=no_hp]').val().length;
    var error     = false;

    if(no_hp < 9 || no_hp > 13) {
      alert('Nomor handphone minimal 10 digit dan max 13 digit.');
      $('input[name=no_hp]').addClass('is-invalid');
      error = true;
    } else {
      $('input[name=no_hp]').removeClass('is-invalid');          
    }

    if(tipe_akun == 1) {
      var validasi = ['komunitas', 'jml'];

      $.each(validasi, function(index, value){
        if($('#' + value).val() == ''){
          $('#' + value).addClass('is-invalid');
          error = true;
        } else {
          if(value == 'jml' && jml < 2) {
            alert('Jumlah personal minimal harus 2 person');
            $('#' + value).addClass('is-invalid');
            error = true;
          } else {
            $('#' + value).removeClass('is-invalid');          
          }
        }
      });
    }

    if(!error) {
      $('#form_profile').submit();
    } else {
      e.preventDefault();
    }
  });
</script>
  {{-- expr --}}
@endpush