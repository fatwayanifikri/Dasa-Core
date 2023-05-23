<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
    <td align="center"><h4><center>FACILITY CONTROL</center></h4></td>
</tr>  
</thead>
<tr>
<tr>
           <th>No</th>
            <th>Tanggal Request</th>
            <th>Unit</th>
            <th>Defect</th>
            <th>Category</th>
            <th>Location</th>
           <th>Category Area</th>
           <th>Action Plan</th>
           <th>Reasoning</th>
           <th>Status</th>
           <th>Remarks</th>
         
           
        </tr>
        </thead>
        <?php $no = 0;?>
        @foreach($data as $p)
        <?php $no++ ;?>
        <tr>
            <td>{{$no}}</td>
            <td>{{$p->reqid->tgl_request}}</td>
            <td>{{$p->reqid->unit->UnitName}}</td>
            <td>{{$p->defect}}</td>
            <td>{{$p->kategori}}</td>
            <td>{{$p->lokasi}}</td>
            <td>{{$p->kategori_area}}</td>
            <td>{{$p->actionplan}}</td>
            <td>{{$p->reasoning}}</td>
            <td>{{$p->work_status}}</td>
            <td>{{$p->remarks}}</td>
          
        </tr>
        @endforeach

    </table>




