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

.form-control{
  width: 88%;
}

.link {
    text-decoration: none; 
    color: white; 

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

<a href="downloadExcel5/xlsx?UnitName={{ request('UnitName') }}&from={{ request('from') }}&until={{ request('until') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>

<a href="#" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   

<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span> 

<span>
<a href="../admin/p102_newcomer" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a>
</span>

</p>
</div> 

<!------------------------------END EXPORT--------------------------------->

<!------------------------------END SEARCH--------------------------------->


<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>      
<tr>
<th><input type="checkbox"></th>
<th>NPK</th>
<th>Nama Karyawan</th>
<th>Unit</th>
<th>Perusahaan</th>
<th>Departement</th>
<th>Jabatan</th>
<th>Tanggal Masuk</th>
</tr>
</thead>
        
@foreach($result ->sortByDesc('HiredDate' ) as $p)
<tr>
<td><input type="checkbox"></td>
<td>{{$p->NPK}}</td>
<td>{{$p->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td> 
<td>{{$p->company->CompanyName}}</td>
<td>{{$p->department->DepartementName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->HiredDate}}</td>
</tr>
@endforeach

<tfoot>
<tr>
<th><input type="checkbox"></th>
<th>NPK</th>
<th>Nama Karyawan</th>
<th>Unit</th>
<th>Perusahaan</th>
<th>Departement</th>
<th>Jabatan</th>
<th>Tanggal Masuk</th>
</tr>
</tfoot>
</table>
{{ $result->links() }}
<!-------------------------------MODAL SEARCH------------------------------>
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
<form method="GET">
<label>Tanggal Masuk</label>
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

<!------------------------SEARCH UNIT---------------------------->
<label>Unit:</label>
<select name="UnitName" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('UnitName') }}"  >  
<option value="">-Select Unit-</option>
<option value="Aladdin">Aladdin</option>
<option value="Buring">Buring</option>
<option value="ERA">ERA</option>
<option value="Cano">Cano</option>
<option value="Kantor Pusat">Kantor Pusat</option>
<option value="Depress">Depress</option>
<option value="Fast Print">Fast Print</option>
</select>
<br>

<input type="submit"class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/p102_newcomer"> <button type="reset" class="btn btn-danger" title="Reset">Reset
</a>
</button>
</center>
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
<!-------------------------END MODAL SEARCH------------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection