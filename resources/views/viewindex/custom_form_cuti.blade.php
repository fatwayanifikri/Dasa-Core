<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')
@section('content')
  <!-- Your html goes here -->
  <div class='panel panel-default'>
    <div class='panel-heading'>Edit Form</div>
    <div class='panel-body'>
      <form method='post' action='{{CRUDBooster::mainpath('edit-save/'.$row->id)}}'>
        <div class='form-group'>
          <label>Karyawan</label>
          <input type='text' name='name' required class='form-control' value='{{$row->name}}'/>
        </div>
        <div class='form-group'>
          <label>Jabatan</label>
          <input type='text' name='email' required class='form-control' value='{{$row->email}}'/>
        </div>
        <div class='form-group'>
          <label>Unit</label>
          <input type='text' name='password' required class='form-control' value='{{$row->password}}'/>
        </div>
        <div class='form-group'>
          <label>Jenis Cuti</label>
          <input type='text' name='password' required class='form-control' value='{{$row->password}}'/>
        </div>
       
        <div class='form-group'>
          <label>Sisa Cuti</label>
          <input type='text' name='password' required class='form-control' value='{{$row->password}}'/>
        </div>
        
        <div class='form-group'>
          <label>Tujuan</label>
          <input type='text' name='password' required class='form-control' value='{{$row->password}}'/>
        </div>
        <div class='form-group'>
          <label>Lama</label>
          <input type='text' name='password' required class='form-control' value='{{$row->password}}'/>
        </div>
        <div class='form-group'>
          <label>Pelaksanaan</label>
          <input type='text' name='password' required class='form-control' value='{{$row->password}}'/>
        </div>
          </div>
         
        <!-- etc .... -->
        
      </form>
    </div>
    <div class='panel-footer'>
      <input type='submit' class='btn btn-primary' value='Save changes'/>
    </div>
  </div>
@endsection