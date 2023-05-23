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

<!--Select2-->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<head>


<script type="text/javascript">

$(document).ready(function() {

// untuk table modal
 var $dTable = $('#example').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

 
//datamodal select customer
$(document).on('click','#select',function(){
 var RequestID = $(this).data('reqid');
 var NoPR = $(this).data('nomorpr');
 var TanggalRequest = $(this).data('tgl');
 var UnitID = $(this).data('unit');
 var StatusApproval = $(this).data('status');
 var Catatan = $(this).data('ctt');

 $('#RequestID').val(RequestID);
 $('#NoPR').val(NoPR);
 $('#TanggalRequest').val(TanggalRequest);
 $('#UnitID').val(UnitID);
 $('#StatusApproval').val(StatusApproval);
 $('#Catatan').val(Catatan);

 $('#myModal').modal('hide');
document.getElementById("inputrequest").submit();

});


} );
</script>

<br>
<!------------------------------CHILD TABLE--------------------------------->

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Purchase Request</div>
<div class="panel-body">
<form action="{{route('input_copyrequest')}}" method="POST" id="inputrequest">
{{ csrf_field() }}

<!-- input ke tbl copypurchaserequest untuk trigger input ke tbl detail -->
<input type="hidden" name="request_id" id="RequestID" />
<input type="hidden" name="NoPR" id="NoPR" />
<input type="hidden" name="Tanggal" id="TanggalRequest" />
<input type="hidden" name="Unit_id" id="UnitID" />
<input type="hidden" name="IsStatus" id="StatusApproval"/>
<input type="hidden" name="Catatan" id="Catatan"/>
</form>
<!--  -->


<table class="table table-sm table-bordered" id="table-kas">
<thead>
<tr>
<th>No PR</th>
<th>Tanggal</th>
<th>Unit</th>
<th>Status</th>
<th>Catatan</th>
<th>Action</th>
</tr>
</thead>

<tbody id="body-kas">
@foreach($child as $data)
<tbody id="body-kas">
<td>{{$data->NoPR}}</td>
<td>{{$data->Tanggal}}</td>
<td>{{$data->unit->UnitName}}</td>
<td>{{$data->IsStatus}}</td>
<td>{{$data->Catatan}}</td>
<td>

<a href="{{ url('admin/delete_copyrequest/'.$data->id) }}" title="Delete">
<i class="fa fa-trash" style="color:red;"></i></a>  
          
</td>
</tbody>
@endforeach
</table>


<button class="btn btn-success" type="button" data-toggle="modal" data-target="#myModal" id="add-transaksi">
<span class="fa fa-plus-circle"> Add PR</span>
</button>
</div>      
</div>
</div>
</div>



<!------------------------------CHILD DETAIL--------------------------------->

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Purchase Request Detail</div>
<div class="panel-body">

<table class="table table-sm table-bordered" id="table-kas">
<thead>
<tr>
<th>No PR</th>
<th>Kode Barang</th>
<th>Nama Barang</th>
<th>Jumlah Pesan</th>
<th>Action</th>
</tr>
</thead>

@foreach($detail as $d)
<tbody id="body-kas">
<td>{{$d->purchasereq->NoPR}}</td>
<td>{{$d->kodebarang}}</td>
<td>{{$d->namabarang}}</td>
<td>{{$d->jumlahpermintaan}}</td>
<td>

<a href="{{ url('admin/delete_podetail/'.$d->id) }}" title="Delete">
<i class="fa fa-trash" style="color:red;"></i></a>  
          
</td>
</tbody>
@endforeach
</table>

</div>      
</div>
</div>
</div>



<!------------------------------MAIN PO--------------------------------->
<div style="float:left; width: 100%">
<div class="row">
<div class="col-md-5">
<div class="panel panel-default">
<div class="panel-heading">Purchase Order</div>
<div class="panel-body">

<form action="{{route('input_data_po')}}" method="POST">
{{ csrf_field() }}

<table style="width:100%">
<tr>
<td>Nomor PO</td>
<td>:</td>
<td><input type="text" class="form-control" name="NoPO" id="NoPO"/></td>
</tr>

<tr><td>&nbsp</td></tr>

<tr>
<td>Tanggal</td>
<td>:</td>
<td><input type="date" class="form-control" name="tanggal" id="tanggal"/></td>
</tr>

<tr><td>&nbsp</td></tr>

<tr>
<td>Vendor</td>
<td>:</td>
<td>
<select name="vendor_ID" class="form-control " placeholder="Select Vendor ..">  
<option value="">-Select Vendor-</option>
@foreach($vendor as $v)
<option value="{{$v->id}}">{{$v->Nama}}</option>
@endforeach
</select>
</td>
</tr>

</table>
<br>
<div class="text-right">
<button class="btn btn-success" type="submit"><i class="fa fa-floppy-o"></i> Simpan</button>
<a href="../admin/logt301_purchaseorder" class="btn btn-danger"><i class="fa fa-arrow-left"></i> Cancel</a>
</form>

</div>
</div>
</div>
</div>
</div>
</div>
<br>


<!------------------------------MODAL DETAIL PR---------------------------------->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">List Data PR</h4>
</div>
<!-- body modal -->
<div class="modal-body">
 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr>
<th>No PR</th>
<th>Tanggal</th>
<th>Unit</th>
<th>Status</th>
<th>Catatan</th>
<th>Action</th>
</tr>
</thead>

@foreach($modals as $c => $data)

<tr>
<td>{{$data->NoPR}}</td>
<td>{{$data->Tanggal}}</td>
<td>{{$data->unit->UnitName}}</td>
<td>{{$data->IsStatus}}</td>
<td>{{$data->Catatan}}</td>
<td>
<button class="btn btn-xs btn-info" id="select" title="Select"
data-reqid="<?=$data->id?>"
data-nomorpr="<?=$data->NoPR?>"
data-tgl="<?=$data->Tanggal?>"
data-unit="<?=$data->UnitID?>"
data-status="<?=$data->IsStatus?>"
data-ctt="<?=$data->Catatan?>"
>
<i class="fa fa-check"> Select</i></button>
</td>
</tr>

@endforeach

<tfoot>
<tr>
<th>No PR</th>
<th>Tanggal</th>
<th>Unit</th>
<th>Status</th>
<th>Catatan</th>
<th>Action</th>
</tr> 
</tfoot>

</table>

</div>
<!-- footer modal -->
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!------------------------------END MODAL CUSTOMER------------------->


@endsection