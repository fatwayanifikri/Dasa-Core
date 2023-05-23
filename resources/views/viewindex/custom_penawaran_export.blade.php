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
responsive: true
 });

// $("#myModal2").modal('show');

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

<a href="downloadExcelKendaraan/xlsx?Unit_id={{ request('Unit_id') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>

<a href="Printpenawaran_pdf?Sales_Unit={{ request('Sales_Unit') }}" class="btn btn-danger" title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   

<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span> 
<span>
<a href="../admin/penawaran_export" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a>
</span>

</p>
</div> 

<!------------------------------END EXPORT--------------------------------->


<!-------------------------------VIEW TABLE------------------------------->
<div class="container">   
</div>
<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr>
<th>No</th>
<th>Nomor Dokumen</th>
<th>Unit</th>
<th>Sales</th>
<th>Tgl Request</th>
<th>Company Name</th>
<th>Status</th>             
</tr>
</thead>

<?php $no = 0;?>
@foreach($result as $p)
<?php $no++ ;?>
<tr>
<td>{{$no}}</td>
<td>{{$p->Nomor_Penawaran}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->sales->EmployeeName}}</td>
<td>{{ \Carbon\Carbon::parse($p->tgl_request)->format('d-m-Y')}}</td>
<td>{{$p->CompanyName}}</td>

@if($p->Status =='1') 
<td>Blm Disetujui</td>
@elseif($p->Status =='2') 
<td>Disetujui SM</td>
@elseif($p->Status =='3') 
<td>Disetujui Customer</td>
@else
<td>Faktur Sudah Dibuat</td>
@endif 
</tr>

@endforeach

<tfoot>
<tr>
<th>No</th>
<th>Nomor Dokumen</th>
<th>Unit</th>
<th>Sales</th>
<th>Tgl Request</th>
<th>Company Name</th>
<th>Status</th>             
</tr>
</tfoot>

</table>
<!------------------------------------END VIEW TABLE------------------------------->



 <!----------------------------------MODAL SEARCH---------------------------------->
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

<!-------SEARCH TANGGAL REQUEST------>
<label>Tanggal Request</label><br></br>
<table>
<tr>
<td>From: &nbsp</td>
<td><input type="date" name="from" class="form-control " value="{{ request('from') }}"></td>
<td>To: &nbsp</td>
<td><input type="date" name="until" class="form-control "  value="{{ request('until') }}"></td>
</tr>
</table>
<br>

<!-------SEARCH UNIT------>
<label>Unit:</label>
<select name="Sales_Unit" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('Sales_Unit') }}"  >  
<option value="">-Select Unit-</option>
@foreach($value as $p)
<option value="{{$p->id}}">{{$p->UnitName}}</option>
@endforeach
</select>
<br>

<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/penawaran_export" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
<!------------------------------END MODAL SEARCH--------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection