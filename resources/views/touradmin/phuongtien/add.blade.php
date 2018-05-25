@extends('touradmin.layout.bodycontent')
@section('title') Thêm phương tiện
@endsection
@section('content')
<div class="list-title">Add phương tiện</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">DashBoard</a>
	</li>
	<li>
		<a href="{{route('admin.list.phuongtien')}}">Phương tiện</a>
	</li>
	<li class="active">Thêm</li>
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
<div class="panel-heading">Thêm Phương tiện </div>
<div class="panel-body">
<form action="{{route('admin.phuongtien.add')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
{{ csrf_field() }}
	<div class="form-group">
		<label class="control-label col-sm-2">Tên phương tiện</label>
		<div class="col-sm-10"> 
		<input type="text" name="ten" class="form-control" placeholder="Tên phương tiện">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Mô tả</label>
		<div class="col-sm-10"> 
		<textarea class="form-control" name="mota" id="floranote"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Ảnh đại diện</label>
		<div class="col-sm-10"> 
		<input type="file" name="anhdaidien" class="form-control">
		</div>
	</div>
	<div style="margin-left: 300px;"><button type="submit" class="btn btn-primary">Thêm</button></div>
</form>
</div>
</div>
@endsection