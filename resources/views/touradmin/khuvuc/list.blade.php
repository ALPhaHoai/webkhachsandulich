@extends('touradmin.layout.bodycontent')
@section('title') Danh sách 
@endsection
@section('content')
@if($danhsach==null)
@endif
<div class="list-title">{{$title}}</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">Home</a>
	</li>
	<li class="active">{{$title}}</li>
</ol>
</div>
<div class="table">
<div class="addBtn" style="margin-bottom:10px "><a href="{{route('admin.'.$content.'.getadd')}}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"> Add</span></button></a></div>
<table id="table_id" class="display">
	<thead>
	<tr>
		@foreach($columns as $column)
		<th>{{$column}}</th>
		@endforeach
		<td>Sửa</td>
		<th>Xóa</th>
	</tr>
	</thead>
	<tbody>
		@foreach($danhsach as $danhsachitem)
		<tr>
			@foreach($columns as $column)
			<td>{{ $danhsachitem->$column}}</td>
			@endforeach
			<td><a href="{{url('admin/'.$content.'/getupdate/'.$danhsachitem->IDKhuVuc)}}">Sửa</a></td>
			<td><a href="{{url('admin/'.$content.'/delete/'.$danhsachitem->IDKhuVuc)}}">Xóa</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
	
</div>
@endsection