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
<td style="width: 150px; text-align: center;font-size: 12pt;"><h2>PT. DASA PRIMA</h2></td>
</tr>
<tr> 
<td></td>
<td style="width: 150px; text-align: center;font-size: 10pt;"><h3>ASSET LOGISTIK</h3></td>
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
<th>Kode Asset</th>
<th>Nama Asset</th>
<th>Kategori</th>
<th>Unit</th>
<!-- <th>Kondisi</th> -->
<th>Tanggal Pemakaian</th>
<th>Tanggal Pembelian</th>
<!-- <th>Keterangan</th> -->
</tr>

</thead>
<?php $no = 0;?>
@foreach($query as $p)
<?php $no++ ;?>
<tr>
<td>{{$no}}</td>
<td>{{$p->aset->kode}}</td>
<td>{{$p->aset->nama}}</td>
<td>{{$p->aset->kategori->kategori_name}}</td>
<td>{{$p->aset->unit->UnitName}}</td>
<!-- <td>{{$p->kondisi}}</td> -->
<td>{{$p->tgl_pemakaian}}</td>
<td>{{$p->tgl_pembelian}}</td>
<!-- <td>{{$p->keterangan}}</td>   -->     
</tr>
@endforeach

</table>
</body>
</html>



