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
                            <td style="width: 150px; text-align: center;font-size: 12pt;"><h3>PT. DASA PRIMA</h3></td>
                            <td style="width: 250px; text-align: right" ><strong>RAHASIA</strong></td>
                        </tr>
                        </tbody>
                    </table>
                    
                    <p align="center">Kode Dok: 5.02.002| Revisi No:0 | Tgl.Revisi: 6 Des 2017 | Halaman: 1/3</p>
                    <p style="text-align: center;"><strong><span style="text-decoration: underline;">LEMBAR DATA PRIBADI</span></strong></p>
                    <article>
                         <p style="text-align: left;">Catatan:&nbsp;</p>
                         <p style="text-align: justify">
                            Kami sungguh menghargai ketertarikan Anda kepada perusahaan kami. Latar Belakang yang jelas dan lengkap tentang Anda akam 
                            membantu kami menetukan posisi yang sesuai dengan kualifikasi dan memungkinkan anda berkembang masa depan.
                            Anda diharapkan mengisi semua bagian dari lembar data pribadi ini dengan jujur dan benar.
                         </p>
                    </article>
                    <div class="col-sm-12">
                    <p style="text-align: left;">&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline;"><strong>A.DATA PRIBADI&nbsp;</strong></span></p>
                    <table style="height: 79px; width: 491.667px;">
                    @foreach ($dataInterview as $row)
                        <tbody>
                        <tr>
                            <td>Nama</td>
                            <td class="">:</td>
                            <td aligin="left">{{ $row->NamaPelamar}}</td>
                        </tr>
                        <tr>
                            <td>Jenis Kelamin</td>
                            <td class="">:</td>
                            <td>{{ $row->JenisKelamin}}</td>
                        </tr>
                        <tr>
                            <td>Tempat, Tanggal Lahir</td>
                            <td class="">:</td>
                            <td>{{ $row->TempatLahir}},&nbsp;{{\Carbon\Carbon::parse($row->TanggalLahir)->format('d M Y')}}</td>
                        </tr>
                        <tr>
                            <td>Agama</td>
                            <td class="">:</td>
                            <td>{{ $row->Agama}}</td>
                        </tr>
                        <tr>
                            <td>Status Perkawinan</td>
                            <td class="">:</td>
                            <td>{{ $row->StatusNikah}}</td>
                        </tr>
                        <tr>
                            <td>Alamat Saat ini</td>
                            <td class="">:</td>
                            <td>{{ $row->Alamat}}</td>
                        </tr>
                            <tr>
                            <td>Telepon Rumah/Mobile</td>
                            <td class="">:</td>
                            <td>{{ $row->TelpHp}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td class="">:</td>
                            <td>{{ $row->Email}}</td>
                        </tr>
                        <tr>
                            <td>Kewarganegaraan</td>
                            <td class="">:</td>
                            <td>Indonesia</td>
                        </tr>
                        <tr>
                            <td>Jenis SIM/No/Sim/berlaku s.d</td>
                            <td class="">:</td>
                            <td>........../................................/................</td>
                        </tr>
                        <tr>
                            <td>Tinggi dan Berat Badan</td>
                            <td class="">:</td>
                            <td>................/.................Kg</td>
                        </tr>
                        </tbody>
                        @endforeach
                    </table>
                    <div class="col-sm-12">
                    <p style="text-align: left;">&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline;"><strong>B.DATA KELUARGA</strong></span></p>
                    <table style="width:100%; border: 1px solid; border-collapse: collapse">
                        <thead>
                        <tr>
                            <th align ="center" style="border: 1px solid black; width: 100px;">Hubungan</th>
                            <th align ="center" style="border: 1px solid black;width: 200px;"> Nama</th>
                            <th align ="center" style="border: 1px solid black;width: 50px;">L/P</th>
                            <th align ="center" style="border: 1px solid black;">Usia</th>
                            <th align ="center" style="border: 1px solid black;">Pekerjaan</th>
                            <th align ="center" style="border: 1px solid black;">Alamat</th>
                        </tr>
                        </thead>
                        <tr>
                            <td style="border: 1px solid black;">Ayah</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Ibu</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Suami/Istri</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Anak#1</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Anak#2</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">Saudara Kandung</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">#1</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">#2</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">#3</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">#4</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        
                        </table>
                    </div>

                    <div class="col-sm-12">
                    <p style="text-align: left;">&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline;"><strong>B.PENDIDIKAN FORMAL</strong></span></p>
                    <table style="width:100%; border: 1px solid; border-collapse: collapse">
                        <thead>
                        <tr>
                            <th align ="center" style="border: 1px solid black; width: 100px;">Hubungan</th>
                            <th align ="center" style="border: 1px solid black;width: 200px;"> Nama Sekolah</th>
                            <th align ="center" style="border: 1px solid black;">Lokasi(Kota)</th>
                            <th align ="center" style="border: 1px solid black;width: 50px;">IPK</th>
                            <th align ="center" style="border: 1px solid black;">Jurusan</th>
                            <th align ="center" colspan="2" style="border: 1px solid black;">Waktu (Tahun)</th>
                            <th align ="center" colspan="2"  style="border: 1px solid black;">Lulus</th>
                        </tr>
                        </thead>
                        <tr>
                            <td style="border: 1px solid black;">SD</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">SMP</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">SMA/SMK</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">D1/D2/D3</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        <tr>
                            <td style="border: 1px solid black;">S1/S2</td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        </tr>
                        
                        </table>
                    </div>

                    <div class="col-sm-2">
                        <p style="text-align: center"center" ;"><span style="text-decoration: underline;"><strong>PENDIDIKAN NON FORMAL / PELATIHAN BERSERTIFIKAT NAMA/JENIS</strong></span></p>
                    </div>
                        <table cellspacing="15" style ="width:100%;">
                            <thead class="">
                                <tr class="">
                                    <td style="text-align: center">NAMA / JENIS</td>
                                    <td style="text-align: center">PENYELENGGARA</td>
                                    <td style="text-align: center">PERIODE</td>
                                </tr>
                               
                                <tr>
                                    <td style="border-bottom : 1px solid; height: 10px;"></td>
                                    <td style="border-bottom : 1px solid; height: 10px"></td>
                                    <td style="border-bottom : 1px solid; height: 10px"></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom : 1px solid; height: 10px;"></td>
                                    <td style="border-bottom : 1px solid; height: 10px"></td>
                                    <td style="border-bottom : 1px solid; height: 10px"></td>
                                </tr>
                                <tr>
                                    <td style="border-bottom : 1px solid; height: 10px;"></td>
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



