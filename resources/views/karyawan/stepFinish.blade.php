@extends('crudbooster::admin_template')
@section('content')

@push('head')
@endpush
<ul class="nav nav-tabs">
        @if($id)
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep1',['id'=>$id])}}"><i class='fa fa-info'></i> Step 1 - Data Diri
                    Information</a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep2',['id'=>$id])}}"><i class='fa fa-table'></i> Step 2 - Identitas Karyawan & Pendidikan </a></li>
            <li role="presentation" class="active"><a href="{{Route('AdminEmployeeCustomControllerGetStep3',['id'=>$id])}}"><i class='fa fa-plus-square-o'></i> Step 3 - PKWT</a></li>
            <li role="presentation"><a href="{{Route('AdminEmployeeCustomControllerGetStep4',['id'=>$id])}}"><i class='fa fa-wrench'></i> Step 5 - Authentication</a></li>
        @endif
</ul>
<div class="box box-default">
    <div class="box box-header with-border">
        <h3 class="box-title">Registrasi Akun</h3>
    </div>
    <div class="box-body">
        
    </div>
</div>

@push('bottom')
@endpush
@endsection