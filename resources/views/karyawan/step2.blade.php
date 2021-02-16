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
            <li role="presentation" class="active"><a href="{{Route('AdminEmployeeCustomControllerGetStep2',['id'=>$id])}}"><i class='fa fa-table'></i> Step 2 - Identitas Karyawan & Pendidikan </a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep3',['id'=>$id])}}"><i class='fa fa-plus-square-o'></i> Step 3 - PKWT</a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep4',['id'=>$id])}}"><i class='fa fa-wrench'></i> Step 5 - Authentication</a></li>
        
        @endif
           
</ul>

<div class="box box-default">
    <div class="box box-header with-border">
        <h3 class="box-title"> Identitas diri & Pendidikan </h3>
    </div>
    <div class="box-body">
            <div class="alert alert-warning">
                Pastikan data diri diisi dengan benar.
            </div>
        <div class="col-sm-12">
            <div id='panel-form-identitasdiri' class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bars"></i>&nbsp<label> Identitas diri</label>
                </div>
                <div class="panel-body">
                    <form name="IdentitasForm" id="IdentitasForm" action="" method="post" class="form-horizontal">
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <input type="hidden" name="Employee_id" id="Employee_id"  value="{{$id}}">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label class="control-label col-sm-2">Tipe Identitas <span style="color:red"> *</span></label>
                            <div class="col-sm-8">
                                <select name="TipeIdentitas_id" id="TipeIdentitas_id" class="select2 form-control">
                                    <option value="">*** Pilih Tipe Identitas</option>
                                    @foreach ($identitas as $idn)
                                        <option {{request()->get('id') == $idn->id? 'selected':""}}
                                        value="{{$idn->id}}">
                                        {{$idn->NamaID}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Nomer Identitas</label>
                            <div class="col-sm-8">
                                <input class="form-control" id="NoID" name="NoID" type="text" placeholder="Masukan Nomer Identitas">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2">Masa Berlaku <span style="color:red"> *</span></label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="MasaBerlaku" name="MasaBerlaku" placeholder="Masa Berlaku Identitas">
                            </div>
                        </div>

                        <div class="box-footer" align="left">
                            <input type="button" class="btn btn-default" id="btnReset" onclick="resetFormIdentitas()" 
                            value='{{trans("crudbooster.button_reset")}}'/>
                            <input type="button" id="saveIdentitas" class="btn btn-success" onclick="addIdentitas()" value='Tambah'>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-table"></i><label for="" class=""> Detail Data</label>
                            </div>
                            <div class="panel-body no-padding table-responsive" style="max-height: 400px;overflow: auto">
                                <table id='dtIdentitas' class="table table-striped table-bordered">
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
         <!--sisi pendidikan-->
                    <div class="col-sm-12">
                        <div id="panel-form-pendidikan" class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bars">&nbsp</i><label>Pendidikan</label>
                            </div>
                            <div class="panel-body">
                                <form name="PendidikanForm" id="PendidikanForm" action="" method="post" class="form-horizontal">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <input type="hidden" name="Employee_id_pendidikan" id="Employee_id_pendidikan" value="{{$id}}">
                                    <input type="hidden" name="idPendidikan" id="idPendidikan">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2">Tingkat Pendidikan <span style="color:red">*</span></label>
                                        <div class="col-sm-3">
                                            <select name="EducationLevel_id" id="EducationLevel_id" class="select2 form-control">
                                                <option value="">*** Pilih Pendidikan</option>
                                                @foreach ($pendidikan as $pend)
                                                    <option {{request()->get('id') == $pend->id? 'selected':""}} value="{{$pend->id}}">
                                                        {{$pend->EducationName}}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <label class="control-label col-sm-2">Nama Instasi Pendidikan <span style="color:red">*</span></label>
                                        <div class="col-sm-4">
                                            <input type="text" name="EducationName" id="EducationName" placeholder="Nama Instasi Pendidikan" class="form-control" required>
                                        </div>

                                    </div>


                                    <div class="form-group">
                                        <label  class="control-label col-sm-2">Tanggal Mulai</label>
                                        <div class="col-sm-3">
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control" id="Form" name="Form" placeholder="Tanggal Mulai"readonly>
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <label  class="control-label col-sm-2">Tanggal Selesai</label>
                                        <div class="col-sm-4">
                                            <div class="input-group date" data-provide="datepicker">
                                                <input type="text" class="form-control" id="To" name="To" placeholder="Tanggal Selesai"readonly>
                                                <div class="input-group-addon">
                                                    <span class="glyphicon glyphicon-th"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   

                                    <div class="form-group">
                                    <label class="control-label col-sm-2">Nilai Akhir</label>
                                        <div class="col-sm-2">
                                            <input type="number" id="NilaiAkhir" name="NilaiAkhir" class="form-control" placeholder="Nilai Akhir">
                                        </div>

                                    </div>

                                    
                                    <div class="box-footer" align="left">
                                        <input type="button" class="btn btn-default" id="btnResetPendidikan" onclick="resetFormPendidikan()" 
                                        value='{{trans("crudbooster.button_reset")}}'/>
                                        <input type="button" id="savePendidikan" name="savePendidikan" class="btn btn-success" onclick="addPendidikan()" value='Tambah'>
                                    </div>
                                    <!--Data Table Pendidikan-->
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <i class="fa fa-table"></i><label>  Detail Pendidikan</label>
                                        </div>
                                        <div class="panel-body no-padding table-responsive" style="max-height: 400px;overflow: auto">
                                            <table id='dtPendidikan' class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        @foreach($colPendidikan as $colPend)
                                                            <th>{{$colPend}}</th>
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
                                <button type="button" onclick="location.href='{{CRUDBooster::mainpath('step1').'/'.$id}}'"class="btn btn-default">
                                &laquo; Back
                                </button>
                               <a href="{{Route('AdminEmployeeCustomControllerGetStep3',['id'=>$id])}}" class="btn btn-primary">Step Selanjutnya &raquo;</a>
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

    var table = $('#dtIdentitas').dataTable({
        "dom": 'Brt',
        "bSort" : false,
        "processing" : true,
        "ajax" : {
                "url" : "{{route('detailIdentitas',$id)}}",
                "type" : "GET"
        }

    });

    var tablePendidikan = $('#dtPendidikan').dataTable({
        "dom":'Brt',
        "bSort": false,
        "processing" : true,
        "ajax" : {
            "url":"{{route('detailPendidikan',$id)}}",
            "type":"GET"
        }
    });
});




var currentRow = null;

function addIdentitas()
{
    var idDetail = $('#id').val();
    console.log(idDetail);
    if(idDetail == "")
    {
        var url = "{{url('identitasPelamar')}}";
    }
    else
    {
        var url = "{{url('updateIdentitasPelamar')}}/"+idDetail;
    }
    $.ajax({
        data: $('#IdentitasForm').serialize(),
        url: url,
        type:"POST",
        dataType:'JSON',
        success: function (data) {
            console.log(data);
            resetFormIdentitas();
          
            oTable = $('#dtIdentitas').dataTable();
            oTable.api().ajax.reload();
        }
       
    });
  
}

function editIdentitas(id)
{
    //save method = "edit";
    $.ajax({
        url:"{{url('editIdentitasPelamar')}}/"+id,
        type:"GET",
        dataType:"JSON",
        success: function(data){
            console.log(data.id);
            $('#saveIdentitas').val('{{trans("crudbooster.save_changes")}}');
            $('#id').val(id);
            $('#TipeIdentitas_id').val(data.TipeIdentitas_id).trigger('change');
            $('#NoID').val(data.NoID);
            $('#MasaBerlaku').val(data.MasaBerlaku);
        }
    });
}
function resetFormIdentitas()
{
    $('#TipeIdentitas_id').val('').trigger('change');
    $('#NoID').val('');
    $('#MasaBerlaku').val('');
}

function resetFormPendidikan()
{
    $('#EducationLevel_id').val('').trigger('change');
    $('#EducationName').val('');
    $('#Form').val('');
    $('#To').val('');
    $('#NilaiAkhir').val('');
}
function deleteRowidentitasdiri(id)
{ 
   
    var token = $("meta[name='csrf-token']").attr("content");
   
    var row_id = $(this).attr("id");
    if(confirm("Apakah Anda Yakin Menghapus Data Ini?"))
    {
        $.ajax({
            url: "{{url('hapusIdentitas')}}/"+id,
            type: "POST",
            data: {
                'method': 'DELETE',
                'token': token
            },
            success: function(data){
                console.log("Berhasil di hapus");
                oTable = $('#dtIdentitas').dataTable();
                oTable.api().ajax.reload();
            }
        });
    }
        
}

function editRowidentitasdiri(id)
{
    var p = $(id).parent().parent();
    currentRow = p;
    console.log(currentRow);
    p.addClass('warning');
    $('#saveIdentitas').val('{{trans("crudbooster.save_changes")}}');
    $('#TipeIdentitas_id').val(p.find(".TipeIdentitas_id input").val()).trigger("change");
    $('#NoID').val(p.find(".NoID input").val());
    $('#MasaBerlaku').val(p.find(".MasaBerlaku input").val());

}

function addPendidikan() 
{
    var idPendidikan = $('#idPendidikan').val();
    console.log(idPendidikan);

    if(idPendidikan == "")
    {
        var urlPendidikan = "{{url('pendidikanSave')}}";
    }
    else
    {
        var urlPendidikan = "{{url('pendidikanUpdate')}}/"+idPendidikan;
    }
    $.ajax({
        data: $('#PendidikanForm').serialize(),
        url: urlPendidikan,
        type:"POST",
        dataType:'JSON',
        success: function (data) {
            resetFormPendidikan();
            oTablePendidikan= $('#dtPendidikan').dataTable();
            oTablePendidikan.api().ajax.reload();
        }
    });

}
function editPendidikan(id)
{
    $.ajax({
        url:"{{url('pendidikanEdit')}}/"+id,
        type:"GET",
        dataType:"JSON",
        success: function(data){
           console.log(data.id);
           $('#idPendidikan').val(id);
           $('#savePendidikan').val('{{trans("crudbooster.save_changes")}}');
           $('#EducationLevel_id').val(data.EducationLevel_id).trigger('change');
           $('#Form').val(data.Form);
           $('#To').val(data.To);
           $('#NilaiAkhir').val(data.NilaiAkhir);
           $('#EducationName').val(data.EducationName);
        }
    });
}

function deletePendidikan(id)
{
    var token = $("meta[name='csrf-token']").attr("content");
   if(confirm("Apakah Anda Yakin Menghapus Data Ini?"))
   {
       $.ajax({
           url: "{{url('PendidikanDelete')}}/"+id,
           type: "POST",
           data: {
                'method': 'DELETE',
                'token': token
           },
           success:function(data){
                console.log("Berhasil Hapus Pendidikan");
                oTablePendidikan = $('#dtPendidikan').dataTable();
                oTablePendidikan.api().ajax.reload();
           }
       });
   }
}

function addTableIdentitas()
{
    var kosong = 'secret';
    var trRow = '<tr>';
    trRow += "<td class='Employee_id'>"+$('#Employee_id').val() +
    "<input type='hidden' name='identitasdiri-Employee_id[]' value='"+$('#Employee_id').val() +"'/>"+
    "</td>";

    trRow += "<td class='TipeIdentitas_id'>"+$('#TipeIdentitas_id option:selected').text()+
    "<input type='hidden' name='identitasdiri-TipeIdentitas_id[]' value='"+$('#TipeIdentitas_id').val()+"'/>"+
    "</td>";

    trRow += "<td class='NoID'>"+$('#NoID').val() +
    "<input type='hidden' name='identitasdiri-NoID[]' value='"+$('#NoID').val() +"'/>"+
    "</td>";

    trRow += "<td class='MasaBerlaku'>"+$('#MasaBerlaku').val() +
    "<input type='hidden' name='identitasdiri-MasaBerlaku[]' value='"+$('#MasaBerlaku').val() +"'/>"+
    "</td>";
    trRow += "<td>" +
        "<a href='#panel-form-identitasdiri' onclick='editRowidentitasdiri(this)' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i></a> " 
        +
        "<a href='javascript:void(0)' onclick='deleteRowidentitasdiri(this)' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i></a></td>";

    trRow += '</tr>';
    $('#dtIdentitas tbody .trNull').remove();
    if(currentRow == null ){
        $('#dtIdentitas').prepend(trRow);
    }else
    { 
        currentRow.removeClass('warning');
        currentRow.replaceWith(trRow);
        currentRow = null;
    }
    $('saveIdentitas').val('{{trans("crudbooster.button_add_to_table")}}');
    resetFormIdentitas();
    
}
</script>
@endpush

@endsection