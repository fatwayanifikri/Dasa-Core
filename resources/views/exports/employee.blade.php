<thead>      
<tr>
    <th>NPK</th>
    <th>Nama Karyawan</th>
    <th>Unit</th>
    <th>Perusahaan</th>
    <th>Departement</th>
   <th>Jabatan</th>
</tr>
</thead>

@foreach($data as $p)
<tr>
    <td>{{$p->NPK}}</td>
    <td>{{$p->EmployeeName}}</td>
    <td>{{$p->unit->UnitName}}</td>
    <td>{{$p->company->CompanyName}}</td>
    <td>{{$p->department->DepartementName }}</td>
    <td>{{$p->jabatan->name}}</td>
  
</tr>
@endforeach