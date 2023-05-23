<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>MONITORING LEMBUR KARYAWAN PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
<td align="center"><h4><center>MONITORING LEMBUR</center></h4></td>
</tr>  
</thead>

<tr>           
  <b><td>No</td>
  <b><td>Karyawan</td>
  <b><td>Unit</td>
  <b><td>Jabatan</td>
  <b><td>Shift</td>
  <b><td>Jadwal Lembur</td>
  <b><td>Menit Lemburan</td>
  <b><td>Approve Lembur</td>
  <b><td>Status Voucher</td>
  <b><td>Nomor Voucher</td>
</tr>

</thead>
        
<?php $no = 0;?>
@foreach($data as $p)
<?php $no++ ;?>

<tr align = "center">
<td>{{$no}}</td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->shift}}</td>
<td>{{$p->StartTime}} - {{ \Carbon\Carbon::parse($p->EndTime)->format('H:i:s')}}</td>
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
@elseif($p->AmountMinute <= 239) 
<td>Non Voucher</td>
@else
<td>Blm Dibuat</td>
@endif
<td>{{$p->NomerVoucher}}</td>
          
</tr>
@endforeach


