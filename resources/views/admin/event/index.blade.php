@extends('admin.index')

@section('content')
<div class="row">
<div class="col-lg-12">
  <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Bordered Table</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
    <table class="table table-bordered" id="table-data">
        <thead>
            <tr>
                <th>Id</th>
                <th>Nama</th>
                <th>Opsi</th>
            </tr>
        </thead>
    </table>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            </div>
          </div>
</div>
  
</div>
@endsection

@push('script')
  {{-- expr --}}
  <script type="text/javascript">
    $(function() {
    $('#table-data').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ url(Request::segment(1).'/'.Request::segment(2).'/data') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'nama', name: 'nama' },
            
        ]
    });
});
  </script>
@endpush