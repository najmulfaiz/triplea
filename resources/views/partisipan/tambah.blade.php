<div class="row"> 
	<div class="col-lg-6">
		<div class="form-group"> 
			<label>Partisipan</label>
			<select class="form-control" id="partisipan">
			<option value="">Pilih</option>
			@if ($partisipan->count()>0)
			@foreach ($partisipan->get() as $p)
			<option value="{{$p->id}}">{{$p->nama_awal.' '.$p->nama_akhir}}</option>
				{{-- expr --}}
			@endforeach
				{{-- expr --}}
			@endif
				
			</select>
		</div>

		<div class="form-group"> 
			<label>Kategori</label>
			<select class="form-control" id="kategori">
			<option value="">Pilih</option>
			@if ($kategori->count()>0)
			@foreach ($kategori->get() as $p)
			@if ($p->kategori!=null)
				{{-- expr --}}
			<option data-price="{{$p->kategori['harga']}}" value="{{$p->kategori['id']}}">{{$p->kategori['nama']}}</option>
			@endif
				{{-- expr --}}
			@endforeach
				{{-- expr --}}
			@endif
				
			</select>
		</div>

	</div>
</div>
	<h4>Jersey</h4>
<div class="row">
@if ($jersey->count() >0 )
  {{-- expr --}}
  @foreach ($jersey->get() as $j)

  <div class="col-lg-3">
    
<input  
  type="radio" name="jersey" 
  id="{{$j->id}}" class="input-hidden" value="{{$j->id}}" required data-text="{{$j->ukuran}}"/>
<label for="{{$j->id}}">
  <img 
    src="{{$j->foto}}" />
</label><br>
<center>
<h4>{{$j->ukuran}}</h4>
</center>
  </div>
  @endforeach
@endif
</div>
<br>



<button class="btn btn-primary choose">Pilih</button>