@extends('touradmin.layout.bodycontent')
@section('title') Danh sách user
@endsection
@section('css')
@endsection
@section('content')

<h1>Thành viên - danhsach</h1>

<div class="col-lg-12" style="margin-bottom: 20px;">
	<a href="{{route('admin.user.getthem')}}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Add</button></a>
</div>
<div class="container">
<div class="row">
	<table class="table_id table table-striped table-bordered table-hover" style="width: 100%;" id="myTable">
	<thead>
	<tr align="center">
		<td> Mã </td>
		<td> Họ Tên </td>
		<td>Email </td>
		<td> Chức vụ </td>
		<td> Ngày tạo </td>
		<td>Sửa</td>
		<td>Xóa</td>
	</tr>
	</thead>
	<tbody>
	@foreach($danhsach as $danhsach1)
	<tr class="odd gradeX">
		<td>{{$danhsach1->id}}</td>
		<td>{{$danhsach1->name}}</td>
		<td>{{$danhsach1->email}}</td>
		<td><?php $chucvu=DB::table('nhomnguoidung')->where('ID',$danhsach1->level)->first(); 

		echo $chucvu->TenNhomNguoiDung;?></td>
		<td>{{$danhsach1->created_at}}</td>
		<td> <a href="{{ url('admin/user/sua',['iduser'=>$danhsach1->id])}}" >Sửa</a></td>
		<td> <a href="{{ url('admin/user/xoa',['iduser'=>$danhsach1->id])}}" onclick="return xacnhanxoa('Bạn có chắc chắn muốn xóa ?')">xóa</a></td>
	</tr>
@endforeach
</tbody>
</table>
</div>
</div>

@endsection