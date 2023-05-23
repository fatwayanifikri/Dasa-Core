<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')

@section('content')

<!-- Your html goes here -->
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
  width: 75%;

}

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
<table align="center"  width="30%">
<tr><td>
<input type="submit" data-toggle="modal" class="button" data-target="#myModal1"  value="Absen Masuk..."> 
</td>
<td>&nbsp</td>
<td>
<input type="submit"  data-toggle="modal" class="button" data-target="#myModal2" value="Keluar Istirahat" >
</td></tr>

<tr><td>
&nbsp
</td></tr>

<tr><td>
<input type="submit"  data-toggle="modal" class="button" data-target="#myModal3" value="Masuk Istirahat" >
</td>
<td>&nbsp</td>
<td>
<input type="submit"  data-toggle="modal" class="button" data-target="#myModal4" value="Absen Pulang..." >
</td></tr>
</table>

<!----------------------------------------------------------------------------->

<!---------------------MODAL INPUT ABSEN MASUK--------------------------------->

<div id="myModal1" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">ABSEN MASUK KARYAWAN</h4>
</div>
<!-- body modal -->
<div class="modal-body">

<!------------------------INPUT ABSEN---------------------------->
<form action="{{route('masuk')}}" method="POST">
 {{csrf_field()}}
<center>
<select name="Employee_id" class="form-control " placeholder="Cari Karyawan.." value="{{ request('Employee_id') }}"  >  
<option value="">-Select Nama Karyawan-</option>
@foreach($result as $p)
<option value="{{$p->id}}">{{$p->EmployeeName}}</option>
@endforeach
</select>
<br>
<input type="submit" class="btn btn-primary btn-md"> 
</center>
</form>

</div>
<!-- footer modal -->
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!----------------------------END INPUT ABSEN MASUK--------------------------->
<!---------------------------------------------------------------------------->


<!-----------------------------MODAL ABSEN KELUAR ISTIRAHAT------------------->

<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">ABSEN KELUAR ISTIRAHAT</h4>
</div>
<!-- body modal -->
<div class="modal-body">
 <!------------------------INPUT ABSEN---------------------------->
<form action="{{route('masuk2')}}" method="POST">
{{csrf_field()}}
<center>
<select name="Employee_id" class="form-control " placeholder="Cari Karyawan.." value="{{ request('Employee_id') }}"  >  
<option value="">-Select Nama Karyawan-</option>
@foreach($result as $p)
<option value="{{$p->id}}">{{$p->EmployeeName}}</option>
@endforeach
</select>
<br>
<input type="submit" class="btn btn-primary btn-md"> 
</center>
</form>

</div>
<!-- footer modal -->
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!------------------------------END KELUAR ISTIRAHAT--------------------------->
<!----------------------------------------------------------------------------->


<!----------------------------MODAL INPUT ABSEN ISTIRAHAT----------------------->

<div id="myModal3" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">ABSEN MASUK ISTIRAHAT</h4>
</div>
<!-- body modal -->
<div class="modal-body">
 <!------------------------INPUT ABSEN---------------------------->
<form action="{{route('masuk3')}}" method="POST">
{{csrf_field()}}
<center>
<select name="Employee_id" class="form-control " placeholder="Cari Karyawan.." value="{{ request('Employee_id') }}"  >  
<option value="">-Select Nama Karyawan-</option>
@foreach($result as $p)
<option value="{{$p->id}}">{{$p->EmployeeName}}</option>
@endforeach
</select>
<br>
<input type="submit" class="btn btn-primary btn-md"> 
</center>
</form>

</div>
<!-- footer modal -->
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!---------------------------------END MASUK ISTIRAHAT------------------------->
<!----------------------------------------------------------------------------->


<!----------------------------MODAL INPUT ABSEN PULANG------------------------->


<div id="myModal4" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">ABSEN PULANG</h4>
</div>
<!-- body modal -->
<div class="modal-body">
 <!------------------------INPUT ABSEN---------------------------->
<form action="{{route('pulang')}}" method="POST">
  {{csrf_field()}}
<center>
<select name="Employee_id" class="form-control " placeholder="Cari Karyawan.." value="{{ request('Employee_id') }}"  >  
<option value="">-Select Nama Karyawan-</option>
@foreach($result as $p)
<option value="{{$p->id}}">{{$p->EmployeeName}}</option>
@endforeach
</select>
<br>
<input type="submit" class="btn btn-primary btn-md"> 
</center>
</form>

</div>
<!-- footer modal -->
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-----------------------------END ABSEN PULANG-------------------------------->
<!----------------------------------------------------------------------------->

</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection