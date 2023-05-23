<html>
<head>
<title class="">Print Interview</title>
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

<table>
<tbody>
<tr>
<td style="width: 263px;" ><img src="{{asset('picture/dasaprima.png') }}"style="width:40px;height:40px;"></td>
<td style="width: 500px; text-align: center;font-size: 12pt;"><h3>PT. DASA PRIMA</h3></td>
</tr>
</tbody>
</table>

<p style="text-align: center; width:101%;"><strong><span style="text-decoration: underline;"><center>DATA MAINTENANCE KENDARAAN</center></span></strong></p>
<div class="col-sm-12">                   
<br>

<div class="col-sm-12">
<p style="text-align: left;">&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline;"></span></p>
<table style="width:100% solid; border-collapse: collapse" border="1">

<!-- GROUPING BY NAMA/NOPOL_ID -->

@foreach($query->groupBy('EmployeeName') as $col)
<tr align="left">
<td  colspan="8" rowspan="3"><b>{{ $col[0]['EmployeeName'] }}</b></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
<td style><br></td>
</tr>

<!-- END -->

<!-- HEADER -->
<tr align="center">
<td width="20%"><b>No Pol</td>
<td width="20%"><b>Tanggal Req</td>
<td width="30%"><b>Karyawan</td>
<td width="20%"><b>Unit</td>
<td width="40%"><b>Nama Barang</td>
<td width="10%"><b>Jumlah</td>
<td width="15%"><b>Nilai</td>
<td width="40%"><b>Catatan</td>      
</tr>
<!-- END -->

@foreach($col as $p)
<tr align="left">
<td>{{$p->kendaraan2->nomor_kendaraan}}</td>
<td>{{$p->tgl_permintaan}}</td>
<td>{{$p->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->nama_barang}}</td>
<td align="center">{{$p->jumlah}}</td>
<td align="center">{{$p->nilai}}</td>
<td>{{$p->catatan}}</td>
@endforeach
</tr>

@endforeach

</table>
</div>
                  
</body>
</html>



