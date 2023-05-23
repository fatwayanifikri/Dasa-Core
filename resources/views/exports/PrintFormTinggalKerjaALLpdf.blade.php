<html>
<head>
<title class="">FORM TIDAK ABSEN</title>
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
<td style="width: 263px;" ><img src="{{asset('picture/dasaprima.png') }}"style="width:40px;height:40px;"></td> -->
<td style="width: 550px; text-align: center;font-size: 12pt;"><h2>PT. DASA PRIMA</h2></td>
</tr>
<tr> 
<td></td>
<td style="width: 150px; text-align: center;font-size: 10pt;"><h3>FORM IZIN KERJA</h3></td>
</tr>
</tbody>
</table>                  
</div>
</div>
</div>
<br>

<table style="width:100% solid; border-collapse: collapse" border="1">
<thead>
<tr>
<th>No</th>
<th>Karyawan</th>
<th>Jabatan</th>
<th>Unit</th>
<th>Tanggal Pengajuan</th>
<th>Tanggal Izin</th>
<th>Keterangan</th> 
<th>Status</th> 
</tr>
</thead>

<?php $no = 0;?>
@foreach($query as $p)
<?php $no++ ;?>

<tr align = "center">
<td>{{$no}}</td>
<td align="left">{{$p->employee->EmployeeName}}</td>
<td align="left">{{$p->jabatan->name}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->tgl_pengajuan ? \Carbon\Carbon::parse($p->tgl_pengajuan)->format('d/m/Y') : null}}</td>

<!-- TANGGAL IZIN  -->
@if(\Carbon\Carbon::parse($p->EndDate)->format('d/m/Y') == \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y'))
<td>{{$p->StartDate ? \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y') : null}}</td>

@elseif(\Carbon\Carbon::parse($p->EndDate)->format('d/m/Y') != \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y'))
<td>{{$p->StartDate ? \Carbon\Carbon::parse($p->StartDate)->format('d/m/Y') : null}} - 
{{$p->EndDate ? \Carbon\Carbon::parse($p->EndDate)->format('d/m/Y') : null}}</td>

@else
<td>{{$p->tgl_pengajuan? \Carbon\Carbon::parse($p->tgl_pengajuan)->format('d/m/Y') : null}}</td>
@endif

<!-- END TANGGAL IZIN  -->

<td align="left">{{$p->keterangan}}</td>
@if($p->isApproved =='2') 
<td>Disetujui</td>
@elseif($p->isApprove =='3') 
<td>Tidak Disetujui</td>
@else
<td>Blm Disetujui</td>
@endif
</tr>

@endforeach    
</table>
</body>
</html>



