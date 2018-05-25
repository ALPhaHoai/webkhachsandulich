@extends('touradmin.layout.bodycontent')
@section('title') Danh sách khách hàng
@endsection
@section('content')

<h1>Khách hàng - danhsach</h1>


<div class="container">
<div class="row">
	<table class="table_id table table-striped table-bordered table-hover" style="width: 100%; table-layout: fixed;" id="myTable">
	<thead>
	<tr align="center">
		<td>Mã khách hàng</td>
		<td>Mã tài khoản</td>
		<td>Họ Tên</td>
		<td>SDT</td>
		<td>Giới tính </td>
		<td>Địa chỉ</td>
		<td>CMT</td>

	</tr>
	</thead>
	<tbody>
	@foreach($danhsach as $danhsach1)
	<tr class="odd gradeX">
		<td>{{$danhsach1->IDKH}}</td>
		<td>{{$danhsach1->IDTaiKhoan}}</td>
		<td>{{$danhsach1->HoTen}}</td>
		<td>{{$danhsach1->SDT}}</td>
		<td>{{$danhsach1->GioiTinh}}</td>
		<td>{{$danhsach1->DiaChi}}</td>
		<td>{{$danhsach1->CMT}}</td>
	</tr>
@endforeach
</tbody>
</table>
</div>
</div>

@endsection