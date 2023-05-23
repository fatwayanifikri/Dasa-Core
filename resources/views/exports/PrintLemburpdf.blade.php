<html>
<head>
<title class="">Print Asset</title>
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
<td style="width: 150px; text-align: center;font-size: 10pt;"><h3>DATA LEMBUR</h3></td>
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
<th>Unit</th>
<th>Jabatan</th>
<th>Shift</th>
<th>Jadwal Lembur</th>
<th>Menit Lemburan</th>
<th>Approve Lembur</th>
<th>Status Voucher</th>
<th>Nomor Voucher</th>
</tr> 
</thead>

<?php $no = 0;?>
@foreach($query as $p)
<?php $no++ ;?>

<tr align = "center">
            <td>{{$no}}</td>
            <td>{{$p->employee->EmployeeName}}</td>
            <td>{{$p->unit->UnitName}}</td>
            <td>{{$p->jabatan->name}}</td>
            <td>{{$p->shift}}</td>
            <td>{{$p->StartTime}} - {{ \Carbon\Carbon::parse($p->EndTime)->format('H:i:s')}}</td>
            <td>{{$p->AmountMinute}}</td>
            <td>{{ ($p->isApproved == 1) ? 'Setuju' : 'Blm Di Setujui'}}</td>
            @if($p->isVoucher =='1') 
            <td>Dibuat</td>
            @elseif($p->isVoucher =='2') 
            <td>Diajukan</td>
            @elseif($p->isVoucher =='3') 
            <td>Dicairkan</td>
            @elseif($p->isVoucher =='4') 
            <td>Diterima</td>
            @elseif($p->AmountMinute <= 239) 
            <td>Non Voucher</td>
            @else
            <td>Blm Dibuat</td>
            @endif
            <td>{{$p->NomerVoucher}}</td>
</tr>

@endforeach
</table>
</body>
</html>



