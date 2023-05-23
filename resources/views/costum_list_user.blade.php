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
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

 $("div.searchbox").html('<form class="example"><input type="text" class="form-control" name="name" placeholder="Search Employee Name" value="{{ request('name') }}" ><button type="submit"><i class="fa fa-search"></i></button></form>');
 document.getElementsByClassName("searchbox")[0].style.textAlign = "right";

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
a{
color: black;
}

table {
    table-layout:fixed;
}
table td {
    width: 50px;
    overflow: hidden;
    text-overflow: ellipsis;
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
  background: black;
}

/* Clear floats */
form.example::after {
  content: "";
  clear: both;
  display: table;
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
<a href="../admin/cms_users" class="btn btn-info btn-sm" title="Clear">Clear</a>
<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" title="Filter">Filter</button>

</div> 
<!------------------------------END EXPORT--------------------------------->

 <!------------------------------END SEARCH--------------------------------->


  <div class="panel-body">
  <div class="table-responsive" style="overflow-x: auto"> 
  <table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
 <thead>      
<tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Privileges</th>
           <th>Employee Id</th>
           <th>Action</th>
        </tr>
        </thead>
        
        @foreach($data as $p)
        <tr>
            <td>{{$p->name}}</td>
            <td>{{$p->email}}</td> 
            <td >{{$p->password}}</td>
            <td>{{$p->id_cms_privileges }}</td>
            <td>{{$p->Employee_id}}</td>
            <td>

            <a href="#" class="btn btn-primary btn-sm" title="Show">
            <i class="fa fa-eye"></i></a>  
            <a href="{{ url('admin/edituser/'.$p->id) }}" class="btn btn-success btn-sm" title="Edit">
            <i class="fa fa-pencil"></i></a>  
            <a href="#" class="btn btn-warning btn-sm" title="Delete">
            <i class="fa fa-trash"></i></a>  
          
            </td>
        </tr>
        @endforeach

           <tfoot>
            <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Privileges</th>
           <th>Employee Id</th>
           <th>Action</th>
            </tr>
        </tfoot>
    </table>

<!------------------------------------------------MODAL SEARCH-------------------------------------------------------->
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
<form method="GET">
<select name="name" class="form-control " value="{{ request('name') }}"  >  
<option value="">-Select Name-</option>
@foreach($data as $p) 
<option value="{{$p->name}}"  >{{$p->name}}</option>
 @endforeach
</select>
<br>
<input type="submit"class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="http://localhost:1500/coredocs/public/admin/employee"> <button type="reset" class="btn btn-danger" title="Reset">Reset
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
<!------------------------------------------------------END MODAL SEARCH-------------------------------------------------->



    </div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection