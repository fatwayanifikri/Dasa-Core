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

var $dTable = $('#example2').DataTable({

 });

$("#myModal2").modal('show');

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

<a href="downloadExcelGS/xlsx?Unit_id={{ request('Unit_id') }}&from={{ request('from') }}&until={{ request('until') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>

<a href="PrintGS?Unit_id={{ request('Unit_id') }}&from={{ request('from') }}&until={{ request('until') }}" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   

<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span> 

<span>
<a href="../admin/Facility_Control" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a>
</span>

</p>
</div> 

 <!------------------------------END EXPORT--------------------------------->


<!----------------------------------VIEW TABLE------------------------------>
<div class="container">   
</div>
<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr><b>
<th>No</th>
<th>Tanggal Request</th>
<th>Unit</th>
<th>Defect</th>
<th>Category</th>
<th>Location</th>
<th>Category Area</th>
<th>Action Plan</th>
<th>Reasoning</th>
<th>Status</th>
<th>Remarks</th>         
</tr>
</thead>

<?php $no = 0;?>
@foreach($result as $p)
<?php $no++ ;?>

<tr>
<td>{{$no}}</td>
<td>{{$p->reqid->tgl_request}}</td>
<td>{{$p->reqid->unit->UnitName}}</td>
<td>{{$p->defect}}</td>
<td>{{$p->kategori}}</td>
<td>{{$p->lokasi}}</td>
<td>{{$p->kategori_area}}</td>
<td>{{$p->actionplan}}</td>
<td>{{$p->reasoning}}</td>
<td>{{$p->work_status}}</td>
<td>{{$p->remarks}}</td>
</tr>

@endforeach

<tfoot>
<tr><b>
<th>No</th>
<th>Tanggal Request</th>
<th>Unit</th>
<th>Defect</th>
<th>Category</th>
<th>Location</th>
<th>Category Area</th>
<th>Action Plan</th>
<th>Reasoning</th>
<th>Status</th>
<th>Remarks</th>         
</tr>
</tfoot>

</table>
<!-----------------------------END VIEW TABLE---------------------------->



<!---------------------------MODAL SEARCH-------------------------------->
<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Filter Print</h4>
</div>
<!-- body modal -->
<div class="modal-body">

<!------------------------SEARCH---------------------------->
<form> 

<!-------SEARCH TANGGAL------>
<label>Tanggal Request</label>
<br></br>
<table>
<tr>
<td>From :&nbsp</td><td>
<input type="date" name="from" style="width:100%;" class="form-control" value="{{ request('from') }}">
</td>
<td>&nbsp &nbsp To :&nbsp</td><td>
<input type="date" name="until" style="width:100%;" class="form-control "  value="{{ request('until') }}">
</td>
</tr>
</table>
<br>

<!-------SEARCH UNIT------>
<label>Unit:</label>
<select name="Unit_id" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('Unit_id') }}"  >  
<option value="">-Select Unit-</option>
@foreach($value as $p)
<option value="{{$p->id}}">{{$p->UnitName}}</option>
@endforeach
</select>
<br>

<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/FacilityControlCustom" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
<!-----------------------------END MODAL SEARCH----------------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection