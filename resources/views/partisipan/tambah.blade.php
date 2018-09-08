<div class="row"> 
	<div class="col-lg-6">
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
			<option data-price="{{$p->harga}}" value="{{$p->id_kategori}}">{{$p->nama}}</option>

				{{-- expr --}}
			@endforeach
				{{-- expr --}}
			@endif
				
			</select>
		</div>

	</div>
	<div class="col-lg-6">
		
	<h4>Jersey</h4>
<div class="row">
@if ($jersey->count() >0 )
  {{-- expr --}}
  @foreach ($jersey->get() as $j)

  <div class="col-6">
    
<input  
  type="radio" name="jersey" 
  id="{{$j->id}}" class="input-hidden" value="{{$j->id}}" required data-text="{{$j->ukuran}}"/>
<label for="{{$j->id}}">
  <img 
    src="{{url('uploads/'.$j->foto)}}" />
</label><br>
<center>
<h4>{{$j->ukuran}}</h4>
</center>
  </div>
  @endforeach
@endif


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