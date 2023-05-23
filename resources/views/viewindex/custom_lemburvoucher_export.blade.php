
<!-- VIEW EXPORT VOUCHER LEMBUR ALL STATUS-->

@extends('crudbooster::admin_template')

@section('content')

  <!-- Your html goes here -->
<head>

<!--DataTables -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>

<!--Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!--DateRangePicker -->
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.0.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<head>
    
<script type="text/javascript">

$(document).ready(function() {

    var table = $('#example').DataTable( {
    "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>"+ 
    "<'row'<'col-sm-12 text-right'i>>",
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
} );
// $("#myModal").modal('show');

</script>
  
<style>
 p { 
  margin:0 
}

/* Style the search field */
form.example input[type=text] {
  padding: 9px;
  font-size: 12px;
  border: 1px solid grey;
  width: 60%;
  background: white;
}
/* Style the submit button */
form.example button {
  float: right;
  width: 15%;
  padding: 7.8px;
  background: #708090;
  color: white;
  font-size: 12px;
  border: 1px solid grey;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}
.link {
    text-decoration: none; 
    color: white; 
}

.form-control{
  width: 88%;
  
}

a:hover {
  color: white;
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

<a href="downloadExcelVoucher/xlsx?from={{ request('from') }}&until={{ request('until') }}&isVoucher={{ request('isVoucher') }}&Unit_id={{ request('Unit_id') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>

<a href="printvoucherpdf?from={{ request('from') }}&until={{ request('until') }}&isVoucher={{ request('isVoucher') }}&Unit_id={{ request('Unit_id') }}" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   
<span>

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span> 

@foreach($jabatan as $j)
@if($j->id == 1 or $j->id == 62 or $j->id == 63 or $j->id == 64 or $j->id == 65 or $j->id == 66) 
<span>
<a href="../admin/voucher_lembur_ho" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a> <!-- FOR HC & SUPERADMIN -->
</span>
@else
<span>
<a href="../admin/pembuatan_voucher_lembur" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a> <!-- FOR ADMIN -->
</span>
@endif
@endforeach
</p>
</div>
 <!------------------------------END EXPORT--------------------------------->


<!-----------------------------------VIEW TABLE--------------------------------->
<div class="container">   
</div>
<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 

<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100% " >

<thead>  
<tr>
<th><input type="checkbox"></th>
<th>Karyawan</th>
<th>Unit</th>
<th>Jabatan</th>
<th>Shift</th>
<th>Tgl Lembur</th>
<th>Jam Lembur</th>
<th>Menit Lemburan</th>
<th>Approve Lembur</th>
<th>Status Voucher</th>
<th>Nomor Voucher</th>    
</tr>
</thead>
      
        @foreach($result as $p)
        <tr>
            <td><input type="checkbox"></td>
            <td>{{$p->employee->EmployeeName}}</td>
            <td>{{$p->unit->UnitName}}</td>
            <td>{{$p->jabatan->name}}</td>
            <td>{{$p->shift}}</td>
            <td>{{ \Carbon\Carbon::parse($p->StartTime)->format('d-m-Y')}}</td>
            <td>{{ \Carbon\Carbon::parse($p->StartTime)->format('H:i:s')}} - {{ \Carbon\Carbon::parse($p->EndTime)->format('H:i:s')}}</td>
            <td>{{$p->AmountMinute}}</td>
            <td>{{ ($p->isApproved == 1) ? 'Setuju' : 'Blm Di Setujui'}}</td>
            @if($p->isVoucher =='1') 
            <td>Dibuat</td>
            @elseif($p->isVoucher =='2') 
            <td>Diajukan</td>
            @elseif($p->isVoucher =='3') 
            <td>Dicairkan</td>
            @elseif($p->isVoucher =='4') 
            <td>Diterima</td>
            @else
            <td>Blm Dibuat</td>
            @endif
            <td>{{$p->NomerVoucher}}</td>
        </tr>
        @endforeach

<tfoot>  
<tr>
<th><input type="checkbox"></th>
<th>Karyawan</th>
<th>Unit</th>
<th>Jabatan</th>
<th>Shift</th>
<th>Tgl Lembur</th>
<th>Jam Lembur</th>
<th>Menit Lemburan</th>
<th>Approve Lembur</th>
<th>Status Voucher</th>
<th>Nomor Voucher</th>    
</tr>
</tfoot>

</table> {{ $result->links() }}

<!------------------------------------END VIEW TABLE--------------------------------->


<!------------------------------------MODAL SEARCH------------------------------>
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
 <!------------------------SEARCH TANGGAL---------------------------->
<form>   
<label>Tanggal Lembur</label><br>
<table><tr>
<td>From :&nbsp</td><td>
<input type="date" name="from" style="width:100%;" class="form-control" value="{{ request('from') }}">
</td>
<td>&nbsp &nbsp To :&nbsp</td><td>
<input type="date" name="until" style="width:100%;" class="form-control "  value="{{ request('until') }}">
</td>
</tr></table>
<br>

<!------------------------SEARCH STATUS VOUCHER---------------------------->

@foreach($jabatan as $j)
@if($j->id == 1 or $j->id == 62 or $j->id == 63 or $j->id == 64 or $j->id == 65 or $j->id == 66)
<label>Status Voucher</label>
<select name="isVoucher" class="form-control " value="{{ request('isVoucher') }}"  >  
<option value="">-Status Voucher-</option>
<option value="2">Diajukan</option>
<option value="3">Dicairkan</option>
<option value="4">Diterima</option>
</select>
<br>
@else
<label>Status Voucher</label>
<select name="isVoucher" class="form-control " value="{{ request('isVoucher') }}"  >  
<option value="">-Status Voucher-</option>
<option value="1">Dibuat</option>
<option value="4">Diterima</option>
</select>
<br>
@endif
@endforeach

<!--------------------------SEARCH UNIT---------------------------->
<!-- (Untuk jabatan super admin, maka muncul filter unit) -->

@foreach($jabatan as $j)
@if($j->id == 1)
<label>Select Unit</label>
<select name="Unit_id" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('Unit_id') }}"  >  
<option value="">-Select Unit-</option>
@foreach($value as $p)
<option value="{{$p->id}}">{{$p->UnitName}}</option>
@endforeach
</select>
<br>
@else
<br>
@endif
@endforeach

<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/export_voucher_lembur" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
</div>
<!-------------------------------------END MODAL SEARCH---------------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection