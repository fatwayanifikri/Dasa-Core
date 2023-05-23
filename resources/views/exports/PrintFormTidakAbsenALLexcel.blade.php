<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
<td align="center"><h4><center>FORM TIDAK ABSEN</center></h4></td>
</tr>  

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Tanggal</th>
<th>Jam</th>
<th>Keterangan</th> 
<th>Status</th> 
</tr>
</thead>

<?php $no = 0;?>
@foreach($data as $p)
<?php $no++ ;?>

<tr align = "center">
<td>{{$no}}</td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->tanggal}}</td>
<td>{{$p->jam_pelaksanaan}}</td>
<td>{{$p->keterangan}}</td>
@if($p->is_approve =='2') 
<td>Disetujui</td>
@elseif($p->is_approve =='3') 
<td>Tidak Disetujui</td>
@else
<td>Blm Disetujui</td>
@endif
</tr>

@endforeach    
</table>




