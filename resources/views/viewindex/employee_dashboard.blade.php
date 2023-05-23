<!-- First, extends to the CRUDBooster Layout -->
@extends('crudbooster::admin_template')

@section('content')

  <!-- Your html goes here -->
<!--DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<!--Jquery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<!--DateRangePicker -->
<script type="text/javascript" src="https://cdn.datatables.net/datetime/1.0.2/js/dataTables.dateTime.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<head>
  
<style>

.card-box {
    position: relative;
    color: #fff;
    padding: 20px 10px 40px;
    margin: 20px 0px;
}
.card-box:hover {
    text-decoration: none;
    color: #f1f1f1;
}
.card-box:hover .icon i {
    font-size: 100px;
    transition: 1s;
    -webkit-transition: 1s;
}
.card-box .inner {
    padding: 5px 10px 0 10px;
}
.card-box h3 {
    font-size: 27px;
    font-weight: bold;
    margin: 0 0 8px 0;
    white-space: nowrap;
    padding: 0;
    text-align: left;
}
.card-box p {
    font-size: 15px;
}
.card-box .icon {
    position: absolute;
    top: auto;
    bottom: 5px;
    right: 5px;
    z-index: 0;
    font-size: 72px;
    color: rgba(0, 0, 0, 0.15);
}
.card-box .card-box-footer {
    position: absolute;
    left: 0px;
    bottom: 0px;
    text-align: center;
    padding: 3px 0;
    color: rgba(255, 255, 255, 0.8);
    background: rgba(0, 0, 0, 0.1);
    width: 100%;
    text-decoration: none;
}
.card-box:hover .card-box-footer {
    background: rgba(0, 0, 0, 0.3);
    width: 100%;
     
}
.bg-green {
    background-color: #00a65a !important;

}
.bg-blue {
    background-color: #00c0ef !important;
    
}
.bg-orange {
    background-color: #f39c12 !important;
    
}
.bg-red {
    background-color: #d9534f !important;
    
  
}

</style>
</head>

<div class="container-fluid"><!-- biar responsive -->
<div class="row">

@foreach($jabatan as $j)
@if($j->id == 1 or $j->id == 62 or $j->id == 63 or $j->id == 64 or $j->id == 65 or $j->id == 66 or $j->id == 8 or $j->id == 9 )

<!------------------------------FOR ADMIN--------------------------------->

<div class="col-lg-3 col-sm-6">
<div class="card-box bg-green">
<div class="inner">
@forelse($pelamar as $pl)
<h3>{{$pl->total_pelamar}}</h3>
@empty
<h3>0</h3>
@endforelse
<p>Jumlah Pelamar</p>
</div>
<div class="icon">
<i class="fa fa-user-plus" aria-hidden="true"></i>
</div>
<a href="#" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-sm-6">
<div class="card-box bg-red">
<div class="inner">
@forelse($karyawan as $k)
<h3>{{$k->total_karyawan}}</h3>
@empty
<h3>0</h3>
@endforelse
<p>Jumlah Karyawan</p>
</div>
<div class="icon">
<i class="fa fa-book" aria-hidden="true"></i>
</div>
<a href="EmployeeCustom" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-sm-6">
<div class="card-box bg-orange">
<div class="inner">
@forelse($request as $req)
<h3>{{$req->total_request}}</h3>
@empty
<h3>0</h3>
@endforelse
<p>Request Karyawan</p>
</div>
<div class="icon">
<i class="fa fa-phone" aria-hidden="true"></i>
</div>
<a href="employeerequest" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-sm-6">
<div class="card-box bg-blue">
<div class="inner">
@forelse($lembur as $lem)
<h3>{{$lem->total_lembur}}</h3>
@empty
<h3>0</h3>
@endforelse
<p>Form Lembur</p>
</div>
<div class="icon">
<i class="fa fa-clock-o" aria-hidden="true"></i>
</div>
<a href="export_lembur" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
    
<!------------------------------END ADMIN--------------------------------->

@elseif($j->id == 157)

<!------------------------------FOR CUSTOMER-------------------------------->

<div class="col-lg-3 col-sm-6">
<div class="card-box bg-green">
<div class="inner">
@forelse($transaction as $t)
<h3>{{$t->trans_total}}</h3>
@empty
<h3>0</h3>
@endforelse
<p>Total Transaksi</p>
</div>
<div class="icon">
<i class="fa fa-list" aria-hidden="true"></i>
</div>
<a href="penawaran_customer_dashboard" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-sm-6">
<div class="card-box bg-yellow">
<div class="inner">
@forelse($pembayaran as $b)
<h3>Rp. {{number_format($b->grand_total)}}</h3>
@empty
<h3>0</h3>
@endforelse
<p>Total Pembayaran</p>
</div>
<div class="icon">
<i class="fa fa-money" aria-hidden="true"></i>
</div>
<a href="penawaran_customer_dashboard" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<!------------------------------END CUSTOMER--------------------------------->

@else

<!------------------------------FOR EMPLOYEE--------------------------------->

<div class="col-lg-3 col-sm-6">
<div class="card-box bg-green">
<div class="inner">
@forelse($value as $s)
<h3>{{$s->Endstock}}</h3>
@empty
<h3>0</h3>
@endforelse
<p>Sisa Stock Cuti</p>
</div>
<div class="icon">
<i class="fa fa-list" aria-hidden="true"></i>
</div>
<a href="Pengajuanformcuti" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-sm-6">
<div class="card-box bg-blue">
<div class="inner">
@forelse($result as $p)
<h3>{{$p->total_cuti}}</h3>
@empty
<h3>0</h3>
@endforelse
<p>Jumlah Cuti Approved</p>
</div>
<div class="icon">
<i class="fa fa-calendar" aria-hidden="true"></i>
</div>
<a href="Pengajuanformcuti" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-sm-6">
<div class="card-box bg-orange">
<div class="inner">
@forelse($total as $t)
<h3>{{$t->total_menit}}</h3>
@empty
<h3>0</h3>
@endforelse
<p>Total Menit Lembur</p>
</div>
<div class="icon">
<i class="fa fa-clock-o" aria-hidden="true"></i>
</div>
<a href="FormLembur" class="card-box-footer">View More <i class="fa fa-arrow-circle-right"></i></a>
</div>
</div>
</div>
<!------------------------------END EMPLOYEE--------------------------------->

@endif
@endforeach

@endsection