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
<td><b>Start Time</td>
<td><b>End Time</td>
<td><b>Menit Lemburan</td>
<td><b>Approve Lembur</td>
<td><b>Status Voucher</td>
<td><b>Nomor Voucher</td>
<td><b>Jumlah Voucher</td>
<td><b>Nilai Voucher</td>
</tr> 
<?php $no = 0;?>
@foreach($data as $p)
@php
    $totaljumlah += $p['JumlahVoucher'];
    $totalnilai += $p['NilaiVoucher'];
@endphp  
<?php $no++ ;?>
<tr align = "center">
<td>{{$no}}</td>
<td>{{$p->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->StartTime}}</td>
<td>{{$p->EndTime}}</td>
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
<td>{{$p->JumlahVoucher}}</td>
<td>{{$p->NilaiVoucher}}</td>
</tr>
@endforeach
<tr>
<td colspan = "10"><b>TOTAL</td>
<td><b><center>{{ $totaljumlah }}</center></b> </td>
<td><b><center>{{ $totalnilai }}</center></b> </td>
</tr>      
</table>
       


