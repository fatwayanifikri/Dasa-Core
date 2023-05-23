<html>
<head>
<title class="">Print Req BBM</title>
<link rel="stylesheet" href="main.css" />
<link rel="stylesheet" media="print" href="print.css" />    
<style>
                body {
                background: rgb(255,255,255); 
                }
                page {
                background: white;
                display: block;
                margin: 0 auto;
                margin-bottom: 0.3cm;
                box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
                }
                page[size="A4"] {  
                width: 21cm;
                height: 29.7cm; 
                }
                @media print {
                body, page {
                 margin: 0;
                 box-shadow: 0;
                 }
                  }
                    
                h2{
                    font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;;
                    
                }

                p{
                    font-size: 12px;
                    font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;;
                }

                td{
                    font-size: 12px;
                    font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;;
                }
                thead{
                    font-size: 12px;
                    font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;

                }
</style>
</head>

<body>
<div class="container">
<div class="col-sm-12">
<div class=""></div>
<center><h3>REKAP LAPORAN PERMINTAAN VOUCHER BBM DETAIL</h3>
<p>@foreach($dataprintBBM as $p)
<h3>PERIODE {{\Carbon\Carbon::parse($p->tgl_permintaan)->format('m-Y') }}</h3></center>
<?php break; ?>
@endforeach
</div>
</div>
<br>


<table style="width:100% solid; border-collapse: collapse" border="1">

<!-- GROUPING BY NAMA/NOPOL_ID -->

@foreach($dataprintBBM->groupBy('EmployeeName') as $tot)
<tr align="left">
<td colspan="14" rowspan="2"><b>{{ $tot[0]['EmployeeName'] }}</b></td>
</tr>
<tr>
<td><br><br></td>
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

</div>
</body>
</html>



