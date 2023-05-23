<table style="width:100% solid; border-collapse: collapse;text-align: center;" border="0">

<thead align="center"> 
<tr align="center">
<th align="center" colspan="14"><h1 align="center" ><center>PT.DASA PRIMA</center></h1></th>
</tr>

<tr align="center">
<th align="center" colspan="14"><h1 align="center" ><center>REKAP LAPORAN PERMINTAAN VOUCHER BBM DETAIL</center></h1></th>
</tr>

<tr align="center">
<th align="center" colspan="14"><h1 align="center" ><center>@foreach($data as $p) PERIODE {{\Carbon\Carbon::parse($p->tgl_permintaan)->format('m-Y') }} <?php break; ?>
@endforeach</center></h1></th>
</tr>

</table>


<table style="width:100% solid; border-collapse: collapse" border="1">

<!-- GROUPING BY NAMA/NOPOL_ID -->

@foreach($data->groupBy('EmployeeName') as $tot)
<tr>
<td colspan="14"><br><br></td>
</tr>

<tr align="left">
<td colspan="14" rowspan="2"><b>{{ $tot[0]['EmployeeName'] }}</b></td>
</tr>


<tr align="center">
<td><b>Unit</td>
<td><b>Nopol</td>
<td><b>Pemakai</td>
<td><b>Nomor Kupon</td>
<td><b>Tanggal Request</td>
<td><b>KM Tujuan</td>
<td><b>BBM Rekom</td>
<td><b>Rata2 Rekom</td>
<td><b>Jml KM</td>
<td><b>Jml BBM</td>
<td><b>Total Biaya</td>
<td><b>Rata2 KM</td>
<td><b>Rata2 Liter</td>
<td><b>Tujuan</td>
</tr>

@foreach($tot as $p)
<tr align="center">
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->kendaraan->nomor_kendaraan}}</td>
<td align="left">{{$p->EmployeeName}}</td>
<td>{{$p->nomor_voucher}}</td>
<td>{{\Carbon\Carbon::parse($p->tgl_permintaan)->format('d-m-Y') }}</td>
<td>{{$p->jumlah_kmtujuan }}</td>
<td>{{$p->jumlah_disarankan }}</td>
<td>{{$p->ratarata_kmhabis }}</td>
<td>{{$p->jumlah_km }}</td>
<td>{{$p->jumlah_bbm }}</td>
<td>{{$p->total_biaya }}</td>
<td>{{$p->ratarata_km }}</td>
<td>{{$p->ratarata_kmhabis }}</td>
<td align="left">{{$p->tujuan }}</td>
@endforeach
</tr>

<tr align = "center">
<td  colspan="5"><b>TOTAL</b></td>
<td><b>{{ $tot->sum('jumlah_kmtujuan') }}</td>
<td><b>{{ $tot->sum('jumlah_disarankan') }}</td>
<td><b>{{ $tot->sum('ratarata_kmhabis') }}</td>
<td><b>{{ $tot->sum('jumlah_km') }}</td>
<td><b>{{ $tot->sum('jumlah_bbm') }}</td>
<td><b>{{ $tot->sum('total_biaya') }}</td>
<td><b>{{ $tot->sum('ratarata_km') }}</td>
<td><b>{{ $tot->sum('ratarata_kmhabis') }}</td>
<td></td>
</tr> 

@endforeach

<tr align="left">
<td colspan="14" rowspan="2"></td>
</tr>
<tr>
<td><br><br></td>
</tr>

@foreach($dataprintBBM as $g)
<tr align = "center">
<td colspan="5"><b>GRAND TOTAL</b></td>   
<td><b>{{ $g->sum('jumlah_kmtujuan') }}</td>
<td><b>{{ $g->sum('jumlah_disarankan') }}</td>
<td><b>{{ $g->sum('ratarata_kmhabis') }}</td>
<td><b>{{ $g->sum('jumlah_km') }}</td>
<td><b>{{ $g->sum('jumlah_bbm') }}</td>
<td><b>{{ $g->sum('total_biaya') }}</td>
<td><b>{{ $g->sum('ratarata_km') }}</td>
<td><b>{{ $g->sum('ratarata_kmhabis') }}</td>
<td></td>
</tr>
<?php break; ?>
@endforeach

</table>

</html>



