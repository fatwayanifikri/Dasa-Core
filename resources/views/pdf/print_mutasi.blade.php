<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>TURN OVER KARYAWAN PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  

<?php $count = 0; ?>

@foreach($data ->sortBy('TanggalMutasi') as $p)
<?php if($count == 1) break; ?>
<tr colspan="9">
<td align="center"><center>{{$p->TanggalMutasi}} s/d {{$p->TanggalMutasi}}</center></td>
<?php $count++; ?>
@endforeach
<tr>    

<tr colspan="9">
    <td align="center"><h4><center>MUTASI</center></h4></td>
</tr>  

<tr border="visible"><b>
   <b><td>No</td>
   <b><td>Cabang</td>
   <b><td>Nama Karyawan</td>
   <b><td>NPK</td>
   <b><td>Alasan</td>
   <b><td>Jabatan</td>
   <b> <td>Cabang Baru</td>
   <b><td>Jabatan Baru</td>
   <b><td>Tanggal Mutasi</td>

</tr>

<?php $no = 0;?>
@foreach($data as $p)
<?php $no++ ;?>
<tr border="1">
    <td>{{$no}}</td>
    <td>{{$p->unit->UnitName}}</td>
    <td>{{$p->employee->EmployeeName}}</td>
    <td>{{$p->employee->NPK}}</td>
    <td>{{$p->Note}}</td>
    <td>{{$p->jabatan->name }}</td>
    <td>{{$p->unit2->UnitName}}</td>
    <td>{{$p->jabatan2->name }}</td>
    <td>{{$p->TanggalMutasi}}</td>
  
</tr>

@endforeach