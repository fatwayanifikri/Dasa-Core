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
                margin: 1 auto;
                margin-bottom: 0.5cm;
                margin-left:  1cm;
                margin-right:  1cm;
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
                    font-family: Calibri,Candara,Segoe,Segoe UI,Optima,"Times New Roman";
                    
                }

                p{
                    font-size: 13px;
                    font-family: Calibri,Candara,Segoe,Segoe UI,Optima,"Times New Roman";
                }

                td{
                    font-size: 13px;
                    font-family: Calibri,Candara,Segoe,Segoe UI,Optima,"Times New Roman";
                }
                thead{
                    font-size: 14px;
                    font-family: Calibri,Candara,Segoe,Segoe UI,Optima,"Times New Roman";
                }
    </style>
    </head>
    <page>
    <body>
                <div class="container">
                  <div class="col-sm-12">
                    
                    
                    <p align="center"><span style="color: #999999;">Kode Dok : 5.02.007 | Revisi No : 0 | Tgl. Revisi : 6 Des 2017 | Halaman : 1 / 1</span></p>
                    <p style="text-align: center;"><strong><span style="text-decoration: underline"><font size="6">NOTA DINAS</font></span></strong></p>
                    <p style="text-align: center;"><span style="text-decoration"><font size="2"><strong>No.001/ND/PERS/I/2020</strong></font></span></p>
                    
                    <div class="col-sm-12">
                      @foreach ($dataNotadinas as $p)
                    <table style="height: 79px; width: 1080.667px;">
                   
                      
                        <tbody>
                        <tr>
                        <td>Dari</td>
                        <td class="">:</td>
                        <td aligin="left"><strong>Manager  Sumber Daya Manusia (SDM)</strong></td>
                        </tr>
                        <tr>
                        <td>Kepada</td>
                        <td class="">:</td>
                        <td aligin="left">{{ $p->EmployeeName }}</td>
                        </tr>
                        
                        <tr>
                        <td>Perihal</td>
                        <td class="">:</td>
                        <td aligin="left">Penempatan Karyawan Baru Posisi {{$p ->name }}</td>
                        </tr>
                      
                    </table>
                  </tbody>
                
                 <hr/>
                 
               
                 <article>
                  <p style="text-align: justify">Sehubungan hasil Test/Seleksi penerimaan karyawan baru, maka yang
                    tersebut dibawah ini dinyatakan <strong><font color="#0000CD"><u> BERHASIL</u></font></strong> dan dapat diterima sebagai Calon Karyawan guna mengisi lowongan bagian {{$p ->name }} :</td>
                  </p></article>

                    <table style="height: 79px; width: 570.667px;">
                      <tbody>
                      <tr>
                      <td>Nama</td>
                      <td class="">:</td>
                      <td aligin="left">{{$p ->EmployeeName }}</td>
                      </tr>
                      
                      <tr>
                        <td>Tempat Lahir</td>
                        <td class="">:</td>
                        <td aligin="left">{{$p ->TempatLahir }}</td>
                        </tr>
                      <tr>
                      <td>Tanggal Lahir</td>
                      <td class="">:</td>
                      <td aligin="left">{{$p ->TanggalLahir }}</td>
                      </tr>
                      @endforeach
                      @foreach ($dataNotadinas as $e )
                      <tr>
                        <td>Pendidikan</td>
                        <td class="">:</td>
                        <td aligin="left">{{ $e ->EducationName }}</td>
                        </tr>
                      @endforeach
                      @foreach ($dataNotadinas as $p)
                      
                      <tr>
                      <td>Temapat Tinggal</td>
                      <td class="">:</td>
                      <td aligin="left">{{$p ->AlamatRumah }}</td>
                      </tr>
                      <tr>
                      <td>Masuk Kerja</td>
                      <td class="">:</td>
                      <td aligin="left">{{\Carbon\Carbon::parse($p ->Start)->format('d, M Y') }}</td>
                      </tr>
                      <tr>
                      <td>Status Karyawan</td>
                      <td class="">:</td>
                      <td aligin="left">{{$p ->StatusName }}</td>
                      </tr>
                      <tr>
                      <td>Lama Kontrak</td>
                      <td class="">:</td>
                      <td aligin="left">{{\Carbon\Carbon::parse($p ->Start)->format('d, M Y') }} - {{\Carbon\Carbon::parse($p ->End)->format('d, M Y') }}</td>
                      </tr>
                      <tr>
                      <td>Pakaian Kerja</td>
                      <td class="">:</td>
                      <td aligin="left"><i>Baju kerja kemeja dan celana/rok bahan hitam</i></td>
                      </tr>
                      </tbody>
                      <td></td>
                      </tr>
                    </table>
                    <br>
        
                    <table style="height: 5px; width: 650.667px;">
                      <tbody>
                      <tr>
                      <td class="">Selama masa percobaan, apabila yang bersangkutan kurang menunjukkan disiplin kerja dan kinerja yang baik, maka sewaktu – waktu dapat diberhentikan sebelum masa percobaan berakhir.</td>
                      </tr>
                      </tbody>
                    </table>
                     <br>
                    <table style="height: 5px; width: 667.667px;">
                      <tbody>
                      <tr>
                      <td class="">Untuk selanjutnya kepada <strong> Store Manager Cabang </strong> {{$p ->UnitName }}  segera menempatkan dan memberi pelatihan kepada calon karyawan tersebut sesuai dengan tugasnya.</td>
                      </tr>
                      </tbody>
                    </table>
       @endforeach<br>
                    <table style="height: 2px; width: 667.667px;">
                      <tbody>
                      <tr>
                      <td class="">Demikian untuk dilaksanakan dengan sebaik-baiknya.</td>
                      </tr>
                      </tbody>
                    </table>
                    <br>
                    <table style="height: 21px; width: 400.667px;"> 
                      <tbody>
                      <tr>    
                      <td aligin="left">Depok,&nbsp;<?php
                        echo date("d F Y") . "<br>";
                      ?></td>
                      </tr>
                      </table>
                      <table style="height: 20px; width: 570.667px;">
                          <tbody>
                          <tr>
                          <td>HR, GA Manager</td>
                          </tr>
                          </tbody>
                          </table>
                          <br><br>
                      <table style="height: 120px; width: 570.667px;">
                                <tbody>
                                <tr>
                                <td><strong>YULIYANAH</strong></td>
                                </tr>
                                </tbody>
                       </table>
                        <br>
                              
                      <table style="height: 50px; width: 300.667px;">
                                <tbody>
                                <tr>
                                <td>Tembusan</td>
                                <td class="">:</td>
                                <td aligin="left">1. Yang bersangkutan</td>
                                </tr>
                                <tr>
                                <td></td>  <td></td> <td>2. Arsip</td>
                                </tr>
                                </tbody>
                        </table>
                        
                    </div>
                  </div>
                </div>
    </body>
</page>
</html>



