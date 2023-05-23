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
 "fnRowCallback": function(nRow, aData, iDisplayIndex, iDisplayIndexFull) {
      if (aData[7] == "Blm Disetujui") {
        $('td', nRow).css('background-color', '#FFA07A');
      } else if (aData[7] == "Disetujui") {
        $('td', nRow).css('background-color', '#90EE90');
      }
    },

    "dom": "<'row'<'col-sm-9'l><'col-sm-3'<'searchbox'>>>" +
    "<'row'<'col-sm-12'tr>>"+ 
    "<'row'<'col-sm-12 text-right'i>>",
        scrollY:        "1000px",
        scrollX:        "true",
        scrollCollapse: true,
        paging:         true,
        info:         true,
        fixedColumns:   {
            left: 1,
            right: 1
        },

        "oLanguage" : {
        "sInfo" : "Showing _START_ to _END_ of _TOTAL_ items",
        "sInfoEmpty" : "Showing 0 to 0 of 0 items",
        "sInfoFiltered" : " - filtering from _MAX_ items",
        "sEmptyTable" : "No Data Available",

    }

    } );

     $("div.searchbox").html('<form class="example"><input type="text" class="form-control" name="EmployeeName" placeholder="Search Employee Name" value="{{ request('EmployeeName') }}" ><button type="submit"><i class="fa fa-search"></i></button></form>');

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

<a href="print_tinggalkerjaALL?Unit_id={{ request('Unit_id') }}&from={{ request('from') }}&until={{ request('until') }}&from2={{ request('from2') }}&until2={{ request('until2') }}&EmployeeName={{ request('EmployeeName') }}" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   

<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span>

<span>
<a href="../admin/monitoring_tinggal_kerja" class="btn btn-primary btn-sm"  title="Back">
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
<th>Karyawan</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Pengajuan</th>
<th>Tanggal Izin</th>
<th>Keperluan</th>
<th>Status</th>
<th>Action</th>
<!-- <th>Keterangan</th>  -->
</tr>
</thead>

@php $i = ($result->currentpage()-1)* $result->perpage() + 1; @endphp
@foreach($result as $p)

<tr>
<td>{{$i}}</td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->tgl_pengajuan ? \Carbon\Carbon::parse($p->tgl_pengajuan)->format('d/m/Y') : null}}</td><!-- SUPAYA KLO NULL GK TAMPIL -->

<!-- TANGGAL IZIN  -->
@if(\Carbon\Carbon::parse($p->EndDate)->format('d/m/Y') == \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y'))
<td>{{$p->StartDate ? \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y') : null}}</td>

@elseif(\Carbon\Carbon::parse($p->EndDate)->format('d/m/Y') != \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y'))
<td>{{$p->StartDate ? \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y') : null}} - 
{{$p->EndDate ? \Carbon\Carbon::parse($p->EndDate)->format('d/m/Y') : null}}</td>

@else
<td>{{$p->tgl_pengajuan? \Carbon\Carbon::parse($p->tgl_pengajuan)->format('d/m/Y') : null}}</td>
@endif

<!-- END TANGGAL IZIN  -->

<td>{{$p->keperluan}}</td>
@if($p->isApproved =='2') 
<td>Disetujui</td>
@elseif($p->isApprove =='3') 
<td>Tidak Disetujui</td>
@else
<td>Blm Disetujui</td>
@endif
<td>

<a href="{{ url('admin/print_meninggalkan_kerjaan/'.$p->id) }}" title="Print" class="btn btn-primary btn-sm"><i class="fa fa-print"></i></a>  
&nbsp
<a href="{{ url('admin/monitoring_tinggal_kerja/edit/'.$p->id) }}" title="Edit" class="btn btn-success btn-sm"><i class="fa fa-pencil"></i></a>  
&nbsp
<a href="{{ url('admin/delete_form2/'.$p->id) }}" title="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>  
          
</td>
</tr>
@php  $i += 1; @endphp
@endforeach

<tfoot>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Pengajuan</th>
<th>Tanggal Izin</th>
<th>Keperluan</th>
<th>Status</th>
<th>Action</th>
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

<!-------SEARCH TANGGAL TIDAK ABSEN------>
<label>Tanggal Pengajuan:</label><br></br>
<table>
<tr>
<td>From:&nbsp</td>
<td><input type="date" name="from" class="form-control " value="{{ request('from') }}"></td>
<td>To:&nbsp</td>
<td><input type="date" name="until" class="form-control "  value="{{ request('until') }}"></td>
</tr>
</table>
<br>

<label>Tanggal Izin:</label><br></br>
<table>
<tr>
<td>From:&nbsp</td>
<td><input type="date" name="from2" class="form-control " value="{{ request('from2') }}"></td>
<td>To:&nbsp</td>
<td><input type="date" name="until2" class="form-control "  value="{{ request('until2') }}"></td>
</tr>
</table>
<br>

<!----------SEARCH UNIT (HRD ONLY)------------------>

@foreach($jabatan as $j)
@if($j->id == 1 or $j->id == 62 or $j->id == 63 or $j->id == 64 or $j->id == 65 or $j->id == 66)
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
@endif
@endforeach

<br>
<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/monitoring_tidak_absen" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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