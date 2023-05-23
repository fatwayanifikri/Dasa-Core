<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
    <td align="center"><h4><center>CUT OFF ASSET</center></h4></td>
</tr>  
</thead>
<tr>
<tr>
            <th>No</th>
            <th>Kode Asset</th>
            <th>Nama Asset</th>
            <th>Kategori</th>
            <th>Unit</th>
            <th>Periode Cut Off</th>
            <th>Status Cut Off</th>

        </tr>
        </thead>
        <?php $no = 0;?>
        @foreach($data as $p)
        <?php $no++ ;?>
        <tr>
            <td>{{$no}}</td>
            <td>{{$p->kode}}</td>
            <td>{{$p->nama}}</td>
            <td>{{$p->kategori->kategori_name}}</td>
            <td>{{$p->unit->UnitName}}</td>
            <td>{{$p->periode}}</td>
            <td > {{ ($p->status_cutoff == 1) ? 'Sudah Di Cutoff' : 'Blm Di Cut Off'}}</td>
          
        </tr>
        @endforeach

    </table>




