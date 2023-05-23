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
$( document ).ready(function() {
//konfigurasi DataTable pada tabel dengan id example dan menambahkan  div class dateseacrhbox dengan dom untuk meletakkan inputan daterangepicker
 var $dTable = $('#example').DataTable({
  "dom": "<'row'<'col-sm-9'l><'col-sm-3'<'searchbox'>>>" +
   "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-12 text-right'i>>"
 });

 $("div.searchbox").html('<form class="example"><input type="text" class="form-control" name="EmployeeName" placeholder="Search Employee Name" value="{{ request('EmployeeName') }}" ><button type="submit"><i class="fa fa-search"></i></button></form>');
 document.getElementsByClassName("searchbox")[0].style.textAlign = "right";

} );
</script>
  
<style>
 p { 
  margin:0 
}

.link {
    text-decoration: none; 
    color: white; 
}

* {
  box-sizing: border-box;
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

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
}

a:hover {
  color: white;
}
</style>
</head>

<!------------------------------BUTTON EXPORT DLL--------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<p align="right">

<a href="../admin/Rekaplembur" class="btn btn-primary btn-sm" title="Clear">Clear</a>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Filter">Filter</button>

<a href="downloadExcel3/xlsx?from={{ request('from') }}&until={{ request('until') }}&EmployeeName={{ request('EmployeeName') }}&Unit_id={{ request('Unit_id') }}" class="btn btn-primary btn-sm"  title="Export">Export</a>
</div> 

<!------------------------------END BUTTON--------------------------------->
<div class="container">
</div>
<!---------------------------------VIEW TABLE------------------------------>

<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">

<thead>      
<tr>
<th><input type="checkbox"></th>
<th>Employee id</th>
<th>Employee Name</th>
<th>Unit</th>
<th>Departement</th>
<th>Jabatan</th>
<th>Total Lembur</th>   
</tr>
</thead>

@foreach($result as $p)
  
<tr>
<td><input type="checkbox"></td>
<td>{{$p->employee->NPK}}</td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->departement->DepartementName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->total_minute}}</td>          
</tr>

@endforeach
</table>{{ $result->links() }}

<!-------------------------------END VIEW TABLE-------------------------------->

<!--------------------------------MODAL SEARCH-------------------------------------->
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
<label>From:</label>
<input type="date" name="from" class="form-control " value="{{ request('from') }}">
<br>
<label>To:</label>
<input type="date" name="until" class="form-control "  value="{{ request('until') }}">
<br>
<label>Unit Name:</label>
<select name="Unit_id" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('Unit_id') }}" >  
<option value="">-Select Unit-</option>
<!---Ambil data option dari table hrdm101_unit--->
@foreach($value as $p)
<option value="{{$p->id}}">{{$p->UnitName}}</option>
@endforeach
<!----------------------------------------->
</select>
<br>
<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/Rekaplembur"><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
<!----------------------------------END MODAL SEARCH---------------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection