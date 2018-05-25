@extends('touradmin.layout.bodycontent')
@section('title') Sửa loại tin
@endsection
@section('content')

<h1>Loại tin - Sửa</h1>
<form action="{!!route('admin.loaitin.sua')!!}" method="post" class="form-horizontal">
<input type="hidden" name="_token" value="{{ csrf_token() }}">﻿
	<form-group>
		<label>Mã </label>
		<input type="text" name="ma" value="{{$ma}}" class="form-control" readonly>
	</form-group>
		<form-group>
		<label> Tên</label>
		<input type="text" name="ten" value="{{$ten}}" class="form-control">
	</form-group>
	<button class="btn btn-primary" type="submit">Sửa</button>
</form>
@endsection