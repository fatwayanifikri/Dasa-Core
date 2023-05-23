<!------------------------------FORM INPUT-------------------------------->
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
<td><label>Nama Customer*</label></td>
<td><input type = "text" name="nama_customer" class="form-control" form="detail" id="nama_customer" value="{{old('nama_customer')}}"></td>
</div></tr>

<tr><div class="form-group {{ $errors->has('no_spk') ? 'has-error' : ''}}">
<td><label>Nomor SPK*</label></td>
<td><input type = "text" name="no_spk" class="form-control" form="detail" id="no_spk" value="{{old('no_spk')}}" ></td></div>
</tr>

<tr><div class="form-group {{ $errors->has('qty_produksi') ? 'has-error' : ''}}">
<td><label>Jumlah Produksi*</label></td>
<td><input type = "number" name="qty_produksi" class="form-control" form="detail" id="qty_produksi" value="{{old('qty_produksi')}}"></td></div>
</tr>

<tr><div class="form-group {{ $errors->has('tanggal_mulai') ? 'has-error' : ''}}">
<td><label>Tanggal*</label></td>
<td><input type = "date" name="tanggal_mulai" class="form-control" form="detail" id="tanggal_mulai" value="{{old('tanggal_mulai')}}"></td></div>
<!-- </tr>
<tr> -->
<!-- <td><label>Tanggal Selesai</label></td>
<td><input type = "date" name="tanggal_selesai" class="form-control" form="detail" id="tanggal_selesai" ></td> -->
</tr>

<tr>
<td><label>Status Produksi</label></td>
<td><select name="status_produksi" class="form-control " placeholder="Pilih Status" form="detail" id="status_produksi" readonly="true" value="{{old('status_produksi')}}">  
<!-- <option value="">-Select Status-</option> -->
<option value="1">Persiapan</option>
<!-- <option value="2">Proses</option>
<option value="3">Selesai</option> -->
</select></td>
</tr>

<tr><div class="form-group {{ $errors->has('lokasi_produksi') ? 'has-error' : ''}}">
<td><label>Lokasi Produksi*</label></td>
<td><select name="lokasi_produksi" class="form-control " placeholder="Cari Berdasarkan Unit .." value="{{ request('Unit_id') }}" form="detail" id="lokasi_produksi" value="{{old('lokasi_produksi')}}">  
<option value="">-Select Unit-</option>
@foreach($unit as $p)
<option value="{{$p->id}}">{{$p->UnitName}}</option>
@endforeach
</select></td></div>
</tr>

<!-- --------------- -->
<!-- <tr ><div class="form-group {{ $errors->has('id_mesin') ? 'has-error' : ''}}">
<td><label>Mesin*</label></td>
<td>
<table>
<tr>
<td>
<input type="text" class="form-control" name="id_mesin" id="mesin" form="detail" disabled="true" style="width:100%;" value="{{old('id_mesin')}}"/>
<input type="hidden" class="form-control" name="id_mesin" id="id_mesin" form="detail" />
</td>
<td>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal2" title="Search"><i class="fa fa-search"></i></button>
</td>
</tr>
</table>
</td></div>
</tr> -->
<!-- --------------- -->

<!-- --------------- -->
<tr ><div class="form-group {{ $errors->has('operator') ? 'has-error' : ''}}">
<td><label>Operator*</label></td>
<td>
<table>
<tr>
<td>
<input type="text" class="form-control" name="operator" id="operator" form="detail" disabled="true" style="width:100%;"/>
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
<!----------------------------END FORM-------------------------------->

<center><a href="../admin/produksi_view" class="btn btn-warning"  title="Back">
<i class="fa fa-backward"> Back</i></a>

<button type="submit" class="btn btn-success" title="Save" form="detail">
<i class="fa fa-check"></i> Save</button></center>


<br>
</br>
</div>