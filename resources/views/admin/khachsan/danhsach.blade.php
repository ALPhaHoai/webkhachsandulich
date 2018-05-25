@extends('admin.layout.thongtinindex')
@section('content')

<h1>Khách Sạn- danhsach</h1>


<div class="container" style=" width: 100%;">
	<table class="table table-hover table-bordered table-condensed" style="table-layout: fixed; width: 100%;" id="myTable">
	<thead>
	<tr>
		<td>Mã khách sạn </td>
		<td>Tên khách sạn </td>
		<td>Địa chỉ </td>
		<td>Số phòng </td>
		<td>Liên hệ </td>
		<td>Danh sách đơn đặt phòng</td>
		<td>Sửa chính sách</td>
		<td>Sửa thông tin khách sạn </td>
		<td>Xóa </td>
	</tr>
	</thead>
	<tbody>
	@foreach($danhsach as $danhsach1)
	<tr>
		<td>{{$danhsach1->IDKhachSan}}</td>
		<td>{{$danhsach1->TenKhachSan}}</td>
		<td>{{$danhsach1->DiaChi}}</td>
		<td>{{$danhsach1->SoPhong}}</td>
		<td>{{$danhsach1->LienHe}}</td>
		<td><a href="{{url('admin/don/dontheoks/'.$danhsach1->IDKhachSan)}}">Xem</a></td>
		<td> <a href="{!! url('admin/chinhsach/sua/'.$danhsach1->IDKhachSan)!!}">Sửa</a></td>
		<td> <a href="sua/{{$danhsach1->IDKhachSan}}">Sửa</a></td>
		<td> <a href="xoa/{{$danhsach1->IDKhachSan}}" onclick=" return xacnhanxoa('Bạn có chắc chắn muốn xóa khách sạn này , toàn bộ thông tin về khách sạn sẽ bị hủy')">Xóa</a></td>
	</tr>
@endforeach
</tbody>
</table>
</div>

@endsection