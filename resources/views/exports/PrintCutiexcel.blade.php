<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
<td align="center"><h4><center>DATA CUTI</center></h4></td>
</tr>  
</thead>

<tr>
<tr>
<th>No</th>
<th>Employee</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Tgl Request</th>
<th>Jenis Cuti</th>
<th>Tahun Cuti</th>
<th>Tujuan</th>
<th>Lama</th>
<th>Pelaksanaan</th>
<th>Approved</th>
</tr>
</thead>

<?php $no = 0;?>
@foreach($data as $p)
<?php $no++ ;?>

<tr align = "center">
<td>{{$no}}</td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->jabatan->name }}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y')}}</td>
<td>{{$p->cuti->namacuti}}</td>
<td>{{$p->Tahuncuti}}</td>
<td>{{$p->Tujuan}}</td>
<td>{{$p->Lama}}</td>

@if($p->Pelaksanaan == null) 
<td class="evencolor">
{{ \Carbon\Carbon::parse($p->tgl_mulai)->format('d/m/Y')}} - 
{{ \Carbon\Carbon::parse($p->tgl_selesai)->format('d/m/Y')}}
</td>
@else
<td class="evencolor">{{$p->Pelaksanaan}}</td>
@endif

    @if($p->isApprove =='1') 
    <td>Disetujui Kabag/SPV</td>
    @elseif($p->isApprove =='2') 
    <td>Disetujui SM</td>
    @elseif($p->isApprove =='3') 
    <td>Tidak Disetujui</td>
    @else
    <td>Blm Disetujui</td>
    @endif
</tr>
@endforeach

</table>




