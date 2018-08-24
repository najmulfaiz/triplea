@extends('main')

@section('content')
  {{-- expr --}}
  <style type="text/css"> .content{ padding-top: 90px; } </style>

    <div class="container">
{{--     <center><h3>Book Your Event</h3></center> --}}
@if ($user->status==0)
  {{-- expr --}}

    <div class="alert alert-warning">
      Email Anda Belum diverifikasi, silahkan cek email untuk mengaktifkan akun
    </div>
@endif
@if (session('success'))
  {{-- expr --}}
  <div class="alert alert-success">

  {{session('success')}}  
  </div>
@endif
@if (session('danger'))
  {{-- expr --}}
  <div class="alert alert-danger">

  {{session('danger')}}  
  </div>
@endif
        <div class="row">
        <div class="col-lg-12 with-margin">

<div class="card">
<!-- Image -->

<!-- Text Content -->
<div class="card-body ">
{{-- <p class="card-text"> --}}
<center><h3>Partisipan</h3></center>

@if ($user->tipe_akun==1)
  {{-- expr --}}
<button  style="padding: 10px 10px;" class="btn btn-primary btn-modal-add" data-toggle="modal" data-target="#exampleModal">Tambah</button> 
<br>

<table class="table table-striped">
  <thead>
    <th>#</th>
    <th>Nama</th>
    <th>Jenis Kelamin</th>
    <th>Tanggal Lahir</th>
    <th>Golongan Darah</th>
    <th>Opsi</th>
  </thead>
  <tbody>
    @foreach ($personal->get() as $p)
      {{-- expr --}}
      <tr>
        <td>{{$p->nik}}</td>
        <td>{{$p->nama_awal.' '.$p->nama_akhir}}</td>
        <td>{{$p->jk=='1'?'Laki-Laki':'Perempuan'}}</td>
        <td>{{$p->tgl_lahir}}</td>
        <td>{{$p->gol_darah}}</td>
        <td><button data-id="{{$p->id}}" style="padding: 10px 10px;" class="btn btn-primary btn-modal" data-toggle="modal" data-target="#exampleModal">Lihat</button> 
        <a style="padding: 10px 10px;" class="btn btn-danger" href="{{ url('/partisipan/'.$p->id.'/hapus') }}">Hapus</a></td>
      </tr>
    @endforeach
  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Info Personal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
@else
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal Detail</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Kondisi Kesehatan</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
<br>
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    
  <h3>Profil</h3>
  <div class="row">
<div class="col-lg-6">
<form action="{{ url('/update-personal') }}" method="post">
{{csrf_field()}}
  <div class="form-group">
    <label>NIK</label>
    <input type="text" name="nik" class="form-control" value="{{$personal==null ? '' : $personal->nik}}">  
  </div>
  <div class="form-group">
    <label>Nama Awal</label>
    <input type="text" name="nama_awal" class="form-control" value="{{$personal==null ? '' : $personal->nama_awal}}">  
  </div>
  <div class="form-group">
    <label>Nama Akhir</label>
    <input type="text" name="nama_akhir" class="form-control" value="{{$personal==null ? '' : $personal->nama_akhir}}"> 
  </div>
  <div class="form-group">
    <label>Jenis Kelamin</label>
<div class="custom-control custom-radio">
  <input  {{$personal!=null ? ($personal->jk =='1'? 'checked':'') :''}}  type="radio" id="customRadio1" name="kelamin" class="custom-control-input" value="1">
  <label class="custom-control-label" for="customRadio1">Laki - Laki</label>
</div>
<div class="custom-control custom-radio">
  <input {{$personal!=null ? ($personal->jk =='2'? 'checked':'') :''}} type="radio" id="customRadio2" name="kelamin" class="custom-control-input" value="2">
  <label class="custom-control-label" for="customRadio2">Perempuan</label>
</div>

  </div>
  <div class="form-group">
    <label>Golongan Darah</label>
  <select class="form-control" name="gol_darah">
    <option {{$personal==null ? 'selected' : ''}} value="">Tidak Diketahui</option>
    <option {{$personal!=null ? ($personal->gol_darah =='A'? 'selected':'') :''}} value="A">A</option>
    <option  {{$personal!=null ? ($personal->gol_darah =='B'? 'selected':'') :''}}  value="B">B</option>
    <option  {{$personal!=null ? ($personal->gol_darah =='AB'? 'selected':'') :''}} value="AB">AB</option>
    <option  {{$personal!=null ? ($personal->gol_darah =='O'? 'selected':'') :''}} value="O">O</option>
  </select>
  </div>
  <div class="form-group">
    <label>Tanggal Lahir</label>
    <input type="date" name="tgl_lahir" class="form-control" value="{{$personal==null ? '' : $personal->tgl_lahir}}">  
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label>Nomor HP</label>
    <input type="text" name="no_hp" class="form-control" value="{{$personal==null ? '' : $personal->nohp}}"> 
  </div>
  <div class="form-group">
    <label>Alamat</label>
    <textarea class="form-control" name="alamat">{{$personal==null ? '' : $personal->alamat}}</textarea>
  </div>
  <div class="form-group">
    <label>Kota</label>
    <select class="form-control" name="kota">
      <option value="">Pilih Kota</option>
      @foreach ($kota as $k)
      <option {{$personal!=null ? ($personal->id_kota ==$k->id ? 'selected':'') :''}} value="{{$k->id}}">{{$k->nama}}</option>
        {{-- expr --}}
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Negara</label>

  <select class="form-control" name="negara" required="">
  <option value="">Pilih Negara</option>
          @foreach ($negara as $n)
      <option {{$personal!=null ? ($personal->nasionality ==$n->id ? 'selected':'') :''}}  value="{{$n->id}}">{{$n->nama}}</option>
        {{-- expr --}}
      @endforeach
  </select>
  </div>
  <div class="form-group">
    <label>Tempat Tinggal</label>
    <select class="form-control" name="tempat_tinggal" required=""> 
      
  <option value="">Pilih Tempat Tinggal</option>
      @foreach ($negara as $n)
      <option {{$personal!=null ? ($personal->residence ==$n->id ? 'selected':'') :''}}  value="{{$n->id}}">{{$n->nama}}</option>
        {{-- expr --}}
      @endforeach
    </select>
  </div>

</div>
  
</div>
<br><br>
<center><button type="submit" class="btn btn-primary">Simpan</button></center>
</form>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <h3>Emergency Medical</h3>
  <form>
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control">
      </div>
      <div class="form-group">
        <label>Nomor HP</label>
        <input type="text" name="no_hp" class="form-control">
      </div>
      <div class="form-group">
        <label>Kondisi Kesehatan</label>
        <textarea class="form-control" name="kondisi"></textarea>
      </div>
      <button class="btn btn-primary">Simpan</button>
    </div>
  </div>
  </form>
  </div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

  <h3>Event Term</h3>

  </div>
</div>
@endif




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
  // alert("ok");
  $(document).on('click','.btn-modal',function(){
    var id = $(this).attr('data-id');
    // alert(id);
    $.ajax({
      url: "{{ url('/personal/') }}/"+id,
      method: "GET",
      success:function(res){
        $(".modal-body").html(res);
      }
    })
  });
  $(document).on('click','.btn-modal-add',function(){
    var id = $(this).attr('data-id');
    // alert(id);
    $.ajax({
      url: "{{ url('/personal/tambah/') }}/",
      method: "GET",
      success:function(res){
        $(".modal-body").html(res);
      }
    })
  });

</script>
  {{-- expr --}}
@endpush