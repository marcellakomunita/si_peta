<!DOCTYPE html>
<html>
<head>
	<title>Data Pengguna</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"  >
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Data Pengguna</h4>
		<h6>printed {{ date('d-m-Y') }}</h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Telepon</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($users as $user)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$user->name}}<br>ID #{{ $user->id }}</td>
				<td>{{$user->email}}</td>
				<td>{{$user->phone}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>