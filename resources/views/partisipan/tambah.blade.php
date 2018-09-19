<div class="row"> 
	<div class="col-lg-4">
		<div class="form-group"> 
			<label>Partisipan</label>
			<select class="form-control" id="partisipan">
			<option value="">Pilih</option>
			@if ($partisipan->count()>0)
			@foreach ($partisipan->get() as $p)
			<option   value="{{$p->id}}">{{$p->nama_awal.' '.$p->nama_akhir}}</option>
				{{-- expr --}}
			@endforeach
				{{-- expr --}}
			@endif
				
			</select>
		</div>
	<div class="form-group"> 
			<label>Nama BIB</label>
			<input type="text" name="" id="nama_bib" class="form-control">
		</div>
		<div class="form-group"> 
			<label>Kategori</label>
			<select class="form-control kategori-data" id="kategori">
			<option value="">Pilih</option>
			@if ((count($kategori)))
			@foreach ($kategori as $p)
				{{-- expr --}}
			<option data-price="{{$p->harga}}" value="{{$p->id_kategori}}">{{ $p->grup . ' - ' . $p->nama.'('.$p->usia_min.' - '.$p->usia_max.')'}}</option>

				{{-- expr --}}
			@endforeach
				{{-- expr --}}
			@endif
				
			</select>
		</div>

	</div>
	<div class="col-lg-8">
		
	<h4>Jersey</h4>
<div class="row">
<div class="col-lg-6">
  {{-- expr --}}

  <div class="row">
  	<div class="col-lg-6">
	  <img src="{{ url('/uploads/'.$jersey->get()[0]->foto) }}" class="img img-responsive" style="width: 100%;">
  		
  	</div>
  	<div class="col-lg-6">
	  <table class="table table-striped">
	@if ($jersey->count() >0 )
  @foreach ($jersey->get() as $j)
  	<tr>
  		<td>{{$j->ukuran}}</td>
  		<td>{{$j->deskripsi}}</td>
  		<td>
<input  
  type="radio" name="jersey" 
  id="{{$j->id}}"  value="{{$j->id}}" required data-text="{{$j->ukuran}}"/>
<label for="{{$j->id}}"></td>
  	</tr>
  @endforeach
  	@endif
  </table>  		
  	</div>
  </div>

</div>

</div>
	</div>
</div>
<br>

<br><br>
{{-- {{$p}} --}}
<center><button class="btn btn-primary choose"  disabled="disabled"><span><i class="fas fa-shopping-cart"></i></span><span style="margin-left: 10px;" id="pilih">Pilih </span></button>
</center>

<style type="text/css">
	@media (min-width: 992px){
.modal-lg {
    max-width: 1000px;
}
}
</style>

<script>
	$(document).on('change', '#partisipan', function(){
		var partisipan = {!! $partisipan->with('medical')->get() !!};
		var pilih = $(this).val();
		var error = false;

		$.each(partisipan, function(index, value){
			if(value.id == pilih) {
				if(value.nik == '' || value.nik == null) {
					error = true;
				}

				if(value.foto_ktp == '' || value.foto_ktp == null) {
					error = true;
				}

				if(value.medical !== null) {
					if(value.medical.nama == '' || value.medical.nama == null) {
						error = true;
					}

					if(value.medical.nohp == '' || value.medical.nohp == null) {
						error = true;
					}
				} else {
					error = true;
				}
			}
		});

		if(error == true) {
			alert('Silahkan melengkapi data participant (ID No, KTP, Medical Emergency)');
			$('#partisipan').val('');
		}
	});
</script>