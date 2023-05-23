<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>VOUCHER LEMBUR KARYAWAN PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
<td align="center"><h4><center>VOUCHER LEMBUR</center></h4></td>
</tr>  
</thead>
<tr>
<td><b>No</td>
<td><b>Karyawan</td>
<td><b>Unit</td>
<td><b>Jabatan</td>
<td><b>Shift</td>
<td><b>Tgl Lembur</td>
<td><b>Jam lembur</td>
<td><b>Menit Lemburan</td>
<td><b>Approve Lembur</td>
<td><b>Status Voucher</td>
<td><b>Nomor Voucher</td>

</tr> 
<?php $no = 0;?>
@foreach($data as $p) 
<?php $no++ ;?>
<tr align = "center">
<td>{{$no}}</td>
<td>{{$p->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->shift}}</td>
<td>{{ \Carbon\Carbon::parse($p->StartTime)->format('d-m-Y')}}</td>
<td>{{ \Carbon\Carbon::parse($p->StartTime)->format('H:i:s')}} - {{ \Carbon\Carbon::parse($p->EndTime)->format('H:i:s')}}</td>
<td>{{$p->AmountMinute}}</td>
<td>{{ ($p->isApproved == 1) ? 'Setuju' : 'Blm Di Setujui'}}</td>
@if($p->isVoucher =='1') 
<td>Dibuat</td>
@elseif($p->isVoucher =='2') 
<td>Diajukan</td>
@elseif($p->isVoucher =='3') 
<td>Dicairkan</td>
@elseif($p->isVoucher =='4') 
<td>Diterima</td>
@else
<td>Blm Dibuat</td>
@endif
<td>{{$p->NomerVoucher}}</td>

</tr>
@endforeach
   
</table>
       


