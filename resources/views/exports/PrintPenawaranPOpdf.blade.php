<html>
<head>
<title class="">Faktur Penawaran</title>
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
                    font-size: 15px;
                    font-family: font-family: "Times New Roman";;
                }

                td{
                    font-size: 15px;
                    font-family: font-family: "Times New Roman";;
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

<!-- KAP CABANG -->
@foreach($query as $j)
@if($j->Sales_Unit == 1 or $j->Sales_Unit == 2)
<img src="{{asset('picture/kap_dpress.png') }}"style="width:100%">
@elseif($j->Sales_Unit == 3)
<img src="{{asset('picture/kap_aladdin.png') }}"style="width:100%">
@elseif($j->Sales_Unit == 4)
<img src="{{asset('picture/kap_buring.png') }}"style="width:100%">
@elseif($j->Sales_Unit == 5)
<img src="{{asset('picture/kap_cano.png') }}"style="width:100%">
@elseif($j->Sales_Unit == 6)
<img src="{{asset('picture/kap_data.png') }}"style="width:100%">
@elseif($j->Sales_Unit == 7)
<img src="{{asset('picture/kap_era.png') }}"style="width:100%">
@elseif($j->Sales_Unit == 8)
<img src="{{asset('picture/kap_fast.png') }}"style="width:100%">
@else
@endif
@endforeach

<br></br>
<br></br>
 

@foreach($query as $geralt)  

<!-- NOMOR & PERIHAL -->
<table style="margin-left:10px; width: 100%;" >
<tr>
<td>NOMOR</td>
<td style="margin-left:10px; width: 100%;">: {{$geralt->Nomor_Penawaran}}</td>
</tr>
<tr>
<td>PERIHAL</td>
<td>: {{$geralt->Perihal}}</td>
</tr>
</table>

<br></br>

<!-- Yang terhormat -->
<table style="margin-left:10px; width: 100%;" >
<tr>
<td>Kepada YTH</td>
</tr>
<tr>
<td>{{$geralt->CustomerName}}</td>
</tr>
<tr>
<td>{{$geralt->CompanyName}}</td>
</tr>
</table>
@endforeach

<br>
</br>

<table style="margin-left:10px; width: 100%;" >
<tr>
<td>Dengan hormat,</td>
</tr>
<tr>
<td style = "text-align: justify;">Salam sejahtera Bapak/Ibu, bersama surat ini kami bermaksud untuk menindaklanjuti permintaan penawaran harga cetak sesuai dengan spesifikasi yang diinginkan. Berikut ini penawaran harganya dari kami :</td>
</tr>
</table>

<br>
</br>

<!-- TABLE BARANG QUERRY2 -->

<table style= "border-collapse: collapse; width: 100%;margin-left:10px;" border="1">
<thead >      
<tr>
<th width="5%"><center>No</center></th>
<th><center>Nama Barang</center></th>
<th width="10%"><center>Jumlah</center></th>
<th width="20%"><center>Harga/pcs</center></th>
<th width="20%"><center>Total</center></th>
</tr>

<?php $no = 0;?>
@foreach($query2 as $p)
<?php $no++ ;?>

@if($p->is_pajak =='2') 
@php
$sblm_pajak += $p['total_harga'];
$kena_pajak  = (11 / 100) * $sblm_pajak;
$grand_total = $sblm_pajak + $kena_pajak;
@endphp 

@else
@php
$sblm_pajak += $p['total_harga'];
$kena_pajak  = 0;
$grand_total = $sblm_pajak + $kena_pajak;
@endphp
@endif

<tr align="center">
<td>{{$no}}</td>
<td align ="left">{{$p->nama_barang}}</td>
<td>{{$p->jumlah_barang}}</td>
<td align ="right"><span style="float: left; clear: both">Rp.</span>{{number_format($p->harga_barang)}}</td>
<td align ="right"><span style="float: left; clear: both">Rp.</span>{{number_format($p->total_harga)}}</td> 
</tr>

<tr>
<td></td>
<td align ="left">{{$p->detail_barang}}</td>
<td></td>
<td></td>
<td></td>
</tr>

@endforeach

<tr>
<td colspan = "4" align ="left"><b>TOTAL</td>
<td align ="right"><b><span style="float: right; clear: both">Rp.</span><span>{{number_format($sblm_pajak) }}</span></td>
</tr>

<tr>
<td colspan = "4" align ="left"><b>PAJAK 11%</td>
<td align ="right"><b><span style="float: right; clear: both">Rp.</span><span>{{ number_format($kena_pajak) }}</span></td>
</tr>

<tr>
<td colspan = "4" align ="left"><b>GRAND TOTAL</td>
<td align ="right"><b><span style="float: right; clear: both">Rp.</span><span>{{ number_format($grand_total) }}</span></td>
</tr>

</thead>
</table>
<br></br>

<!-- PENUTUP -->
<table style="margin-left:10px; width: 100%;" >
@if($kena_pajak =='0') 
<tr>
<td><i></i></td>
</tr>
@else
<tr>
<td><i>*harga tersebut sudah termasuk Ppn 11%</i></td>
</tr>
@endif
</table>

<br></br>

<table style="margin-left:10px; width: 100%;" >
<tr>
<td style = "text-align: justify;">Demikian penawaran harga dari kami, semoga sesuai dengan yang diharapkan dan kami tunggu kabar baiknya. Terima Kasih.</td>
</tr>
</table>

<br></br>

<!-- <div class="col-sm-2">
<p style="text-align: center"center" ;"><span style="text-decoration: underline;"><strong></strong></span></p>
</div>
 -->
<table cellspacing="15" style ="width:100%;margin-left:10px;">
<thead class="">
<tr class="">@foreach($query as $q) 
<td style="text-align: center">Mengetahui,</td>
<td></td>
<td style="text-align: center">Depok, {{\Carbon\Carbon::parse($q->tgl_request)->format(' d F Y')}}<p>Hormat Kami</p></td>
</tr>

<tr>
<td><br></td>
<td></td>
<td></td>
</tr>

<tr>
<td><center><i>Store Manager</i></center></td>
<td></td>
<td><center>{{$q->sales->EmployeeName}}<p><i>Sales Marketing</p></i></center></td>
</tr>@endforeach



</thead>
</table>
</div>
</div>
</div>

</body>
</html>



