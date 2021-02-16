<html>

<head>

  <title>Data Interview </title> <!-- Judul pada suatu web-->

</head>

<body bgcolor="#FFFFFF" width="800px"> <!-- Membuat body memiliki warna dengan menggunakan bgcolor -->

  <div align="center">

   <!-- Membuat rata tengah-->

   <center>

    

   <h1>PT. Dasa Prima</h1>

    <!-- Membuat huruf menjadi besar (Ukuran H1) -->

  </center>

  <hr/>

  <h2>

  Personal Details</h2>

  <!-- Membuat huruf menjadi besar (Ukuran H2) -->

  <table width="800px"> <!-- Membuat sebuah table -->
<tbody>
@foreach ($dataInterview as $object)
    <tr>
      <td width="25%">Nama Lengkap</td>
      <td width="1%">:</td>
      <td><b>{{ $object->NamaPelamar}}</b></td>
      <td rowspan="4"><img src="1.jpg" alt="1" title="1" height="100px" width="75px"></td>
    </tr>
    <tr>
      <td>Tempat, Tanggal lahir </td>
      <td>:</td>
      <td>{{ $object->TempatLahir}}, {{ $object->TanggalLahir}}</td>
    </tr>
    <tr>
      <td>Alamat</td>
      <td>:</td>
      <td>{{ $object->Alamat}}</td>
    </tr>
    <tr>
      <td>E-mail</td>
      <td>:</td>
      <td></td>
    </tr>
    @endforeach
  </tbody>
</table>

<h2>
Educational Background</h2>
<table width="800px">
  <tbody>
  @foreach ($dataPendidikan as $row)
    <tr>
      <td width="25%">{{$row ->NamaPendidikan}}</td>
      <td width="1%">:</td>
      <td>{{\Carbon\Carbon::parse($row->Dari)->format('d, M Y')}} -  {{\Carbon\Carbon::parse($row->Sampai)->format('d, M Y')}}</td>
    </tr>
    @endforeach
     
   </tbody>
    </body>
    </html> 