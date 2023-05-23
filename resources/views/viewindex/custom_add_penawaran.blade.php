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

  var $dTable = $('#example2').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

// untuk hitung total harga barang
  setInterval(function(){
      var total_harga = 0;  
      var jumlah_barang = $('#jumlah_barang').val();
      var harga_barang = $('#harga_barang').val();
      var calculate = Math.abs(jumlah_barang * harga_barang);
      var hasil = Math.ceil(calculate);
      $('#total_harga').val(hasil);
      });


//datamodal select sales
$(document).on('click','#select',function(){
 var employee_id = $(this).data('employeeid');
 var employee_name = $(this).data('employeename');
 var unit_id = $(this).data('unitid');
 var unit_name = $(this).data('unitname');
 $('#SalesID').val(employee_id);
 $('#SalesName').val(employee_name);
 $('#Sales_Unit').val(unit_id);
 $('#UnitName').val(unit_name);
 $('#myModal').modal('hide');
});


//datamodal select customer
$(document).on('click','#select2',function(){
 var CompanyName = $(this).data('comname');
 var CompanyAddress = $(this).data('comad');
 var CompanyPhoneNumber = $(this).data('comphone');
 var CustomerName = $(this).data('custname');
 var CustomerAddress = $(this).data('custad');
 var CustomerPhoneNumber = $(this).data('custphone');
 var CustomerEmail = $(this).data('cusmail');
 $('#CompanyName').val(CompanyName);
 $('#CompanyAddress').val(CompanyAddress);
 $('#CompanyPhoneNumber').val(CompanyPhoneNumber);
 $('#CustomerName').val(CustomerName);
 $('#CustomerAddress').val(CustomerAddress);
 $('#CustomerPhoneNumber').val(CustomerPhoneNumber);
 $('#CustomerEmail').val(CustomerEmail);
 $('#myModal2').modal('hide');
});


} );

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
a:hover {
  color: white;
}

.form-control{
  border-color: rgba(180, 180, 180);
 
}

.hidden{
   visibility:hidden;
}

</style>
</head>


<!------------------------------HEADER--------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Detail Penawaran
</div> 

<!-----------------------------FORM PARENT-------------------------------->
<br>

<form action="{{route('input_penawarandetail')}}" method="POST" id="detail">{{ csrf_field() }}</form>

<div style="float:LEFT; width: 50%">
<table class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
<input type = "hidden" name="id" class="form-control" form="detail">
<tr>
<td><label>Nama Barang</label></td>
<td><input type = "text" name="nama_barang" class="form-control" form="detail"></td>
</tr>
<tr>
<td><label>Detail Barang</label></td>
<td><input type = "text" name="detail_barang" class="form-control" form="detail"></td>
</tr>
<tr>
<td><label>Jumlah Barang</label></td>
<td><input type = "number" name="jumlah_barang" class="form-control" form="detail" id="jumlah_barang"></td>
</tr>
<tr>
<td><label>Harga Barang</label></td>
<td><input type = "number" name="harga_barang" class="form-control" form="detail" id="harga_barang"></td>
</tr>
<tr>
<td><label>Total Harga</label></td>
<td><input type = "number" name="total_harga" class="form-control" form="detail" id="total_harga" ></td>
</tr>
<tr>
<td><label>Pajak</label></td>
<td>
<input type="radio" form="detail" name="is_pajak" value="2"> Pajak &nbsp&nbsp
<input type="radio" form="detail" name="is_pajak" value="1" checked="checked"> Non Pajak
</td>
</tr>
<td><input type ="submit" form="detail"></td>

</table>
</div>

  
<div style="float:right; width: 50%">
<table style= "border-collapse: collapse; width: 90%" border="1">
<thead >      
<tr>
<th><center>Nama Barang</center></th>
<th><center>Jumlah</center></th>
<th><center>Harga</center></th>
<th><center>Total</center></th>
<th><center>Delete</center></th>
</tr>

@foreach($value as $p)

@if($p->is_pajak =='2') 
@php
$sblm_pajak += $p['total_harga'];
$kena_pajak  = (11 / 100) * $sblm_pajak;
$grand_total = $sblm_pajak + $kena_pajak;
@endphp 

@else
@php
$sblm_pajak += $p['total_harga'];
$kena_pajak  = 0;
$grand_total = $sblm_pajak + $kena_pajak;
@endphp 
@endif

<tr align="center">
<td align ="left">{{$p->nama_barang}}</td>
<td>{{$p->jumlah_barang}}</td>
<td>{{number_format($p->harga_barang)}}</td>
<td>{{number_format($p->total_harga)}}</td> 
<td>

<a href="{{ url('admin/delete_child/'.$p->id) }}" title="Delete">
<i class="fa fa-trash" style="color:red;"></i></a>  
          
</td>
</tr>

<tr><td align ="left">{{$p->detail_barang}}</td></tr>
@endforeach

<tr>
<td colspan = "3" align ="left"><b>SEBELUM PAJAK</td>
<td colspan ="2"><b>Rp. {{ number_format($sblm_pajak) }}</td>
</tr>

<tr>
<td colspan = "3" align ="left"><b>PAJAK</td>
<td colspan ="2"><b>Rp. {{ number_format($kena_pajak) }}</td>
</tr>

<tr>
<td colspan = "3" align ="left"><b>GRAND TOTAL</td>
<td colspan ="2"><b>Rp. {{ number_format($grand_total) }}</td>
</tr>

</table>
</div>

<!--------------------------END FORM PARENT-------------------------->


<!------------------------------CHILD-------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Master Penawaran</div>
<div class="panel-body">


<form action="{{route('input_penawaran')}}" method="POST" id="penawaran">{{ csrf_field() }}
</form><!-- karena form gk bisa di nested, jadi pake form attribute -->

<table class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
<input type = "hidden" name="Status" class="form-control" value = "1" form="penawaran">

<!-- -------- -->
<tr >
<td width="10%"><label>Sales Name</label></td>
<td>

<div>
<div class="pull-right">
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" title="Search"><i class="fa fa-search"></i></button>
</div>
<div>
<div class="input-group">
<input type="text" class="form-control" name="SalesName" id="SalesName" form="penawaran" disabled="true" />
<input type="hidden" class="form-control" name="SalesID" id="SalesID" form="penawaran"/>
</div>
</div>
</div>

</td>
<td>&nbsp</td>

<td><label>Sales Unit</label></td>
<td><input type="text" class="form-control" name="UnitName" id="UnitName" form="penawaran"disabled="true"/>
<input type="hidden" class="form-control" name="Sales_Unit" id="Sales_Unit" form="penawaran"/></td>
<td>&nbsp</td>
<td><label>Nomor Dokumen</label></td>
<td><input type = "text" name="Nomor_Penawaran" class="form-control" form="penawaran"></td>
</tr>

<!-- -------- -->

<tr>
<td><label>Perihal</label></td>
<td>
<select name="Perihal" class="form-control " form="penawaran" >  
<option value="Penawaran">Penawaran</option>
</select>
</td>
<td>&nbsp</td>
<td><label>Tanggal Request</label></td>
<td><input type = "date" name="tgl_request" class="form-control" form="penawaran"></td>
<td>&nbsp</td>

<td><label>Company Name</label></td>
<td>
<div>
<div class="pull-right">
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2" title="Search"><i class="fa fa-search"></i></button>
</div>
<div>
<div class="input-group">
<input type = "text" name="CompanyName" class="form-control" form="penawaran" id="CompanyName">
</div>
</div>
</div>
</td>

</tr>

<!-- -------- -->

<tr>  
<td><label>Company Address</label></td>
<td><input type = "text" name="CompanyAddress" class="form-control" form="penawaran" id="CompanyAddress"></td>
<td>&nbsp</td>
<td><label>Company Phone</label></td>
<td><input type = "number" name="CompanyPhoneNumber" class="form-control" form="penawaran" id="CompanyPhoneNumber"></td>
<td>&nbsp</td>
<td><label>Customer Name</label></td>
<td><input type = "text" name="CustomerName" class="form-control" form="penawaran" id="CustomerName"></td>
</tr>

<!-- -------- -->

<tr>
<td><label>Customer Address</label></td>
<td><input type = "text" name="CustomerAddress" class="form-control" form="penawaran" id="CustomerAddress"></td>
<td>&nbsp</td>
<td><label>Customer Phone</label></td>
<td><input type = "number" name="CustomerPhoneNumber" class="form-control" form="penawaran" id="CustomerPhoneNumber"></td>
<td>&nbsp</td>
<td><label>Customer Email</label></td>
<td><input type = "text" name="CustomerEmail" class="form-control" form="penawaran" id="CustomerEmail"></td>
</tr>

<!-- -------- -->

@foreach($value as $d)

@if($d->is_pajak =='2') 
@php
$nonpajak  += $d['total_harga'];
$pajak      = $nonpajak * 0.11;
$grandtotal = $nonpajak + $pajak;
@endphp 

@else
@php
$nonpajak  += $d['total_harga'];
$pajak      = 0;
$grandtotal = $nonpajak + $pajak;
@endphp 
@endif

<label class ="hidden">{{$d->total_harga}}</label> 

@endforeach

<tr>  
<td><label>No NPWP</label></td>
<td><input type = "text" name="NPWP" class="form-control" form="penawaran"></td>
<td>&nbsp</td>
<td><label>Pajak</label></td>
<td><input type = "number" name="Pajak" class="form-control" form="penawaran" value = "{{ $pajak }}" readonly="true"></td>
<td>&nbsp</td>
<td><label>Grand Total</label></td>
<td><input type = "number" name="Grand_Total" class="form-control" form="penawaran" value = "{{ $grandtotal }}" readonly="true"></td>
</tr>
</table>
<br>

</div>
</div> 
</div></div>
<!----------------------------END CHILD-------------------------------->
<br>
<br>

<center><a href="../admin/penawaran_harga" class="btn btn-warning"  title="Back">
<i class="fa fa-backward"> Back</i></a>

<button type="submit" class="btn btn-success" title="Save" form="penawaran">
<i class="fa fa-check"></i> Save</button></center>
<br>
<br>
<br>

<!------------------------------MODAL CUSTOMER---------------------------------->
<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">DATA CUSTOMER</h4>
</div>
<!-- body modal -->
<div class="modal-body">
 
<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr>
<th>Company Name</th>
<th>Company Mail</th>
<th>Customer Name</th>
<th>Customer Mail</th>
<th>Select</th>
</tr> 
</thead>

@foreach($customer as $c => $data)

<tr>
<td>{{$data->CompanyName}}</td>
<td>{{$data->CompanyPhoneNumber}}</td>
<td>{{$data->CustomerName}}</td>
<td>{{$data->CustomerEmail}}</td>
<td>
<button class="btn btn-xs btn-info" id="select2" title="Select"
data-comname="<?=$data->CompanyName?>"
data-comad="<?=$data->CompanyAddress?>"
data-comphone="<?=$data->CompanyPhoneNumber?>"
data-custname="<?=$data->CustomerName?>"
data-custad="<?=$data->CustomerAddress?>"
data-custphone="<?=$data->CustomerPhoneNumber?>"
data-cusmail="<?=$data->CustomerEmail?>"
>
<i class="fa fa-check"> Select</i></button>
</td>
</tr>

@endforeach

<tfoot>
<tr>
<th>Company Name</th>
<th>Company Mail</th>
<th>Customer Name</th>
<th>Customer Mail</th>
<th>Select</th>
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

<!------------------------------MODAL EMPLOYEE---------------------------------->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Sales Name</h4>
</div>
<!-- body modal -->
<div class="modal-body">
 
<table id="example" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
 
<thead>
<tr><b>
<b><th>Employee</th>
<b><th>Unit</th>
<b><th>Jabatan</th>
<b><th>Select</th>
</tr> 
</thead>


@foreach($sales as $s => $data)

<tr border="1">
<td class="evencolor">{{$data->EmployeeName}}</td>
<td class="evencolor">{{$data->unit->UnitName}}</td>
<td class="evencolor">{{$data->jabatan->name}}</td>
<td class="evencolor">
<button class="btn btn-xs btn-info" id="select" title="Select"
data-employeeid="<?=$data->id?>"
data-employeename="<?=$data->EmployeeName?>"
data-unitid="<?=$data->Unit_id?>"
data-unitname="<?=$data->unit->UnitName?>"
>
<i class="fa fa-check"> Select</i></button>
</td>
</tr>

@endforeach

<tfoot>
<tr><b>
<b><th>Employee</th>
<b><th>Unit</th>
<b><th>Jabatan</th>
<b><th>Select</th>
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
<!------------------------------END MODAL EMPLOYEE------------------->

</div>
</div>

@endsection