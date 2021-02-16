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
                    
                    
                    <p align="center"><span style="color: #999999;">Kode Dok : 5.02.006 | Revisi No : 0 | Tgl. Revisi : 6 Des 2017 | Halaman : 1 / 4</span></p>
                    <p style="text-align: center;"><strong><span style="text-decoration"><font size="4">PERJANJIAN KERJA WAKTU TERTENTU (PKWT)</font></span></strong></p>
                    <p style="text-align: center;"><span style="text-decoration"><font size="2">(…../PT.DP/PERS/……. - ……..)</font></span></p>
                    
                    <div class="col-sm-12">
                    <p style="text-align: left;">&nbsp;&nbsp;&nbsp;<span style="text-decoration"><strong>Yang bertanda tangan dibawah ini :&nbsp;</strong></span></p>
                    <table style="height: 79px; width: 1080.667px;">
                   
                        <tbody>
                        <tr>
                        <td>Nama</td>
                        <td class="">:</td>
                        <td aligin="left"><strong>YULIYANAH</strong></td>
                        </tr>
                        <tr>
                        <td>Pekerjaan</td>
                        <td class="">:</td>
                        <td aligin="left">HR, GA Manager</td>
                        </tr>
                        <tr>
                        <td>Perusahaan</td>
                        <td class="">:</td>
                        <td aligin="left">PT. DASA PRIMA</td>
                        <td></td>
                        </tr>
                        <tr>
                        <td>Alamat</td>
                        <td class="">:</td>
                        <td aligin="left">Jl. Margonda Raya No 499 Kel. Pondok Cina – Depok</td>
                        </tr>
                        <tr>
                        <article>
                        <p style="text-align: justify">Dalam hal ini bertindak untuk dan atas nama PT. DASA PRIMA berkedudukan di Depok, Selanjutnya disebut <strong>PERUSAHAAN</strong></td>
                        </p></article>
                        <td></td>
                        </tr>
                    </table>
                  </tbody>
                  @foreach ($dataPkwt as $p)
                    <table style="height: 79px; width: 570.667px;">
                      <tbody>
                      <tr>
                      <td>Nama {{ $p->EmployeeName }}</td>
                      <td class="">:</td>
                      <td aligin="left">{{ $p->EmployeeeName }}</td>
                      </tr>
                      
                      <tr>
                        <td>Tempat Lahir</td>
                        <td class="">:</td>
                        <td aligin="left">{{ $p->TempatLahir }}</td>
                        </tr>
                      <tr>
                      <td>Tanggal Lahir</td>
                      <td class="">:</td>
                      <td aligin="left">{{ $p->TanggalLahir }}</td>
                      </tr>
                      <tr>
                      <td>No. Identitas</td>
                      <td class="">:</td>
                      <td aligin="left">{{ $p->NoID }}</td>
                      </tr>
                      <tr>
                      <td>Alamat</td>
                      <td class="">:</td>
                      <td aligin="left">{{ $p->AlamatRumah }}</td>
                      </tr>
                      <td>Selanjutnya disebut</td>
                      <td></td>
                      <td> <strong>KARYAWAN</strong><td>
                      </tbody>
                      @endforeach
                      <article>
                      <p style="text-align: justify">Kedua belah pihak sepakat untuk mengadakan Perjanjian Kerja Waktu Tertentu (selanjutnya disebut Perjanjian), dengan ketentuan sebagaimana tertuang dalam pasal-pasal sbb :</td>
                      </p></article>
                      <td></td>
                      </tr>
                    </table>
                   <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong> PASAL 1</strong></font></span></p>
                   <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong> JANGKA WAKTU</strong></font></span></p>
              <article>
                    <p style="text-align: justify">
                      Perjanjian ini dibuat untuk jangka waktu selama 12 (Dua Belas) bulan, dimulai pada tanggal :
                    </p>
              </article>
              @foreach ($status as $d)
              <table style="height: 5px; width: 290.667px;">
                <tbody>
                <tr>
                <td aligin="left"><strong>{{ $d->Start }}</strong></td>
                <td class="">sampai dengan tanggal</td>
                <td aligin="left"><strong>{{ $d->End }}</strong></td>
                </tr>
                </tbody>
              </table>
              @endforeach
              <br>
              @foreach ($dataPkwt as $p)
             <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 2</strong></font></span></p>
             <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong>TUGAS dan PENEMPATAN</strong></font></span></p>
              <table style="height: 79px; width: 500.667px;"> 
                <tbody>
                <tr>
                <td>Jabatan</td>
                <td class="">:</td>
                <td aligin="left">{{ $p->NamaJabatan}}</td>
                </tr>
                <tr>
                <td>Departemen/bagian</td>
                <td class="">:</td>
                <td aligin="left">{{ $p->DepartementName}}</td>
                </tr>
                <tr>
                <td>No. Bertanggung Jawab pada</td>
                <td class="">:</td>
                <td aligin="left">XXXXXXXXXXXXXX</td>
                </tr>
                <tr>
                <td>Tugas dan Tanggung Jawab</td>
                <td class="">:</td>
                <td aligin="left">Dijelaskan oleh Atasan </td>
                </tr>
                <tr>
                <article>
                <p style="text-align: justify">Karyawan bersedia melaksanakan tugas pekerjaan yang diberikan oleh Perusahaan dengan sebaik-baiknya.</td>
                </p></article>
                <td></td>
                </tr>
            </table>
            @endforeach
            
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <p align="center"><span style="color: #999999;">Kode Dok : 5.02.006 | Revisi No : 0 | Tgl. Revisi : 6 Des 2017 | Halaman : 2 / 4</span></p>
            <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 3</strong></font></span></p>
            <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong> GAJI dan TUNJANGAN</strong></font></span></p>
                <article>
                    <p style="text-align: justify">
                      <strong> 1.	</strong> mempekerjakan karyawan dengan memberikan Gaji, dengan perincian sebagai berikut :
                    </p>
                </article>
                <table style="height: 21px; width: 700.667px;"> 
                    <tbody>
                    <tr>
                    <td aligin="left">Rp.   XXXXXXX,- </td>
                    </tr>
                </table>
                <article>
                  <p style="text-align: justify">
          <strong>  2.</strong>	Peninjauan gaji akan dilakukan sesuai dengan ketentuan perusahaan.
          <strong> <br>3.</strong> Perusahaan memberikan Tunjangan Hari Raya (THR) sebesar 1 (satu) bulan gaji pada setiap hari raya lebaran kepada karyawan yang telah bekerja minimal 1 (satu) tahun. Bagi karyawan yang masa kerjanya kurang dari 1 (satu) tahun tetapi lebih dari 3 (tiga) bulan, maka THR akan diberikan secara proporsional.
          <strong> <br>4.</strong>	Perusahaan akan mengikutsertakan karyawan dalam program Asuransi (BPJS Ketenagakerjaan/BPJS Ksehatan) sesuai dengan ketentuan yang berlaku di Perusahaan.
          <strong> <br>5.</strong>	Segala ketentuan mengenai tunjangan dan penerimaan lain, beserta pembayaran akan mengikuti kebijakan perusahaan yang berlaku.
                  </p>
                 </article>

                 <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 4</strong></font></span></p>
                 <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong> HARI KERJA dan WAKTU KERJA</strong></font></span></p>
                 <article>
                  <p style="text-align: justify">
           <strong> 1.</strong>	Hari kerja, jam kerja dan shift disesuaikan dengan jabatan dan fungsinya sesuai dengan kebutuhan operasional tiap-tiap unit usaha dengan berpedoman kepada Peraturan Perusahaan yang berlaku.
           <strong><br> 2.</strong>	Jam kerja resmi adalah 48 (Empat Puluh Delapan) jam seminggu dengan ketentuan apabila pekerjaan mendesak untuk diselesaikan, maka karyawan harus bersedia untuk melaksanakan perpanjangan waktu kerja untuk menyelesaikan pekerjaan tersebut dengan cara kerja lembur.
                    
                  </p>
                 </article>
                 <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 5</strong></font></span></p>
                 <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong> CUTI TAHUNAN</strong></font></span></p>
                 <article>
                  <p style="text-align: justify">
                        <strong>1.</strong>	Karyawan berhak atas cuti tahunan sebanyak 12 (dua belas) hari kerja selama 1 (satu) tahun, dan akan muncul setelah karyawan bekerja dalam kurun waktu tersebut diatas (terhitung sejak penandatanganan kontrak kerja).
                        <strong> <br>2.</strong>	Pengambilan hak cuti tahunan karyawan akan disesuaikan dengan kebutuhan masing-masing unit.
                        <strong><br>3.</strong>	Perusahaan berhak mangatur ketetapan cuti tahunan demi efisiensi dan efektivitas kerja perusahaan namun kepentingan karyawan tetap dipertimbangkan.
                        <strong><br> 4.</strong>Permohonan pengambilan cuti harus diajukan kepada atasan karyawan <strong>sekurang-kurangnya 1 (satu) minggu </strong> pelaksanaan cuti.
                  </p>
                 </article>
                 <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 6</strong></font></span></p>
                 <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong>HAK DAN KARYAWAN</strong></font></span></p>
                 <p style="text-align: left;"><span style="text-decoration"><font size="2"> <strong>(1)   Hak dan Kewajiban Perusahaan</strong></font></span></p>
                 <p style="text-align: left;"><span style="text-decoration"><font size="2"> <strong>Hak</strong></font></span></p>
                 <article>
                  <p style="text-align: justify">
                        <strong>1.</strong>Perusahaan berhak untuk menerima hasil pekerjaan dari karyawan.
                        <strong> <br>2.</strong>Perusahaan berhak untuk melakukan penempatan, pemindahan dan evaluasi karyawan dengan ketentuan sebagaimana diatur dalam Peraturan Perusahaan
                  </p>
                 </article>
                 <br>
                 <br>
                 <br>
                 <br>
                 <br>
                 <br>

                 <p align="center"><span style="color: #999999;">Kode Dok : 5.02.006 | Revisi No : 0 | Tgl. Revisi : 6 Des 2017 | Halaman : 3 / 4</span></p>
                 <p style="text-align: left;"><span style="text-decoration"><font size="2"> <strong>Kewajiban</strong></font></span></p>
                 <article>
                    <p style="text-align: justify">
                          <strong>1.</strong>Perusahaan berkewajiban untuk memberikan Gaji dan tunjangan kepada KARYAWAN dengan ketentuan sebagaimana yang diatur dalam pasal 3 Perjanjian Kerja ini.
                          <strong> <br>2.</strong>Memberikan fasilitas operational untuk pekerjaan.
                    </p>
                   </article>
                   <p style="text-align: left;"><span style="text-decoration"><font size="2"> <strong>(2)   Hak dan Kewajiban Karyawan</strong></font></span></p>
                   <p style="text-align: left;"><span style="text-decoration"><font size="2"> <strong>Hak</strong></font></span></p>
                 <article>
                    <p style="text-align: justify">
                          <strong>1.</strong>Karyawan berhak untuk menerima gaji dan tunjangan dari Perusahaan dengan ketentuan sebagaimana yang diatur dalam pasal 3 Perjanjian Kerja ini
                          <strong> <br>2.</strong>Segala ketentuan mengenai tunjangan dan penerimaan lain, beserta pembayaran akan mengikuti kebiijakan perusahaan yang berlaku.
                    </p>
                   </article>
                   <p style="text-align: left;"><span style="text-decoration"><font size="2"> <strong>Kewajiban</strong></font></span></p>
                   <article>
                    <p style="text-align: justify">
                          <strong>1.</strong>Karyawan wajib mentaati tata tertib perusahaan.
                          <strong> <br>2.</strong>Karyawan wajib menjaga harta milik perusahaan, nama baik dan berjanji tidak akan membocorkan rahasia perusahaan dengan cara apapun, baik langsung maupun tidak langsung atau melakukan perbuatan yang dilarang dalam Peraturan Perusahaan.
                          <strong><br>3.</strong>Karyawan melakukan tugas pekerjaannya sesuai job desk dengan tidak mengabaikan arahan manajemen cabang.
                          <strong><br>4.</strong>Karyawan dilarang memanfaatkan jabatan/pekerjaannya untuk tindakan-tindakan diluar kepentingan perusahaan dengan tujuan mencari keuntungan pribadi.
                          <strong><br>5.</strong>Karyawan diwajibkan mengembalikan kelengkapan yang diberikan kepadanya selama bekerja pada akhir perjanjian kerja ini.
                    </p>
                   </article>
                  <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 7</strong></font></span></p>
                   <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong>TINDAKAN DISIPLIN</strong></font></span></p>
                  <article>
                    <p style="text-align: justify">
                        Perusahaan akan mengenakan sanksi disiplin terhadap setiap karyawan yang melakukan pelanggaran-pelanggaran 
                        yang tertulis dalam Pasal 6 dan peraturan-peraturan perusahaan.
                    </p>
                   <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 8</strong></font></span></p>
                   <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong>PERPANJANGAN MASA KERJA</strong></font></span></p>
                   <article>
                    <p style="text-align: justify">
                        Apabila dikehendaki kedua belah pihak dan didasarkan pada hasil evaluai kinerja karyawan dan kesepakatan kedua belah pihak serta kebutuhan perusahaan,
                        maka perjanjian ini dapat diperpanjang dengan pemberitahuan paling lambat 2 (dua) minggu sebelum perjanjian kerja berakhir.
                    </p>
                   <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 9</strong></font></span></p>
                   <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong>PENGUNDURAN DIRI</strong></font></span></p>
                   <article>
                    <p style="text-align: justify">
                        <strong>1.</strong>Apabila karyawan mengundurkan diri dari perusahaan harus dilakukan dengan pemberitahuan secara tertulis selambat-lambatnya <strong>1 (satu) bulan sebelum tanggal pengunduran diri</strong> yang dikehendaki.
                        <strong><br>2.</strong>Dalam hal pengunduran diri, <strong>tidak berkewajiban untuk memberikan kompensasi maupun ganti rugi dalam bentuk apapun.</strong>
                    </p>


                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <p align="center"><span style="color: #999999;">Kode Dok : 5.02.006 | Revisi No : 0 | Tgl. Revisi : 6 Des 2017 | Halaman : 4 / 4</span></p>
                    <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 10</strong></font></span></p>
                    <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong>PEMUTUSAN HUBUNGAN KERJA</strong></font></span></p>
                    <article>
                     <p style="text-align: justify">
                        Hubungan kerja ini dapat diakhiri apabila :
                        <br>
                        <br>
                        <strong>1.</strong>Berakhirnya jangka waktu perjanjian kerja, atau atas kesepakatan kedua belah pihak untuk mengakhiri perjanjian kontrak kerja sebelum waktunya.
                        <br><strong>2.</strong>	Perusahaan berhak melakukan pemutusan hubungan kerja kepada karyawan yang tidak mampu melaksanakan tugas dan tanggung jawab yang dibebankan. Perusahaan tidak berkewajiban untuk membayar uang ganti rugi atau pembayaran lainnya kecuali gaji sampai pada saat pemutusan hubungan kerja.
                        <br><strong>3.</strong>	Karyawan mengundurkan diri atau karyawan tidak masuk kerja selama 3 (tiga) hari berturut-turut tanpa disertai keterangan secara tertulis dengan bukti-bukti yang sah, karyawan tersebut dinyatakan telah mengundurkan diri.
                        <br><strong>4.</strong>	Perusahaan berhak memutus hubungan kerja kepada karyawan yang melakukan tindakan tertentu dan berakibat fatal pada perusahaan.
                     </p>
                     <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 11</strong></font></span></p>
                    <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong>PENYELESAIAN PERSELISIHAN</strong></font></span></p>
                    <article>
                     <p style="text-align: justify">
                        Bila terjadi perselisihan dalam pelaksanaan isi perjanjian kerja ini, maka kedua belah pihak berusaha menyelesaikannya melalui musyawarah dan bila 
                        tidak tercapai kesepakatan,maka akan ditempuh melalui ketentuan Peraturan Perusahaan yang berlaku.
                     </p>
                    <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 12</strong></font></span></p>
                    <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong>ROTASI KARYAWAN</strong></font></span></p>
                    <article>
                     <p style="text-align: justify">
                        Hubungan kerja ini dapat diakhiri apabila :
                        <br>
                        <br>
                        <strong>1.</strong>Perusahaan berhak melakukan mutasi, dan demosi setelah ada evaluasi kinerja karyawan, perubahan sistem, dan perubahan struktur maupun permintaan management
                        <br><strong>2.</strong>Perusahaan berkewajiban menaikkan gaji dan tunjangan sesuai jabatan
                        <br><strong>3.</strong>Perusahaan berhak menurunkan gaji dan tunjangan sesuai jabatan.
                     </p>
                     <p style="text-align: center;"><span style="text-decoration: underline;"><font size="2"> <strong>PASAL 13</strong></font></span></p>
                    <p style="text-align: center;"><span style="text-decoration"><font size="2"> <strong>PENUTUP</strong></font></span></p>
                    <article>
                     <p style="text-align: justify">
                        Untuk hal-hal yang belum diatur tercakup dalam perjanjian kerja ini, maka kedua belah pihak berpedoman pada Peraturan Perusahaan. Karyawan sehubungan dengan Perjanjian ini, menyatakan dengan sebenarnya dalam keadaan sehat, tidak terikat hubungan kerja dengan perusahaan lain dan tidak menjadi anggota organisasi yang dilarang oleh Pemerintah RI.
                        <br><br>Demikian perjanjian ini dibuat dalam rangkap 2 (dua), telah dibaca, dipahami dan ditanda tangani oleh kedua belah pihak dalam keadaan sadar, tanpa adanya tekanan atau paksaan dari pihak manapun, dan berlaku sejak ditanda tangani oleh kedua belah pihak.
                     </p>
                     <br>
                    <table style="height: 21px; width: 900.667px;"> 
                    <tbody>
                    <tr>
                    <td aligin="left">Depok,&nbsp;<?php
                      echo date("d F Y") . "<br>";
                    ?></td>
                    </tr>
                    </table>
                    <table style="height: 21px; width: 950.00.667px;">
                    <tr>
                      <td aligin="left">PT. DASA PRIMA</td>
                      <td aligin="center">KARYAWAN</td>
                    </table>
                    @foreach ($dataPkwt as $p)
                        <br><br><br>
                        <table style="height: 21px; width: 990.00.667px;">
                        <tr>
                            <td aligin="left"><strong>YULIYANAH</strong></td>
                          <td aligin="center"><strong>{{ $p->EmployeeeName }}</strong></td>
                          @endforeach
                        </table>
                        
                    </div>
                  </div>
                </div>
    </body>
</page>
</html>



