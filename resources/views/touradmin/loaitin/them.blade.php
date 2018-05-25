@extends('touradmin.layout.bodycontent')
@section('title') Thêm loại tin
@endsection
@section('content')
<h1>Loại tin- thêm</h1>

<form action="{!!route('admin.loaitin.them')!!}" method="post" class="form-vertical">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{ csrf_token() }}">﻿
<div class="form-group">
	<label>Mã loại tin</label>
	<input type="text" name="maloaitin" class="form-control" placeholder="please enter ID">
</div>
<div class="form-group">
	<label>Tên loại tin</label>
	<input type="text" name="ten" class="form-control" placeholder="please enter name">
</div>
<button type="submit" class="btn btn-primary"> Thêm </button>
<button type="reset" class="btn btn-primary"> reset </button>
</form>

@endsection