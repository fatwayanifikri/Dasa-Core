<html>
<head>
<title class="">Print Penawaran</title>
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
                tdead{
                    font-size: 12px;
                    font-family: Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;

                }
</style>
</head>

<body>
<div class="container">
<div class="col-sm-12">
<div class=""></div>
<center><h3>REPORT PENAWARAN HARGA</h3>
</div>
</div>
<br>

<table style="width:100% solid; border-collapse: collapse" border="1">

<!-- GROUPING BY NAMA/NOPOL_ID -->

@foreach($printpenawaran->groupBy('month') as $tgl)
<tr align="left">

<td colspan="14" rowspan="2"><b>{{$tgl[0]['month']}}</b></td>
</tr>
<tr>
<td><br><br></td>
</tr>


<tr>
<td>Nomor Dokumen</td>
<td>Unit</td>
<td>Sales</td>
<td>Tgl Request</td>
<td>Company Name</td>
<td>Status</td>             
</tr>


@foreach($tgl as $p)
<tr>
<td>{{$p->Nomor_Penawaran}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->sales->EmployeeName}}</td>
<td>{{ \Carbon\Carbon::parse($p->tgl_request)->format('d-m-Y')}}</td>
<td>{{$p->CompanyName}}</td>

@if($p->Status =='1') 
<td>Blm Disetujui</td>
@elseif($p->Status =='2') 
<td>Disetujui SM</td>
@elseif($p->Status =='3') 
<td>Disetujui Customer</td>
@else
<td>Faktur Sudah Dibuat</td>
@endif 

@endforeach
</tr>
@endforeach


</table>

</div>
</body>
</html>



