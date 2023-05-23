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
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

//menambahkan costum filter select unit di dalam datatables
//versi non jsnya ada dibawah untuk yg rapihnya karena klo js harus disatukan tdk boleh di spasi
    $("div.filtersearchbox").html('');

 document.getElementsByClassName("filtersearchbox")[0].style.textAlign = "left";

} );

$('#selectID').change(function(){
    this.form.submit()
});

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

<!-------------------------------------
 <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
  <div class="panel-heading">
<p align="right">
<a class="fa fa-download" style="width:1%" href="{{ URL::to('admin/downloadExcel2/xlsx') }}" title="Download" ></a> 
<a href="downloadExcel2/xlsx?UnitName={{ request('UnitName') }}&EmployeeName={{ request('EmployeeName') }}&DepartementName={{ request('DepartementName') }}" class="fa fa-download" title="Export"></a>
</p>
</div>----------------------->
<!------------------------------EXPORT DOKUMEN--------------------------------->
 <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
  <div class="panel-heading">
<p align="right">
<a href="../admin/employee" class="btn btn-primary btn-sm" title="Clear">Clear</a>
<a href="downloadExcel2/xlsx?UnitName={{ request('UnitName') }}&EmployeeName={{ request('EmployeeName') }}&NPK={{ request('NPK') }}" class="btn btn-primary btn-sm"  title="Export">Export</a>
</div> 
<!------------------------------END EXPORT--------------------------------->

 <!------------------------------END SEARCH--------------------------------->


  <div class="panel-body">

<table>

<tr>

<td>
<b> Select Employee: &nbsp </b>
</td>

<td>
<form method="GET">
<select name="EmployeeName" class="form-control " value="{{ request('EmployeeName') }}" id="dropdown" onchange="this.form.submit()" >  
<option value="kamu">-Select Name-</option>
@foreach($bring as $p) 
<option value="{{$p->EmployeeName}}">{{$p->EmployeeName}}</option>
 @endforeach
</select>
</td>

</tr>
</form>
</table>
<br>

  <div class="table-responsive" style="overflow-x: auto"> 
  <table id="" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 

        <?php $count = 0; ?>
        @foreach($result ->sortBy('NPK') as $p)
        <?php if($count == 1) break; ?>
        <tr>
          <td width="10%"><b>NPK</td>
            <td>{{$p->NPK}}</td>
        </tr>
        <tr>
          <td><b>Employee Name</td>
            <td>{{$p->EmployeeName}}</td>
        </tr>
        <tr>
          <td><b>Unit</td>
            <td>{{$p->unit->UnitName}}</td> 
        </tr>
        <tr>
          <td><b>Company</td>
            <td>{{$p->company->CompanyName}}</td>
        </tr>
        <tr>
          <td><b>Departement</td>
            <td>{{$p->department->DepartementName}}</td>
        </tr>
        <tr>
           <td><b>Jabatan</td>
            <td>{{$p->jabatan->name}}</td>
        </tr>  
        
        <?php $count++; ?>
        @endforeach
    </table>


    </div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection