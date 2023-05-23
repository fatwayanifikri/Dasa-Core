<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>VOUCHER LEMBUR KARYAWAN PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
<td align="center"><h4><center>VOUCHER LEMBUR</center></h4></td>
</tr>  
</thead>
<?php $count = 0; ?>
@foreach($data as $p)
<?php if($count == 1) break; ?>
<tr colspan="9">
<td align="center"><h4><center>CABANG : {{$p->unit->UnitName}}</center></h4></td>
<?php $count++; ?>
@endforeach
</tr>  
</thead>
<tr>
<td><b>No</td>
<td><b>Nama Pegawai</td>
<td><b>Unit</td>
<td><b>Divisi</td>
<td><b>Tanggal</td>
<td><b>Waktu</td>
<td><b>Total Menit</td>
<td><b>Status Voucher</td>
<td><b>Nominal</td>
<td><b>Nomerator</td>

</tr> 
<?php $no = 0;?>
@foreach($data as $p)
<?php $no++ ;?>

@php
$total += $p['NilaiVoucher'];
@endphp 

<tr align = "center">
<td>{{$no}}</td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->jabatan->name}}</td>
<td> {{ \Carbon\Carbon::parse($p->StartTime)->format('d-m-Y')}}</td>
<td> {{ \Carbon\Carbon::parse($p->StartTime)->format('H:i:s')}} - {{ \Carbon\Carbon::parse($p->EndTime)->format('H:i:s')}}</td>
<td>{{$p->AmountMinute}}</td>

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
            
<td>Rp. {{$p->NilaiVoucher}}</td>
<td>{{$p->NomerVoucher}}</td>
</tr>
@endforeach 

<tr align = "center">
<td colspan = "8"><b>TOTAL = </td>
<td><b>Rp. {{ $total }}</td>
<td></td>
</tr>

</table>
       


