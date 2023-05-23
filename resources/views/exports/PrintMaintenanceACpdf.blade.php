<html>
    <head>
        <title class="">Print AC</title>
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
<table>

<tbody>
<tr>
<td style="width: 263px;" ><img src="{{asset('picture/dasaprima.png') }}"style="width:40px;height:40px;"></td> -->
<td style="width: 500px; text-align: center;font-size: 12pt;"><h2>PT. DASA PRIMA</h2></td>
</tr>
<tr> 
<td></td>
<td style="width: 500px; text-align: center;font-size: 10pt;"><h3>MAINTENANCE AC</h3></td>
</tr>
</tbody>
</table>            

</div>
</div>
</div>
<br>
<table style="width:100% solid; border-collapse: collapse" border="1" >

<?php $no = 0;?>
@foreach($query->groupBy('maintenance_ac_id') as $col)
<?php $no++ ;?>

<tr align="center">
<td><b>No</td>
<td><b>Kode MB</td>
<td><b>Nama AC</td>
<td><b>Unit</td>
<td><b>Jadwal Ke</td>
<td><b>Bulan</td>
<td><b>Jadwal Realisasi</td>  
</tr>


@foreach($col->sortBy('jadwal_ke') as $p)

<tr align="center">
<td >{{$no}}</td>
<td>{{$p->maintenance->kode_mb}}</td>
<td>{{$p->maintenance->nama_ac}}</td>
<td>{{$p->unit->UnitName}}</td>
<td>{{$p->jadwal_ke}}</td>
<td>{{$p->tgl_maintenance}}</td>
<td>{{$p->tgl_realisasi}}</td>
@endforeach          
</tr>
<tr>
<td colspan="7" height="10px"></td>

</tr>
@endforeach  
</table>




</body>
</html>



