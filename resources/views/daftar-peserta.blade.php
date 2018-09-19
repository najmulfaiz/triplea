@extends('main')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<style type="text/css"> .content{ padding-top: 90px; } </style>
<div class="container">
	<div class="card">
		<div class="card-header">Daftar Peserta Event</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="event" class="font-weight-bold">Pilih Event :</label>
						<select name="event" id="event" class="form-control">
							<option value=""> -- Pilih Event -- </option>
							@foreach($events as $event) 
								<option value="{{ $event->id }}">{{ $event->nama }}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-lg-12">
					<table class="table table-striped table-hovered table-bordered" id="datatable">
						<thead>
							<tr>
								<td>No</td>
								<td>Nama</td>
								<td>Nama Komunitas</td>
							</tr>
						</thead>
						<tbody id="data_peserta"></tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script')
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
	$(document).ready(function(){
		$('#datatable').DataTable();

		$(document).on('change', '#event', function(){
			var id = $(this).val();

			if(id != '') {
				$.ajax({
					url: '{{ url('/event') }}/' + id + '/peserta',
					success: function(data){
						$('#datatable').DataTable().destroy();

						$('#data_peserta').html('');
						$.each(data, function(index, value){
							var komunitas = value.komunitas == null ? '-': value.komunitas;
							var last_name = value.nama_akhir == null ? '' : value.nama_akhir;
							$('#data_peserta').append('<tr>'+
								'<td>'+ (index + 1) +'</td>'+
								'<td>'+ value.nama_awal.toUpperCase() + ' ' + last_name.toUpperCase() +'</td>'+
								'<td>'+ komunitas +'</td>'+
							'</tr>');
						});

						$('#datatable').DataTable();
					}, error: function(xhr) {
						console.log(xhr.status);
					}
				});
			} else {
				$('#datatable').DataTable().destroy();
				$('#data_peserta').html('');
				$('#datatable').DataTable();
			}
		});
	});
</script>
@endpush