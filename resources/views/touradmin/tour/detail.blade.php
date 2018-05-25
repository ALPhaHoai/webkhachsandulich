@extends('touradmin.layout.bodycontent')
@section('title') Chi tiết tour
@endsection
@section('css')
@endsection
@section('content')
@if($tour==null)
@endif
<div class="list-title">Chi tiết Tour</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">Home</a>
	</li>
	<li>
		<a href="{{route('admin.list.tour')}}">Tour</a>
	</li>
	<li class="active">{{$tour->TenTour}}</li>
</ol>
</div>
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if(count($errors)>0)
	<div class="alert alert-danger">
		<ul>
			@foreach($errors->all() as $error)
				<li>{!! $error !!}</li>
			@endforeach
		</ul>
	</div>
@endif
<div class="panel panel-default">
	<div class="panel-heading"> <b>Thông tin cơ bản </b></div>
	<div class="panel-body">
<form action="{{route('admin.tour.update',['idtour'=>$tour->ID])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="form-group">
		<label class="control-label col-sm-2">Tên Tour</label>
		<div class="col-sm-10"> 
		<input type="text" name="tentour" class="form-control" placeholder="Tên Tour" value="{{$tour->TenTour}}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Tổng quan</label>
		<div class="col-sm-10"> 
		<textarea id="floranote" name="tongquan"  class="form-control">{{$tour->TongQuan}}</textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Khu vực</label>
		<div class="col-sm-10"> 
		<select name="khuvuc" class="form-control">
			<option value="{{$curkhuvuc->IDKhuVuc}}" selected>{{$curkhuvuc->TenKV}}</option>
			@foreach($listkhuvuc as $khuvuc)
				<option value="{{$khuvuc->IDKhuVuc}}">{{$khuvuc->TenKV}}</option>
			@endforeach
		</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Khu vực khởi hành</label>
		<div class="col-sm-10"> 
		<select name="khoihanh" class="form-control">
			<option value="{{$curkhuvuc->IDKhuVuc}}" selected>{{$curkhuvuckhoihanh->TenKV}}</option>
			@foreach($listkhuvuckhoihanh as $khuvuc)
				<option value="{{$khuvuc->IDKhuVuc}}">{{$khuvuc->TenKV}}</option>
			@endforeach
		</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Loại Tour</label>
		<div class="col-sm-8"> 
		<select name="idloaitour" class="form-control">
			<option value="{{$curloaitour->ID}}" selected>{{$curloaitour->TenLoaiTour}}</option>
			@foreach($listloaitour as $loaitour)
				<option value="{{$loaitour->ID}}">{{$loaitour->TenLoaiTour}}</option>
			@endforeach
		</select>
		</div>
		<div class="col-sm-2"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm loại</button></div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ngày khởi hành</label>
		<div class="col-sm-10"> 
		<input type="date" name="ngaykhoihanh" class="form-control" value="{{$tour->NgayKhoiHanh}}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Giá</label>
		<div class="col-sm-10"> 
		<input type="number" name="gia" class="form-control" value="{{$tour->Gia}}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Giá khuyến mãi</label>
		<div class="col-sm-10"> 
		<input type="number" name="giakhuyenmai" class="form-control" value="{{$tour->GiaKhuyenMai}}">
		</div>
	</div>
	<div class="form-group" id="imgDisplay">
		<img src="{{asset($tour->AnhDaiDien)}}">
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ảnh đại diện</label>
		<div class="col-sm-10"> 
		<input type="file" name="anhdaidien">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ghi chú</label>
		<div class="col-sm-10"> 
		<textarea style="height: 300px;" class="form-control" name="ghichu">{{$tour->GhiChu}}</textarea>
		</div>
	</div>
	<button type="submit" class="btn btn-primary" style="margin-left: 300px;">Update</button>
	</form>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><b>Ảnh Tour</b></div>
	<div id="tourimg_holder" class="panel-body">
	<form name="imgform" action="{{route('admin.tour.updateimg',['idtour'=>$tour->ID])}}" method="post" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
	@foreach($listanhtour as $anhtour)
		<div class="touritem" idanh={{$anhtour->ID}} >
			<div class="tourimg"><img src="{{asset($anhtour->URL)}}"></div>
			<div class="addimg"><input type="file" name="anhtour[]"></div>
			<div class="delimg" idanh={{$anhtour->ID}}><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span></button></div>
		</div>
	@endforeach
	<div class="insert_more">
		<div class="form-group">
			<input type="file" name="anhtour[]" class="form-control">
		</div>
	</div>
	</div>
	<div class="panel-footer">
		<button id="plus" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span> Thêm slot ảnh</button>
		<button id="minus" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-minus"></span> Bỏ slot ảnh</button>
		<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Update ảnh Tour</button>
	</div>
	</form>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><b>Lịch trình</b></div>
	<div class="panel-body">
		<table class="table_id" class="display">
	<thead>
	<tr>
		<th>ID</th>
		<th>Ngày thứ</th>
		<th>Nội dung hoạt động</th>
	</tr>
	</thead>
	<tbody>
		@foreach($listlichtrinh as $lichtrinh)
			<tr>
				<td>{{$lichtrinh->ID}}</td>
				<td>{{$lichtrinh->NgayThu}}</td>
				<td>{{$lichtrinh->NoiDung}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<a href="{{route('admin.lichtrinh.getadd',['idtour'=>$tour->ID])}}"><button type="button" class="btn btn-primary" style="float: right;">Sửa</button></a>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<b>Ngày khởi hành</b>
	</div>
	<div class="panel-body">
		<table class="table_id" class="display">
	<thead>
	<tr>
		<th>ID</th>
		<th>Ngày khởi hành</th>
		<th>Đặc điểm</th>
		<th>Địa điểm</th>
		<th>Số chỗ</th>
		<th>Giá</th>
	</tr>
	</thead>
	<tbody>
		@foreach($listlichkhoihanh as $lichkhoihanh)
			<tr>
				<td>{{$lichkhoihanh->ID}}</td>
				<td>{{$lichkhoihanh->NgayKhoiHanh}}</td>
				<td>{{$lichkhoihanh->DacDiem}}</td>
				<td>{{$lichkhoihanh->DiaDiem}}</td>
				<td>{{$lichkhoihanh->SoCho}}</td>
				<td>{{$lichkhoihanh->Gia}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
<a href="{{route('admin.lichkhoihanh.getadd',['idtour'=>$tour->ID])}}"><button type="button" class="btn btn-primary" style="float: right;">Sửa</button></a>
	</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<b>Dịch vụ đi kèm</b>
	</div>
	<div class="panel-body">
		<table class="table_id">
			<thead>
				<tr>
					<td>Tên dịch vụ</td>
					<td>Mô tả</td>
				</tr>
			</thead>
			<tbody>
				@foreach($listdichvu as $dichvu)
				<tr>
					<td>{{$dichvu->TenDichVu}}</td>
					<td>{{$dichvu->MoTa}}</td>	
				</tr>
				@endforeach
			</tbody>
		</table>
		<a href="{{route('admin.dichvudikem.getadd',['idtour'=>$tour->ID])}}"><button type="button" class="btn btn-primary" style="float: right;">Sửa</button></a>
	</div>
	</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<b>Phương tiện đi kèm</b>
	</div>
	<div class="panel-body">
		<table class="table_id">
			<thead>
				<tr>
					<td>Tên phương tiện</td>
					<td>Mô tả</td>
				</tr>
			</thead>
			<tbody>
				@foreach($listphuongtien as $phuongtien)
				<tr>
					<td>{{$phuongtien->Ten}}</td>
					<td>{{$phuongtien->MoTa}}</td>	
				</tr>
				@endforeach
			</tbody>
		</table>
		<a href="{{route('admin.phuongtiendikem.getadd',['idtour'=>$tour->ID])}}"><button type="button" class="btn btn-primary" style="float: right;">Sửa</button></a>
	</div>
</div>



</div>


@section('script')
<script type="text/javascript" src="{{asset('js/ajaxTourInfo.js')}}"></script>
<script type="text/javascript" src="{{asset('js/ajaxAnhTour.js')}}"></script>
@endsection
@endsection