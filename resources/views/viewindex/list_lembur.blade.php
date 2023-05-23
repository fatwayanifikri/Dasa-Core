<html>
<head>
	<title>DASAGROUPC</title>
</head>
<body>
 
	<style type="text/css">
		.pagination li{
			float: left;
			list-style-type: none;
			margin:5px;
		}
	</style>
 
	<h2><a href="www.dasacore.dasaprima.co.id">DASA GROUP</a></h2>
	<h3>Data Lembur</h3>
 
 
	<!-- <p>Cari Data Lembur :</p>
	<form action="viewindex/list_lembur" method="GET">
		<input type="text" name="cari" placeholder="Cari Pegawai .." value="{{ old('$data') }}">
		<input type="submit" value="CARI">
	</form> -->
		
	<br/>
 
	<table class="table table-striped">
    <thead>
		<tr>
			<th>Employee</th>
			<th>Unit</th>
			<th>Jabatan</th>
			<th>Menit</th>
		</tr>
        </thead>
        
        @foreach($data as $p)
		<tr>
			<td>{{$p->EmployeeName}}</td>
			<td>{{$p->Unit_id}}</td>
			<td>{{$p->Jabatan_id}}</td>
			<td>{{$p->AmountMinute}}</td>
		</tr>
		@endforeach
        
	</table>
 
	<br/>
	<!-- Halaman : {{ $data->currentPage() }} <br/>
	Jumlah Data : {{ $data->total() }} <br/>
	Data Per Halaman : {{ $data->perPage() }} <br/>
 
 
	{{ $data->links() }} -->
 
 
</body>
</html>

