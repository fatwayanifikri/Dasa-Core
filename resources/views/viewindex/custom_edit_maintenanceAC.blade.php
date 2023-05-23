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
<div class="panel-heading">Master Data
</div> 

<!-----------------------------FORM PARENT-------------------------------->
<br>


@foreach($maintenance as $p)
<form action="{{route('update_parent')}}" method="POST" id="detail">{{ csrf_field() }}</form>

<div style="float:RIGHT; width: 70%">
<table class="table pop_modal table-striped table-bordered table-hover" style="width:70%">
<input type = "hidden" name="id" class="form-control" form="detail">

<tr>
<td><label>Nama AC</label></td>
<td><input type = "text" name="nama_ac" class="form-control" form="detail" value="{{ $p->nama_ac }}"></td>
</tr>
<tr>
<td><label>Unit</label></td>
<td><input type = "text" name="Unit_id" class="form-control" form="detail" value="{{ $p->Unit_id }}"></td>
</tr>
<tr>
<td><label>Kode MB</label></td>
<td><input type = "text" name="kode_mb" class="form-control" form="detail" value="{{ $p->kode_mb }}"></td>
</tr>
<tr>
<td><label>Tipe</label></td>
<td><input type = "text" name="tipe" class="form-control" form="detail" value="{{ $p->tipe }}"></td>
</tr>
<tr>
<td><label>Lokasi</label></td>
<td><input type = "text" name="lokasi" class="form-control" form="detail"  value="{{ $p->lokasi }}"></td>
</tr>
<tr>
<td><label>Lantai</label></td>
<td><input type = "text" name="lantai" class="form-control" form="detail" value="{{ $p->lantai }}"></td>
</tr>
<tr>
<td><label>Periode</label></td>
<td><input type = "text" name="periode" class="form-control" form="detail" value="{{ $p->periode }}" ></td>
</tr>
<tr>
<td><label></label></td>
<td><input type ="submit" form="detail"></td>
</tr>

@endforeach

</table>
</div>


<!--------------------------END FORM PARENT-------------------------->


<!------------------------------CHILD-------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Data Detail</div>
<div class="panel-body">


<form action="{{route('input_penawaran')}}" method="POST" id="penawaran">{{ csrf_field() }}
</form><!-- karena form gk bisa di nested, jadi pake form attribute -->

<table class="table pop_modal table-striped table-bordered table-hover" style="width:100%">

<thead >      
<tr>
<th><center>Maintenance ID</center></th>
<th><center>Jadwal Ke</center></th>
<th><center>Tgl Maintenance</center></th>
<th><center>Tgl Realisasi</center></th>
<th><center>Keterangan</center></th>
<th><center>Action</center></th>
</tr>

@foreach($maintenancedetail as $m)

<tr align="center">
<td>{{$m->maintenance_ac_id}}</td>
<td>{{$m->jadwal_ke}}</td>
<td>{{$m->tgl_maintenance}}</td>
<td>{{$m->tgl_realisasi}}</td>
<td>{{$m->keterangan}}</td>
<td>


<a href="{{ url('admin/delete_child/'.$m->id) }}" title="Edit">
<i class="fa fa-pencil" style="color:green;"></i></a>  
&nbsp&nbsp&nbsp
<a href="{{ url('admin/delete_child/'.$m->id) }}" title="Delete">
<i class="fa fa-trash" style="color:red;"></i></a>  

</td>
</tr>

@endforeach
</table>

</div>
</div> 
</div>
</div>
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



</div>
</div>

@endsection