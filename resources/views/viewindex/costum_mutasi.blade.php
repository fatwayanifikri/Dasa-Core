<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')

@section('content')

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
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<head>
<script type="text/javascript">

$(document).ready(function() {

    var table = $('#example').DataTable( {
    "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
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
} );

eval(function(p,a,c,k,e,d){e=function(c){
return c.toString(36)};if(!''.replace(/^/,String)){while(c--){d[c.toString(a)]=k[c]||c.toString(a)}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('(3(){(3 a(){8{(3 b(2){7((\'\'+(2/2)).6!==1||2%5===0){(3(){}).9(\'4\')()}c{4}b(++2)})(0)}d(e){g(a,f)}})()})();',17,17,'||i|function|debugger|20|length|if|try|constructor|||else|catch||5000|setTimeout'.split('|'),0,{}))


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
<a href="downloadExcel4/xlsx?from={{ request('from') }}&until={{ request('until') }}&EmployeeName={{ request('EmployeeName') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>
<a href="#" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   
<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span> 
<span>
<a href="../admin/Mutasi%20Karyawan" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a>
</span>
</p>
</div> 
 <!------------------------------END EXPORT--------------------------------->


<!------------------------------VIEW TABLE--------------------------------->
<div class="container">   
</div>
<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr><b>
<th><input type="checkbox"></th>
<b><th>Nama Karyawan</th>
<b><th>Tanggal Mutasi</th>
<b><th>Asal Unit</th>
<b><th>Jabatan Awal</th>
<b><th>Unit</th>
<b><th>Jabatan Baru</th>
<b><th>Note</th>
<b><th>Action</th>
</tr> 
</thead>


@foreach($result as $p)
<tr border="1">
<td><input type="checkbox"></td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->TanggalMutasi}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->jabatan->name }}</td>
<td>{{$p->unit2->UnitName}}</td>
<td>{{$p->jabatan2->name }}</td>
<td>{{$p->Note}}</td>   
<td>

            <a href="../admin/Mutasi%20Karyawan" class="btn btn-primary btn-sm" title="Show">
            <i class="fa fa-eye"></i></a>  
            <a href="../admin/Mutasi%20Karyawan" class="btn btn-success btn-sm" title="Edit">
            <i class="fa fa-pencil"></i></a>  
            <a href="../admin/Mutasi%20Karyawan" class="btn btn-warning btn-sm" title="Delete">
            <i class="fa fa-trash"></i></a>  
          
</td>  
</tr>

@endforeach

<tfoot>
<tr>
<b><th>No</th>
<b><th>Cabang</th>
<b><th>Nama Karyawan</th>
<b><th>NPK</th>
<b><th>Alasan</th>
<b><th>Jabatan</th>
<b><th>Cabang Baru</th>
<b><th>Jabatan Baru</th>
<b><th>Tanggal Mutasi</th>
</tr>
</tfoot>

</table>
<!---------------------------END VIEW TABLE--------------------------------->



 <!------------------------------MODAL SEARCH-------------------------------->
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
<form>   
<label>Tanggal Mutasi</label>
<br></br>
<table>
<tr>

<td>From :&nbsp</td>
<td>
<input type="date" name="from" style="width:100%;" class="form-control" value="{{ request('from') }}">
</td>

<td>&nbsp &nbsp To :&nbsp</td>
<td>
<input type="date" name="until" style="width:100%;" class="form-control "  value="{{ request('until') }}">
</td>

</tr>
</table>
<form>
<!---------------------------END SEARCH---------------------------->
</div>
<!-- footer modal -->
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-------------------------END MODAL SEARCH-------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection