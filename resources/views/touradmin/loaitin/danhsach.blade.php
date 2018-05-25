@extends('touradmin.layout.bodycontent')
@section('title') Danh sách loại tin
@endsection
@section('content')

<h1>Loại tin- danhsach</h1>

<div class="col-lg-12" style="margin-bottom: 20px;">
	<a href="{{route('admin.loaitin.getthem')}}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add</button></a>
</div>
<div class="container">
<div class="row">
	<table class="table_id table table-striped table-bordered table-hover" style="table-layout: fixed; width: 100%;" >
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