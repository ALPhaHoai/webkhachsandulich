@extends('touradmin.layout.bodycontent')
@section('title') Danh sách tour
@endsection
@section('content')
@if($danhsach==null)
@endif
<div class="list-title">Danh Sách tour</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">Home</a>
	</li>
	<li class="active">Tour</li>
</ol>
</div>
<div class="table">
<div class="addBtn" style="margin-bottom:10px "><a href="{{route('admin.tour.getadd')}}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"> Add</span></button></a></div>
<table id="table_id" class="display">
	<thead>
	<tr>
		<th>ID</th>
		<th>Tên tour</th>
		<th>Địa điểm </th>
		<th>Ngày khởi hành</th>
		<th>Giá</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
		@foreach($danhsach as $danhsachitem)
		<tr>
			<td>{{$danhsachitem->ID}}</td>
			<td>{{$danhsachitem->TenTour}}</td>
			<td>{{$danhsachitem->IDKhuVuc}}</td>
			<td>{{$danhsachitem->NgayKhoiHanh}}</td>
			<td>{{$danhsachitem->Gia}}</td>
			<td>
			<div class="dropdown">
  				<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Action
  				<span class="caret"></span></button>
  					<ul class="dropdown-menu">
    					<li><a href="{{route('admin.tour.getdetail',['id'=>$danhsachitem->ID])}}">Chi tiết</a></li>
    					<li><a href="{{route('admin.lichtrinh.getadd',['idtour'=>$danhsachitem->ID])}}">Lịch trình</a></li>
    					<li><a href="{{route('admin.lichkhoihanh.getadd',['idtour'=>$danhsachitem->ID])}}">Lịch khởi hành</a></li>
    					<li><a href="{{route('admin.dichvudikem.getadd',['idtour'=>$danhsachitem->ID])}}">Dịch vụ đi kèm</a></li>
    					<li><a href="{{route('admin.phuongtiendikem.getadd',['idtour'=>$danhsachitem->ID])}}">Phương tiện đi kèm</a></li>
    					<li><a class="tourdel" onclick="showmessage('Bạn có chắc chắn muốn xóa , toàn bộ thông tin tour sẽ bị hủy','{{route('admin.tour.delete',['idtour'=>$danhsachitem->ID]) }}')" href="#">Xóa Tour</a></li>
  					</ul>
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>
	
</div>

@endsection
