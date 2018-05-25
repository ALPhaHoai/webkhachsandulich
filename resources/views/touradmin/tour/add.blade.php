@extends('touradmin.layout.bodycontent')
@section('title') Thêm tour 
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/addtour.css')}}">
@endsection
@section('content')
<div class="list-title">Add Tour</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">Home</a>
	</li>
	<li>
		<a href="{{route('admin.list.tour')}}">Tour</a>
	</li>
	<li class="active">Add tour</li>
</ol>
</div>
<div class="Location col-lg-12">
	<div class="step activeloc">1</div>
	<div class="step">2</div>
	<div class="step">3</div>
	<div class="step">4</div>
	<div class="step">5</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><b>Bước 1 : Thêm thông tin tour</b></div>
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
<form action="{{route('admin.tour.add')}}" name="frm" method="post" class="form-horizontal" enctype="multipart/form-data">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="col-lg-9">
<div class="panel panel-default ">
<div class="panel-heading"><b> Thông tin tour</b></div>
<div class="panel-body">
	<div class="form-group">
		<label class="control-label col-sm-2">Tên Tour</label>
		<div class="col-sm-10"> 
		<input type="text" name="ten" class="form-control" placeholder="Tên Tour">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Tổng quan</label>
		<div class="col-sm-10"> 
		<textarea id="floranote" name="tongquan"  class="form-control"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Khu Vực</label>
		<div class="col-sm-10"> 
		<select class="form-control" onchange="getkhuvuc(this)" id="sl_thanhpho">
			<option class="default-select" value="0">--Select-a-city--</option>
			@foreach($listthanhpho as $thanhpho)
			<option value="{{$thanhpho->ID}}">{{$thanhpho->TenThanhPho}}</option>
			@endforeach
		</select>
		</div>
	</div>
		<div class="form-group">
		<label class="control-label col-sm-2">Khu Vực khởi hành</label>
		<div class="col-sm-10"> 
		<select class="form-control" name="khoihanh">
			@foreach($listkhuvuc as $khuvuc)
			<option value="{{$khuvuc->IDKhuVuc}}">{{$khuvuc->TenKV}}</option>
			@endforeach
		</select>
		</div>
	</div>
	<div class="form-group hidden" id="khuvucInput">
		<label class="control-label col-sm-2">Địa điểm</label>
		<div class="col-sm-10"> 
		<select class="form-control" onchange="getvalue(this);" name="khuvuc" id="khuvucInsert" >
		</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Loại Tour</label>
		<div class="col-sm-10"> 
		<select name="idloaitour" class="form-control">
			@foreach($listloaitour as $loaitour)
				<option value="{{$loaitour->ID}}">{{$loaitour->TenLoaiTour}}</option>
			@endforeach
		</select>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Số ngày</label>
		<div class="col-sm-10"> 
		<input type="number" name="songay" class="form-control" placeholder="trong vòng bao nhiêu ngày">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Số đêm</label>
		<div class="col-sm-10"> 
		<input type="number" name="sodem" class="form-control" placeholder="trong vòng bao nhiêu đêm">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ngày khởi hành</label>
		<div class="col-sm-10"> 
		<input type="text" name="ngaykhoihanh" class="form-control" placeholder="ngày khởi hành trong tuần">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ảnh đại diện</label>
		<div class="col-sm-10"> 
		<input type="file" name="anhdaidien" class="form-control" >
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Giá</label>
		<div class="col-sm-10"> 
		<input type="number" name="gia" class="form-control" placeholder="Giá Tour">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Giá Khuyến Mãi</label>
		<div class="col-sm-10"> 
		<input type="number" name="giakhuyenmai" class="form-control" placeholder="Giá Khuyến mãi">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ghi chú</label>
		<div class="col-sm-10"> 
		<textarea class="form-control" name="ghichu"></textarea>
		</div>
	</div>
	<button type="submit" class="btn btn-primary" style="margin-left: 50%;">Bước tiếp theo</button>
</div>
</div>
</div>

<div class="col-lg-3" style="overflow: hidden;">
	<div class="panel panel-default">
	<div class="panel-heading"><b>Ảnh tour</b></div>
		<div class="panel-body">
			@for($i=1;$i<=10;$i++)
			<div class="form-group">
				<input type="file" name="anhtour[]" class="form-control">
			</div>			
			@endfor
			<div id="insert" style="margin-top: 20px;"></div>
		</div>
	</div>
</div>
</form>	
@section('script')
<script type="text/javascript" src="{{asset('js/addtour.js')}}"></script>
@endsection
@endsection