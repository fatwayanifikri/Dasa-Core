<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')

@section('content')

<!-- Your html goes here -->
<head>

<!--DataTables -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.5.6/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.5.6/js/jquery.dataTables.js"></script>

<!--Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!--DateRangePicker -->
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.0.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<head>
<script type="text/javascript">

$( document ).ready(function() {

var table = $('#example').DataTable( {
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        scrollY:        "1000px",
        scrollX:        "true",
        scrollCollapse: true,
        paging:         true,
        info:         true,
        fixedColumns:   {
            left: 1,
            right: 1
        },
        "oLanguage" : {
        "sInfo" : "Showing _START_ to _END_ of _TOTAL_ items",
        "sInfoEmpty" : "Showing 0 to 0 of 0 items",
        "sInfoFiltered" : " - filtering from _MAX_ items",
        "sEmptyTable" : "No Rules available",

    }

    } );

  var $dTable = $('#example2').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
        scrollY:        "400px",
        scrollX:        "true",
        scrollCollapse: true,
        paging:         true,
        info:         true,
        fixedColumns:   {
            left: 1,
            right: 1
        },
        "oLanguage" : {
        "sInfo" : "Showing _START_ to _END_ of _TOTAL_ items",
        "sInfoEmpty" : "Showing 0 to 0 of 0 items",
        "sInfoFiltered" : " - filtering from _MAX_ items",
        "sEmptyTable" : "No Rules available",

    }
 });


//datamodal select from2
$(document).on('click','#select',function(){
 var id = $(this).data('id');
 var tanggal = $(this).data('tanggal');
 $('#from2').val(id);
 $('#start').val(tanggal);
 $('#myModal2').modal('hide');
});

//datamodal select until2
$(document).on('click','#select2',function(){
 var id = $(this).data('id');
 var tanggal = $(this).data('tanggal');
 $('#until2').val(id);
 $('#end').val(tanggal);
 $('#myModal3').modal('hide');
});

// $(function() {
//   $('input[name="from2"]').daterangepicker({
//     opens: 'right',
//     drops: 'down'
//   }, function(start, end, label) {
//     console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
//   });
// });



});



</script>

<style>
 p { 
  margin:0 
}

.link {
    text-decoration: none; 
    color: white; 
}

.form-control{
  width: 88%;
  
}

.wrapper {
  position: relative;
  overflow: auto;
  border: 1px solid black;
  white-space: nowrap;
 
}
td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 150px;
}

a:hover {
  color: white;
}
.split-para      { display:block;margin:0px;}
.split-para span { display:block;float:right;width:15px;margin-right:50px;}
</style>
</head>

<!------------------------------EXPORT DOKUMEN--------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<p class="split-para">

<a href="downloadExcelCuti/xlsx?from={{ request('from') }}&until={{ request('until') }}&isApprove={{ request('isApprove') }}&Unit_id={{ request('Unit_id') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>

<a href="printcutipdf?from={{ request('from') }}&until={{ request('until') }}&isApprove={{ request('isApprove') }}&Unit_id={{ request('Unit_id') }}" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   

<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span>

<span>
<a href="../admin/management_cuti" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a>
</span>

</p>
</div> 
 <!------------------------------END EXPORT--------------------------------->


<!---------------------------------VIEW TABLE--------------------------------->
<div class="container">   
</div>
<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr>
<th><input type="checkbox"></th>
<th>Employee</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Tgl Request</th>
<th>Jenis Cuti</th>
<th>Tahun Cuti</th>
<th>Tujuan</th>
<th>Lama</th>
<th>Pelaksanaan</th>
<th>Approved</th>
</tr> 
</thead>


@foreach($result as $p)

<tr border="1">
<td class="evencolor"><input type="checkbox"></td>
<td class="evencolor">{{$p->employee->EmployeeName}}</td>
<td class="evencolor">{{$p->jabatan->name }}</td>
<td class="evencolor">{{$p->unit->UnitName}}</td>
<td class="evencolor">{{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y')}}</td>
<td class="evencolor">{{$p->cuti->namacuti}}</td>
<td class="evencolor">{{$p->Tahuncuti}}</td>
<td class="evencolor">{{$p->Tujuan}}</td>
<td class="evencolor">{{$p->Lama}}</td>
<td class="evencolor">{{$p->Pelaksanaan}}</td>
@if($p->isApprove =='1') 
<td>Disetujui Kabag/SPV</td>
@elseif($p->isApprove =='2') 
<td>Disetujui SM</td>
@elseif($p->isApprove =='3') 
<td>Tidak Disetujui</td>
@else
<td>Blm Disetujui</td>
@endif
</tr>

@endforeach

<tfoot>
<tr>
<th><input type="checkbox"></th>
<th>Employee</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Tgl Request</th>
<th>Jenis Cuti</th>
<th>Tahun Cuti</th>
<th>Tujuan</th>
<th>Lama</th>
<th>Pelaksanaan</th>
<th>Approved</th>
</tr> 
</tfoot>

</table>

<!------------------------------END VIEW TABLE--------------------------------->



<!------------------------------MODAL SEARCH---------------------------------->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Select Filter</h4>
</div>
<!-- body modal -->
<div class="modal-body">

<!------------------------SEARCH TANGGAL PENGAJUAN---------------------------->
<form>   
<label>Tanggal Pengajuan Cuti</label><br><br>
<table><tr>
<td>From :&nbsp</td><td>
<input type="date" name="from" style="width:100%;" class="form-control" value="{{ request('from') }}">
</td>
<td>&nbsp &nbsp To :&nbsp</td><td>
<input type="date" name="until" style="width:100%;" class="form-control "  value="{{ request('until') }}">
</td>
</tr></table>
<br>

<!------------------------SEARCH TANGGAL PENGAJUAN---------------------------->
<label>Tanggal Cuti</label><br><br>
<table><tr>

<td>From:&nbsp</td>
<td>
<div>
<div class="pull-right">
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2" title="Search"><i class="fa fa-search"></i></button>
</div>
<div>
<div class="input-group">
<input type="text" name="from2" style="width:100%;" class="form-control " id="start"  disabled="true">
<input type="hidden" name="from2" style="width:100%;" class="form-control " id="from2"  value="{{ request('from2') }}">
</div>
</div>
</div>
</td>

<td>&nbsp&nbspTo:&nbsp</td>
<td>
<div>
<div class="pull-right">
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal3" title="Search"><i class="fa fa-search"></i></button>
</div>
<div>
<div class="input-group">
<input type="text" name="from2" style="width:100%;" class="form-control " id="end"  disabled="true">
<input type="hidden" name="until2" style="width:100%;" class="form-control " id="until2"  value="{{ request('until2') }}">
</div>
</div>
</div>
</td>

</tr></table>
<br>

 <!------------------------SEARCH STATUS---------------------------->
<label>Status</label>
<select name="isApprove" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('isApprove') }}"  >  
<option value="">-Select Status-</option>
<option value="0">Blm Disetujui</option>
<option value="1">Disetujui Kabag/SPV</option>
<option value="2">Disetujui SM</option>
<option value="3">Tidak Disetujui</option>
</select>
<br>

<!------------------------SEARCH UNIT (HRD ONLY)---------------------------->
@foreach($jabatan as $j)
@if($j->id == 1 or $j->id == 62 or $j->id == 63 or $j->id == 64 or $j->id == 65 or $j->id == 66)
<label>Unit</label>
<select name="Unit_id" class="form-control " value="{{ request('Unit_id') }}"  >  
<option value="">-Select Unit-</option>
<option value="1">Kantor Pusat</option>
<option value="2">Depress</option>
<option value="3">Aladdin</option>
<option value="4">Buring</option>
<option value="5">Cano</option>
<option value="6">Data</option>
<option value="7">Era</option>
<option value="8">Fast Print</option>
<option value="9">Geray Print</option>
</select>
<br>
@endif
@endforeach

<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/export_cuti" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
</button>
</form>
<!---------------------------END SEARCH---------------------------->
</div>
<!-- footer modal -->
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>

<!------------------------------END MODAL SEARCH------------------->


<!-----------------MODAL SEARCH TGL CUTI START---------------------->

<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Select Cuti</h4>
</div>
<!-- body modal -->
<div class="modal-body">

<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr>
<th>ID</th>
<th>EmployeeName</th>
<th>Jabatan</th>
<th>Tanggal Cuti</th>
<th>Select</th>
</tr> 
</thead>

@foreach($cuti as $c => $data)

<tr>
<td class="evencolor">{{$data->id}}</td>
<td class="evencolor">{{$data->employee->EmployeeName}}</td>
<td class="evencolor">{{$data->jabatan->name }}</td>
<td class="evencolor">{{$data->Pelaksanaan}}</td>
<td>
<button class="btn btn-xs btn-info" id="select" title="Select"
data-id="<?=$data->id?>"
data-tanggal="<?=$data->Pelaksanaan?>"

>
<i class="fa fa-check"> Select</i></button>
</td>
</tr>

@endforeach

<tfoot>
<tr>
<th>ID</th>
<th>EmployeeName</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Tanggal Cuti</th>
</tr> 
</tfoot>

</table>

</div>
<!-- footer modal -->
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!------------------------------END MODAL SEARCH------------------->


<!-----------------MODAL SEARCH TGL CUTI END---------------------->

<div id="myModal3" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Select Cuti</h4>
</div>
<!-- body modal -->
<div class="modal-body">

<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr>
<th>ID</th>
<th>EmployeeName</th>
<th>Jabatan</th>
<th>Tanggal Cuti</th>
<th>Select</th>
</tr> 
</thead>

@foreach($cuti as $c => $data)

<tr>
<td class="evencolor">{{$data->id}}</td>
<td class="evencolor">{{$data->employee->EmployeeName}}</td>
<td class="evencolor">{{$data->jabatan->name }}</td>
<td class="evencolor">{{$data->Pelaksanaan}}</td>
<td>
<button class="btn btn-xs btn-info" id="select2" title="Select"
data-id="<?=$data->id?>"
data-tanggal="<?=$data->Pelaksanaan?>"

>
<i class="fa fa-check"> Select</i></button>
</td>
</tr>

@endforeach

<tfoot>
<tr>
<th>ID</th>
<th>EmployeeName</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Tanggal Cuti</th>
</tr> 
</tfoot>

</table>

</div>
<!-- footer modal -->
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!------------------------------END MODAL SEARCH------------------->

</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection