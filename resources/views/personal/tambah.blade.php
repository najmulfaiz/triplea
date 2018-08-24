
<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Personal Detail</a>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
<br>
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
    
  <h3>Profil</h3>
  <form id="form" action="{{ url('/personal/tambah') }}" method="post">
  <div class="row">

<div class="col-lg-6">
{{csrf_field()}}
  <div class="form-group">
    <label>NIK</label>
    <input type="text" name="nik" class="form-control" >  
  </div>
  <div class="form-group">
    <label>Nama Awal</label>
    <input type="text" name="nama_awal" class="form-control" >  
  </div>
  <div class="form-group">
    <label>Nama Akhir</label>
    <input type="text" name="nama_akhir" class="form-control" > 
  </div>
  <div class="form-group">
    <label>Jenis Kelamin</label>
<div class="custom-control custom-radio">
  <input  type="radio" id="customRadio1" name="kelamin" class="custom-control-input" value="1">
  <label class="custom-control-label" for="customRadio1">Laki - Laki</label>
</div>
<div class="custom-control custom-radio">
  <input type="radio" id="customRadio2" name="kelamin" class="custom-control-input" value="2">
  <label class="custom-control-label" for="customRadio2">Perempuan</label>
</div>

  </div>
  <div class="form-group">
    <label>Golongan Darah</label>
  <select class="form-control" name="gol_darah">
    <option  value="">Tidak Diketahui</option>
    <option  value="A">A</option>
    <option  value="B">B</option>
    <option  value="AB">AB</option>
    <option  value="O">O</option>
  </select>
  </div>
  <div class="form-group">
    <label>Tanggal Lahir</label>
    <input type="date" name="tgl_lahir" class="form-control">  
  </div>
</div>
<div class="col-lg-6">
  <div class="form-group">
    <label>Nomor HP</label>
    <input type="text" name="no_hp" class="form-control" > 
  </div>
  <div class="form-group">
    <label>Alamat</label>
    <textarea class="form-control" name="alamat"></textarea>
  </div>
  <div class="form-group">
    <label>Kota</label>
    <select class="form-control" name="kota">
      <option value="">Pilih Kota</option>
      @foreach ($kota as $k)
      <option value="{{$k->id}}">{{$k->nama}}</option>
        {{-- expr --}}
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label>Negara</label>

  <select class="form-control" name="negara" required="">
  <option value="">Pilih Negara</option>
          @foreach ($negara as $n)
      <option value="{{$n->id}}">{{$n->nama}}</option>
        {{-- expr --}}
      @endforeach
  </select>
  </div>
  <div class="form-group">
    <label>Tempat Tinggal</label>
    <select class="form-control" name="tempat_tinggal" required=""> 
      
  <option value="">Pilih Tempat Tinggal</option>
      @foreach ($negara as $n)
      <option  value="{{$n->id}}">{{$n->nama}}</option>
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