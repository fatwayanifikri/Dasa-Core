@extends('crudbooster::admin_template')
@section('content')

@push('head')
<link rel='stylesheet' href='<?php echo asset("vendor/crudbooster/assets/select2/dist/css/select2.min.css")?>'/>
<style>

        .select2-container--default .select2-selection--single {
            border-radius: 0px !important
        }

        .select2-container .select2-selection--single {
            height: 35px
        }
        .note
        {
        text-align: center;
        height: 50px;
        background: -webkit-linear-gradient(left, #0072ff, #8811c5);
        color: #fff;
        font-weight: bold;
        line-height: 50px;
        }

        .btnSubmit
        {
        border:none;
        border-radius:1.5rem;
        padding: 1%;
        width: 20%;
        cursor: pointer;
        background: #0062cc;
        color: #fff;
        }

       
</style>
@endpush
<ul class="nav nav-tabs">
        @if($id)<li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep1',['id'=>$id])}}"><i class='fa fa-info'></i> Step 1 - Data Diri
                    Information</a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep2',['id'=>$id])}}"><i class='fa fa-table'></i> Step 2 - Identitas Karyawan & Pendidikan </a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep3',['id'=>$id])}}"><i class='fa fa-plus-square-o'></i> Step 3 - PKWT</a></li>
            <li role="presentation" class="active"><a href="#"><i class='fa fa-wrench'></i> Step 5 - Authentication</a></li><li class=""></li>
        @endif
</ul>

<div class="box box-default">
    <div class="box box-header with-border">
        <h3 class="box-title">Registrasi Account Karyawan</h3>
    </div>
    <div class="box-body">
        <div class="note">
               <p> Hanya yang sudah terdaftar menjadi karyawan yang bisa membuat Account</p>
        </div>
        <div class="col-sm-12">
                <div class="panel-body">
                        <form action="{{Route('AdminEmployeeCustomControllerPostStep4')}}" method="post"  class="form-horizontal">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}"/> 
                        <input type="hidden" name="Employee_id" id="Employee_id" value="{{$id}}">
                        <input type="hidden" name="id" id="id" value="{{$idUser}}"> 
                        <div class="form-group">
                            <label class="control-label col-sm-2">Nama Lengkap <span style="color:red">*</span></label>
                                <div class="col-sm-6">
                                    <input type="text" name="name" id="name" class="form-control" value="{{$karyawan->EmployeeName}}" required>
                                </div>
                        </div>

                        <div class="form-group">
                        	<label class="control-label col-sm-2">Email <span style="color:red">*</span></label>
                            	<div class="col-sm-6">
                                     <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-envelope"></span>
                                            </div>
                                            <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                </div>
                        </div> 

                        <!-- <div class="form-group">
                            <label class="control-label col-sm-2">Photo <span style="color:red">*</span></label>
                            <div class="col-sm-6">
                                <input type="file" id="photo" name="photo" class="form-control" readonly>
                                <p class="text-muted"><em class="">Recommended resolution is 200x200px dan max. 1MB</em></p>
                            </div>
                        </div> -->

                        <div class="form-group">
                      		<label class="control-label col-sm-2">Jabatan <span style="color:red">*</span></label>
							  <div class="col-sm-6">
							  	<select name="id_cms_privileges" id="id_cms_privileges" class="select2 form-control" value="{{$karyawan->Jabatan_id}}">
									<option value="">*** Pilih Jabatan</option>
                                    @foreach ($jabatan as $jab)
                                        <option {{$jab->id == $karyawan->Jabatan_id? "selected":"" }} value="{{$jab->id}}">
                                            {{$jab->name}}
                                        </option>
                                    @endforeach
								</select>
							  </div>
                        </div>  

                        <div class="form-group">
                            <label class="control-label col-sm-2">Unit <span style="color:red">*</span></label>
                                <div class="col-sm-6">
                                    <select name="Unit_id" id="Unit_id" class="select2 form-control" value="{{$karyawan->Unit_id}}">
                                        <option value="">*** Pilih Unit</option>
                                        @foreach ($unit as $un)
                                            <option {{ $un->id == $karyawan->Unit_id? "selected":"" }} value="{{$un->id}}">
                                                {{$un->UnitName}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div> 

                        <!--<div class="form-group">
                            <label class="control-label col-sm-2">Password <span style="color:red">*</span></label>
                                <div class="col-sm-6">
                                    <input type="password" id="password" name="password" class="form-control"required >
                                </div>
                        </div>--> 

                            <div class="box-footer">
                                    <div class="pull-right">
                                    <button type="button" onclick="location.href='{{CRUDBooster::mainpath('step3').'/'.$id}}'"class="btn btn-default">
                                                    &laquo; Back
                                    </button>
                                    <input type="submit" class='btn btn-primary' value='Save Account'>
                                    </div>       
                            </div>
                        
                        </form>
                </div>
        </div>

        
    </div>
</div>

@push('bottom')
<script src='<?php echo asset("vendor/crudbooster/assets/select2/dist/js/select2.full.min.js")?>'></script>
<script type="text/javascript">
        $(function () 
        {
                $('.select2').select2();
        });
</script>
@endpush
@endsection
