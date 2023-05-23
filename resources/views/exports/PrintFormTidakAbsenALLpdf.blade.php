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
<td style="width: 150px; text-align: center;font-size: 10pt;"><h3>FORM TIDAK ABSEN</h3></td>
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
<th>Tanggal</th>
<th>Jam</th>
<th>Keterangan</th> 
<th>Status</th> 
</tr>
</thead>

<?php $no = 0;?>
@foreach($query as $p)
<?php $no++ ;?>

<tr align = "left">
<td align = "center">{{$no}}</td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->jabatan->name}}</td>
<td align = "center">{{$p->unit->UnitName}}</td>
<td align = "center">{{$p->tanggal}}</td>
<td align = "center">{{$p->jam_pelaksanaan}}</td>
<td>{{$p->keterangan}}</td>
@if($p->is_approve =='2') 
<td>Disetujui</td>
@elseif($p->is_approve =='3') 
<td>Tidak Disetujui</td>
@else
<td>Blm Disetujui</td>
@endif

</tr>

@endforeach    
</table>
</body>
</html>



