@extends('touradmin.layout.bodycontent')
@section('title') Danh sách đơn đặt phòng
@endsection
@section('content')

<h1>Đơn đặt phòng- danhsach</h1>


<div class="container">
<div class="row">
<form method="POST" action="{{route('admin.don.duyet')}}">
{{ csrf_field() }}
	<table class="table_id table table-striped table-bordered table-hover" style="width: 100%; table-layout: fixed;" id="myTable">
	<thead>
	<tr align="center">
		<td>Mã đơn</td>
		<td>Khách sạn </td>
		<td>Loại phòng </td>
		<td>Số ngày</td>
		<td>Hiệu lực</td>
		<td>Kiểu thanh toán</td>
		<td>Thành tiền</td>
		<td>Ngày tạo</td>
		<td>Duyệt</td>
		<td>Hủy</td>
	</tr>
	</thead>
	<tbody>
	@foreach($danhsach as $danhsach1)
	@if($danhsach1->Duyet==0)
	<tr class="odd gradeX alert alert-danger">
		<td>{{$danhsach1->IDDon}}</td>
		<?php $dondetail=DB::table('dondatphong')->where('IDDon',$danhsach1->IDDon)->get()->first();
				$khachsan=DB::table('khachsan')->where('IDKhachSan',$dondetail->IDKhachSan)->get()->first();
				$loaiphong=DB::table('loaiphong')->where('IDLoaiPhong',$dondetail->IDLoaiPhong)->get()->first();
		 ?>
		<td>{{$khachsan->TenKhachSan}}</td>
		<td>{{$loaiphong->TenLoaiPhong}}</td>
		<td>{{$dondetail->SoNgay}}</td>
		<td>{{$danhsach1->TrangThai}}</td>
		<td>{{$danhsach1->LoaiThanhToan}}</td>
		<td>{{$danhsach1->ThanhTien}}</td>
		<td>{{$danhsach1->created_at}}</td>
		<td><input type="checkbox" name="duyet[]" value="{{$danhsach1->IDDon}}"></td>
		<td><a href="{{url('admin/don/xoa/'.$danhsach1->IDDon)}}" onclick=" return xacnhanxoa('Bạn có chắc chắn muốn xóa')">Hủy</a></td>
	</tr>
		@else
	<tr class="odd gradeX">
		<td>{{$danhsach1->IDDon}}</td>
		<?php $dondetail=DB::table('dondatphong')->where('IDDon',$danhsach1->IDDon)->get()->first();
				$khachsan=DB::table('khachsan')->where('IDKhachSan',$dondetail->IDKhachSan)->get()->first();
				$loaiphong=DB::table('loaiphong')->where('IDLoaiPhong',$dondetail->IDLoaiPhong)->get()->first();
		 ?>
		<td>{{$khachsan->TenKhachSan}}</td>
		<td>{{$loaiphong->TenLoaiPhong}}</td>
		<td>{{$dondetail->SoNgay}}</td>
		<td>{{$danhsach1->TrangThai}}</td>
		<td>{{$danhsach1->LoaiThanhToan}}</td>
		<td>{{$danhsach1->ThanhTien}}</td>
		<td>{{$danhsach1->created_at}}</td>
		<td>Đã duyệt</td>
		<td><a href="{{url('admin/don/xoa/'.$danhsach1->IDDon)}}" onclick=" return xacnhanxoa('Bạn có chắc chắn muốn xóa')">Hủy</a></td>
	</tr>
		@endif
@endforeach
</tbody>
</table>
<div class="col-lg-12"><button type="submit" class="btn btn-primary">Đã duyệt</button></div>
</form>	
</div>
</div>

@endsection