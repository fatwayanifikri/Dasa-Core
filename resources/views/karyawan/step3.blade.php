@extends('crudbooster::admin_template')
@section('content')

@push('head')
<link rel='stylesheet' href='<?php echo asset("vendor/crudbooster/assets/select2/dist/css/select2.min.css")?>'/>
    <style>
        .select2-container--default .select2-selection--single {
            border-radius: 0px !important
        }

        .select2-container .select2-selection--single {
            height: 35px
        }
    </style>
@endpush
<ul class="nav nav-tabs">
        @if($id)
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep1',['id'=>$id])}}"><i class='fa fa-info'></i> Step 1 - Data Diri
                    Information</a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep2',['id'=>$id])}}"><i class='fa fa-table'></i> Step 2 - Identitas Karyawan & Pendidikan </a></li>
            <li role="presentation" class="active"><a href="{{Route('AdminEmployeeCustomControllerGetStep3',['id'=>$id])}}"><i class='fa fa-plus-square-o'></i> Step 3 - PKWT</a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep4',['id'=>$id])}}"><i class='fa fa-wrench'></i> Step 5 - Authentication</a></li>
        @endif
</ul>
<div class="box box-default">
    <div class="box box-header with-border">
        <h3 class="box-title"> Perjanjian Kerja Waktu Tertentu</h3>
    </div>
    <div class="box-body">
            <div class="alert alert-warning">
                Pastikan data diri diisi dengan benar.
            </div>
         <!--sisi pkwt-->
                    <div class="col-sm-12">
                        <div id="panel-form-pkwt" class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bars">&nbsp</i><label>PKWT</label>
                            </div>
                            <div class="panel-body">
                                <form name="PkwtForm" id="PkwtForm" action="" method="post" class="form-horizontal">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <input type="hidden" name="Employee_id" id="Employee_id" value="{{$id}}">
                                    <input type="hidden" name="idPkwt" id="idPkwt">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Status Karyawan <span style="color:red">*</span></label>
                                        <div class="col-sm-3">
                                            <select name="EmployeeStatus_id" id="EmployeeStatus_id" class="select2 form-control">
                                                <option value="">*** Pilih Status</option>
                                                @foreach ($statusKaryawan as $status)
                                                    <option {{request()->get('id') == $status->id? 'selected':""}} value="{{$status->id}}">
                                                        {{$status->StatusName}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label  class="control-label col-sm-2">Tanggal Mulai</label>
                                        <div class="col-sm-3">
                                            <div class="input-group date" data-provide="datepicker">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                               <input type="text"  class="form-control notfocus input_date" name="Start" id="Start" placeholder="Tanggal Mulai" readonly>
                                            </div>
                                        </div>

                                        <label  class="control-label col-sm-2">Tanggal Mulai</label>
                                        <div class="col-sm-3">
                                            <div class="input-group date" data-provide="datepicker">
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                               <input type="text"  class="form-control notfocus input_date" name="End" id="End" placeholder="Tanggal Selesai" readonly>
                                            </div>
                                        </div>
                                    </div>

                                    
                                    <div class="box-footer" align="left">
                                        <input type="button" class="btn btn-default" id="btnResetPkwt" onclick="resetPkwt()" 
                                        value='{{trans("crudbooster.button_reset")}}'/>
                                        <input type="button" id="savePkwt" name="savePkwt" class="btn btn-success" onclick="addPkwt()" value='Tambah'>
                                    </div>
                                    <!--Data Table Pkwt-->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-table"></i><label>  Detail PKWT</label>
                                        </div>
                                        <div class="panel-body no-padding table-responsive" style="max-height: 400px;overflow: auto">
                                            <table id='dtPkwt' class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        @foreach($columns as $col)
                                                            <th>{{$col}}</th>
                                                        @endforeach
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
          <!--sisi pendidikan end-->
                        
                        <div class="box-footer">
                            <div class="pull-right">
                                <button type="button" onclick="location.href='{{CRUDBooster::mainpath('step2').'/'.$id}}'"class="btn btn-default">
                                &laquo; Back
                                </button>
                                <a href="{{Route('AdminEmployeeCustomControllerGetStep4',['id'=>$id])}}" class="btn btn-primary">Step Selanjutnya &raquo;</a> 
                                <!-- <a href="{{Route('AdminCreateUserControllerGetAdd')}}" class="btn btn-primary">Step Selanjutnya &raquo;</a> -->
                            </div>
                        </div>
    </div>
</div>


@push('bottom')
<script src='<?php echo asset("vendor/crudbooster/assets/select2/dist/js/select2.full.min.js")?>'></script>

<script type="text/javascript">
$('.datepicker').datepicker();  

$(function () 
{
   $('.select2').select2();
});

$(document).ready(function(){
    var tablePkwt = $('#dtPkwt').dataTable({
        "dom": 'Brt',
        "bSort": false,
        "processing" : true,
        "ajax" : {
                "url" : "{{route('detailPkwt',$id)}}",
                "type": "GET"
        }
    });

});

function resetPkwt()
{
    $('#EmployeeStatus_id').val('').trigger('change');
    $('#Start').val('');
    $('#End').val('');
}

function addPkwt()
{
    var idPkwt = $('#idPkwt').val();
    if(idPkwt == "")
    {
        var url = "{{url('PkwtSave')}}";
    }
    else
    {
        var url = "{{url('PkwtUpdate')}}/"+idPkwt;
    }
    $.ajax({
        data: $('#PkwtForm').serialize(),
        url: url,
        type:"post",
        dataType:'JSON',
        success: function (data) {
            console.log(data);
            resetPkwt();
            oTablePkwt = $('#dtPkwt').dataTable();
            oTablePkwt.api().ajax.reload();
        }

    })
}

function editPkwt(id)
{
    $.ajax({
        url:"{{url('PkwtEdit')}}/"+id,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            console.log(data.id);
            $('#savePkwt').val('{{trans("crudbooster.save_changes")}}');
            $('#idPkwt').val(id);
            $('#EmployeeStatus_id').val(data.EmployeeStatus_id).trigger('change');
            $('#Start').val(data.Start);
            $('#End').val(data.End);
        }
    });
}

function deletePkwt(id)
{
    var token = $("meta[name='csrf-token']").attr("content");
   
   var row_id = $(this).attr("id");
   if(confirm("Apakah Anda Yakin Menghapus Data Ini?"))
   {
       $.ajax({
           url: "{{url('PkwtDelete')}}/"+id,
           type: "POST",
           data: {
               'method': 'DELETE',
               'token': token
           },
           success: function(data){
               console.log("Berhasil di hapus");
               oTable = $('#dtPkwt').dataTable();
               oTable.api().ajax.reload();
           }
       });
   }
       
}

function cetakPkwt(id)
{
    var idEmployee = id;
    $.ajax({
        url: "{{url('PrintPkwt')}}/"+idEmployee,
        type:"GET",
        dataType:"html",
        success: function(html) {
            
        }


    })
}
</script>
@endpush

@endsection
