<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')

@section('content')

  <!-- Your html goes here -->
<!--DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<!--Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<!--DateRangePicker -->
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.0.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<head>
    
<script type="text/javascript">
$(document).ready(function() {

 var $dTable = $('#example').DataTable({
  "dom": "<'row'<'col-sm-4'l><'col-sm-3' <'filtersearchbox'>><'col-sm-5'f>>" +
    "<'row'<'col-sm-12'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>"
 });

</script>
  
<style>
 p { 
  margin:0;
}

.form-control{
  width: 100%;
  height: 30%;
  font-size: 12px;
}

.form-control2{
  height:29px;
  width: 100%;
  font-size: 14px;

}

.form-control3{
    height:29px;
    width: 100%;
    line-height:30px;
    padding:6px;
    font-size: 14px;
    }

.link {
    text-decoration: none; 
    color: white; 

}
a:hover {
  color: white;
}

.form-control{
  border-color: rgba(180, 180, 180);
 
}

.hidden{
   visibility:hidden;
}
.wrapper {
  position: relative;
  overflow: auto;
  border: 1px solid black;
  white-space: nowrap;
 
}
td {
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px;
  font-weight: 550; 
}


</style>
</head>

<!------------------------------DASHBOARD--------------------------------->

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<!-- <div class="panel-heading">Cek IP</div> -->
<div class="panel-body">
<h3><b>RUMUS HITUNG CETAKAN</b></h3>
<h4>52 (area maks. 35 x 50) (kertas maks. 37 x 52)</h4>

<div style="float:right; width: 50%">
<table class="table pop_modal table-striped table-bordered table-hover" style="width:90%">
<tr>
<td></td>
<td></td>
<td>P</td>
<td>L</td>
</tr>

<tr>
<td>AREA CETAK ISI SM 74</td>
<td>:</td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
</tr>

<tr>
<td>UKURAN CETAK ISI SM 74</td>
<td>:</td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
</tr>

<tr>
<td>UKURAN PLANO MENDEKATI</td>
<td>:</td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
</tr>

<tr>
<td>UK. PLANO</td>
<td>:</td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
</tr>

<tr>
<td>JENIS ISI KERTAS</td>
<td>:</td>
<td colspan="2"><select name="Unit_id" class="form-control " placeholder="" value="">  
<option value="ART PAPER">ART PAPER</option>
<option value="ART CARTON">ART CARTON</option>
<option value="HVS">HVS</option>
<option value="HVS WARNA">HVS WARNA</option>
<option value="BOOK PAPER">BOOK PAPER</option>
<option value="Linen Jepang 210gr">Linen Jepang 210gr</option>
<option value="BW 250gr">BW 250gr</option>
<option value="Councord Art Carton ( Putih ) 220gr">Councord Art Carton ( Putih ) 220gr</option>
<option value="Stiker Cromo 210gr (65x100)">Stiker Cromo 210gr (65x100)</option>
<option value="Stiker Cromo 210gr (70x108)">Stiker Cromo 210gr (70x108)</option>
<option value="Stiker HVS 210gr">Stiker HVS 210gr</option>
<option value="Karton AKASIA 190gr">Karton AKASIA 190gr</option>
<option value="Stiker Vinel Duratac 250gr">Stiker Vinel Duratac 250gr</option>
<option value="Ivory 210gr">Ivory 210gr</option>
<option value="Karton Tik Putih 210gr">Karton Tik Putih 210gr</option>
<option value="Councord Art Paper ( Putih ) 90gr">Councord Art Paper ( Putih ) 90gr</option>
<option value="Samson/Suparma 90gr">Samson/Suparma 90gr</option>
</select></td>
</tr>

<tr>
<td>GRAMATUR</td>
<td>:</td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
<td>Insheet</td>
</tr>

<tr>
<td>JUMLAH KERTAS ISI</td>
<td>:</td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
</tr>

<tr>
<td>JUMLAH KERTAS PLUS INSHEET</td>
<td>:</td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
<td>&nbsp</td>
</tr>

<tr>
<td>MUKA PLAT</td>
<td>:</td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
<td>&nbsp</td>
</tr>

<tr>
<td>JUMLAH PLAT ISI</td>
<td>:</td>
<td><input type = "text" name="kode_produksi" class="form-control" form="detail" id="kode_produksi" ></td>
<td>&nbsp</td>
</tr>
</tr>
</table>
</div>

<!-- -------------------------- -->
<br>
<div style="float:LEFT; width: 50%">
<table class="table pop_modal table-striped table-bordered table-hover" style="width:100%">

<tr>
<td>NO BOM</td>
<td>:</td>
<td colspan="3"><input type = "text" name="no_bom" class="form-control"></td>
<td>&nbsp</td><td>&nbsp</td>
</tr>

<tr>
<td>NAMA PEMESAN</td>
<td>:</td>
<td colspan="3"><input type = "text" name="kode_produksi" class="form-control" placeholder="Diisi Manual"></td>
<td>&nbsp</td><td>&nbsp</td>
</tr>

<tr>
<td>TANGGAL TERIMA</td>
<td>:</td>
<td colspan="3"><input type = "text" name="no_bom" class="form-control" value="<?php echo date('d-m-Y'); ?>"></td>
<td>&nbsp</td><td>&nbsp</td>
</tr>

<tr>
<td>ESTIMASI LAMA PEK.</td>
<td>:</td>
<td colspan="2"><input type = "text" name="no_bom" class="form-control"></td>
<td>Hari</td>
<td>&nbsp</td>
</tr>

<tr>
<td>SELESAI PEKERJAAN</td>
<td>:</td>
<td colspan="3"><input type = "text" name="no_bom" class="form-control"  value="<?php echo date('d-m-Y'); ?>"></td>
<td>&nbsp</td><td>&nbsp</td>
</tr>

<tr>
<td>JUDUL CETAKAN</td>
<td>:</td>
<td colspan="3"><input type = "text" name="kode_produksi" class="form-control" placeholder="Diisi Manual" ></td>
<td>&nbsp</td><td>&nbsp</td>
</tr>

<tr>
<td>JENIS/MODEL CETAKAN</td>
<td>:</td>
<td><b>MAP</b></td>
<td colspan="2"><input type = "text" name="no_bom" class="form-control"></td>
<td>&nbsp</td>
</tr>

<tr>
<td>JUMLAH PESANAN</td>
<td>:</td>
<td colspan="2"><input type = "text" name="no_bom" class="form-control"></td>
<td>pcs</td>
<td>&nbsp</td>
</tr>

<tr>
<td>UKURAN JADI</td>
<td>:</td>
<td>Custom</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
<td><center>X</center></td>
<td><input type = "text" name="no_bom" class="form-control"></td>
</tr>

<tr>
<td>DETAIL</td>
<td>:</td>
<td>Muka</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
<td>Warna</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
</tr>
</table>
</div>

<!-- -----------------------------PAGE 2------------------------- -->

<table class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
<tr style="background-color:#00BFFF; color:black;">
<td colspan="3"><b>1. BIAYA BAHAN BAKU</b></td>
<td><center>KET.</center></td>
<td><center>RP/QTY</center></td>
<td><center>GRAM</center></td>
<td colspan="3"><center>PANJANG  X  LEBAR</center></td>
<td colspan="2"><center>TOTAL</center></td>
</tr>

<tr>
<td colspan="3">&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td colspan="3">&nbsp</td>
<td colspan="2">&nbsp</td>
</tr>

<tr>
<td colspan="2">Harga Bahan Baku MAP</td>
<td>:</td>
<td colspan="2"><input type = "text" name="no_bom" class="form-control"></td>
<td>/KG</td>
<td colspan="2"><input type = "text" name="no_bom" class="form-control"></td>
<td>/Lembar</td>
<td>Rp</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
</tr>

<tr>
<td colspan="2">Harga Bahan Baku Kuping MAP</td>
<td>:</td>
<td colspan="2"><input type = "text" name="no_bom" class="form-control"></td>
<td>/KG</td>
<td colspan="2"><input type = "text" name="no_bom" class="form-control"></td>
<td>/Lembar</td>
<td>Rp</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
</tr>

<tr>
<td colspan="3">&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td colspan="3" style="text-align:right;"><b>Total Biaya Bahan Baku</b></td>
<td >Rp</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
</tr>

</table>

<BR>

<!-- -----------------------------PAGE 3------------------------- -->

<table class="table pop_modal table-striped table-bordered table-hover" style="width:100%">
<tr style="background-color:#00BFFF; color:black;">
<td colspan="3"><b>2. BIAYA CETAK</b></td>
<td><center>PLAT/MUKA</center></td>
<td><center>RP</center></td>
<td><center>DRAG</center></td>
<td><center>WARNA</center></td>
<td><center>QTY</center></td>
<td><center>RP/QTY</center></td>
<td colspan="2"><center>TOTAL</center></td>
</tr>

<tr>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td colspan="2"></td>
</tr>

<tr>
<td colspan="2">PLAT CTP SM 52</td>
<td>:</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
<td><input type = "text" name="no_bom" class="form-control"></td>
<td><center>&nbsp</center></td>
<td><input type = "text" name="no_bom" class="form-control"></td>
<td><center>&nbsp</center></td>
<td><center>&nbsp</center></td>
<td >Rp</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
</tr>

<tr>
<td colspan="2">Cetak S.M 52</td>
<td>:</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
<td><input type = "text" name="no_bom" class="form-control"></td>
<td><center><input type = "text" name="no_bom" class="form-control"></center></td>
<td><input type = "text" name="no_bom" class="form-control"></td>
<td><center><input type = "text" name="no_bom" class="form-control"></center></td>
<td><center>&nbsp</center></td>
<td >Rp</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
</tr>

<tr>
<td colspan="3">&nbsp</td>
<td>&nbsp</td>
<td>&nbsp</td>
<td >&nbsp</td>
<td colspan="3" style="text-align:right;"><b>Total Biaya Cetak</b></td>
<td >Rp</td>
<td><input type = "text" name="no_bom" class="form-control"></td>
</tr>
</table>



<?php
// Mengetahui IP Pengunjung
// function get_client_ip() {
//     $ipaddress = '';
//     if (getenv('HTTP_CLIENT_IP'))
//         $ipaddress = getenv('HTTP_CLIENT_IP');
//     else if(getenv('HTTP_X_FORWARDED_FOR'))
//         $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
//     else if(getenv('HTTP_X_FORWARDED'))
//         $ipaddress = getenv('HTTP_X_FORWARDED');
//     else if(getenv('HTTP_FORWARDED_FOR'))
//         $ipaddress = getenv('HTTP_FORWARDED_FOR');
//     else if(getenv('HTTP_FORWARDED'))
//        $ipaddress = getenv('HTTP_FORWARDED');
//     else if(getenv('REMOTE_ADDR'))
//         $ipaddress = getenv('REMOTE_ADDR');
//     else
//         $ipaddress = 'IP tidak dikenali';
//     return $ipaddress;
// }
   
   
// Mengetahui web browser yang digunakan pengunjung
// function get_client_browser() {
//     $browser = '';
//     if(strpos($_SERVER['HTTP_USER_AGENT'], 'Netscape'))
//         $browser = 'Netscape';
//     else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox'))
//         $browser = 'Firefox';
//     else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome'))
//         $browser = 'Chrome';
//     else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
//         $browser = 'Opera';
//     else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE'))
//         $browser = 'Internet Explorer';
//     else
//         $browser = 'Other';
//     return $browser;
// }

// $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
//    echo "Hostname : ".$hostname."<br>";
//    echo "IP anda adalah : ".get_client_ip()."<br>";
//    echo "Browser : ".get_client_browser()."<br>";
//    echo "Sistem Operasi : ".$_SERVER['HTTP_USER_AGENT']."<br>";
   
// ?>

</div>
</div>
</div>
</div>


@endsection