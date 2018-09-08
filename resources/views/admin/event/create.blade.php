@extends('admin.index')

@section('content')
<div class="row">
<div class="col-lg-12">
  <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Tambah Event</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             
        <div class="wizard">
            
                <ul class="nav nav-wizard">

                    <li class="active">
                        <a href="#step1" data-toggle="tab">Event</a>
                    </li>

                    <li class="disabled">
                        <a href="#step2" data-toggle="tab">Event Detail</a>
                    </li>

                    <li class="disabled">
                        <a href="#step3" data-toggle="tab">Event Term</a>
                    </li>
                    
                     <li class="disabled">
                        <a href="#step4" data-toggle="tab">Fasilitas</a>
                    </li>
                     <li class="disabled">
                        <a href="#step5" data-toggle="tab">Group </a>
                    </li>
                     <li class="disabled">
                        <a href="#step6" data-toggle="tab">Kategori</a>
                    </li>
                     <li class="disabled">
                        <a href="#step7" data-toggle="tab">Jersey</a>
                    </li>
                     <li class="disabled">
                        <a href="#step8" data-toggle="tab">Rekening</a>
                    </li>
                </ul>
           

            <form action="{{ url('admin/event/create') }}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
                <div class="tab-content">
                    <div class="tab-pane active" id="step1">
               
               <br>




<div class="row">
<div class="col-lg-6">

<h3>Info Event</h3>
<div class="form-group">

    <label>Nama Event</label>
    <input type="text" name="nama_event" class="form-control">
</div>
<div class="form-group">
    <label>Tanggal</label>
    <input type="date" name="tanggal" class="form-control">
</div>
<div class="form-group">
    <label>Kota</label>
    <select class="form-control select2" name="kota">
    @foreach ($kota as $k)
        {{-- expr --}}
        <option value="{{$k->id}}">{{$k->nama}}</option>
    @endforeach
        
    </select>
</div>
<div class="form-group">
    <label>Logo</label>
    <input type="file" name="logo" class="form-control">
</div>

   
</div>
<div class="col-lg-6">
    
</div>
    
</div>
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary btn-next">Selanjutnya</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="step2">
                 

                         <h3>Event Detail</h3>
<div class="row">
                             <div class="col-lg-6">
    <div class="form-group">
        <label>Status Registrasi</label>
        <select class="form-control" name="status_registrasi">
            <option value="">Pilih Status</option>
            <option value="0">Close</option>
            <option value="1">Open</option>
        </select>
    </div>
                             
                         </div>
</div>
    <div class="form-group">
        <label>Deskripsi</label>
        <textarea name="deskripsi_event_detail" class="form-control textarea-t"></textarea>
    </div>
                        <ul class="list-inline pull-right">
                           <li><button type="button" class="btn btn-primary btn-next">Selanjutnya</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="step3">
                        <h3>Event Term</h3>
                       
    <div class="form-group">
        <textarea class="form-control textarea-t" name="event_term"></textarea>
    </div>
             
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary btn-next">Selanjutnya</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="step4">
                        <h3>Fasilitas Yang Didapat</h3>
    <div class="form-group">
        <textarea class="form-control textarea-t" name="Fasilitas"></textarea>
    </div>

                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary btn-next">Selanjutnya</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" id="step5">

                        <h3>Group </h3>
<div style="display: none;" id="form_group">
    
</div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Tambah Group</button>
<br>

<br>

<table class="table table-responsive" >
  <thead>
    <th>Nama</th>
    <th>Status</th>
    <th>Nationality</th>
    <th>Kuota</th>
  </thead>
  <tbody id="wrap-tbody">
    
  </tbody>
</table>


                        <ul class="list-inline pull-right">
                           <li><button type="button" class="btn btn-primary btn-next">Selanjutnya</button></li>
                        </ul>
                    </div>


                    <div class="tab-pane" id="step6">
                        <h3>Kategori</h3>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalK">Tambah Kategori</button>
<br>

<br>
<div style="display: none;" id="kategori_form">
    
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th>Event</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Usia Min</th>
            <th>Usia Max</th>
            <th>Kuota</th>

        </thead>
        <tbody id="kategori_wrap">
            <tr class="not">
                <td colspan="3"></td>
                <td><center>Belum Ada Event</center></td>
            </tr>
        </tbody>
    </table>
</div>

                        <ul class="list-inline pull-right">
                           <li><button type="button" class="btn btn-primary btn-next">Selanjutnya</button></li>
                        </ul>

                    </div>
                    <div class="tab-pane" id="step6">
                        <h3>Kategori</h3>

    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalK">Tambah Kategori</button>
<br>

<br>
<div style="display: none;" id="kategori_form">
    
</div>

<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th>Event</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Usia Min</th>
            <th>Usia Max</th>
            <th>Kuota</th>

        </thead>
        <tbody id="kategori_wrap">
            <tr class="not">
                <td colspan="3"></td>
                <td><center>Belum Ada Event</center></td>
            </tr>
        </tbody>
    </table>
</div>
                    </div>

                    <div class="tab-pane" id="step7">
                      <h3>Ukuran Jersey</h3>

                      <div class="row">
                        <div class="col-lg-6">
                          <div class="input_fields_wrap_file">
    <button class="add_field_button_file btn btn-primary">Tambah Jersey</button>
</div>


                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary btn-next">Selanjutnya</button></li>
                        </ul>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="step8">
                      <div class="col-lg-6">
                        <h3>Rekening Tujuan</h3>



<br>
<div class="form-group">
  <label>Bank</label>
  <select class="form-control" name="bank">
    <option value="">Pilih</option>
    @foreach ($bank as $b)
      {{-- expr --}}
      <option value="{{$b->kode_bank}}">{{$b->kode_bank}} - {{$b->nama_bank}}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
  <label>Nama Pemilik</label>
<input type="text" name="nama_pemilik" class="form-control">
</div>
<div class="form-group">
  <label>Nomor Rekening</label>
<input type="text" name="no_rekening" class="form-control">
</div>



                        <ul class="list-inline pull-right">
                           <li><button type="submit" class="btn btn-primary ">Selesai</button></li>
                        </ul>

                      </div>


                    </div>

                    <div class="clearfix"></div>
                </div>
            </form>
        </div>

            </div>
            <!-- /.box-body -->


</div>
  
</div>
</div>


<!-- Modal -->
<div id="modalK" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Kategori</h4>
      </div>
      <div class="modal-body">
<div class="row">
          <div class="col-lg-6">
          <div class="form-group">
              <label>Nama Kategori</label>
              <input type="text" name="" class="form-control" id="nama_kategori">
          </div>
          <div class="form-group">
              <label>Group</label>
                <select class="form-control" id="kategori_grup">
                    
                </select>
          </div>

          <div class="form-group">
              <label>Harga</label>
              <input type="text" name="" class="form-control" id="harga">
          </div>


          </div>

   <div class="col-lg-6">
       
          <div class="form-group">
              <label>Usia Minimal</label>
              <input type="text" name="" class="form-control" id="usia_min">
          </div>
          <div class="form-group">
              <label>Usia Maksimal</label>
              <input type="text" name="" class="form-control" id="usia_max">
          </div>
          <div class="form-group">
              <label>Kuota</label>
              <input type="text" name="" class="form-control" id="kuota_kategori">
          </div>
</div>


<div class="col-lg-12"> 
              <div class="form-group">
              <label>Deskripsi</label>
              <textarea class="form-control" id="deskripsi"></textarea>
          </div>
</div>
   </div>
      </div>
      <div class="modal-footer">

        <button type="button" id="ok-kategori" class="btn btn-primary" data-dismiss="modal">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Group</h4>
      </div>
      <div class="modal-body">
<div class="row">
          <div class="col-lg-6">
          
<div class="form-group">
    <label>Nama</label>
    <input type="text" name="" class="form-control" id="nama_grup">
</div>
<div class="form-group">
<label>Status</label>
<select class="form-control"  id="status_grup">
<option>Pilih</option>
<option value="1">Aktif</option>
<option value="0">Tidak Aktif</option>
    
</select>
    
</div>
<div class="form-group">
    <label>Nationality</label>
    <select class="form-control" name="nationality_grup" id="nationality_grup">
    <option>Pilih</option>
    <option value="0">Open</option>
    <option value="1">Indonesia</option>

        
    </select>
</div>

              <label>Kuota</label>
            <input type="text" name="" class="form-control" id="kuota">
      </div>
</div>
      </div>
      <div class="modal-footer">

        <button type="button" id="ok" class="btn btn-primary" data-dismiss="modal">Ok</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
@endsection
@push('script')
<style type="text/css">
    
ul.nav-wizard {
  background-color: #f1f1f1;
  border: 1px solid #d4d4d4;
  -webkit-border-radius: 6px;
  -moz-border-radius: 6px;
  border-radius: 3px;
  position: relative;
  overflow: hidden;
}
ul.nav-wizard:before {
  position: absolute;
}
ul.nav-wizard:after {
  display: block;
  position: absolute;
  left: 0px;
  right: 0px;
  top: 138px;
  height: 47px;
  border-top: 1px solid #d4d4d4;
  border-bottom: 1px solid #d4d4d4;
  z-index: 11;
  content: " ";
}
ul.nav-wizard li {
  position: relative;
  float: left;
  height: 46px;
  display: inline-block;
  text-align: center;
  padding: 0 20px 0 30px;
  margin: 0;
  font-size: 16px;
  line-height: 46px;
}
ul.nav-wizard li a {
  color: #428bca;
  padding: 0;
}
ul.nav-wizard li a:hover {
  background-color: transparent;
}
ul.nav-wizard li:before {
  position: absolute;
  display: block;
  border: 24px solid transparent;
  border-left: 16px solid #d4d4d4;
  border-right: 0;
  top: -1px;
  z-index: 10;
  content: '';
  right: -16px;
}
ul.nav-wizard li:after {
  position: absolute;
  display: block;
  border: 24px solid transparent;
  border-left: 16px solid #f1f1f1;
  border-right: 0;
  top: -1px;
  z-index: 10;
  content: '';
  right: -15px;
}
ul.nav-wizard li.active {
  color: #3a87ad;
  background: #dedede;
}
ul.nav-wizard li.active:after {
  border-left: 16px solid #dedede;
}
ul.nav-wizard li.active a,
ul.nav-wizard li.active a:active,
ul.nav-wizard li.active a:visited,
ul.nav-wizard li.active a:focus {
  color: #989898;
  background: #dedede;
}
ul.nav-wizard .active ~ li {
  color: #999999;
  background: #f9f9f9;
}
ul.nav-wizard .active ~ li:after {
  border-left: 16px solid #f9f9f9;
}
ul.nav-wizard .active ~ li a,
ul.nav-wizard .active ~ li a:active,
ul.nav-wizard .active ~ li a:visited,
ul.nav-wizard .active ~ li a:focus {
  color: #999999;
  background: #f9f9f9;
}
ul.nav-wizard.nav-wizard-backnav li:hover {
  color: #468847;
  background: #f6fbfd;
}
ul.nav-wizard.nav-wizard-backnav li:hover:after {
  border-left: 16px solid #f6fbfd;
}
ul.nav-wizard.nav-wizard-backnav li:hover a,
ul.nav-wizard.nav-wizard-backnav li:hover a:active,
ul.nav-wizard.nav-wizard-backnav li:hover a:visited,
ul.nav-wizard.nav-wizard-backnav li:hover a:focus {
  color: #468847;
  background: #f6fbfd;
}
ul.nav-wizard.nav-wizard-backnav .active ~ li {
  color: #999999;
  background: #ededed;
}
ul.nav-wizard.nav-wizard-backnav .active ~ li:after {
  border-left: 16px solid #ededed;
}
ul.nav-wizard.nav-wizard-backnav .active ~ li a,
ul.nav-wizard.nav-wizard-backnav .active ~ li a:active,
ul.nav-wizard.nav-wizard-backnav .active ~ li a:visited,
ul.nav-wizard.nav-wizard-backnav .active ~ li a:focus {
  color: #999999;
  background: #ededed;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="input_fields_wrap"><div class="form-group"><input type="text" name="mytext[]" class="form-control"></div></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});

    $(document).ready(function () {
  
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".btn-next").click(function (e) {

        var $active = $('.wizard .nav-wizard li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}

</script>
<script type="text/javascript">
    $(function(){
        $('.textarea-t').wysihtml5()

    });
    $(document).on('click','#ok',function(){
        var nama_grup = $("#nama_grup").val();
        var status_grup = $("#status_grup").val();
        var kuota = $("#kuota").val();
        var nationality_grup  = $("#nationality_grup").val();

        var st = "";
        if(status_grup=='0'){
            st = "<label class='label label-danger'>Close</label>"
            v_status_grup =  0;
        }
        else if(status_grup=='1'){
            st = "<label class='label label-success'>Open</label>"

            v_status_grup =  1;
        }


        var ng = "";
        if(nationality_grup=='0'){
            ng = "<b>Open</b>";
            ng_status = 0;
        }
        else if(nationality_grup=='1'){
            ng = "<b>Indonesia</b>";
            ng_status = 1;
        }





      var math = Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);
        $("#kategori_grup").append("<option value='"+nama_grup+"-"+math+"'>"+nama_grup+"</option>")




      /*        var res = '   <div class="col-lg-3"><div class="panel panel-default"><div class="panel-body"><ul class="list-group"><li class="list-group-item"><b>'+nama_grup+'</b> </li><li class="list-group-item">'+st+' Status</li><li class="list-group-item">'+ng+' Negara</li></ul></div></div></div>';*/

        var tb = '';
        tb += '<tr>';
        tb += '<td>'+nama_grup+'</td>';
        tb += '<td>'+st+'</td>';
        tb += '<td>'+ng+'</td>';
        tb += '<td>'+kuota+'</td>';
        tb += '</tr>';
        $("#wrap-tbody").append(tb);

        var input = "<input type='hidden' value='"+nama_grup+'-'+math+"' name='nama_grup[]'>";
        input +=  "<input type='hidden' value='"+v_status_grup+"' name='status_grup[]'>";
        input +=  "<input class='"+math+"' type='hidden' value='"+kuota+"' name='kuota[]'>";
        input +=  "<input type='hidden' value='"+ng_status+"' name='lokasi_grup[]'>";

        $("#form_group").append(input);


    })
    $(document).on('click','#ok-kategori',function(){

      var math = Math.floor((1 + Math.random()) * 0x10000)
        .toString(16)
        .substring(1);

        var nama_kategori = $("#nama_kategori").val();
        var kategori_grup = $("#kategori_grup option:selected").text();
        var kategori_grup_val = $("#kategori_grup").val();
        var harga          = $("#harga").val();
        var usia_min      = $("#usia_min").val();
        var usia_max        = $("#usia_max").val();
        var kuota_kategori        = $("#kuota_kategori").val();
        var deskripsi       = $("#deskripsi").val();

        var tr = "<tr class='tr-"+math+"'> ";
        tr += "<td>"+nama_kategori+"</td>";
        tr += "<td>"+kategori_grup+"</td>";
        tr += "<td>"+harga+"</td>";
        tr += "<td>"+usia_min+"</td>";
        tr += "<td>"+usia_max+"</td>";
        tr += "<td>"+kuota_kategori+"</td>";
        tr += "<td><button class='btn btn-danger delete-row' data-id='"+math+"'>Hapus</button></td>";
        tr += "</tr>";

var          input = "<input class='"+math+"' type='hidden' value='"+nama_kategori+'-'+kategori_grup_val+"' name='nama_kategori[]'>";
        input +=  "<input class='"+math+"' type='hidden' value='"+kategori_grup_val+"' name='kategori_group[]'>";
        input +=  "<input class='"+math+"' type='hidden' value='"+harga+"' name='harga_kategori[]'>";
        input +=  "<input class='"+math+"' type='hidden' value='"+usia_min+"' name='usia_min[]'>";
        input +=  "<input class='"+math+"' type='hidden' value='"+usia_max+"' name='usia_max[]'>";
        input +=  "<input class='"+math+"' type='hidden' value='"+deskripsi+"' name='deskripsi[]'>";
        input +=  "<input class='"+math+"' type='hidden' value='"+kuota_kategori+"' name='kuota_kategori[]'>";



        $("#kategori_form").append(input);

        $(".not").remove();
        $("#kategori_wrap").append(tr);


    });
    $(document).on('click','.delete-row',function(){
        var id = $(this).attr('data-id');

        $("."+id).remove();
        $(".tr-"+id).remove();

    })

    $(document).ready(function(){
      $(".select2").select2();
    });

    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap_file"); //Fields wrapper
    var add_button      = $(".add_field_button_file"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            var html = '';
            html += '<div><br/>';

            html += '<input type="file" name="jersey[]" class="form-control"/><br/><input type="text" class="form-control" name="ukuran[]" placeholder="ukuran"><br/><textarea class="form-control" name="deskripsi_jersey[]""></textarea><br/><a href="#" class="remove_field">Hapus</a>';
            html += '</div>';
            $(wrapper).append(html); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
    {{-- expr --}}
@endpush