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
                            <td style="width: 310px; text-align: center;font-size: 12pt;"><h3>PT. DASA PRIMA</h3></td>
                           
                        </tr>
                        </tbody>
                    </table>
                    <p style="text-align: center;"><strong><span style="text-decoration: underline;"><center>FORM MAINTENANCE</center></span></strong></p>
                    <div class="col-sm-12">
                    
<br>
<table width="40%" align="left">
<?php $count = 0; ?>
@foreach($query as $p)
<?php if($count == 1) break; ?>
<tr>
    <td >Nama</td>
    <td>: {{$p->EmployeeName}}</td>
</tr>
<tr>
    <td>Cabang</td>
    <td>: {{$p->unit->UnitName}}</td>
</tr>
<tr>
    <td>Jenis Kendaraan</td>
    <td>: {{$p->maintenance->jenis_kendaraan}}</td>
</tr>
</table>

<table width="30%" align="right">

<tr>
    <td width="30%">No Pol</td>
    <td>: {{$p->maintenance->kendaraan->nomor_kendaraan}}</td>
</tr>
<tr>
    <td>Kilometer</td>
    <td>: {{$p->maintenance->kilometer}}</td>
</tr>
</table>
<?php $count++; ?>
@endforeach
<br>
<br>
<div class="col-sm-12">
<p style="text-align: left;">&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline;"></span></p>
<table style="width:100% solid; border-collapse: collapse" border="1">
<thead>       
<tr>
            <th width="5%">No</th>
            <th width="20%">Tanggal</th>
            <th width="40%">Nama Barang</th>
            <th width="10%">Jumlah</th>
            <th width="40%">Catatan</th>
           
        </tr>
        </thead>
        <?php $no = 0;?>
        @foreach($query as $p)
        <?php $no++ ;?>
        <tr align="center">
       <td>{{$no}}</td>
            <td>{{$p->tgl_permintaan}}</td>
            <td>{{$p->nama_barang}}</td>
            <td>{{$p->jumlah}}</td>
            <td>{{$p->catatan}}</td>
          
        </tr>
        @endforeach

    </table>
                    </div>

                    

                    <div class="col-sm-2">
                        <p style="text-align: center"center" ;"><span style="text-decoration: underline;"><strong></strong></span></p>
                    </div>
                        <table cellspacing="15" style ="width:100%;">
                            <thead class="">
                                <tr class="">
                                    <td style="text-align: center">DISETUJUI</td>
                                    <td style="text-align: center">DIPERIKSA</td>
                                    <td style="text-align: center">MENGETAHUI</td>
                                    <td style="text-align: center">MEKANIK</td>
                                </tr>
                                <tr>
                                    <td><br></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom : 1px solid; height: 10px;"></td>
                                    <td style="border-bottom : 1px solid; height: 10px"><center>Internal Audit</center></td>
                                    <td style="border-bottom : 1px solid; height: 10px"></td>
                                    <td style="border-bottom : 1px solid; height: 10px"></td>
                                </tr>


                            </thead>
                        </table>
                    </div>
                  </div>
                </div>

        
        
    </body>
</html>



