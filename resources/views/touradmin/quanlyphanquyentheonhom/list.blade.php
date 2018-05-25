@extends('touradmin.layout.bodycontent')
@section('title') Quản lý phân quyền theo nhóm 
@endsection
@section('content')
<div class="list-title">Quản lý phân quyền theo nhóm</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">Home</a>
	</li>
	<li class="active">Phân quyền theo nhóm</li>
</ol>
</div>

<form name="frm1">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<div class="col-lg-12 form-group">
	<label class="control-label col-sm-2" ><b>Chọn nhóm người dùng  </b></label>
	<div class="col-sm-10">
	<select id="usergroup" class="form-control" onchange='getauthlist();'>
		<option checked > ----- Select a group ----- </option>
		@foreach($listnhomnguoidung as $nhomnguoidung)
		<option value="{{$nhomnguoidung->ID}}">{{$nhomnguoidung->TenNhomNguoiDung}}</option>
		@endforeach
	</select>
	</div>
</div>
</form>

<div class="col-lg-12"> Cho phép truy cập</div>
<div class="table">
<table class="display table_id">
	<thead>
	<tr>
		<td>Tên quyền</td>
		<td>Thêm</td>
		<td>Sửa </td>
		<td>Xóa</td>
		<td>Xóa Quyền cho nhóm</td>
	</tr>
	</thead>
	<tbody id="allowinsert">
	
	</tbody>
</table>
</div>

<div class="col-lg-12">Không cho phép truy cập </div>
<div class="table" >
<table class="display table_id">
	<thead>
	<tr>
		<td>Tên quyền</td>
		<td>Thêm quyền nhóm</td>
	</tr>
	</thead>
	<tbody id="notallowinsert">
	
	</tbody>
</table>
	
</div>

@section('script')
<script type="text/javascript" src="{{asset('js/quanlyphanquyen/ajaxphanquyen.js')}}"></script>
@endsection
@endsection
