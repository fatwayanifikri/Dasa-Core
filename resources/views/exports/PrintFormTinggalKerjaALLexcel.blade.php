<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
<td align="center"><h4><center>FORM IZIN KERJA</center></h4></td>
</tr>  

<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Tanggal Pengajuan</th>
<th>Tanggal Izin</th>
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
<td>{{$p->tgl_pengajuan ? \Carbon\Carbon::parse($p->tgl_pengajuan)->format('d/m/Y') : null}}</td>

<!-- TANGGAL IZIN  -->
@if(\Carbon\Carbon::parse($p->EndDate)->format('d/m/Y') == \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y'))
<td>{{$p->StartDate ? \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y') : null}}</td>

@elseif(\Carbon\Carbon::parse($p->EndDate)->format('d/m/Y') != \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y'))
<td>{{$p->StartDate ? \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y') : null}} - 
{{$p->EndDate ? \Carbon\Carbon::parse($p->EndDate)->format('d/m/Y') : null}}</td>

@else
<td>{{$p->tgl_pengajuan? \Carbon\Carbon::parse($p->tgl_pengajuan)->format('d/m/Y') : null}}</td>
@endif

<!-- END TANGGAL IZIN  -->
<td>{{$p->keterangan}}</td>
@if($p->isApproved =='2') 
<td>Disetujui</td>
@elseif($p->isApprove =='3') 
<td>Tidak Disetujui</td>
@else
<td>Blm Disetujui</td>
@endif
</tr>

@endforeach    
</table>




