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
$(document).ready(function() {

 var $dTable = $('#example').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

  setInterval(function(){
      var total_harga = 0;  
      var jumlah_barang = $('#jumlah_barang').val();
      var harga_barang = $('#harga_barang').val();
        var calculate = Math.abs(jumlah_barang * harga_barang);
        var hasil = Math.ceil(calculate);
      $('#total_harga').val(hasil);
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
<div class="panel-heading">Master Penawaran
</div> 

<!-----------------------------FORM PARENT-------------------------------->

<form action="{{route('input_penawaran')}}" method="POST" id="penawaran">{{ csrf_field() }}
</form><!-- karena form gk bisa di nested, jadi pake form attribute -->

<div class="panel-body">
<div style="width: 100%">
<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">

<tr >
<td width="10%"><label>Sales Name</label></td>
<td>
<select name="SalesID" class="form-control " placeholder="Cari Berdasarkan Unit .." form="penawaran">  
<option value="">-Select Name-</option>
@foreach($sales as $p)
<option value="{{$p->id}}">{{$p->EmployeeName}}</option>
@endforeach
</select>
</td>

<td>&nbsp</td>
<td><label>Sales Unit</label></td>
<td><input type = "text" name="Sales_Unit" class="form-control" form="penawaran"></td>
<td>&nbsp</td>
<td><label>Nomor Dokumen</label></td>
<td><input type = "text" name="Nomor_PO" class="form-control" form="penawaran"></td>
</tr>

<tr><td>&nbsp</td></tr>

<tr>
<td><label>Perihal</label></td>
<td><input type = "text" name="Perihal" class="form-control" form="penawaran"></td>
<td>&nbsp</td>
<td><label>Tanggal Request</label></td>
<td><input type = "date" name="tgl_request" class="form-control" form="penawaran"></td>
<td>&nbsp</td>
<td><label>Company Name</label></td>
<td><input type = "text" name="CompanyName" class="form-control" form="penawaran"></td>
</tr>

<tr><td>&nbsp</td></tr>

<tr>  
<td><label>Company Address</label></td>
<td><input type = "text" name="CompanyAddress" class="form-control" form="penawaran"></td>
<td>&nbsp</td>
<td><label>Company Phone</label></td>
<td><input type = "number" name="CompanyPhoneNumber" class="form-control" form="penawaran"></td>
<td>&nbsp</td>
<td><label>Customer Name</label></td>
<td><input type = "text" name="CustomerName" class="form-control" form="penawaran"></td>
</tr>

<tr><td>&nbsp</td></tr>

<tr>
<td><label>Costumer Address</label></td>
<td><input type = "text" name="CustomerAddress" class="form-control" form="penawaran"></td>
<td>&nbsp</td>
<td><label>Customer Phone</label></td>
<td><input type = "number" name="CustomerPhoneNumber" class="form-control" form="penawaran"></td>
<td>&nbsp</td>
<td><label>Customer Email</label></td>
<td><input type = "text" name="CustomerEmail" class="form-control" form="penawaran"></td>
</tr>

<tr><td>&nbsp</td></tr>

@foreach($value as $d)

@php
$nonpajak  += $d['total_harga'];
$pajak      = $nonpajak * 0.1;
$grandtotal = $nonpajak + $pajak;
@endphp 

<label class ="hidden">{{$d->total_harga}}</label> 

@endforeach

<tr>  
<td><label>Pajak</label></td>
<td><input type = "number" name="Pajak" class="form-control" form="penawaran" value = "{{ $pajak }}"></td>
<td>&nbsp</td>
<td><label>Grand Total</label></td>
<td><input type = "number" name="Grand_Total" class="form-control" form="penawaran" value = "{{ $grandtotal }}" ></td>
</tr>


</table>
<br>
</div>

<!--------------------------END FORM PARENT-------------------------->


<!------------------------------CHILD-------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Detail Penawaran</div>
<div class="panel-body">

<form action="{{route('input_penawarandetail')}}" method="POST" id="detail">{{ csrf_field() }}</form>

<div style="float:LEFT; width: 50%">
<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
<input type = "hidden" name="id" class="form-control" form="detail">
<input type = "hidden" name="Status" class="form-control" value = "1" form="detail">
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
<td><input type ="submit" form="detail"></td>

</table>
</div>

  
<div style="float:right; width: 50%">
<table style= "border-collapse: collapse; width: 100%" border="1">
<thead >      
<tr>
<th><center>Nama Barang</center></th>
<th><center>Jumlah</center></th>
<th><center>Harga</center></th>
<th><center>Total</center></th>
<th><center>Delete</center></th>
</tr>

@foreach($value as $p)

@php
$sblm_pajak += $p['total_harga'];
$kena_pajak  = (10 / 100) * $sblm_pajak;
$grand_total = $sblm_pajak + $kena_pajak;
@endphp 

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

</thead>
</table>

</div>
</div> 
</div></div>
<!----------------------------END CHILD-------------------------------->

<center><a href="../admin/penawaran_harga" class="btn btn-warning"  title="Back">
<i class="fa fa-backward"> Back</i></a>

<button type="submit" class="btn btn-success" title="Save" form="penawaran">
<i class="fa fa-check"></i> Save</button></center>


</div> 

<br>
</br>
</div>

@endsection