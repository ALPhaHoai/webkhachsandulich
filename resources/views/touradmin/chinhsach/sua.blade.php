@extends('touradmin.layout.bodycontent')
@section('title') Sửa chính sách
@endsection
@section('content')

<h1>Chính sách - Sửa</h1>
<div class="col-lg-11" style="padding-bottom: 120px">
<form action="{!!route('admin.chinhsach.sua')!!}" method="post" class="form-horizontal">
<input type="hidden" name="_token" value="{{ csrf_token() }}">﻿
	
<div class="form-group">
	<label>Mã chính sách</label><br />
	<input class="form-control" name="idCS" value="{{$idCS}}" readonly>
</div>
<div class="form-group">
	<label>Mã khách sạn</label><br />
	<input class="form-control" name="idKS" value="{{$idKS}}">
</div>
<div class="form-group">
	<label>Nhận phòng</label><br />
	<input class="form-control" type="time" name="nhanphong" value="{{$nhanphong}}">
</div>
<div class="form-group">
	<label>Trả phòng</label><br />
	<input class="form-control" type="time" name="traphong" value="{{$traphong}}">
</div>
<div class="form-group">
	<label>Di chuyển</label><br />
	<textarea class="form-control" rows="10" name="dichuyen" >{{$dichuyen}}</textarea>
</div>
<div class="form-group">
	<label>Hoạt động</label><br />
	<textarea class="form-control" rows="10" name="hoatdong" >{{$hoatdong}}</textarea>
</div>
<div class="form-group">
	<label>Hướng dẫn</label><br />
	<textarea class="form-control" rows="10" name="huongdan" >{{$huongdan}}</textarea>
</div>
<div class="form-group">
	<label>Phụ thu</label><br />
	<textarea class="form-control" rows="10" name="phuthu" >{{$phuthu}}</textarea>
</div>
<div class="form-group">
	<button class="btn btn-primary" type="submit">Sửa</button>
</div>
	
</form>
</div>
@endsection