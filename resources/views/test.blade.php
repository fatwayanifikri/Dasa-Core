@extends("crudbooster::admin_template")
@section("content")
         <!-- SELECT2 EXAMPLE -->
 <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">Roles</h3>


        </div>
        <!-- /.box-header -->
        <div class="box-body">
         <form method="post" action="{{CRUDBooster::mainpath('edit-save/'.$row->id)}}">
         <input type="hidden" name="_token" value="{{csrf_token()}}">
              <div class="form-group">
                <label for="nama">Head Roles</label>
                   <option value="" ="">** Select Head Roles</option>
                  
                </select>
              </div>
              <!-- /.form-group -->
              <div class="form-group">
                <label>Level Roles</label>
               
                </select>
              </div>
              <div class="form-group">
                <label>Roles Name</label>
                   
              <!-- /.form-group -->
              </div>
            <div class="panel-footer">
          	<input type="submit" name="submit" class="btn btn-primary" value="Save">
          </div> <!-- /.col -->
          </form>  
        </div>
             <!-- /.form-group -->
            </div>
            <!-- /.col -->
          		</div>
          <!-- /.row -->
        		</div>
				
</div>


@endsection

<div style="float:LEFT; width: 50%">
<table class="table pop_modal table-striped table-bordered table-hover" style="width:100%">

<!---------------------------->
<tr >
<td><label>Mesin</label></td>
<td>
<table  style="width:95%;">
<tr>
<td>
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