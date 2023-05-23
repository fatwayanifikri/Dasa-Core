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

$( document ).ready(function() {

var table = $('#example2').DataTable( {
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
        "sEmptyTable" : "No Rules available",

    }

    } );

// $("div.searchbox").html('<form class="example"><select style="cursor:pointer;margin-top:1 em;margin-left:-20em; height:32px;" width="col-sm-5" class="form-control" id="tag_select" name="bulan"><option value="0" selected disabled> Pilih Bulan</option><option value="01"> Januari</option><option value="02"> Februari</option><option value="03"> Maret</option><option value="04"> April</option><option value="05"> Mei</option><option value="06"> Juni</option><option value="07"> Juli</option><option value="08"> Agustus</option><option value="09"> September</option><option value="10"> Oktober</option><option value="11"> November</option><option value="12"> Desember</option></select><button type="submit" style="height:31px;padding:-3px;"><i class="fa fa-search"></i></button></form>');
//   document.getElementsByClassName("searchbox")[0].style.textAlign = "right";

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
<a href="downloadExcelAsset/xlsx?Unit_id={{ request('Unit_id') }}&from={{ request('from') }}&until={{ request('until') }}&until={{ request('until') }}&from2={{ request('from2') }}&until2={{ request('until2') }}" class="btn btn-success"  title="Print Excel">
<i class="fa fa-file-excel-o"> xlsx</i></a>

<a href="PrintAsset?Unit_id={{ request('Unit_id') }}&from={{ request('from') }}&until={{ request('until') }}&from2={{ request('from2') }}&until2={{ request('until2') }}" class="btn btn-danger"  title="Print Pdf">
<i class="fa fa-file-pdf-o"> PDF</i></a>   

<span>
<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal2" title="Filter">
<i class="fa fa-filter"> Filter</i></button>
</span> 

<span>
<a href="../admin/AssetLogistik" class="btn btn-primary btn-sm"  title="Back">
<i class="fa fa-backward"> Back</i></a>
</span>

</p>
</div> 

 <!------------------------------END EXPORT--------------------------------->


<!--------------------------------VIEW TABLE-------------------------------->
<div class="container">   
</div>
<div class="panel-body">
<div class="table-responsive" style="overflow-x: auto"> 
<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr>
<th class="evencolor"><input type="checkbox"></th>
<th>Kode Asset</th>
<th >Nama Asset</th>
<th>Kategori</th>
<th>Unit</th>
<!-- <th>Kondisi</th> -->
<th>Tgl Pemakaian</th>
<th>Tgl Pembelian</th>
<!-- <th>Keterangan</th> -->
</tr>
</thead>

<?php $no = 0;?>
@foreach($result as $p)
<?php $no++ ;?>

<tr>
<td class="evencolor"><input type="checkbox"></td>
<td>{{$p->aset->kode}}</td>
<td>{{$p->aset->nama}}</td>
<td>{{$p->aset->kategori->kategori_name}}</td>
<td>{{$p->aset->unit->UnitName}}</td>
<!-- <td>{{$p->kondisi}}</td> -->
<td>{{$p->tgl_pemakaian}}</td>
<td>{{$p->tgl_pembelian}}</td>
<!-- <td>{{$p->keterangan}}</td> -->
</tr>

@endforeach

<tfoot>
<tr>
<td class="evencolor"><input type="checkbox"></td>
<th>Kode Asset</th>
<th>Nama Asset</th>
<th>Kategori</th>
<th>Unit</th>
<!-- <th>Kondisi</th> -->
<th>Tgl Pemakaian</th>
<th>Tgl Pembelian</th>
<!-- <th>Keterangan</th> -->
</tr>
</tfoot>

</table>
{{ $result->links() }}
<!-----------------------------------END VIEW TABLE------------------------------->



 <!-------------------------------MODAL SEARCH------------------------------------->
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
<!-------SEARCH TANGGAL PEMAKAIAN------>
<label>Tanggal Pemakaian</label><br></br>
<table>
<tr>
<td>From:</td>
<td><input type="date" name="from" class="form-control " value="{{ request('from') }}"></td>
<td>To:</td>
<td><input type="date" name="until" class="form-control "  value="{{ request('until') }}"></td>
</tr>
</table>
<br>

<!-------SEARCH TANGGAL PEMBELIAN------>
<label>Tanggal Pembelian</label><br></br>
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
@foreach($unit as $u)
@if($u->Unit_id == 1 )
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

<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/AssetLogistikCustom" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
<!-----------------------------END MODAL SEARCH-------------------------->
</div>                     
<div class="panel-heading">
</div> 
</div>                     

@endsection