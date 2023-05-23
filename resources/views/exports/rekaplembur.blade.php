<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>REKAP LEMBUR KARYAWAN PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
<td align="center"><h4><center>REKAP LEMBUR</center></h4></td>
</tr>  
</thead>
<tr>
<b> <td>Employee id</td>
<b> <td>Employee Name</td>
<b> <td>Unit </td>
<b> <td>Departement</td>
<b> <td>Jabatan</td>
<b> <td>Total Lembur</td>
            
</tr>
@foreach($data as $p)
        
@php
$total += $p['total_minute'];
@endphp   
<tr>
<td>{{$p->employee->NPK}}</td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->departement->DepartementName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->total_minute}} Minute</td> 
</tr>
@endforeach

<tr>
<td colspan = "5"><b>TOTAL</td>
<td><b>{{ $total }} Minute</td>

</tr>
       


