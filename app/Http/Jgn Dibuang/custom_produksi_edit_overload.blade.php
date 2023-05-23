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
$(document).ready(function () {
    $('table.display').DataTable();
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
 var mesinID = $(this).data('idmesin');
 var mesin_name = $(this).data('namamesin');
 var kategori_mesin = $(this).data('category');
 $('#nama_mesin').val(mesin_name);
 $('#id_mesin').val(mesinID);
 $('#kategori').val(kategori_mesin);
 $('#myModal2').modal('hide');
});



$(document).ready( function() {
    var now = new Date();
    var kode = "PR";
    var month = (now.getMonth() + 1);               
    var day = now.getDate();
    var year = now.getFullYear();
    year = year.toString().substr(-2);
    if (month < 10) 
        month = "0" + month;
    if (day < 10) 
        day = "0" + day;
    
    var today = year + '' + month + '00' + day;
    var gabung = kode + '' + today;
    $('#kode_produksi').val(gabung);
});

function PopUp(hideOrshow) {
    if (hideOrshow == 'hide') document.getElementById('ac-wrapper').style.display = "none";
    else document.getElementById('ac-wrapper').removeAttribute('style');
}
window.onload = function () {
    setTimeout(function () {
        PopUp('show');
    }, 1000);
}


</script>
  
<style>
 p { 
  margin:0 
}

.form-control{
  width: 88%;
}

.form-control2{
  height:35px;
  width: 100%;
  font-size: 13px;

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

div.dataTables_wrapper {
        margin-bottom: 3em;
    }

#ac-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255,255,255,.6);
    z-index: 1001;
}

#popup {
    width: 700px;
    height: 250px;
    background: #ed5249;
    border: 5px solid #000;
    border-radius: 25px;
    -moz-border-radius: 25px;
    -webkit-border-radius: 25px;
    box-shadow: #64686e 0px 0px 3px 3px;
    -moz-box-shadow: #64686e 0px 0px 3px 3px;
    -webkit-box-shadow: #64686e 0px 0px 3px 3px;
    position: relative;
    top: 150px; left: 375px;
    color: white;
    font-family: serif;

}

</style>
</head>

<!------------------------- MODAL POPUP--------------------->
<div id="ac-wrapper" style='display:none'>
<div id="popup">
<br></br>
<table style= "border-collapse: collapse; width: 100%" >
<tr align="center" ><td>
<h3>Kapasitas Mesin Penuh !! Harap Cek Kembali Jumlah Produksi</h3>    
</td></tr><tr><td>&nbsp</td></tr>
<tr align="center"><td>
<button type="submit" class="btn btn-warning btn-lg" title="OKE" onClick="PopUp('hide')" >
<i class="fa fa-check"></i> OKE</button></center>
</td></tr>
</table>

</div>
</div>
<!------------------------------END MODAL POPUP------------------->



<!------------------------------FORM MESIN-------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Input Mesin</div>
<div class="panel-body">

<br>

<form action="{{route('update_mesin')}}" method="POST" id="mesin">{{ csrf_field() }}
</form>
<div style="float:LEFT; width: 50%">
<table class="table pop_modal table-striped table-bordered table-hover" style="width:100%">

<!---------------------------->
<tr >
<td><label>Mesin</label></td>
<td>
<table  style="width:95%;">
<tr>
<td>@foreach($editproduksi as $d)
<input type="text" class="form-control2" name="mesin_id" id="nama_mesin" form="mesin" disabled="true"  value="{{ $d->mesin_id }}"/>
<input type="hidden" class="form-control" name="mesin_id" id="id_mesin" form="mesin" value="{{ $d->mesin_id }}"/>
</td>
<td>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2" title="Search"><i class="fa fa-search"></i></button>
</td>
</tr>
</table>
</td>
</tr>

<tr><td><label>Kategori Mesin</label></td>
<td><input type = "text" name="kategori" class="form-control" id="kategori" form="mesin" readonly="true" value="{{ $d->kategori }}"></td>
</tr>
<tr>
<td><label>Tanggal</label></td>
<td><input type = "date" name="tgl_produksi" class="form-control" form="mesin" value="{{ $d->tgl_produksi }}"></td>
</tr>

<tr>
<td><label>Lokasi Produksi</label></td>
<td><select name="Unit_id" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('Unit_id') }}" form="mesin" id="Unit_id">  
@foreach($unit as $p)
<option value="{{$p->id}}">{{$p->UnitName}}</option>
@endforeach
</select></td>
</tr>

<tr>
<td><label>QTY Produksi</label></td>
<td><input type = "text" name="qty_produksi" class="form-control" form="mesin" value="{{ $d->qty_produksi }}"></td>
</tr>
<!---------------------------->

<tr>
<td><input type ="submit" form="mesin"></td>
</tr>
</table>
</div>
@endforeach

<div style="float:right; width: 50%">
<table style= "border-collapse: collapse; width: 100%" border="1">
<thead >      
<tr >
<th><center>Mesin</center></th>
<th><center>Kategori</center></th>
<th><center>Tanggal Produksi</center></th>
<th><center>QTY Produksi</center></th>
<th><center>Delete</center></th>
</tr>

@foreach($editproduksi as $i)


<tr align="center" style="background-color: #E9967A;">
<td align ="left">{{$i->mesin->nama_mesin}}</td>
<td>{{$i->kategori}}</td>
<td>{{$i->tgl_produksi}}</td>
<td>{{$i->qty_produksi}}</td>

<td>

<a href="{{ url('admin/delete_mesin_overload/'.$i->id) }}" title="Delete">
<i class="fa fa-trash" style="color:red;"></i></a>          
</td>
</tr>
@endforeach

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


<tr>
<table style="width: 100%;" border="1" align="center">
<tr>
<td colspan="2" align="center">
@foreach($mesin->where('id','=',7) as $m)
@forelse($kapasitasm52 as $p)
<h4>{{number_format($sisa_sm52)}}</h4>
@break
@empty
<h4>{{number_format($m->kapasitas_produksi)}}</h4>
@endforelse
@endforeach
<p>Sisa Kapasitas SM 52</p>
</td>

<td colspan="2" align="center">
@foreach($mesin->where('id','=',6) as $m)
@forelse($kapasitasm74 as $p)
<h4>{{number_format($sisa_sm74)}}</h4>
@break
@empty
<h4>{{number_format($m->kapasitas_produksi)}}</h4>
@endforelse
@endforeach
<p>Sisa Kapasitas SM 74</p>
</td>

</tr>
</table>

</table>
</div>

<!--------------------------END FORM MESIN-------------------------->


<!------------------------------FORM PRODUKSI-------------------------------->
<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Input Produksi</div>
<div class="panel-body">

<form action="{{route('input_produksi')}}" method="POST" id="detail">{{ csrf_field() }}</form>

<div style="float:LEFT; width: 90%">
<table id="example2" class="table pop_modal table-striped table-bordered table-hover" style="width:80%">
<input type = "hidden" name="id" class="form-control" form="detail" >

<tr>
<td><label>Kode Produksi</label></td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" readonly="true" ></td>
</tr>

<tr><div class="form-group @if ($errors->has('nama_customer')) has-error @endif">
<td><label>Nama Customer</label></td>
<td><input type = "text" name="nama_customer" class="form-control" form="detail" id="nama_customer" value="{{old('nama_customer')}}"></td>
</div></tr>

<tr><div class="form-group {{ $errors->has('no_spk') ? 'has-error' : ''}}">
<td><label>Nomor SPK</label></td>
<td><input type = "text" name="no_spk" class="form-control" form="detail" id="no_spk" value="{{old('no_spk')}}" ></td></div>
</tr>


<!-- --------------- -->
<tr ><div class="form-group {{ $errors->has('operator') ? 'has-error' : ''}}">
<td><label>Operator</label></td>
<td>
<table style="width:100%;">
<tr>
<td>
<input type="text" class="form-control2" name="operator" id="operator" form="detail" disabled="true" />
<input type="hidden" class="form-control" name="operator" id="operatorid" form="detail"/>
</td>
<td>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" title="Search"><i class="fa fa-search"></i></button>
</td>
</tr>
</table>
</td></div>
</tr>
<!-- --------------- -->

<tr>
<td><label>Keterangan</label></td>
<td><input type = "text" name="keterangan" class="form-control" form="detail" id="keterangan" style="height:120px; width:90%;"></td>
</tr>
<!-- <td><input type ="submit" form="detail"></td> -->

</table>
</div>
</div> 

<!-- note button back di page 
    overload harus menghapus data yg overload
    supaya data overload tidak exist apabila user
    tidak jadi mengedit -->
<center><a href="../admin/produksi_view" class="btn btn-warning"  title="Back">
<i class="fa fa-backward"> Back</i></a>

<button type="submit" class="btn btn-success" title="Save" form="detail">
<i class="fa fa-check"></i> Save</button></center>


<br>
</br>
</div>
<!-------------------------------END FORM PRODUKSI-------------------------------->


<!------------------------------MODAL MESIN---------------------------------->
<div id="myModal2" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Mesin</h4>
</div>
<!-- body modal -->
<div class="modal-body">
 
<table id="" class="table pop_modal table-striped table-bordered table-hover display" style="width:100%">
 
<thead>
<tr>
<th>Kode Asset</th>
<th>Nama Mesin</th>
<th>Kategori</th>

<th>Select</th>
</tr> 
</thead>

<!-- Menghitung QTY Total Untuk Dpress -->

<!--------------------------------------->

@foreach($mesin as $m => $data)

<tr border="1">
<td class="evencolor">{{$data->kode_asset}}</td>
<td class="evencolor">{{$data->nama_mesin}}</td>
<td class="evencolor">{{$data->kategori}}</td>
<td class="evencolor">
<button class="btn btn-xs btn-info" id="select2" title="Select"
data-idmesin="<?=$data->id?>"
data-namamesin="<?=$data->nama_mesin?>"
data-category="<?=$data->kategori?>"
>
<i class="fa fa-check"> Select</i></button>
</td>
</tr>

@endforeach

<tfoot>
<tr>
<th>Kode Asset</th>
<th>Nama Mesin</th>
<th>Kategori</th>

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
<!------------------------------END MODAL MESIN------------------->


<!------------------------------MODAL EMPLOYEE---------------------------------->
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- konten modal-->
<div class="modal-content">
<!-- heading modal -->
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Employee Name</h4>
</div>
<!-- body modal -->
<div class="modal-body">
 
<!-- <table id="" class="" style="width:100%"> -->
<table id="" class="table pop_modal table-striped table-bordered table-hover display" style="width:100%">

<thead>
<tr>
<th>Employee</th>
<th>Unit</th>
<!-- <b><th>Jabatan</th> -->
<th>Select</th>
</tr> 
</thead>


@foreach($employee as $s => $data)

<tr border="1">
<td class="evencolor">{{$data->EmployeeName}}</td>
<td class="evencolor">{{$data->unit->UnitName}}</td>
<!-- <td class="evencolor">{{$data->jabatan->name}}</td> -->
<td class="evencolor">
<button class="btn btn-xs btn-info" id="select" title="Select"
data-employeeid="<?=$data->id?>"
data-employeename="<?=$data->EmployeeName?>"
>
<i class="fa fa-check"> Select</i></button>
</td>
</tr>

@endforeach

<tfoot>
<tr>
<th>Employee</th>
<th>Unit</th>
<!-- <b><th>Jabatan</th> -->
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
<!------------------------------END MODAL EMPLOYEE------------------->

@endsection