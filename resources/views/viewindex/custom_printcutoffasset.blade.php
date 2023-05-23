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
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>"+ 
    "<'row'<'col-sm-12 text-right'i>>"
    
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
<a href="downloadExcelCutoff/xlsx?Unit_id={{ request('Unit_id') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>
<a href="cutoffpdf?Unit_id={{ request('Unit_id') }}" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   
<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span> 
<span>
<a href="../admin/CutoffAsset" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a>
</span>
</p>
</div> 

 <!------------------------------END EXPORT--------------------------------->


<!-------------------------------VIEW TABLE--------------------------------->
<div class="container">   
</div>
<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:100%"> 

 <thead>
 <tr><b>
 <th>No</th>
 <th>Kode Asset</th>
 <th>Nama Asset</th>
 <th>Kategori</th>
 <th>Unit</th>
 <th>Periode Cut Off</th>
 <th>Status Cut Off</th>
 </b>
 </tr>
 </thead>

 <?php $no = 0;?>
 @foreach($result as $p)
 <?php $no++ ;?>
 <tr>
 <td>{{$no}}</td>
 <td>{{$p->kode}}</td>
 <td>{{$p->nama}}</td>
 <td>{{$p->kategori->kategori_name}}</td>
 <td>{{$p->unit->UnitName}}</td>
 <td> {{ \Carbon\Carbon::parse($p->created_at)->format('m-Y')}}</td>
 <td> {{ ($p->status_cutoff == 1) ? 'Sudah Di Cutoff' : 'Blm Di Cut Off'}}</td>  
 </tr>
 @endforeach

 <tfoot>
 <tr>
 <th>No</th>
 <th>Kode Asset</th>
 <th>Nama Asset</th>
 <th>Kategori</th>
 <th>Unit</th>
 <th>Periode Cut Off</th>
 <th>Status Cut Off</th>
 </tr>
 </tfoot>
 </table>
 {{ $result->links() }}
  
<!------------------------------END VIEW TABLE--------------------------------->



<!----------------------------MODAL SEARCH-------------------------------------->
<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Filter Unit</h4>
</div>
<!-- body modal -->
<div class="modal-body">

<!------------------------SEARCH---------------------------->

<form> 
<label>Unit:</label>
<select name="Unit_id" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('Unit_id') }}"  >  
<option value="">-Select Unit-</option>
@foreach($value as $p)
<option value="{{$p->id}}">{{$p->UnitName}}</option>
@endforeach
</select>
<br>
<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/PrintCutoffAsset" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
<!----------------------------------------END MODAL SEARCH-------------------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection