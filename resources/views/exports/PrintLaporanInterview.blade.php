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
                .checkboxes label {
                 display: inline-block;
                 padding-right: 10px;
                 white-space: nowrap;
                 }
                .checkboxes input{
                 vertical-align: middle;
                 margin-left: 10px;
                }

               .checkboxes label span {
                 vertical-align: middle;
                }

    </style>

           
    </head>
    <body>
<div class="container">
<div class="col-sm-12">
<div class=""></div>
<table style="border-collapse:collapse;" border="1">
<tbody>
<tr>
<td style="width: 100px;" ><center><img src="{{asset('picture/dasaprima.png') }}"style="width:40px;height:40px;"></center></td>
<td style="width: 300px; text-align: center;font-size: 12pt;"><h3>FORM RECRUITMENT PROCESS LAPORAN HASIL INTERVIEW</h3></td>
<td style="width: 100px; text-align: right" ><strong></strong></td>
</tr>
</tbody>
</table>
                        
<table style="width: 100%;">      
<tr><td colspan="4"></td></tr>            
<tr>
<td style="width: 100px;">No</td>
<td >:</td>
<td style="width: 150px;">Nama Interviewer</td>
<td >: </td>
</tr>
<tr>
<td style="width: 100px;">Tanggal</td>
<td >: {{\Carbon\Carbon::now()->format('d M Y')}}</td>
<td style="width: 100px;">Jabatan/Bagian</td>
<td >:</td>
</tr>                      

<tr><td colspan="4"></td></tr>
<tr><td style="background-color: #C0C0C0;" colspan="4"><center><b>CALON KARYAWAN</center></b></td></tr>
<tr><td colspan="4"></td></tr>

@foreach ($data as $row)
<tr>
<td style="width: 100px;">Nama</td>
<td >: {{ $row->NamaPelamar}}</td>
<td style="width: 150px;">Posisi Yang Dilamar</td>
<td >: {{ $row->name}}</td>
</tr>
<tr>
<td style="width: 100px;">Tanggal Lahir</td>
<td >: {{\Carbon\Carbon::parse($row->TanggalLahir)->format('d M Y')}}</td>
<td style="width: 100px;">Pendidikan</td>
<td >:</td>
</tr>
<tr>
<td style="width: 100px;"></td>
<td ></td>
<td style="width: 100px;">Jabatan Terakhir</td>
<td >:</td>
</tr>
@endforeach
</table>

<p>

<!---------------------------------------------------------------------------->
<table style="width: 100%; border-collapse:collapse;" border="1" >
<tr>
<td style ="background-color: #C0C0C0;" colspan="4"><center><b>INTERVIEW</center></b>
</td>
</tr>

<tr>
<td style="width: 50px;" ><center><b>NO</center></b></td>
<td colspan="3"><center><b>RECRUITMENT PROCESS</center></b></td>
</tr>
<!---------------->
<tr>
<td style="width: 50px;" rowspan="2"><h4><center>1</center></h4></td>
<td colspan="3"><label><b><span><center>INTERVIEW HRD</center></span></b></label></td>
</tr>
<!---------------->
<tr>
<td style="width: 100px;"><label><span>COMMENT:</span></label><p>&nbsp;</p>&nbsp;</td>

<td>
<div class="checkboxes">
<input type="checkbox"><label><span>&nbsp;LULUS</span></label><br>
<input type="checkbox"><label><span>&nbsp;TIDAK LULUS</span></label>
</div>

</td>
<td><label>NOTE:</label><p>&nbsp;</p>&nbsp;</td>
</tr>

<!---------------->
<tr>
<td style="width: 50px;" rowspan="2"><h4><center>2</center></h4></td>
<td colspan="3"><label><b><span><center>TEST KOMPUTERISASI</center></span></b></label></td>
</tr>

<tr>
<td style="width: 100px;"><label><span>COMMENT:</span></label><p>&nbsp;</p>&nbsp;</td>

<td>
<div class="checkboxes">
<input type="checkbox"><label><span>&nbsp;MS.OFFICE&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span></label><br>
<input type="checkbox"><label><span>&nbsp;MS.EXCEL&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span></label><br>
<input type="checkbox"><label><span>&nbsp;MS.POWER POINT&nbsp;:</span></label>
</div>

</td>
<td><label>NOTE:</label><p>&nbsp;</p>&nbsp;</td>
</tr>

<!---------------->
<tr>
<td style="width: 50px;" rowspan="2"><h4><center>3</center></h4></td>
<td colspan="3"><label><b><span><center>PSIKOGRAM</center></span></b></label></td>
</tr>

<tr>
<td style="width: 100px;"><label><span>COMMENT:</span></label><p>&nbsp;</p>&nbsp;</td>

<td>
<div class="checkboxes">
<input type="checkbox"><label><span>&nbsp;INTELEGENSI UMUM&nbsp;:</span></label><br>
<input type="checkbox"><label><span>&nbsp;SIKAP KERJA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span></label><br>
<input type="checkbox"><label><span>&nbsp;INTERAKSI SOSIAL&nbsp;&nbsp;&nbsp;&nbsp;:</span></label><br>
<input type="checkbox"><label><span>&nbsp;KEPRIBADIANNYA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</span></label>
</div>

</td>
<td><label>NOTE:</label><p>&nbsp;</p>&nbsp;</td>
</tr>

<!---------------->
<tr>
<td style="width: 50px;" rowspan="2"><h4><center>4</center></h4></td>
<td colspan="3"><label><b><span><center>INTERVIEW USER</center></span></b></label></td>
</tr>

<tr>
<td style="width: 100px;"><label><span>COMMENT:</span></label><p>&nbsp;</p>&nbsp;</td>

<td>
<div class="checkboxes">
<input type="checkbox"><label><span>&nbsp;INTERVIEW USER I&nbsp;&nbsp;&nbsp;:</span></label><br>
<input type="checkbox"><label><span>&nbsp;INTERVIEW USER II&nbsp;&nbsp;:</span></label><br>
<input type="checkbox"><label><span>&nbsp;INTERVIEW USER III&nbsp;:</span></label><br>
</div>

</td>
<td><label>NOTE:</label><p>&nbsp;</p>&nbsp;</td>
</tr>

<!---------------->
<tr>
<td colspan="4"></td>
</tr>
</table>                          

<!---------------------------------------------------------------------------->

<table style="width: 100%; border-collapse:collapse;" border="1" >
<tr><td style="background-color: #C0C0C0;"><center><b>KETERANGAN</center></b></td></tr>
<tr><td><h3><center>&nbsp;</center></h3></td></tr>

<tr><td style="background-color: #C0C0C0;"><center><b>KEPUTUSAN</center></b></td></tr>
<tr><td>
<div class="checkboxes">
<input type="checkbox"><label><span>&nbsp;DITERIMA</span></label><br>
<input type="checkbox"><label><span>&nbsp;TIDAK DITERIMA</span></label><br>
<input type="checkbox"><label><span>&nbsp;PENDING/STOCK</span></label><br>
</td></tr>
</table>

<!---------------------------------------------------------------------------->

<table style="width: 100%; border-collapse:collapse;" border="1" >
<tr><td style="background-color: #C0C0C0;" colspan="4"><center><b>PENILAI/YANG MENGINTERVIEW</center></b></td></tr>

<tr>
<td style="font-size: 10px;"><h2>&nbsp;</h2></td>
<td style="font-size: 10px;"></td>
<td style="font-size: 10px;"></td>
<td style="font-size: 10px;"></td>
</tr>

<tr>
<td style="font-size: 10px;">NAMA:</td>
<td style="font-size: 10px;">NAMA:</td>
<td style="font-size: 10px;">NAMA:</td>
<td style="font-size: 10px;">NAMA:</td>
</tr>

<tr>
<td style="font-size: 10px;">JABATAN: HR RECRUITMENT</td>
<td style="font-size: 10px;">JABATAN: HR-MANAGER</td>
<td style="font-size: 10px;">JABATAN: STORE MANAGER</td>
<td style="font-size: 10px;">JABATAN: GENERAL MANAGER</td>
</tr>
</table>

</div>
</div>
</div>

        
        
</body>
</html>



