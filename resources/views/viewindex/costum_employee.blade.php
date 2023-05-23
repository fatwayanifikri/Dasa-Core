<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')

@section('content')

  <!-- Your html goes here -->
<head>

<!--DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
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

var $dTable = $('#example').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 text-right'i>>"
 });

//menambahkan costum filter select unit di dalam datatables
//versi non jsnya ada dibawah untuk yg rapihnya karena klo js harus disatukan tdk boleh di spasi
    $("div.filtersearchbox").html('');

 document.getElementsByClassName("filtersearchbox")[0].style.textAlign = "left";

} );
</script>
  
<style>
 p { 
  margin:0 
}

.form-control{
  width: 88%;
}

.link {
    text-decoration: none; 
    color: white; 

}
a:hover {
  color: white;
}
</style>
</head>


<!------------------------------EXPORT DOKUMEN--------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<p align="right">
<a href="../admin/employee" class="btn btn-primary btn-sm" title="Clear">Clear</a>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Filter">Filter</button>
<a href="downloadExcel2/xlsx?UnitName={{ request('UnitName') }}&EmployeeName={{ request('EmployeeName') }}&NPK={{ request('NPK') }}" class="btn btn-primary btn-sm"  title="Export">Export</a>
</div> 
<!------------------------------END EXPORT--------------------------------->



<!------------------------------VIEW TABLE--------------------------------->


<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>      
<tr>
<th><input type="checkbox"></th>
<th>NPK</th>
<th>Nama Karyawan</th>
<th>Unit</th>
<th>Perusahaan</th>
<th>Departement</th>
<th>Jabatan</th>
</tr>
</thead>
        
@foreach($result as $p)
<tr>
<td><input type="checkbox"></td>
<td>{{$p->NPK}}</td>
<td>{{$p->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td> 
<td>{{$p->company->CompanyName}}</td>
<td>{{$p->department->DepartementName}}</td>
<td>{{$p->jabatan->name}}</td>
</tr>
@endforeach

<tfoot>
<tr>
<th><input type="checkbox"></th>
<th>NPK</th>
<th>Nama Karyawan</th>
<th>Unit</th>
<th>Perusahaan</th>
<th>Departement</th>
<th>Jabatan</th>
</tr>
</tfoot>
</table>

{{ $result->links() }}

<!--------------------------------MODAL SEARCH------------------------------------>
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

<!------------------------SEARCH NPK---------------------------->
<form method="GET">
<select name="NPK" class="form-control " value="{{ request('NPK') }}"  >  
<option value="">-Select NPK-</option>
@foreach($result as $p) 
<option value="{{$p->NPK}}">{{$p->NPK}}</option>
 @endforeach
</select>
<br>

<!------------------------SEARCH EMPLOYEENAME-------------------------->
<select name="EmployeeName" class="form-control " value="{{ request('EmployeeName') }}"> 
<option value="">-Select Name-</option>
@foreach($result as $p) 
<option value="{{$p->EmployeeName}}">{{$p->EmployeeName}}</option>
 @endforeach
</select>
<br>

<!------------------------SEARCH UNIT---------------------------->
<select name="UnitName" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('UnitName') }}"  >  
<option value="">-Select Unit-</option>
@foreach($value as $p)
<option value="{{$p->UnitName}}">{{$p->UnitName}}</option>
@endforeach
</select>
<br>

<input type="submit"class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/employee"> <button type="reset" class="btn btn-danger" title="Reset">Reset
</a>
</button>
</center>
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
<!---------------------------------END MODAL SEARCH---------------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection