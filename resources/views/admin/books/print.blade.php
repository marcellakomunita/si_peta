<!DOCTYPE html>
<html>
<head>
	<title>Data Ebook</title>
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
		<h5>Data Ebook</h4>
		<h6>printed {{ date('d-m-Y') }}</h5>
	</center>
 
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>No</th>
				<th>Judul</th>
				<th>Penulis</th>
				<th>Penerbit</th>
			</tr>
		</thead>
		<tbody>
			@php $i=1 @endphp
			@foreach($books as $book)
			<tr>
				<td>{{ $i++ }}</td>
				<td>{{$book->judul}}<br>{{ $book->isbn }}</td>
				<td>{{$book->penulis}}</td>
				<td>{{$book->penerbit}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
 
</body>
</html>