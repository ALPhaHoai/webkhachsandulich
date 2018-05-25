@extends('touradmin.layout.bodycontent')
@section('title') Sửa loại tour 
@endsection
@section('content')
<div class="list-title">Sửa Loại tour</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">DashBoard</a>
	</li>
	<li>
		<a href="{{route('admin.list.loaitour')}}">Loại tour</a>
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
<div class="panel-heading">Thêm loại tour </div>
<div class="panel-body">
<form action="{{route('admin.loaitour.update',['id'=>$loaitour->ID])}}" method="post" class="form-horizontal">
{{ csrf_field() }}
	<div class="form-group">
		<label class="control-label col-sm-2">Tên loại tour</label>
		<div class="col-sm-10"> 
		<input type="text" name="ten" class="form-control" value="{{$loaitour->TenLoaiTour}}">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ghi chú</label>
		<div class="col-sm-10"> 
		<textarea id="floranote" name="ghichu"  class="form-control">{{$loaitour->GhiChu}}</textarea>
		</div>
	</div>
	<div style="margin-left: 300px;"><button type="submit" class="btn btn-primary">Sửa</button></div>
</form>
</div>
</div>
@endsection