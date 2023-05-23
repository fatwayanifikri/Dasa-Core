<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>NEWCOMER KARYAWAN PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  

<?php $count = 0; ?>
@foreach($data ->sortBy('HiredDate') as $p)
<?php if($count == 1) break; ?>
<tr colspan="9">
<td align="center"><center>{{ request('from') }} s/d {{ request('until') }}</center></td>
<?php $count++; ?>
@endforeach
<tr>    

<tr colspan="9">
    <td align="center"><h4><center>NEWCOMER</center></h4></td>
</tr>  

<tr border="visible"><b>
   <b><td>No</td>
   <b><td>NPK</td>
   <b><td>Nama Karyawan</td>
   <b><td>Unit</td>
   <b><td>Perusahaan</td>
   <b> <td>Departement</td>
   <b><td>Jabatan</td>
   <b><td>Tanggal Masuk</td>

</tr>

<?php $no = 0;?>
@foreach($data ->sortByDesc('HiredDate' ) as $p)
<?php $no++ ;?>
<tr border="1">
  <td>{{$no}}</td>
            <td>{{$p->NPK}}</td>
            <td>{{$p->EmployeeName}}</td>
            <td>{{$p->unit->UnitName}}</td> 
            <td>{{$p->company->CompanyName}}</td>
            <td>{{$p->department->DepartementName}}</td>
            <td>{{$p->jabatan->name}}</td>
            <td>{{$p->HiredDate}}</td>
  
</tr>

@endforeach