<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')

@section('content')

<!-- CUSTOM VIEW FORM INPUT BB/BOM -->

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
      var harga_bb = 0; 
      var harga_barang = $('#harga_barang').val();
      var harga_satuan = $('#harga_satuan').val();
      var qty = $('#qty').val();
      var hargaxqty = Math.abs(harga_barang * qty);
      var total = Math.abs(hargaxqty / harga_satuan);
      var hasil = Math.round(total * 100) / 100;

      $('#harga_bb').val(hasil);
      }); 


//datamodal select sales
$(document).on('click','#select',function(){
 var barang_id = $(this).data('idbarang');
 var barang_nama = $(this).data('namabarang');
 var harga_after = $(this).data('hargapajak');

 $('#barangID').val(barang_id);
 $('#barangname').val(barang_nama);
 $('#harga_barang').val(harga_after);
 $('#myModal').modal('hide');
});


} );

</script>
  
<style>
 p { 
  margin:0 
}

.form-control{
  width: 100%;
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

<form action="{{route('input_BB_detail')}}" method="POST" >{{ csrf_field() }}

<div style="float:LEFT; width: 50%">
<table class="table pop_modal table-striped table-bordered table-hover" style="width:100%">

<tr>
<td width="25%"><label>Nama Barang</label></td>
<td>
<!-- ------------------------ -->
<table border="0">
<tr>
<td>
<input type="text" class="form-control" name="barang_id" id="barangname" disabled="true" />
<input type="hidden" class="form-control" name="barang_id" id="barangID" />
</td>
<td>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" title="Search"><i class="fa fa-search" ></i></button>
</td>
</tr>
</table>
<!-- ------------------------ -->
</td>
</tr>

<tr>
<td><label>Harga Barang</label></td>
<td><input type = "number" name="harga_barang" class="form-control" id="harga_barang" readonly="true"></td>
<td></td>
</tr>
<tr>
<td><label>Jumlah Barang</label></td>
<td><input type = "number" name="qty" class="form-control" id="qty"></td>
</tr>
<tr>
<td><label>KTS</label></td>
<td><input type = "text" name="kts" class="form-control" ></td>
</tr>
<tr>
<td><label>Satuan</label></td>
<td><input type = "number" name="harga_satuan" class="form-control" id="harga_satuan" ></td>
</tr>
<tr>
<td><label>Harga BB</label></td>
<td><input type = "text" name="harga_bb" class="form-control" id="harga_bb" ></td>
</tr>
<tr>
<td><label>Mesin</label></td>
<td><input type = "text" name="mesin" class="form-control" ></td>
</tr>
<!-- <tr>
<td><label>Pajak</label></td>
<td>
<input type="radio" form="detail" name="is_pajak" value="2"> Pajak &nbsp&nbsp
<input type="radio" form="detail" name="is_pajak" value="1" checked="checked"> Non Pajak
</td>
</tr> -->

<!-- ------------------------ -->
<tr>
<td><label></label></td>
<td>
<button type="submit" class="btn btn-primary" title="Add" >
<i class="fa fa-plus"></i> Add</button>
</td>
</tr>

</table>
</form>
</div>
<!-------------------------- -->

<br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br><br></br>
<br></br>
<div style="float:center; width: 100%">
<table style= "border-collapse: collapse; width: 90%" border="1" align="center">
<thead >      
<tr>
<th><center>Nama Barang</center></th>
<th><center>Harga Barang</center></th>
<th><center>QTY</center></th>
<th><center>KTS</center></th>
<th><center>Satuan</center></th>
<th><center>Harga BB</center></th>
<th><center>Mesin</center></th>
<th><center>Delete</center></th>
</thead>
</tr>

@foreach($result as $p)


<tr align="center">
<td align ="left">{{$p->harga->nama_barang}}</td>
<td>Rp.{{number_format($p->harga_barang)}}</td>
<td>{{number_format($p->qty)}}</td>
<td>{{$p->kts}}</td> 
<td>{{number_format($p->harga_satuan)}}</td>
<td>{{$p->harga_bb}}</td>
<td>{{$p->mesin}}</td>
<td>

<a href="{{ url('admin/delete_hargabb/'.$p->id) }}" title="Delete">
<i class="fa fa-trash" style="color:red;"></i></a>  
          
</td>
</tr>
@ENDFOREACH


</table>

<br></br>
<!-- ------------------------ -->
<form>
<table align="center">
<tr>
<td><label></label></td>
<td>
<a href="../admin/harga_bb" class="btn btn-warning"  title="Back">
<i class="fa fa-backward"> Back</i></a>

<a href="../admin/submit_confirm" class="btn btn-success"  title="Submit">
<i class="fa fa-check"> Submit</i></a>
</td>
</tr>

</table>
</form>
</div>
<!-------------------------- -->
<!--------------------------END FORM PARENT-------------------------->

<div class="row">
<div class="col-md-12">
<div class="panel-body">
</div>
</div> 
</div>



<!------------------------------MODAL BARANG---------------------------------->
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
<b><th>Nama Barang</th>
<b><th>No Barang</th>
<b><th>Harga</th>
<b><th>Select</th>
</tr> 
</thead>


@foreach($barang as $b => $data)

<tr border="1">
<td class="evencolor">{{$data->nama_barang}}</td>
<td class="evencolor">{{$data->no_barang}}</td>
<td class="evencolor">{{$data->harga_pajak}}</td>
<td class="evencolor">
<button class="btn btn-xs btn-info" id="select" title="Select"
data-idbarang="<?=$data->id?>"
data-namabarang="<?=$data->nama_barang?>"
data-hargapajak="<?=$data->harga_pajak?>"

>
<i class="fa fa-check"> Select</i></button>
</td>
</tr>

@endforeach

<tfoot>
<tr><b>
<b><th>Nama Barang</th>
<b><th>No Barang</th>
<b><th>Harga</th>
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