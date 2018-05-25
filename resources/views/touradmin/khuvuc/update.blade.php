@extends('touradmin.layout.bodycontent')
@section('title') Sửa khu vực
@endsection
@section('content')
<div class="list-title">Sửa khu vực</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">DashBoard</a>
	</li>
	<li>
		<a href="{{route('admin.list.khuvuc')}}">Khu vực</a>
	</li>
	<li class="active">Sửa</li>
</ol>
</div>
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
<div class="panel panel-default form">
<div class="panel-heading">Sửa khu vực </div>
<div class="panel-body">
<form action="{{route('admin.khuvuc.update',['id'=>$khuvuc->IDKhuVuc])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="form-group">
		<label class="control-label col-sm-2">Tên khu vực</label>
		<div class="col-sm-10"> 
		<input type="text" name="tenkhuvuc" class="form-control" placeholder="Tên Khu vực" value="{{$khuvuc->TenKV}}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Thuộc tỉnh , thành phố</label>
		<div class="col-sm-10"> 
		<select name="thanhpho" class="form-control">
			@foreach($listthanhpho as $thanhpho)
				@if($thanhpho->ID == $khuvuc->IDDiaDiem)
					<option value="{{$thanhpho->ID}}" selected>{{$thanhpho->TenThanhPho}}</option>
				@else
					<option value="{{$thanhpho->ID}}">{{$thanhpho->TenThanhPho}}</option>
				@endif
			@endforeach
		</select>
		</div>
	</div>
	<div class="form-group" id="imgDisplay">
		<img src="{{asset($khuvuc->anhdaidien)}}">
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ảnh đại diện</label>
		<div class="col-sm-10"> 
		<input type="file" name="anhdaidien">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Giới thiệu</label>
		<div class="col-sm-10"> 
		<textarea name="gioithieu"  class="form-control">{{$khuvuc->GioiThieu}}</textarea>
		</div>
	</div>
	<div style="margin-left: 300px;"><button type="submit" class="btn btn-primary">Sửa</button></div>
</form>
</div>
</div>
@endsection