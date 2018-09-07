<div class="row">
	 <div class="col-lg-6">
	 	<form id="form" action="{{ url(Request::segment(1).'/'.Request::segment(2)) }}">
{{csrf_field()}}
{{method_field("POST")}}
<div class="form-group">
	<label>Email</label>
	<input type="email" name="email" class="form-control">
</div>
<div class="form-group">
	<label>Password</label>
	<input type="password" name="password" class="form-control">
</div>
<div class="form-group">
	<label>Tipe Akun</label>
	<select class="form-control select2" name="tipe_akun">
		<option value="">Pilih Tipe Akun</option>
		<option value="0">Personal</option>
		<option value="1">Komunitas</option>
	</select>
</div>
<div class="form-group">
	<label>Nama Komunitas</label>
	<input type="text" class="form-control" name="komunitas">
</div>
<div class="form-group">
	<label>Verified</label>
	<select class="form-control" name="verified">
		<option value="">Pilih</option>
		<option value="1">Ya</option>
		<option value="0">Tidak</option>
	</select>
</div>
<div class="form-group">
	<label>Nomor HP</label>
	<input type="text" class="form-control" name="no_hp">
</div>
<div class="form-group">
	<label>Status</label>
	<select class="form-control" name="status_aktif">
		
		<option value="">Pilih</option>
		<option value="1">Aktif</option>
		<option value="0">Belum Aktif</option>
	</select>
</div>



</form>
	 </div>
</div>