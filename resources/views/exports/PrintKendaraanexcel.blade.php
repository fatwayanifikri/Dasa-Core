<thead align="center"> 
<tr colspan="7">
<th align="center"><h1><center>PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="7">
<td align="center"><h4><center>DATA KENDARAAN</center></h4></td>
</tr>  
</thead>

<tr>           
<b><td>No</td>
<b><td>Karyawan</td>
<b><td>Jabatan</td>
<b><td>Unit</td>
<b><td>Jenis Kendaraan</td>
<b><td>Merk</td>
<b><td>Nopol</td>
</tr>
</thead>
        
<?php $no = 0;?>
@foreach($data as $p)
<?php $no++ ;?>

<tr align = "center">
<td>{{$no}}</td>
<td>{{$p->EmployeeName}}</td>
<td>{{$p->jabatan->name}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->jenis_kendaraan}}</td>
<td>{{$p->merk_kendaraan}}</td>
<td>{{$p->nomor_kendaraan}}</td>      
</tr>

@endforeach


