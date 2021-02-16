@extends("crudbooster::admin_template")
@section("content")

    @push('head')
    <link rel='stylesheet' href='<?php echo asset("vendor/crudbooster/assets/select2/dist/css/select2.min.css")?>'/>
    <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>
    
        <style>
            .select2-container--default .select2-selection--single {
                border-radius: 0px !important
            }

            .select2-container .select2-selection--single {
                height: 35px
            }
        </style>
        @endpush

        
        <ul class="nav nav-tabs">
        @if($id)
        <li role="presentation" class="active"><a href="{{Route('AdminEmployeeCustomControllerGetStep1',['id'=>$id])}}"><i class='fa fa-info'></i> Step 1 - Data Diri
                    Information</a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep2',['id'=>$id])}}"><i class='fa fa-table'></i> Step 2 - Identitas Karyawan dan Pendidikan</a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep3',['id'=>$id])}}"><i class='fa fa-plus-square-o'></i> Step 3 - PKWT</a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep4',['id'=>$id])}}"><i class='fa fa-wrench'></i> Step 4 - Authentication</a></li>
        @else
            <li role="presentation" class='active'><a href="#"><i class='fa fa-table'></i> Step 1 - Data Diri</a></li>
            <li role="presentation"><a href="#"><i class='fa fa-table'></i> Step 2 - Identitas Karyawan dan Pendidikan</a></li>
            <li role="presentation"><a href="#"><i class='fa fa-plus-square-o'></i> Step 3 - PKWT</a></li>
            <li role="presentation"><a href="#"><i class='fa fa-wrench'></i> Step 4 - Authentication</a></li>
        @endif
           
        </ul>
       
        <div class="box box-default">
            <div class="box box-header with-border">
                <h3 class="box-title">Data Diri Karyawan</h3>
            </div>
            <div class="box-body">
                <form action="{{Route('AdminEmployeeCustomControllerPostStep1')}}" method="post" class="form-horizontal">
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/> 
                <input type="hidden" name="id" id="id" value="{{$id}}">
                    <div class="form-group">
                        <label class="control-label col-sm-2">NPK<span style="color:red"> *</span></label>
                        <div class="col-sm-5">
                            <input type="hidden" name="Pelamar_id" id="Pelamar_id" value="{{$row->Pelamar_id}}">
                            <input class="form-control" id="NPK" name="NPK"  placeholder="Silahkan Masukan NPK Karyawan" type="text" value="{{$row->NPK}}" required>
                        </div>
                        <div class="col-sm-3">
                            <button type="button" class="btn btn-success" data-toggle="modal" onclick="showModal()">Pilih Calon Karyawan</button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nama Karyawan<span style="color:red"> *</span></label>
                        <div class="col-sm-8">
                        <input class="form-control" id="EmployeeName" name="EmployeeName" type="text" placeholder="Nama Karyawan" value="{{$row->EmployeeName}}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Jabatan<span style="color:red"> *</span></label>
                        <div class="col-sm-8">
                            <select name="Jabatan_id" id="Jabatan_id" required class="select2 form-control" value="{{$row->Jabatan_id}}">
                                <option value="" class="">{{trans('crudbooster.text_prefix_option')}} pilih jabatan</option>
                                @foreach ($jabatan as $jab)
                                    <option {{($jab->id == $row->Jabatan_id)?"selected":""}} 
                                    value="{{ $jab->id}}">
                                        {{$jab->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Level<span style="color:red"> *</span></label>
                        <div class="col-sm-8">
                            <select name="Level_id" id="Level_id" required class="select2 form-control" value="{{$row->Level_id}}">
                                <option value="" class="">{{trans('crudbooster.text_prefix_option')}} pilih level</option>
                                @foreach ($level as $lev)
                                    <option {{($lev->id == $row->Level_id)?"selected":""}} 
                                    value="{{ $lev->id}}">
                                        {{$lev->LevelName}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Unit<span style="color:red"> *</span></label>
                        <div class="col-sm-8">
                            <select name="Unit_id" id="Unit_id" required class="select2 form-control" value="{{$row->Unit_id}}">
                                <option value="">{{trans('crudbooster.text_prefix_option')}} pilih unit</option>
                                @foreach ($unit as $un)
                                    <option {{($un->id == $row->Unit_id)?"selected":""}}
                                    value="{{ $un->id}}">
                                            {{$un->UnitName}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Perusahaan<span style="color:red"> *</span></label>
                        <div class="col-sm-8">
                            <select name="Company_id" id="Company_id" required class="select2 form-control" value="{{$row->Company_id}}">
                                <option value="" class="">{{trans('crudbooster.text_prefix_option')}} Pilih perusahaan</option>
                                    @foreach($company as $comp)
                                        <option {{($comp->id == $row->Company_id)?"selected":""}} 
                                        value="{{ $comp->id }}">
                                            {{$comp->CompanyName}}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2">Departement <span style="color:red">*</span></label>
                        <div class="col-sm-8">
                            <select name="Departement_id" id="Departement_id" required class="select2 form-control" value="{{$row->Departemet_id}}">
                                <option value="" class="">{{trans('crudbooster.text_prefix_option')}} Pilih Departement</option>
                                    @foreach($departement as $dept)
                                        <option {{($dept->id == $row->Departement_id)?"selected":""}}
                                        value="{{ $dept->id}}">
                                            {{$dept->DepartementName}}
                                        </option>
                                    @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Tempat Lahir<span style="color:red"> *</span></label>
                        <div class="col-sm-2">
                        <input class="form-control" id="TempatLahir" name="TempatLahir" type="text" placeholder="Tempat Lahir" value="{{$row->TempatLahir}}" required>
                        </div>

                        <label class="control-label col-md-1">Tanggal Lahir<span style="color:red"> *</span></label>
                        <div class="col-sm-2">
                        <input class="form-control" id="TanggalLahir" name="TanggalLahir" type="date" placeholder="Tempat Lahir" value="{{$row->TanggalLahir}}" required>
                        </div>

                        <label class="control-label col-md-1">Status</label>
                        <div class="col-sm-2">
                            <select name="StatusNikah_id" id="StatusNikah_id" class="form-control" value="{{$row->StatusNikah_id}}">
                                <option value="">-- Pilih Jenis Status --</option>
                                <option value="1" {{$row->StatusNikah_id == 1 ? 'selected' :''}}>Menikah</option>
                                <option value="2" {{$row->StatusNikah_id == 2 ? 'selected' :''}}>Single</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2">Jenis Kelamin<span style="color:red"> *</span></label>
                        <div class="col-sm-2">
                            <select name="JenisKelamin" id="JenisKelamin" class="form-control" value="{{$row->JenisKelamin}}">
                                <option value="">-- Pilih Jenis Kelamin --</option>
                                <option value="1" {{$row->JenisKelamin == 1 ? 'selected' :''}}>Laki-Laki</option>
                                <option value="2" {{$row->JenisKelamin == 2 ? 'selected' :''}}>Perempuan</option>
                            </select>
                        </div>

                        <label class="control-label col-sm-1">Hired Date<span style="color:red"> *</span></label>
                        <div class="col-sm-2">
                        <input class="form-control" id="HiredDate" name="HiredDate" type="date"  value="{{$row->HiredDate}}" required>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2">Alamat Rumah</label>
                        <div class="col-sm-8">
                            <input name="AlamatRumah" id="AlamatRumah" cols="100" rows="3" class="form-control" value="{{$row->AlamatRumah}}" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                    <label class="control-label col-sm-2">Telp. Rumah <span style="color:red"> *</span></label>
                        <div class="col-sm-2">
                        <input class="form-control" id="TelpRumah" name="TelpRumah" type="number" value="{{$row->TelpRumah}}" required>
                        </div>
                    
                        <label class="control-label col-sm-2">Handphone <span style="color:red"> *</span></label>
                        <div class="col-sm-2">
                        <input class="form-control" id="TelpHp" name="TelpHp" type="number" value="{{$row->TelpHp}}" required>
                        </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-sm-2">Keterangan</label>
                        <div class="col-sm-8">
                            <input class="form-control" id="Keterangan" name="Keterangan" type="text" value="{{$row->Keterangan}}" required>
                        </div>
                    </div>

            <div class="box-footer">
                <div class="pull-right">
                <a class='btn btn-default' href='{{Route("AdminEmployeeCustomControllerGetIndex")}}'> {{trans('crudbooster.button_back')}}</a>
                <input type="submit" class="btn btn-primary" value="Step Selanjutnya &raquo;">
                </div>
            </div>
                </form>
            </div>
        </div>

       
<!-- Bagian Modal Untuk Pelamar -->
<div class="modal fade" id="ModalPelamar" name="ModalPelamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class='fa fa-search'></i> {{trans('crudbooster.datamodal_browse_data')}} | Data Calon</h4>
      </div>
      <div class="modal-body">
                <table id='dataTablePelamar' class='table table-striped table-bordered table-condensed' style="margin-bottom: 0px">
                    <thead>
                      @foreach($column as $col)
                        <th>{{ $col }}</th>
                       @endforeach
                       <!-- <th width=5% >{{trans('crudbooster.datamodal_select')}}</th> -->
                    </thead>
                        <tbody>
                        
                        </tbody>
                </table>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="hideModal()">Close</button>
        
      </div>
    </div>
  </div>
</div>

@push('bottom')
        <script src='<?php echo asset("vendor/crudbooster/assets/select2/dist/js/select2.full.min.js")?>'></script>
        <script type="text/javascript">
        var SITEURL = '{{URL::to('')}}';
        
          $(function () {
            var table = $('#dataTablePelamar').dataTable({
                "processing" : true,
                "serverside" : true,
                "order": [[0,'desc']],
                "ajax": {
                        "url" : "{{ route('dataPelamar')}}",
                        "type" : "GET"

                }
               
            });

          });
          
          $(function () {
              $('.select2').select2();
          })
          //modal-show
          function showModal() {
              $('#ModalPelamar').modal('show');
          }
          //hide-modal
          function hideModal() {
              $('#ModalPelamar').modal('hide');
          }

        
          function getIDPelamar(id)
          { 
            console.log(id);
             var guid = id;
           // console.log(test);
             $.ajax({
                    url:"{{url('pelamar')}}/"+guid,
                    type:"get",
                    dataType:"json",
                    data:{id:id},
                    success: function(data){
                        //  console.log(data[0].NamaPelamar);
                        console.log(data);
                        console.log(data.Jabatan_id)
                       $('#Pelamar_id').val(guid);
                       $('#EmployeeName').val(data.NamaPelamar);
                       $('#Jabatan_id').val(data.Jabatan_id).trigger('change');
                       $('#Level_id').val(data.Level_id).trigger('change');
                       $('#Unit_id').val(data.Unit_id).trigger('change');
                       $('#Company_id').val(data.Company_id).trigger('change');
                       $('#Departement_id').val(data.Departement_id).trigger('change');
                       $('#TempatLahir').val(data.TempatLahir);
                       $('#TanggalLahir').val(data.TanggalLahir);
                       $('#JenisKelamin').val(data.JenisKelamin);
                       $('#StatusNikah_id').val(data.StatusNikah_id);
                       $('#AlamatRumah').val(data.Alamat);
                       $('#TelpRumah').val(data.TelpRumah);
                       $('#TelpHp').val(data.TelpHp);
                       $('#ModalPelamar').modal('hide');
                    },
                 
            });
          
          }
          //call datatable
          
        </script>
@endpush

@endsection       

