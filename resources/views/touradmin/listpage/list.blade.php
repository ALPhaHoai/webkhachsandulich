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
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session('cusError'))
    <div class="alert alert-danger">
        {{ session('cusError') }}
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
			<td><a href="{{url('admin/'.$content.'/getupdate/'.$danhsachitem->ID)}}">Sửa</a></td>
			<td><a href="{{url('admin/'.$content.'/delete/'.$danhsachitem->ID)}}">Xóa</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
	
</div>
@endsection
