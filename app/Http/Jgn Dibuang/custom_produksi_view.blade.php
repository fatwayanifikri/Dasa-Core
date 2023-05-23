<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')

@section('content')

  <!-- Your html goes here -->
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
$(document).ready(function() {

 var $dTable = $('#example').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

//datamodal select operator
$(document).on('click','#select',function(){
 var employee_id = $(this).data('employeeid');
 var employee_name = $(this).data('employeename');
 $('#operatorid').val(employee_id);
 $('#operator').val(employee_name);
 $('#myModal').modal('hide');
});

$(document).on('click','#select2',function(){
 var mesin_id = $(this).data('mesinid');
 var mesin_name = $(this).data('mesinname');
 $('#id_mesin').val(mesin_id);
 $('#mesin').val(mesin_name);
 $('#myModal2').modal('hide');
});

} );


</script>
  
<style>
 p { 
  margin:0;
}

.form-control{
  width: 100%;
  height: 30%;
  font-size: 12px;
}

.form-control2{
  height:29px;
  width: 100%;
  font-size: 14px;

}

.form-control3{
    height:29px;
    width: 100%;
    line-height:30px;
    padding:6px;
    font-size: 14px;
    }

.link {
    text-decoration: none; 
    color: white; 

}
a:hover {
  color: white;
}

.form-control{
  border-color: rgba(180, 180, 180);
 
}

.hidden{
   visibility:hidden;
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
  max-width: 200px;
}

.card-box {
    position: relative;
    color: #fff;
    padding: 20px 10px 40px;
    margin: 20px 0px;

}
.card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
}
.card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
}
.card-box .inner {
    padding: 5px 10px 0 10px;
}
.card-box h3 {
    font-size: 27px;
    font-weight: bold;
    margin: 0 0 8px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
}
.card-box p {
    font-size: 15px;
}
.card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 72px;
    color: rgba(0, 0, 0, 0.15);
}
.card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
}
.card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
    width: 100%;
     
}
.bg-green {
    background-color: #00a65a !important;

}
.bg-blue {
    background-color: #00c0ef !important;
    
}
.bg-orange {
    background-color: #f39c12 !important;
    
}
.bg-red {
    background-color: #d9534f !important; 
}
.bg-grey {
    background-color: #b8bccc !important; 
}

</style>
</head>

<!------------------------------DASHBOARD--------------------------------->

<!-- Menghitung Kapasitas SM 52-->
@foreach($kapasitasm52 as $p)
@foreach($mesin->where('id','=',7) as $m)
@php
$sm52_terpakai = $p->kapasitas_terpakai;
$kapasitas_sm52  = $m->kapasitas_produksi;
$sisa_sm52 = $kapasitas_sm52 - $sm52_terpakai ;

@endphp 
@endforeach
@endforeach


<!--------------------------------------->

<!-- Menghitung Kapasitas SM 74-->
@foreach($kapasitasm74 as $h)
@foreach($mesin->where('id','=',6) as $i)
@php
$sm74_terpakai = $h->kapasitas_terpakai;
$kapasitas_sm74  = $i->kapasitas_produksi;
$sisa_sm74 = $kapasitas_sm74 - $sm74_terpakai ;
@endphp 
@endforeach
@endforeach
<!--------------------------------------->

<table style= "border-collapse: collapse; width: 100%" >
<tr>

<td>&nbsp</td>

<td>
<div class="card-box bg-red">
<div class="inner">
@forelse($produksi as $k)
<h3>{{number_format($k->where('mesin_id', '=', 7)->where('tgl_produksi', '=', date('Y-m-d') )->sum('qty_produksi'))}}</h3>
@break
@empty
<h3>0</h3>
@endforelse
<p>Antrian SM 52</p>
</div>
<div class="icon">
<i class="fa fa-gears" aria-hidden="true"></i>
</div>
<a href="EmployeeCustom" class="card-box-footer"></i></a>
</div>
</td>

<td>&nbsp</td>

<td>
<div class="card-box bg-orange">
<div class="inner">
@forelse($produksi as $v)
<h3>{{number_format($v->where('mesin_id', '=', 7)->where('status_produksi', '=', 2)->sum('qty_produksi'))}}</h3>
@break
@empty
<h3>0</h3>
@endforelse
<p>Proses SM 52</p>
</div>
<div class="icon">
<i class="fa fa-spinner" aria-hidden="true"></i>
</div>
<a href="employeerequest" class="card-box-footer"></i></a>
</div>
</td>

<td>&nbsp</td>

<td>
<div class="card-box bg-green">
<div class="inner">
@forelse($produksi as $v)
<h3>{{number_format($v->where('mesin_id', '=', 7)->where('status_produksi', '=', 3)->sum('qty_produksi'))}}</h3>
@break
@empty
<h3>0</h3>
@endforelse
<p>Selesai SM 52</p>
</div>
<div class="icon">
<i class="fa fa-check" aria-hidden="true"></i>
</div>
<a href="employeerequest" class="card-box-footer"></i></a>
</div>
</td>

<td>&nbsp</td>

<td>
<div class="card-box bg-blue">
<div class="inner">
@forelse($produksi as $k)
<h3>{{number_format($k->where('mesin_id', '=', 6)->where('tgl_produksi', '=', date('Y-m-d') )->sum('qty_produksi'))}}</h3>
@break
@empty
<h3>0</h3>
@endforelse
<p>Antrian SM 74</p>
</div>
<div class="icon">
<i class="fa fa-gears" aria-hidden="true"></i>
</div>
<a href="EmployeeCustom" class="card-box-footer"></i></a>
</div>
</td>

<td>&nbsp</td>

<td>
<div class="card-box bg-orange">
<div class="inner">
@forelse($produksi as $v)
<h3>{{number_format($v->where('mesin_id', '=', 6)->where('status_produksi', '=', 2)->sum('qty_produksi'))}}</h3>
@break
@empty
<h3>0</h3>
@endforelse
<p>Proses SM 74</p>
</div>
<div class="icon">
<i class="fa fa-spinner" aria-hidden="true"></i>
</div>
<a href="employeerequest" class="card-box-footer"></i></a>
</div>
</td>

<td>&nbsp</td>

<td>
<div class="card-box bg-green">
<div class="inner">
@forelse($produksi as $v)
<h3>{{number_format($v->where('mesin_id', '=', 6)->where('status_produksi', '=', 3)->sum('qty_produksi'))}}</h3>
@break
@empty
<h3>0</h3>
@endforelse
<p>Selesai SM 74</p>
</div>
<div class="icon">
<i class="fa fa-check" aria-hidden="true"></i>
</div>
<a href="employeerequest" class="card-box-footer"></i></a>
</div>
</td>

<!-- <td>&nbsp</td>

<td>
<div class="card-box bg-blue">
<div class="inner">
@foreach($mesin->where('id','=',7) as $m)
@forelse($kapasitasm52 as $p)
@empty
<h3>{{$m->kapasitas_produksi}}</h3>
@endforelse
@endforeach
<h3>{{$sisa_sm52}}</h3>
<p>Kapasitas SM 52</p>
</div>

<div class="icon">
<i class="fa fa-cog" aria-hidden="true"></i>
</div>
<a href="export_lembur" class="card-box-footer"></a>
</div>
</td>

<td>&nbsp</td>

<td>
<div class="card-box bg-blue">
<div class="inner">
@foreach($mesin->where('id','=',6) as $m)
@forelse($kapasitasm74 as $p)
@empty
<h3>{{$m->kapasitas_produksi}}</h3>
@endforelse
@endforeach
<h3>{{$sisa_sm74}}</h3>
<p>Kapasitas SM 74</p>
</div>
<div class="icon">
<i class="fa fa-gears" aria-hidden="true"></i>
</div>
<a href="export_lembur" class="card-box-footer"></a>
</div>
</td> -->


</tr>
</table>
<!------------------------------END ADMIN--------------------------------->

<!------------------------------MAIN TABLE-------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Table Data Penggunaan Mesin</div>
<div class="panel-body">

<form>
<div style="float:left; width: 50%">
<table>
<tr>

<td>Mesin</td>
<td>&nbsp:&nbsp</td>
<td><select name="mesin_id" class="form-control3" placeholder="Cari Mesin .." value="{{ request('mesin_id') }}"  >  
<option value="">Select Mesin</option>
@foreach($mesin as $m)
<option value="{{$m->id}}">{{$m->nama_mesin}}</option>
@endforeach
</select>
</td>
</tr>

<tr>
<td>Tanggal</td>
<td>&nbsp:&nbsp</td>
<td><input type = "date" name="tgl_produksi" class="form-control2" value="{{ request('tgl_produksi') }}"  ></td>
<td><button type="submit" title="Search"><i class="fa fa-search"></i></button></td>

<td><button type="button" title="Clear" onclick="location.href='../admin/produksi_view'"><i class="fa fa-backward"></i></button></td>
</tr>

</table>
</div>
</form>
<div style="float:right; width: 50%">
<table style= "border-collapse: collapse; width: 100%;text-align:right;" >
<tr>
<td>
<td>
<!-- <button type="submit" class="btn btn-primary" title="Search" data-toggle="modal" data-target="#myModal">
<i class="fa fa-search"></i> Search</button> -->
<a href="../admin/produksi_input" class="btn btn-success"  title="Add">
<i class="fa fa-plus"> Add Data</i></a> </td>
</tr>
</table>
</div>
<br></br>
<br></br>

<div class="table-responsive" style="overflow-x: auto">
<table id="" class="table pop_modal table-striped table-bordered table-hover" style="width:100%" border="1">
<thead>
<tr>
<th>No</th>
<th>Kode Produksi</th>
<th>No SPK</th>
<th>Mesin</th>
<th>Customer</th>
<th>QTY</th>
<th>Tanggal Produksi</th>
<!-- <th>Sisa Kapasitas</th> -->
<th>Unit</th>
<th>Status</th>
<th>Update Status</th>
</tr>

<?php $no = 0;?>
@foreach($produksi as $p)

<?php $no++ ;?>
<tr>
<td>{{$no}}</td>
<td>{{$p->produksi->kode_produksi}}</td>
<td>{{$p->produksi->no_spk}}</td>
<td>{{$p->mesin->nama_mesin}}</td>
<td>{{$p->produksi->nama_customer}}</td>
<td>{{number_format($p->qty_produksi)}}</td>
<td>{{$p->tgl_produksi}}</td>
<!-- <td>{{number_format($p->mesin->kapasitas_produksi - $p->kapasitas_terpakai)}}</td> -->
<td>{{$p->unit->UnitName}}</td>

@if($p->status_produksi =='1') 
<td>Persiapan</td>
@elseif($p->status_produksi =='2') 
<td>Proses</td>
@elseif($p->status_produksi =='3') 
<td>Selesai</td>
@else
<td>Cancel</td>
@endif

@if($p->status_produksi =='1') 
<td>
<a href="{{ url('admin/update_status_to_proses/'.$p->id) }}" class="btn btn-warning btn-sm"  title="Add">Proses</a>
</td>
@elseif($p->status_produksi =='2') 
<td>
<a href="{{ url('admin/update_status_to_selesai/'.$p->id) }}" class="btn btn-success btn-sm"  title="Add">Selesai</a>
</td>
@else
<td>
</td>
@endif

</tr>      
@endforeach
</thead>
</table>
<br>
</br>

<!-- Menghitung QTY Total Untuk Dpress(tidak jadi dipakai) -->
@foreach($produksi->where('Unit_id', '=', 2)->where('tgl_produksi', '=', date('Y-m-d') ) as $p)
@php
$qtydpress += $p['qty_produksi'];
$zero  = 0;
$total_dpress = $qtydpress + $zero;
@endphp 
@endforeach
<!--------------------------------------->

<!----------Menghitung QTY Total--------->
<!-- @foreach($produksi as $p)
@php
$qtytotal += $p['qty_produksi'];
$nihil  = 0;
$grand_total = $qtytotal + $nihil;
@endphp 
@endforeach -->
<!--------------------------------------->

@foreach($produksi as $prod)
QTY Total : {{ number_format($prod->sum('qty_produksi')) }} <br/>
@break
@endforeach
Halaman : {{ $produksi->currentPage() }} <br/>
@foreach($produksi as $prod)
Jumlah Data : {{ number_format($prod->count()) }}  <br/>
@break
@endforeach
Data Per Halaman : {{ $produksi->perPage() }} <br/>
 
 
{{ $produksi->links() }}
</div>
</div>
<!------------------------------MODAL SEARCH---------------------------------->
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
 <!------------------------SEARCH KODE PRODUKSI----------------------->
<form>   
<label>Kode Produksi</label><br>
<input type="text" name="kode_produksi" style="width:100%;" class="form-control" value="{{ request('kode_produksi') }}">
<br>

<label>Nomor SPK</label><br>
<input type="text" name="no_spk" style="width:100%;" class="form-control" value="{{ request('no_spk') }}">
<br>

<label>Customer</label><br>
<input type="text" name="nama_customer" style="width:100%;" class="form-control" value="{{ request('nama_customer') }}">
<br>

<!------------------------SEARCH UNIT---------------------------->

<label>Select Unit</label>
<select name="lokasi_produksi" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('lokasi_produksi') }}"  >  
<option value="">-Select Unit-</option>
@foreach($unit as $p)
<option value="{{$p->id}}">{{$p->UnitName}}</option>
@endforeach
</select>
<br>

<input type="submit" class="btn btn-primary" value="Apply" title="Apply">
<a class = "link" href="../admin/produksi_view" ><button type="reset" class="btn btn-danger" title="Reset">Reset</a>
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
<!------------------------------END MODAL SEARCH------------------->
@endsection