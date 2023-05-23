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

<!--Select2-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<head>

<script type="text/javascript">
$(document).ready(function() {

 var $dTable = $('#example').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

  var $dTable = $('#example2').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

  setInterval(function(){
      var Masuk = 0 ;
      var Istirahat = 0;
      var Masuk2 = 0;
      var Pulang = 0;
      var Lembur = 0;
      var Selesai = 0;
      var Employee = $('#Employee').val();
   

      $('#Masuk').val(Employee)
      $('#Istirahat').val(Employee)
      $('#Masuk2').val(Employee)
      $('#Pulang').val(Employee)
      $('#Lembur').val(Employee)
      $('#Selesai').val(Employee)
      $('#NamaEmployee').val(Employee)
      $('#UnitName').val(Employee)
      $('#Jabatan').val(Employee);
      });

// $(document).on('click','#select',function(){
//  var employee_id = $(this).data('employeeid');
//  var employee_name = $(this).data('employeename');
//  var unit_id = $(this).data('unitid');
//  var unit_name = $(this).data('unitname');
//  $('#Employee').val(employee_name);
//  $('#Masuk').val(employee_id)
//  $('#Istirahat').val(employee_id)
//  $('#Masuk2').val(employee_id)
//  $('#Pulang').val(employee_id)
//  $('#myModal').modal('hide');
// });

});


</script>
  
<style>
 p { 
  margin:0 
}

/*.form-control{
  width: 75%;

}

select.form-control {
width: 77%;
}*/

.link {
    text-decoration: none; 
    color: white; 

}
a:hover {
  color: white;
}


.button {
    display: inline-block;
    text-decoration: none;
    color: #fff;
    font-weight: bold;
    background-color: #538fbe;
    padding: 20px 70px;
    font-size: 16px;
    border: 1px solid #2d6898;
    background-image: linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -o-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -moz-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -webkit-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -ms-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0, rgb(120,132,180)),
        color-stop(1, rgb(97,155,203))
    );
}

.button:hover {
  background-color: #4CAF50;
   background-image: linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -o-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -moz-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -webkit-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%);
    background-image: -ms-linear-gradient(bottom, rgb(73,132,180) 0%, rgb(97,155,203) 100%); 
  color: white;
    background-image: -webkit-gradient(
        linear,
        left bottom,
        left top,
        color-stop(0, rgb(0,255,0)), /*green*/
        color-stop(1, rgb(97,155,203))
    );
}



</style>
</head>

<!------------------------------------->

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
</div> 

<!------------------------------BUTTON ABSEN--------------------------------->

<div class="panel-body">
<br>

<table  width="100%">
<tr><td>   
<input type="text" class="form-control" name="SalesName" id="Employee"  />
</td>

<td>
<select name="EmployeeName" class="form-control " id = "NamaEmployee" disabled>  
<option value="">-Employee Name-</option>
@foreach($result as $r)
<option value="{{$r->id}}" id = "NamaEmployee">{{$r->EmployeeName}}</option>
@endforeach
</select>
</td>

<td>
<select name="Unit_id" class="form-control " id = "UnitName" disabled>  
<option value="">-Unit-</option>
@foreach($result as $r)
<option value="{{$r->id}}" id = "UnitName">{{$r->unit->UnitName}}</option>
@endforeach
</select>
</td>

<td>
<select name="Jabatan_id" class="form-control " id = "Jabatan" disabled>  
<option value="">-Jabatan-</option>
@foreach($result as $r)
<option value="{{$r->id}}" id = "Jabatan">{{$r->jabatan->name}}</option>
@endforeach
</select>
</td>

</tr>

</table>

<!-------------------------------------------------------->
<br>
<br>
<br>
<table align="center"  width="30%">
<tr><td>
<form action="{{route('masuk')}}" method="POST">
 {{csrf_field()}}
<center>
<input type="text" class="form-control" name="Employee_id" id="Masuk">
<br>
<input type="submit" data-toggle="modal" class="button" value="Absen Masuk..."> 
</form>

</td>
<td>&nbsp</td>
<td>
<form action="{{route('masuk2')}}" method="POST">
{{csrf_field()}}
<center>
<input type="text" class="form-control" name="Employee_id" id="Istirahat">
<br>
<input type="submit"  data-toggle="modal" class="button" value="Keluar Istirahat" >
</center>
</form>
</td></tr>

<!-------------------------------------------------------->

<tr><td>
&nbsp
</td></tr>

<tr><td>
<form action="{{route('masuk3')}}" method="POST">
{{csrf_field()}}
<center>
<input type="text" class="form-control" name="Employee_id" id="Masuk2">
<br>
<input type="submit"  data-toggle="modal" class="button"  value="Masuk Istirahat" >
</center>
</form>
</td>

<td>&nbsp</td>
<td>
<form action="{{route('pulang')}}" method="POST">
{{csrf_field()}}
<center>
<input type="text" class="form-control" name="Employee_id" id="Pulang">
<br>
<input type="submit"  data-toggle="modal" class="button"value="Absen Pulang.." >
</center>
</form>
</td></tr>

<tr><td>
&nbsp
</td></tr>

<!-------------------------------------------------------->

<tr><td>
<form action="{{route('mulailembur')}}" method="POST">
{{csrf_field()}}
<center>
<input type="text" class="form-control" name="Employee_id" id="Lembur">
<br>
<input type="submit"  data-toggle="modal" class="button"  value="Masuk Lembur" >
</center>
</form>
</td>

<td>&nbsp</td>
<td>
<form action="{{route('selesailembur')}}" method="POST">
{{csrf_field()}}
<center>
<input type="text" class="form-control" name="Employee_id" id="Selesai">
<br>
<input type="submit"  data-toggle="modal" class="button"value="Selesai Lembur" >
</center>
</form>

</td></tr>

</table>

<!----------------------------------------------------------------------------->

<!------------------------------MODAL CUSTOMER---------------------------------->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">DATA KARYAWAN</h4>
</div>
<!-- body modal -->
<div class="modal-body">
 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr>
<th>Employee ID</th>
<th>Employee Name</th>
<th>Unit</th>
<th>Select</th>
</tr> 
</thead>

@foreach($result as $r => $data)

<tr>
<td>{{$data->id}}</td>
<td>{{$data->EmployeeName}}</td>
<td>{{$data->unit->UnitName}}</td>
<td>
<button class="btn btn-xs btn-info" id="select" title="Select"
data-employeeid="<?=$data->id?>"
data-employeename="<?=$data->EmployeeName?>"
data-unitid="<?=$data->Unit_id?>"
data-unitname="<?=$data->unit->UnitName?>"
>
<i class="fa fa-check"> Select</i></button>
</td>
</tr>

@endforeach

<tfoot>
<tr>
<th>Employee ID</th>
<th>Employee Name</th>
<th>Unit</th>
<th>Select</th>
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
<!------------------------------END MODAL CUSTOMER------------------->

<!----------------------------------------------------------------------------->




</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection