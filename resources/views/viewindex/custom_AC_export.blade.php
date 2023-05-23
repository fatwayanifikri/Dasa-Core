<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')

@section('content')
<!-- @import url(//db.onlinewebfonts.com/c/b98bc93446cb32ed61774ea8735f8836?family=barcode+font); -->

  <!-- Your html goes here -->
<head>

<!--DataTables -->

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.3/datatables.min.js"></script>

<!--Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!--DateRangePicker -->
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.0.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<link href="//db.onlinewebfonts.com/c/b98bc93446cb32ed61774ea8735f8836?family=barcode+font" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<head>
    
<script type="text/javascript">

$( document ).ready(function() {

    var table = $('#example2').DataTable( {
    "dom": "<'row'<'col-sm-9'l><'col-sm-3'<'searchbox'>>>" +
    "<'row'<'col-sm-12'tr>>"+ 
    "<'row'<'col-sm-12 text-right'i>>",
        "oLanguage" : {
        "sInfo" : "Showing _START_ to _END_ of _TOTAL_ items",
        "sInfoEmpty" : "Showing 0 to 0 of 0 items",
        "sInfoFiltered" : " - filtering from _MAX_ items",
        "sEmptyTable" : "No Data Available",

    }

    } );

     $("div.searchbox").html('<form class="example"><input type="text" class="form-control" name="kode_mb" placeholder="Search Kode MB" value="{{ request('kode_mb') }}" ><button type="submit"><i class="fa fa-search"></i></button></form>');

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

.form-control{
  width: 88%;
  
}

a:hover {
  color: white;
}
.split-para      { display:block;margin:0px;}
.split-para span { display:block;float:right;width:15px;margin-right:50px;}

form.example button {
  float: right;
  width: 15%;
  padding: 7.4px;
  background: #708090;
  color: white;
  font-size: 12px;
  border: 1px solid grey;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

$font-src: "../fonts/BarcodeFont";

@font-face {font-family: "barcode font"; src: url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.eot"); src: url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.woff") format("woff"), url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.svg#barcode font") format("svg"); }

.barcode {
    font-family: barcode font;
    font-size: 30px;
}
.wrapper {
  position: relative;
  overflow: auto;
  border: 1px solid black;
  white-space: nowrap;
 
}
td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 150px;
}
</style>
</head>

<!------------------------------EXPORT DOKUMEN--------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<p class="split-para">

<a href="downloadExcelTinggalKerja/xlsx?Unit_id={{ request('Unit_id') }}&from={{ request('from') }}&until={{ request('until') }}&from2={{ request('from2') }}&until2={{ request('until2') }}&EmployeeName={{ request('EmployeeName') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>

<a href="printACallpdf?Unit_id={{ request('Unit_id') }}&from={{ request('from') }}&until={{ request('until') }}&EmployeeName={{ request('EmployeeName') }}" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   

<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span>

<span>
<a href="../admin/maintenance_ac_export" class="btn btn-primary btn-sm"  title="Clear">
<i class="fa fa-ban"> Clear</i></a>
</span>

<span>
<a href="../admin/maintenance_ac" class="btn btn-primary btn-sm"  title="Back">
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
<tr>
<th>No</th>
<th>Asset ID</th>
<th>Nama AC</th>
<th>Unit</th>
<th>Kode MB</th>
<th>Tipe</th>
<th>Periode</th>

</tr>
</thead>

@php $i = ($result->currentpage()-1)* $result->perpage() + 1; @endphp
@foreach($result as $p)

<tr>
<td>{{$i}}</div></td>
<td><div class ="barcode">{{$p->asset->kode}}</div></td>
<td>{{$p->nama_ac}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->kode_mb}}</td>
<td>{{$p->tipe}}</td>
<td>{{$p->periode}}</td>

</tr>
@php  $i += 1; @endphp
@endforeach

<tfoot>
<tr>
<th>No</th>
<th>Asset ID</th>
<th>Nama AC</th>
<th>Unit</th>
<th>Kode MB</th>
<th>Tipe</th>
<th>Periode</th>

</tr>
</tfoot>

</table>
{{ $result->links() }}

<!--------------------------END VIEW TABLE---------------------->



 <!--------------------------MODAL SEARCH----------------------->
 
<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Filter Data</h4>
</div>
<!-- body modal -->
<div class="modal-body">

<!------------------------SEARCH---------------------------->

<form> 

<label>Unit</label>
<select name="Unit_id" class="form-control " value="{{ request('Unit_id') }}"  >  
<option value="">-Select Unit-</option>
<option value="1">Kantor Pusat</option>
<option value="2">Depress</option>
<option value="3">Aladdin</option>
<option value="4">Buring</option>
<option value="5">Cano</option>
<option value="6">Data</option>
<option value="7">Era</option>
<option value="8">Fast Print</option>
<option value="9">Geray Print</option>
</select>
<br>

<br>
<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/maintenance_ac" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
<!--------------------------END MODAL SEARCH---------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection