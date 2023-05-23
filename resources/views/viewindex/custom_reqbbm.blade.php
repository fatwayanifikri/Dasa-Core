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

 var $dTable = $('#example').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>"+ 
    "<'row'<'col-sm-12 text-right'i>>"
    
 });

// $("#myModal").modal('show');

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
<a href="downloadExcelReqBBM/xlsx?from={{ request('from') }}&until={{ request('until') }}&Unit_id={{ request('Unit_id') }}&status={{ request('status') }}&nomor_kendaraan={{ request('nomor_kendaraan') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>

<a href="PrintBBM_pdf?from={{ request('from') }}&until={{ request('until') }}&Unit_id={{ request('Unit_id') }}&status={{ request('status') }}&nomor_kendaraan={{ request('nomor_kendaraan') }}" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>  

<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span> 

<span>
<a href="../admin/request_bbm" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a>
</span>

</p>
</div> 
<!------------------------------END EXPORT--------------------------------->


<!------------------------------------VIEW TABLE--------------------------->
<div class="container">   
</div>
<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr>
<th><input type="checkbox"></th>
<th>Jenis Permintaan</th>
<th>Nomor Voucher</th>
<th>Nomor Kendaraan</th>
<th>Employee Name</th>
<th>Kepemilikan</th>
<th>Unit</th>
<th>Tanggal Request</th>
<th>Status Voucher</th>
</tr> 
</thead>

@foreach($result as $p)
<tr border="1">
<td><input type="checkbox"></td>
<td>{{$p->jenis_permintaan}}</td>
<td>{{$p->nomor_voucher}}</td>
<td>{{$p->kendaraan->nomor_kendaraan}}</td>
<td>{{$p->EmployeeName}}</td>
<td>{{$p->kendaraan->kepemilikan}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->tgl_permintaan }}</td>
<td> {{ ($p->status == 2) ? 'Voucher Sudah Cair' : 'Voucher Belum Cair'}}</td>  
</tr>

@endforeach
<tfoot>
<tr>
<th><input type="checkbox"></th>
<th>Jenis Permintaan</th>
<th>Nomor Voucher</th>
<th>Nomor Kendaraan</th>
<th>Employee Name</th>
<th>Kepemilikan</th>
<th>Unit</th>
<th>Tanggal Request</th>
<th>Status Voucher</th>
</tr> 

</tfoot>
</table>
{{ $result->links() }}
<!-----------------------------------END VIEW TABLE------------------------------>

<!-----------------------------------MODAL SEARCH----------------------------->
<div id="myModal" class="modal fade" role="dialog">
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

<!-------SEARCH TANGGAL PERMINTAAN------>
<label>Tanggal Permintaan</label><br></br>
<table>
<tr>
<td>From:</td>
<td><input type="date" name="from" class="form-control " value="{{ request('from') }}"></td>
<td>To:</td>
<td><input type="date" name="until" class="form-control "  value="{{ request('until') }}"></td>
</tr>
</table>
<br>

<!-------SEARCH TANGGAL PENCAIRAN------>
<label>Tanggal Pencairan</label><br></br>
<table>
<tr>
<td>From:</td>
<td><input type="date" name="from2" class="form-control " value="{{ request('from2') }}"></td>
<td>To:</td>
<td><input type="date" name="until2" class="form-control "  value="{{ request('until2') }}"></td>
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

<!-------STATUS VOUCHER------>
<label>Status Voucher:</label>
<select name="status" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('status') }}"  >  
<option value="">-Select Status-</option>
<option value="1">Voucher Belum Cair</option>
<option value="2">Voucher Sudah Cair</option>
</select>
<br>

<!-------NO POL------>
<label>Nomor Kendaraan:</label>
<input type="text" name="nomor_kendaraan" class="form-control " placeholder="Cari Nomor Kendaraan.." value="{{ request('nomor_kendaraan') }}"  >  
<br>

<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/request_bbm_export" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
<!------------------------------END MODAL SEARCH------------------------>
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection