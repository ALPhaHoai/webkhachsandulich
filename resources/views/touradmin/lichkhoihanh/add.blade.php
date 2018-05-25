@extends('touradmin.layout.bodycontent')
@section('title') Lịch khởi hành
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/addtour.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/addlichkhoihanh.css')}}">
@endsection
@section('content')
<div class="list-title">Lịch khởi hành</div>
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
	<div class="step">1</div>
	<div class="step">2</div>
	<div class="step activeloc">3</div>
	<div class="step">4</div>
	<div class="step">5</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><b>Bước 3 : Thông tin khởi hành</b></div>
</div>

<div class="table">
<div class="panel panel-default">
<div class="panel-heading">Thông tin khởi hành</div>
<form action="{{route('admin.lichkhoihanh.next')}}" method="POST">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<input type="hidden" name="idtour" value="{{$idtour}}">
<div class="panel-body">
<table id="table_id" class="display">
	<thead>
	<tr>
		<th>Ngày khởi hành</th>
		<th>Đặc điểm</th>
		<th>Địa điểm </th>
		<th>Số chỗ</th>
		<th>Giá</th>
		<th>Xóa</th>
	</tr>
	</thead>
	<tbody id="insert">
		@foreach($listlichkhoihanh as $lichkhoihanh)
		<tr>
		<input type="hidden" name="idlichkhoihanh[]" value="{{$lichkhoihanh->ID}}">
			<td><div class="form-group">
				<input type="date" name="updngaykhoihanh[]"  value="{{$lichkhoihanh->NgayKhoiHanh}}">
			</div></td>
			<td><div class="form-group">
				<input type="text" name="upddacdiem[]"  value="{{$lichkhoihanh->DacDiem}}">
			</div></td>
			<td><div class="form-group">
				<textarea name="upddiadiem[]">{{$lichkhoihanh->DiaDiem}}</textarea>
			</div></td>
			<td><div class="form-group">
				<input type="number" name="updsocho[]"  value="{{$lichkhoihanh->SoCho}}">
			</div></td>
			<td><div class="form-group">
				<input type="number" name="updgia[]" value="{{$lichkhoihanh->Gia}}">
			</div></td>
			<td><a href="{{route('admin.lichkhoihanh.delete',['id'=>$lichkhoihanh->ID])}}"><span class="glyphicon glyphicon-remove "></span></a></td>
		</tr>
		@endforeach
		<tr>
			<td><div class="form-group">
				<input type="date" name="ngaykhoihanh[]">
			</div></td>
			<td><div class="form-group">
				<input type="text" name="dacdiem[]">
			</div></td>
			<td><div class="form-group">
				<textarea name="diadiem[]"></textarea>
			</div></td>
			<td><div class="form-group">
				<input type="number" name="socho[]">
			</div></td>
			<td><div class="form-group">
				<input type="number" name="gia[]">
			</div></td>
			<td>&nbsp</td>
		</tr>
	</tbody>
</table>

	</div>
	<div class="panel-footer">
		
		<button id="morebtn" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus">
	</span> Thêm ngày</button>
		<button  type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Lưu thay đổi</button>
		@if(sizeof($listlichkhoihanh)!=0)	
		<a class="linkbtn" href="{{route('admin.dichvudikem.getadd',['id'=>$idtour])}}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-right">
	</span> Bước tiếp theo</button></a>
		@endif

	</div>
</form>
</div>
</div>
@section('script')
<script type="text/javascript" src="{{asset('js/addlichkhoihanh.js')}}"></script>
@endsection
@endsection