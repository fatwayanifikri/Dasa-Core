<!-- VIEW EXPORT LEMBUR UNTUK ADMIN UNIT -->

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

/* Style the search field */
form.example input[type=text] {
  padding: 9px;
  font-size: 12px;
  border: 1px solid grey;
  width: 60%;
  background: white;
}
/* Style the submit button */
form.example button {
  float: right;
  width: 15%;
  padding: 7.8px;
  background: #708090;
  color: white;
  font-size: 12px;
  border: 1px solid grey;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
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
<body>
<!------------------------------EXPORT DOKUMEN--------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
<p class="split-para">

<a href="downloadExcelLembur/xlsx?from={{ request('from') }}&until={{ request('until') }}&Unit_id={{ request('Unit_id') }}&isVoucher={{ request('isVoucher') }}&EmployeeName={{ request('EmployeeName') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>

<a href="printlemburpdf?from={{ request('from') }}&until={{ request('until') }}&Unit_id={{ request('Unit_id') }}&isVoucher={{ request('isVoucher') }}&EmployeeName={{ request('EmployeeName') }}" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   
<span>

<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span> 

@foreach($jabatan as $j)
@if($j->id == 1 or $j->id == 62 or $j->id == 63 or $j->id == 64 or $j->id == 65 or $j->id == 66) 
<span>
<a href="../admin/management_lembur" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a> <!-- FOR HC & SUPERADMIN -->
</span>
@else
<span>
<a href="../admin/management_lembur" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a> <!-- FOR ADMIN -->
</span>
@endif
@endforeach
</p>
</div>
 <!------------------------------END EXPORT--------------------------------->


<!-------------------------------VIEW TABLE--------------------------------->
<div class="container">   
</div>
<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%" >
 
<thead>      
<tr>
<th><input type="checkbox"></th>
<th>Karyawan</th>
<th>Unit</th>
<th>Jabatan</th>
<th>Shift</th>
<th>Tgl Lembur</th>
<th>Jam Lembur</th>
<th>Menit Lemburan</th>
<th>Approve Lembur</th>
<th>Status Voucher</th>
<th>Nomor Voucher</th>            
</tr>
</thead>
        
        @foreach($result as $p)
        <tr>
            <td><input type="checkbox"></td>
            <td>{{$p->employee->EmployeeName}}</td>
            <td>{{$p->unit->UnitName}}</td>
            <td>{{$p->jabatan->name}}</td>
            <td>{{$p->shift}}</td>
            <td>{{ \Carbon\Carbon::parse($p->StartTime)->format('d/m/Y')}}</td> 
            <td>{{ \Carbon\Carbon::parse($p->StartTime)->format('H:i:s')}}-
              {{ \Carbon\Carbon::parse($p->EndTime)->format('H:i:s')}}</td>
            <td>{{$p->AmountMinute}}</td>
            <td>{{ ($p->isApproved == 1) ? 'Setuju' : 'Blm Di Setujui'}}</td>
            @if($p->isVoucher =='1') 
            <td>Dibuat</td>
            @elseif($p->isVoucher =='2') 
            <td>Diajukan</td>
            @elseif($p->isVoucher =='3') 
            <td>Dicairkan</td>
            @elseif($p->isVoucher =='4') 
            <td>Diterima</td>
            @elseif($p->AmountMinute <= 239) 
            <td>Non Voucher</td>
            @else
            <td>Blm Dibuat</td>
            @endif
            <td>{{$p->NomerVoucher}}</td>
        </tr>
        @endforeach

<tfoot>
<tr>
<th><input type="checkbox"></th>
<th>Karyawan</th>
<th>Unit</th>
<th>Jabatan</th>
<th>Shift</th>
<th>Tgl Lembur</th>
<th>Jam Lembur</th>
<th>Menit Lemburan</th>
<th>Approve Lembur</th>
<th>Status Voucher</th>
<th>Nomor Voucher</th>            
</tr>
</tfoot>

</table> 
<!------------------------------------END VIEW TABLE--------------------------------->

{{ $result->links() }}
 <!------------------------------------MODAL SEARCH------------------------------>
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
 <!------------------------SEARCH FILTER---------------------------->
<form>  
<label>Tanggal Lembur</label><br>
<table><tr>
<td>From :&nbsp</td><td>
<input type="date" name="from" style="width:100%;" class="form-control" value="{{ request('from') }}">
</td>
<td>&nbsp &nbsp To :&nbsp</td><td>
<input type="date" name="until" style="width:100%;" class="form-control "  value="{{ request('until') }}">
</td>
</tr></table>
<br>
<!------------------------HRD ONLY------------------------------>
@foreach($jabatan as $j)
@if($j->id == 1 or $j->id == 62 or $j->id == 63 or $j->id == 64 or $j->id == 65 or $j->id == 66)
<label>Unit:</label>
<select name="Unit_id" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('Unit_id') }}"  >  
<option value="">-Select Unit-</option>
@foreach($value as $p)
<option value="{{$p->id}}">{{$p->UnitName}}</option>
@endforeach
</select>
<br>
<label>Employee Name</label>
<input type="text" name="EmployeeName" class="form-control" value="{{ request('EmployeeName') }}">
<br>

<!------------------------ADMIN ONLY------------------------------>
@else
<label>Status Voucher</label>
<select name="isVoucher" class="form-control " value="{{ request('isVoucher') }}"  >  
<option value="">-Status Voucher-</option>
<option value="0">Blm Dibuat</option>
<option value="1">Dibuat</option>
<option value="2">Diajukan</option>
<option value="3">Dicairkan</option>
<option value="4">Diterima</option>
</select>
<br>
@endif
@endforeach

<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/export_lembur" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
<!-------------------------------------END MODAL SEARCH---------------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>   

@endsection