@extends('touradmin.layout.bodycontent')
@section('title') Thêm tiện ích
@endsection
@section('content')

<h1>Tiện ích- thêm</h1>

<form action="{!!route('admin.tienich.them')!!}" method="post" class="form-vertical">
{{ csrf_field() }}
<input type="hidden" name="_token" value="{{ csrf_token() }}">﻿
<div class="form-group">
	<label>Nội dung tiện ích</label>
	<input type="text" name="noidung" class="form-control" placeholder="please enter name">
</div>
<button type="submit" class="btn btn-primary"> Thêm </button>
<button type="reset" class="btn btn-primary"> reset </button>
</form>

@endsection