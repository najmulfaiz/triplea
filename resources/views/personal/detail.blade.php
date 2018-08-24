
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
  <form id="form" action="{{ url('/update-personal/'.$id) }}" method="post">
  <div class="row">

<div class="col-lg-6">
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
<center><button id="submit" type="submit" class="btn btn-primary">Simpan</button></center>
</form>

  </div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
  <h3>Emergency Medical</h3>
  <form action="{{ url('/personal/medical/'.$id) }}" method="post">
  {{csrf_field()}}
  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="{{$emergency->count() > 0 ? $emergency->first()->nama:''}}">
      </div>
      <div class="form-group">
        <label>Nomor HP</label>
        <input type="text" name="no_hp" class="form-control" value="{{$emergency->count() > 0 ? $emergency->first()->nohp:''}}">
      </div>
      <div class="form-group">
        <label>Kondisi Kesehatan</label>
        <textarea class="form-control" name="kondisi">{{$emergency->count() > 0 ? $emergency->first()->kondisi_kesehatan:''}}</textarea>
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