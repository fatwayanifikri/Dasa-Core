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
                    word-break: break-all;
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

<!---------------------KAP DOKUMEN------------------>

<table style="border-collapse: collapse; width:100%;" border="">
<tbody>
<tr>
<td style="width: 100px;" ><center><img src="{{asset('picture/dasaprima.png') }}"style="width:40px;height:40px;"></center></td>
<td style="width: 300px; text-align: center;font-size: 12pt;"><h3>PENILAIAN HASIL TEST PRAKTIK</h3></td>

<td style="width: 100px; text-align: center;">
<table style="border-collapse: collapse;width:100%;font-size: 10px; " border="">
<tr>
<td style="font-size: 10px;">Revisi No</td>
<td style="font-size: 10px;">:</td>
</tr>
<tr>
<td style="font-size: 10px;">Tgl Revisi</td>
<td style="font-size: 10px;">: {{\Carbon\Carbon::now()->format('d M Y')}}</td>
</tr>
<tr>
<td style="font-size: 10px;">Halaman</td>
<td style="font-size: 10px;">:</td>
</tr>
</table>
</td>

</tr>

</tbody>
</table>
@foreach ($data2 as $row)
<strong><span style="text-decoration:;"><center>{{ $row->name}}</center></span></strong>
@endforeach

<br><br>

<!---------------------TABLE DATA PELAMAR------------------>
<div class="col-sm-12">
<table style="height: 79px; width: 491.667px; margin-left: 40px;">
@foreach ($data2 as $row)
<tbody>
<tr>
<td>Tanggal</td>
<td class="">:</td>
<td aligin="left">{{\Carbon\Carbon::now()->format('d M Y')}}</td>
</tr>
<tr>
<td>Nama</td>
<td class="">:</td>
<td aligin="left">{{ $row->NamaPelamar}}</td>
</tr>
<tr>
<td>Alamat</td>
<td class="">:</td>
<td>{{ $row->Alamat}}</td>
</tr>
<tr>
<td>No Telp</td>
<td class="">:</td>
<td>{{ $row->TelpHp}}</td>
</tr>
<tr>
<td>Cabang</td>
<td class="">:</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Nomor Dokumen</td>
<td class="">:</td>
<td>&nbsp;</td>
</tr>
<tr>
<td>Kesehatan Mata</td>
<td class="">:</td>
<td>&nbsp;</td>
</tr>

</tbody>
@endforeach
</table>

<br>
<!---------------------TABLE KRITERIA PENILAIAN------------------>
<table style="width: 100%;margin-left: 20px; border-collapse: collapse;" border="1">
<thead><tr>
<th>No</th>
<th>Kriteria Penilaian</th>
<th>A</th>
<th>B</th>
<th>C</th>
<th>D</th>
</tr></thead>

<tr>
<td align="center">1</td>
<td>Penampilan diri</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td align="center">2</td>
<td>Kebersihan diri dan menjaga kebersihan tempat kerja</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td align="center">3</td>
<td>Aktif dalam berbicara dengan konsumen atau karyawan lain</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td align="center">4</td>
<td>Suara jelas, antusias, dan semangat</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td align="center">5</td>
<td>Sikap tanggal ingin membantu konsumen atau karyawan lain</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td align="center">6</td>
<td>Melayani konsumen atau karyawan lain dengan sigap, cepat, dan tuntas</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td align="center">7</td>
<td>Menguasai pekerjaan</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr>
<td align="center">8</td>
<td>Tanggung jawab terhadap pekerjaan</td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>
</table>

<br>
<!---------------------TABLE KETERANGAN------------------>
<table style="margin-left: 20px; border-collapse: collapse;" border="">
<tr>
<td>A</td>
<td>=</td>
<td>Sangat Baik</td>
</tr>

<tr>
<td>B</td>
<td>=</td>
<td>Baik</td>
</tr>

<tr>
<td>C</td>
<td>=</td>
<td>Cukup</td>
</tr>

<tr>
<td>D</td>
<td>=</td>
<td>Kurang</td>
</tr>
</table>

<br>
<!---------------------TABLE TANDA TANGAN------------------>
<table style="width: 100%;margin-left: 20px; border-collapse: collapse; text-align: center;" border="">
<tr>
<td style="width: 200%;">PENILAI I</td>
<td style="width: 100%;">&nbsp;</td>
<td style="width: 200%;">PENILAI II</td>
</tr>

<tr>
<td >&nbsp;</td>
<td style="height: 10%;">&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td>KABAG</td>
<td>&nbsp;</td>
<td>(STORE MANAGER)</td>
</tr>
</table>

<br><br><br><br><br>
<!---------------------TABLE PERNYATAAN KARYAWAN------------------>
<table style="margin-left: 20px; border-collapse: collapse; text-align: center; " border="">
<tr>
<td>Pernyataan Bahwa YBS. Bersedia Melakukan Test Praktik</td>
</tr>

<tr>
<td  style="height: 12%">&nbsp;</td>
</tr>

<tr>
<td>(...........................................................)</td>
</tr>

<tr>
<td>Nama Kandidat</td>
</tr>
</table>

</div>
</div>
</div>

        
        
</body>
</html>



