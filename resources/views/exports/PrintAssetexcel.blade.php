<thead align="center"> 
<tr colspan="9">
<th align="center"><h1><center>PT.DASA PRIMA</center></h1></th>
<tr>
</thead>  
<tr colspan="9">
<td align="center"><h4><center>ASSET LOGISTIK</center></h4></td>
</tr>  
</thead>
<tr>
<tr>
            <th>No</th>
            <th>Kode Asset</th>
            <th>Nama Asset</th>
            <th>Kategori</th>
            <th>Unit</th>
            <!-- <th>Kondisi</th> -->
            <th>Tgl Pemakaian</th>
            <th>Tgl Pembelian</th>
            <!-- <th>Keterangan</th> -->
         
           
        </tr>
        </thead>
        <?php $no = 0;?>
        @foreach($data as $p)
        <?php $no++ ;?>
        <tr>
           <td>{{$no}}</td>
            <td>{{$p->aset->kode}}</td>
            <td>{{$p->aset->nama}}</td>
            <td>{{$p->aset->kategori->kategori_name}}</td>
            <td>{{$p->unit->UnitName}}</td>
            <!-- <td>{{$p->kondisi}}</td> -->
            <td>{{$p->tgl_pemakaian}}</td>
            <td>{{$p->tgl_pembelian}}</td>
            <!-- <td>{{$p->keterangan}}</td> -->
          
        </tr>
        @endforeach

    </table>




