@extends('touradmin.layout.bodycontent')
@section('title') Danh sách đơn đặt phòng theo khách sạn
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/quanlydonkhachsan.css')}}">
@endsection
@section('content')

<h1 > {{$khachsan->TenKhachSan}} - danh sách đơn đặt phòng</h1>

<ol class="breadcrumb" style="border-top: 1px solid black">
	<li>
		<a href="#">Home</a>
	</li>
	<li class="active">Đơn đặt phòng</li>
</ol>
<div class="container">
<div class="row">
<form method="POST" action="{{route('admin.quanlykhachsan.duyetdon')}}">
{{ csrf_field() }}
<div class="panel panel-default">
	<div class="panel-heading"><b>Danh sách các đơn đặt phòng thường</b></div>
	<div class="panel-body">
	<table class="table_id table table-striped table-bordered table-hover" style="width: 100%; table-layout: fixed;" id="myTable">
	<thead>
	<tr align="center">
		<td>Mã đơn</td>
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

	@foreach($danhsachthuong as $danhsach1)

	@if($danhsach1->Duyet==0)
	<tr class="odd gradeX alert alert-danger">
		<td>{{$danhsach1->IDDon}}</td>
		<?php $dondetail=DB::table('dondatphong')->where('IDDon',$danhsach1->IDDon)->get()->first();

				$khachsan=DB::table('khachsan')->where('IDKhachSan',$dondetail->IDKhachSan)->get()->first();
				$loaiphong=DB::table('loaiphong')->where('IDLoaiPhong',$dondetail->IDLoaiPhong)->get()->first();
		 ?>
		<td>{{$loaiphong->TenLoaiPhong}}</td>
		<td>{{$dondetail->SoNgay}}</td>
		<td>{{$danhsach1->TrangThai}}</td>
		<td>{{$danhsach1->LoaiThanhToan}}</td>
		<td>{{$danhsach1->ThanhTien}}</td>
		<td>{{$danhsach1->created_at}}</td>
		<td><input type="checkbox" name="duyet[]" value="{{$danhsach1->IDDon}}"></td>
		<td class="cancelbook" iddon='{{$danhsach2->IDDon}}'>Hủy</td>
	</tr>
		@else
	<tr class="odd gradeX">
		<td>{{$danhsach1->IDDon}}</td>
		<?php $dondetail=DB::table('dondatphong')->where('IDDon',$danhsach1->IDDon)->get()->first();
				$loaiphong=DB::table('loaiphong')->where('IDLoaiPhong',$dondetail->IDLoaiPhong)->get()->first();
		 ?>
		<td>{{$loaiphong->TenLoaiPhong}}</td>
		<td>{{$dondetail->SoNgay}}</td>
		<td>{{$danhsach1->TrangThai}}</td>
		<td>{{$danhsach1->LoaiThanhToan}}</td>
		<td>{{$danhsach1->ThanhTien}}</td>
		<td>{{$danhsach1->created_at}}</td>
		<td>Đã duyệt</td>
		<td class="cancelbook" iddon='{{$danhsach2->IDDon}}'>Hủy</td>
	</tr>
		@endif
@endforeach
</tbody>
</table>
</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><b>Danh sách các đơn đặt cần duyệt trong ngày</b></div>
	<div class="panel-body">
	<table class="table_id table table-striped table-bordered table-hover" style="width: 100%; table-layout: fixed;" id="myTable">
	<thead>
	<tr align="center">
		<td>Mã đơn</td>
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
	@foreach($danhsachduyetngay as $danhsach2)
	
	<tr class="odd gradeX alert alert-danger">
		<td>{{$danhsach2->IDDon}}</td>
		<?php $dondetail=DB::table('dondatphong')->where('IDDon',$danhsach2->IDDon)->get()->first();
				$khachsan=DB::table('khachsan')->where('IDKhachSan',$dondetail->IDKhachSan)->get()->first();
				$loaiphong=DB::table('loaiphong')->where('IDLoaiPhong',$dondetail->IDLoaiPhong)->get()->first();
				$day=strtotime($dondetail->NgayDi) - time();
        		$daydiff=round($day/(60*60*24))+1;
		 ?>
		<td>{{$loaiphong->TenLoaiPhong}}</td>
		<td>{{$dondetail->SoNgay}}</td>
		<td>Còn {{$daydiff}} ngày</td>
		<td> {{$danhsach2->LoaiThanhToan}}</td>
		<td>{{$danhsach2->ThanhTien}}</td>
		<td>{{$danhsach2->created_at}}</td>
		<td><input type="checkbox" name="duyet[]" value="{{$danhsach2->IDDon}}"></td>
		<td class="cancelbook" iddon='{{$danhsach2->IDDon}}'>Hủy</td>
	</tr>
@endforeach
</tbody>
</table>
</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><b>Danh sách đơn hủy mới nhất</b></div>
	<div class="panel-body">
	<table class="table_id table table-striped table-bordered table-hover" style="width: 100%; table-layout: fixed;" id="myTable">
	<thead>
	<tr align="center">
		<td>Mã đơn</td>
		<td>Loại phòng </td>
		<td>Số ngày</td>
		<td>Kiểu thanh toán</td>
		<td>Thành tiền</td>
		<td>Ngày hủy</td>
		<td>Lý do hủy</td>
	</tr>
	</thead>
	<tbody>
	@foreach($danhsachhuy as $danhsach3)
	
	<tr class="odd gradeX">
		<td>{{$danhsach3->IDDon}}</td>
		<?php $dondetail=DB::table('dondatphong')->where('IDDon',$danhsach3->IDDon)->get()->first();
				$khachsan=DB::table('khachsan')->where('IDKhachSan',$dondetail->IDKhachSan)->get()->first();
				$loaiphong=DB::table('loaiphong')->where('IDLoaiPhong',$dondetail->IDLoaiPhong)->get()->first();
		 ?>
		<td>{{$loaiphong->TenLoaiPhong}}</td>
		<td>{{$dondetail->SoNgay}}</td>
		<td> {{$danhsach3->LoaiThanhToan}}</td>
		<td>{{$danhsach3->ThanhTien}}</td>
		<td>{{$danhsach3->updated_at}}</td>
		<td>{{$danhsach3->LyDoHuy}}</td>
	</tr>
@endforeach
</tbody>
</table>
</div>
</div>


<div class="col-lg-12"><button type="submit" class="btn btn-primary">Đã duyệt</button></div>
</form>	

<div id="displaymessage" style="height: 250px; " class="hidden panel panel-default">
	<div class="panel-heading"><b>Lý do hủy đơn</b></div>
	<form action="{{route('admin.quanlykhachsan.huydon')}}" method="POST">
	{{ csrf_field() }}
	<div class="panel-body">
	<input id="iddonhuy" type="hidden" name="iddon">
	<div class="form-group">
	<label>Lý do hủy </label>
		<textarea class="form-control" name="lydohuy" style="width: 100%; height: 100px;"></textarea>
	</div>
	</div>
	<div class="panel-footer">
		<button type="submit" class="btn btn-default">Xác nhận </button>
		<button class="cancel btn btn-default" type="button" class="btn btn-default">Hủy</button>
	</div>
	</form>
</div>
</div>
</div>

@endsection