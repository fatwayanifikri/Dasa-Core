<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title class="">Faktur Penawaran</title>
<head>

<link rel="stylesheet" href="main.css" />
<link rel="stylesheet" media="print" href="print.css" />  
<link href="//db.onlinewebfonts.com/c/b98bc93446cb32ed61774ea8735f8836?family=barcode+font" rel="stylesheet" type="text/css"/>

<style type=text/css>

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
                
               h3{
                    font-size: 15px;
                    font-family: font-family: "Times New Roman";;
                    
                }

@font-face {font-family: "barcode font"; src: url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.eot"); src: url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.eot?#iefix") format("embedded-opentype"), url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.woff2") format("woff2"), url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.woff") format("woff"), url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.ttf") format("truetype"), url("//db.onlinewebfonts.com/t/b98bc93446cb32ed61774ea8735f8836.svg#barcode font") format("svg"); }

.barcode {
    font-family: barcode font;
    font-size: 15px;
}


               h5{
                    font-size: 12px;
                    font-family: font-family: "Times New Roman";;
                    
                }

                p{
                    font-size: 12px;
                    line-height: 5px; 
                    font-family: font-family: "Times New Roman";;
                }
                td{
                    font-size: 12px;
                    font-family: font-family: "Times New Roman";;
                }
                thead{
                    font-size: 15px;
                    font-family: font-family: "Times New Roman";;

                }
                .underline {
                    border-bottom: 1px solid #000;
                }
</style>         
</head>
<body>

<!-------------------HEADER--------------------->

<table style="width:100%;margin-top: -10%; " align="center">
<thead>
<tr>
@foreach($query as $j)
@if($j->Sales_Unit == 1 or $j->Sales_Unit == 2)
<td width="240px"><img src="{{asset('picture/Depress.png') }}"style="width:200px"></td>
@elseif($j->Sales_Unit == 3)
<td width="240px"><img src="{{asset('picture/Aladdin.png') }}"style="width:200px"></td>
@elseif($j->Sales_Unit == 4)
<td width="240px"><img src="{{asset('picture/Buring.png') }}"style="width:200px"></td>
@elseif($j->Sales_Unit == 5)
<td width="240px"><img src="{{asset('picture/Cano.png') }}"style="width:200px"></td>
@elseif($j->Sales_Unit == 6)
<td width="240px"><img src="{{asset('picture/Data.png') }}"style="width:200px"></td>
@elseif($j->Sales_Unit == 7)
<td width="240px"><img src="{{asset('picture/Era.png') }}"style="width:200px"></td>
@elseif($j->Sales_Unit == 8)
<td width="240px"><img src="{{asset('picture/Fast.png') }}"style="width:200px"></td>
@else
@endif

<th align="center"><h2><b>FAKTUR</b></h2></th>
<td align="right"><div class="barcode"><b>{{$j->Nomor_faktur}}</div><h3><p>Ditinggal {{$j->updated_at? \Carbon\Carbon::parse($j->updated_at)->format('d F Y') : null}}</p></h3></td>
</tr>
</thead>
</table>

<table style="width:55%; float: right; margin-top:1%;">
<tr>
<td width="35%">Nama - Telp</td>
<td>: <b>{{$j->CustomerName}}</b> - {{$j->CustomerPhoneNumber}}</td>
</tr>

<tr>
<td width="35%">No.Rak/Tgl Selesai</td>
<td>: {{$j->updated_at? \Carbon\Carbon::parse($j->updated_at)->format('d F Y H:i') : null}}</td>
</tr>

<tr>
<td width="35%">Alamat</td>
<td>: {{$j->CustomerAddress}}</td>
</tr>
</table>
@endforeach 

<!----------------TABLE BARANG QUERRY2------------------->

<br><br><p>Catatan:</p>

<table style= "border-collapse: collapse; width: 100%;" border="1">  

<tr>
<td width="10%"><center>Judul Buku</center></td>
<td width="3%"><center>Banyak</center></td>
<td width="10%"><center>Deskripsi Barang</center></td>
<td width="3%"><center>Kts</center></td>
<td width="5%"><center>Harga</center></td>
<td width="5%"><center>Jumlah</center></td>
</tr>


@foreach($query2 as $p)

@if($p->is_pajak =='2') 
@php
$sblm_pajak += $p['total_harga'];
$kena_pajak  = (10 / 100) * $sblm_pajak;
$grand_total = $sblm_pajak + $kena_pajak;
@endphp 

@else
@php
$sblm_pajak += $p['total_harga'];
$kena_pajak  = 0;
$grand_total = $sblm_pajak + $kena_pajak;
@endphp 
@endif

<tr>
<td align ="left">{{$p->nama_barang}}</td>
<td align ="left">{{$p->jumlah_barang}}</td>
<td align ="left">{{$p->detail_barang}}</td>
<td align ="right">{{$p->jumlah_barang}}</td>
<td align ="right">{{number_format($p->harga_barang)}}</td>
<td align ="right">{{number_format($p->total_harga)}}</td> 
</tr>
@endforeach
</table>

<!---------------------FOOTER----------------------->

<table style= "border-collapse: collapse; width: 100%;">  

<!-- BAGIAN ATAS -->

<tr>
<td colspan="3" rowspan="4" align="justify" style="font-size: 12px;"><b>
- Nilai transaksi di bawah Rp 250.000,-Wajib Tunai<br>
- Barang yang sudah tercetak tidak bisa dibatalkan<br>
- DP 50% untuk setiap transaksi<br>
- Transfer yang DIAKUI hanya NOMOR REKENING yang tertera di faktur<br>
- Kami Tidak bertanggung jawab atas pelanggaran hak cipta
</td>
<td colspan = "2" align ="right" width="90px">Jumlah :</td>
<td align ="right"><b>{{ number_format($sblm_pajak) }}</td>
</tr>

<tr>
<td colspan = "2" align ="right">Diskon 10% :</td>
<td align ="right"><b>{{ number_format($kena_pajak) }}</td>
</tr>

<tr>
<td colspan = "2" align ="right">Total :</td>
<td align ="right"><b>{{ number_format($grand_total) }}</td>
</tr>

<tr>
<td colspan = "2" align ="right">PPN :</td>
<td align ="right"><b>{{ number_format($grand_total) }}</td>
</tr>

<!-- BAGIAN BAWAH -->

<tr>
<td rowspan="5" align="justify" style="font-size: 12px;">
BCA PT.DASA PRIMA 8691392121<br>
KCU. MARGONDA
</td>

<!--------------------->
<td colspan="2" rowspan="5">

<table align="center" width="100%">
<tr align="center"><td>Pemesan</td><td>Kasir</td><td>Kabag/SPV</td></tr>
<tr><td><br><br></td></tr>
<tr align="center"><td>(.................)</td><td>(.................)</td><td>(.................)</td></tr>
</table>

</td>

<!--------------------->

<td colspan = "2" align ="right">Potongan :</td>
<td align ="right"><b>{{ number_format($sblm_pajak) }}</td>
</tr>

<tr>
<td colspan = "2" align ="right">Tertagih :</td>
<td align ="right" class="underline"><b>{{ number_format($kena_pajak) }}</td>
</tr>

<tr>
<td colspan = "2" align ="right">Sudah Bayar :</td>
<td align ="right"><b>{{ number_format($grand_total) }}</td>
</tr>

<tr>
<td colspan = "2" align ="right">Pembayaran :</td>
<td align ="right" class="underline"><b>{{ number_format($grand_total) }}</td>
</tr>

<tr>
<td colspan = "2" align ="right">Sisa :</td>
<td align ="right"><b>{{ number_format($grand_total) }}</td>
</tr>

</table>

</body>
</html>



