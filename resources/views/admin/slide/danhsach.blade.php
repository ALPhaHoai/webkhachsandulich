@extends('admin.layout.thongtinindex')
@section('content')

<h1>Loại tin- danhsach</h1>


<div class="container">
<div class="row">
	<table class="table table-striped table-bordered table-hover" style="table-layout: fixed; width: 100%;" id="myTable">
	<thead>
	<tr>
		<td>Mã loại tin</td>
		<td>Tên </td>
		<td>Sửa </td>
		<td>Xóa </td>
	</tr>
	</thead>
	<tbody>
	@foreach($danhsach as $danhsach1)
	<tr>
		<td>{{$danhsach1->IDLoaiTin}}</td>
		<td>{{$danhsach1->TenLoaiTin}}</td>
		<td> <a href="sua/{{$danhsach1->IDLoaiTin}}">Sửa</a></td>
		<td> <a href="xoa/{{$danhsach1->IDLoaiTin}}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa, mọi bài viết trong mục cũng sẽ bị hủy')">xóa</a></td>
	</tr>
	@endforeach
	</tbody>
	</table>
</div>
</div>

@endsection