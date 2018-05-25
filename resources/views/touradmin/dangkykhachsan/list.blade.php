@extends('touradmin.layout.bodycontent')
@section('title') Danh sách 
@endsection
@section('content')


<div class="list-title">Danh sách đăng ký khách sạn</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">Home</a>
	</li>
	<li class="active">Danh sách đăng ký khách sạn </li>
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

<table id="table_id" class="display">
	<thead>
	<tr>
		<th>Tên khách sạn</th>
		<th>email khách sạn</th>
		<th>SDT khách sạn</th>
		<th>Tên đại diện</th>
		<th>email đại diện</th>
		<th>SDT đại diện</th>
		<th>Duyệt</th>
		<th>Hủy</th>
	</tr>
	</thead>
	<tbody>
	@foreach($dangkylist as $dangky)
		<tr>
			<td>{{$dangky->TenKhachSan}}</td>
			<td>{{$dangky->EmailKhachSan}}</td>
			<td>{{$dangky->SDTKhachSan}}</td>
			<td>{{$dangky->TenDaiDien}}</td>
			<td>{{$dangky->EmailDaiDien}}</td>
			<td>{{$dangky->SDTDaiDien}}</td>
			<td><a href=""> Duyet</a></td>
			<td><a href=""> Huy</a></td>
		</tr>
	@endforeach
	</tbody>
</table>
	
</div>
@endsection