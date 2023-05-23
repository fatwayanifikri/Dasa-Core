<html>
<head>
<title class="">Form Meninggalkan Pekerjaan</title>
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
<td style="width:170px; text-align: center;font-size: 12pt;"><h3>PT. DASA PRIMA</h3></td>
</tr>
</tbody>
</table>
<p style="text-align: center;"><strong><span style="text-decoration: underline;"><center>FORM MENINGGALKAN PEKERJAAN</center></span></strong></p>
<div class="col-sm-12">
                    
<div class="col-sm-12">
<p style="text-align: left;">&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline;"></span></p>
<table style="width:100% solid; border-collapse: collapse; align:center;" border="0">


@foreach($query as $p)     
<tr>
<td align="left" width="30%"><b>Karyawan</td>
<td align="left">: {{$p->employee->EmployeeName}}</td>
</tr>

<tr>
<td align="left"><b>Jabatan</td>
<td align="left">: {{$p->jabatan->name}}</td>
</tr>

<tr>
<td align="left"><b>Unit</td>
<td align="left">: {{$p->unit->UnitName}}</td>
</tr>

<tr>
<td align="left"><b>Tanggal Pelaksanaan</td>

@if(\Carbon\Carbon::parse($p->EndDate)->format('d F Y') == \Carbon\Carbon::parse($p->StartDate)->format('d F Y'))
<td>: {{$p->StartDate ? \Carbon\Carbon::parse($p->StartDate)->format('d F Y') : null}}</td>

@elseif(\Carbon\Carbon::parse($p->EndDate)->format('d F Y') != \Carbon\Carbon::parse($p->StartDate)->format('d F Y'))
<td>: {{$p->StartDate ? \Carbon\Carbon::parse($p->StartDate)->format('d F Y') : null}} - 
{{$p->EndDate ? \Carbon\Carbon::parse($p->EndDate)->format('d F Y') : null}}</td>

@else
<td>: {{$p->tgl_pengajuan? \Carbon\Carbon::parse($p->tgl_pengajuan)->format('d F Y') : null}}</td>

@endif
</tr>

<!-- <tr>
<td align="left"><b>Jam Pelaksanaan</td>
<td>: {{ \Carbon\Carbon::parse($p->tgl_pengajuan)->format('H:i:s')}}</td>
</tr> -->

<tr>
<td align="left"><b>Keperluan</td>
<td align="left">: {{$p->keperluan}}</td>
</tr>

<tr>
<td align="left"><b>Keterangan</td> 
<td align="left">: {{$p->keterangan}}</td>         
</tr>
@endforeach
</table>
</div>

<br>
</br>

<div class="col-sm-2">
<p style="text-align: center"center" ;"><span style="text-decoration: underline;"><strong></strong></span></p>
</div>
<table cellspacing="15" style ="width:100%;">
<thead class="">
<tr class="">
<td style="text-align: center">MANAGER</td>
<td style="text-align: center">HR MANAGER</td>
<td style="text-align: center">PEMOHON</td>
</tr>

<tr>
<td><br></td>
<td></td>
<td></td>
</tr>

<tr>@foreach($query as $p) 

<td style="border-bottom : 1px solid; height: 10px;">
<center>{{ ($p->isApproved == 2) ? 'Disetujui' : 'Blm Di Setujui'}}</center></td>
                                    
<td style="border-bottom : 1px solid; height: 10px">
<center>{{ ($p->isApproved == 2) ? 'Disetujui' : 'Blm Di Setujui'}}</center></td>

<td style="border-bottom : 1px solid; height: 10px">
<center>{{$p->employee->EmployeeName}}</center></td>
                                    
@endforeach</tr>

</thead>
</table>
</div>
</div>
</div>

</body>
</html>



