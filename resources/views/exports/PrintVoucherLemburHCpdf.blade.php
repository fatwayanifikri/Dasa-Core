<html>
<head>
<title class="">VOUCHER LEMBUR</title>
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
<td style="width: 150px; text-align: center;font-size: 10pt;"><h3>VOUCHER LEMBUR</h3></td>
</tr>

<?php $count = 0; ?>
@foreach($query as $p)
<?php if($count == 1) break; ?>

<tr>
<td style="width: 263px;" ><h3><b>Cabang : {{$p->unit->UnitName}}</b></h3></td> -->
<?php $count++; ?>
@endforeach
</tr>

</tbody>
</table>                  
</div>
</div>
</div>

<table style="width:100% solid; border-collapse: collapse" border="1">
<thead>
<tr>
<th>No</th>
<th>Nama Pegawai</th>
<th>Unit</th>
<th>Divisi</th>
<th>Tanggal</th>
<th>Waktu</th>
<th>Total Menit</th>
<th>Status Voucher</th>
<th>Nominal</th>
<th>Nomerator</th>
<th>Tgl Pengajuan</th>
</tr> 
</thead>

<?php $no = 0;?>
@foreach($query as $p)
<?php $no++ ;?>

@php
$total += $p['NilaiVoucher'];
@endphp 

<tr align = "center">
<td>{{$no}}</td>
<td>{{$p->employee->EmployeeName}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->jabatan->name}}</td>
<td> {{ \Carbon\Carbon::parse($p->StartTime)->format('d-m-Y')}}</td>
<td> {{ \Carbon\Carbon::parse($p->StartTime)->format('H:i:s')}} - {{ \Carbon\Carbon::parse($p->EndTime)->format('H:i:s')}}</td>
<td>{{$p->AmountMinute}}</td>

@if($p->isVoucher =='1') 
<td>Dibuat</td>
@elseif($p->isVoucher =='2') 
<td>Diajukan</td>
@elseif($p->isVoucher =='3') 
<td>Dicairkan</td>
@elseif($p->isVoucher =='4') 
<td>Diterima</td>
@else
<td>Blm Dibuat</td>
@endif
            
<td>Rp. {{$p->NilaiVoucher}}</td>
<td>{{$p->NomerVoucher}}</td>
<td>{{$p->tgl_pengajuan_voucher}} </td>
</tr>
@endforeach 

<tr align = "center">
<td colspan = "8"><b>TOTAL = </td>
<td><b>Rp. {{ $total }}</td>
<td></td>
<td></td>
</tr>

</table>
</body>
</html>



