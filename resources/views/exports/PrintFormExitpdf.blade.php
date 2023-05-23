<html>
    <head>
        <title class="">Form Exit Interview</title>
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
              
    </style>

           
    </head>
    <body>
                  <div class="container">
                  <div class="col-sm-12">
                    <div class=""></div>
                    <center><h4><ul>SURAT PENGUNDURAN DIRI</ul></h3></center>
                    
                    
                    <div class="col-sm-12">
                    <p style="text-align: left;">Dengan ini saya yang bertandatangan dibawah ini :</span></p>
                    @foreach($query as $p)
                    <table style=" border: 0px solid; border-collapse: collapse">
                        <tr>
                            <td style="border: 0px solid black; width:20%;">Nama</td>
                            <td style="border: 0px solid black;width:5%;">:</td>
                            <td style="border: 0px solid black;">{{$p->EmployeeName}}</td>
                            
                        </tr>
                        <tr>
                            <td style="border: 0px solid black;">Bagian</td>
                            <td style="border: 0px solid black;">:</td>
                            <td style="border: 0px solid black;">{{$p->jabatan->name}}</td>
                            
                        </tr>
                        <tr>
                            <td style="border: 0px solid black;">Cabang</td>
                            <td style="border: 0px solid black;">:</td>
                            <td style="border: 0px solid black;">{{$p->unit->UnitName}}</td>
                           
                        </tr>
                        <tr>
                            <td style="border: 0px solid black;">Usia</td>
                            <td style="border: 0px solid black;">:</td>
                            <td style="border: 0px solid black;">{{$p->Usia}} Tahun</td>
                           
                        </tr>
                        <tr>
                            <td style="border: 0px solid black;">Alamat</td>
                            <td style="border: 0px solid black;">:</td>
                            <td style="border: 0px solid black;">{{$p->Alamat}}</td>
                           
                        </tr>
                        <tr>
                            <td style="border: 0px solid black;">Alasan Resign</td>
                            <td style="border: 0px solid black;">:</td>
                            <td style="border: 0px solid black;">{{$p->Alasan}}</td>
                           
                        </tr>
                       
                        </table>
                    </div>
                    <p style="text-align: left;">Demikian surat ini saya buat, atas perhatian dan kerjasamanya saya ucapkan terimakasih.</span></p>
                    <br></br>
                    <p style="text-align: left;">Depok, {{ \Carbon\Carbon::parse($p->created_at)->format('d-m-Y')}}
                    <br></br>
                    <p style="text-align: left;">Yang mengundurkan diri,</span></p>
                    <br></br>
                    <br></br>
                    <br></br>
                    <br></br>
                    <p style="text-align: left;">{{$p->EmployeeName}}<</span></p>
                    </div>
                  </div>
                </div>
                @endforeach
    
    </body>
</html>



