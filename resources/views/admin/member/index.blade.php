@extends('admin.index')

@section('content')
<div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
<button type="button" class="btn btn-primary btn-modal" data-source="{{ url(Request::segment(1).'/'.Request::segment(2).'/create') }}" data-toggle="modal" data-target="#modal" data-title="Create Data" data-button="Save">
  Create Data
</button>
<br>


<div class="modal fade " id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="btn-save"></button>
      </div>
    </div>
  </div>
</div>
              <div class="panel panel-default">
        
                <div class="panel-body">
                  <h3>Data Member</h3>
{{--                   <div class="table-responsive"> --}}
                    <table class="table table-striped" id="table">
                      <thead class=" text-primary">
                        <th>#</th>
                        <th>Email</th>
                        <th>Tipe Akun</th>
                        <th>Verified</th>
                        <th>No Hp</th>
                        <th>Status</th>
                        <th>Opsi</th>
                        </thead>
                    </table>
{{--                   </div> --}}
                </div>
              </div>
            </div>
          </div>
        </div>      
@endsection

@push('script')


  <script type="text/javascript">
    
$(function() {
    $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{url(Request::segment(1).'/'.Request::segment(2).'/data')}}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'email', name: 'email' },
            { data: 'tipe_akun_icon', name: 'tipe_akun' },
            { data: 'verified_icon', name: 'verified' },
            { data: 'nohp', name: 'nohp' },
            { data: 'status_icon', name: 'status' },
            { data: 'action', name: 'action' },
        ]
    });
});
  </script>

<script type="text/javascript">
  $(document).on('click','.btn-modal',function(){
      var title = $(this).attr('data-title');
      var datasource = $(this).attr('data-source');
      var button = $(this).attr('data-button');
      $(".modal-title").text(title);
      $("#btn-save").text(button);
      $.get(datasource,function(data){
        $(".modal-body").html(data);
      });
  })
$(document).on('click','.btn-delete',function(){
    var url = $(this).attr('data-url');
    $.ajax({
      url: url,
      method: "DELETE",
      dataType: "JSON",
      success:function(d){
        // md.showNotification('top','left');
var title = d.title;
var message = d.message;
var type = d.type;
var state = d.state;
if(d.type == 'danger'){
$("#modal").modal("show");
  
}
else{
$("#modal").modal("hide");
$('#table').DataTable().ajax.reload();
}
$.notify({
  title: title,
  message: message,
},{
  z_index:10000,
  type: type
});
      }
    })
});
  $(document).on('click','#btn-save',function(){
    var form = $("#form");
    // console.log(form.serialize());
    $.ajax({
      url: form.attr('action'),
      method: "POST",
      data: form.serialize(),
      success: function(d){
// md.showNotification('top','left');
var title = d.title;
var message = d.message;
var type = d.type;
var state = d.state;
if(d.type == 'danger'){
$("#modal").modal("show");
  
}
else{
$("#modal").modal("hide");
$('#table').DataTable().ajax.reload();
}
$.notify({
  title: title,
  message: message,
},{
  z_index:10000,
  type: type
});
      }
    })
  });
</script>
<style type="text/css">
  .dataTables_filter{
    float: right;
  }
  .dataTables_paginate{
    float: right;
  }
</style>
  {{-- expr --}}
@endpush