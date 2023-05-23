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


<!------------------------------EXPORT DOKUMEN--------------------------------->
 <div class="row">
                    <div class="col-md-12">
                     <div class="panel panel-default">
  <div class="panel-heading">

</div> 
<!------------------------------END EXPORT--------------------------------->

 <!------------------------------END SEARCH--------------------------------->

<form action="{{route('input_employee')}}" method="POST">
 

<div class="panel-body">
<div style="float:left; width: 50%">
<table>
<tr>

<td width="30%"><label>NPK</label></td>
<td><input type = "text" name="NPK"></td>
</tr>

<tr><td>&nbsp</td></tr>

<tr>
<td><label>Nama</label></td>
<td><input type = "text" name="EmployeeName"></td>
</tr>

<tr><td>&nbsp</td></tr>

<tr>
<td><label>Jabatan</label></td>
<td><input type = "text" name="Jabatan_id"></td>
</tr>

<tr><td>&nbsp</td></tr>

<tr>  
<td><label>Unit</label></td>
<td><input type = "text" name="Unit_id"></td>
</tr>

<tr><td>&nbsp</td></tr>

<tr>
<td></td>
{{ csrf_field() }}
<td><input type ="submit"></td>
</tr>
</table>
</div>
</form>

<br>
<div style="float:right; width: 50%">
<table style= "width: 100%"" border="1" >
<thead >      
<tr>

<th><center>NPK</center></th>
<th><center>Nama Karyawan</center></th>
<th><center>Unit</center></th>
<th><center>Jabatan</center></th>
<th><center>Action</center></th>
</tr>
</thead>

@foreach($value as $p)
<tr align="center">
<td>{{$p->NPK}}</td>
<td>{{$p->EmployeeName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->unit->UnitName}}</td> 
<td>

            <!-- <a href="{{ url('admin/edituser/'.$p->id) }}" title="Edit">
            <i class="fa fa-pencil" style="color:green;"></i></a>   -->
            &nbsp
            <a href="{{ url('admin/delete_session/'.$p->id) }}" title="Delete">
            <i class="fa fa-trash" style="color:red;"></i></a>  
          
            </td>

</tr>
@endforeach

</table>
</div>     
<div class="panel-heading">
</div> 

</div> 
<center><a href="#" class="btn btn-warning"  title="Back">
<i class="fa fa-backward"> Back</i></a>

<a href="../admin/add_to_main" class="btn btn-success"  title="Save">
<i class="fa fa-check"> Save</i></a></center>
<br>
</br>
</div>

@endsection