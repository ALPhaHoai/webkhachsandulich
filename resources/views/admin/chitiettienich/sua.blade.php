@extends('admin.layout.thongtinindex')
@section('content')

<h1>Tiện ích - Sửa</h1>
<form action="{!!route('admin.tienich.sua')!!}" method="post" class="form-horizontal">
<input type="hidden" name="_token" value="{{ csrf_token() }}">﻿
	<form-group>
		<label>Mã tiện ích </label>
		<input type="text" name="id" value="{{$tienich->id}}" class="form-control" readonly>
	</form-group>
		<form-group>
		<label> Nội dung</label>
		<input type="text" name="noidung" value="{{$tienich->NoiDung}}" class="form-control">
	</form-group>
	<button class="btn btn-primary" type="submit">Sửa</button>
</form>
@endsection