@extends('touradmin.layout.bodycontent')
@section('title') Phương tiện đi kèm
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/addtour.css')}}">
@endsection
@section('content')
<div class="list-title">Phương tiện đi kèm</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">DashBoard</a>
	</li>
	<li>
		<a href="{{route('admin.list.tour')}}">tour</a>
	</li>
	<li class="active">Phương tiện đi kèm</li>
</ol>
</div>
<div class="Location col-lg-12">
	<div class="step">1</div>
	<div class="step ">2</div>
	<div class="step">3</div>
	<div class="step">4</div>
	<div class="step activeloc">5</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><b>Bước 5 : Thêm phương tiện đi kèm</b></div>
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

<div class="panel panel-default">
<div class="panel-heading">Phương tiện đi kèm có sẵn</div>
<div class="panel-body">
<div class="table">
<?php $found=0; ?>
<form name="frm">
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
<table id="table_id" class="display">
	<thead>
	<tr>
		@foreach($columns as $column)
		<th>{{$column}}</th>
		@endforeach
		<th>Bao gồm</th>
		<th>Ghi Chú</th>
	</tr>
	</thead>
	<tbody>
		@foreach($phuongtien as $phuongtienitem)
		<tr>
			@foreach($columns as $column)
			<td>{{ $phuongtienitem->$column}}</td>
			@endforeach
			@foreach($phuongtiendikem as $dikem)
				@if($dikem->IDPhuongTien == $phuongtienitem->ID)
					<td><input onchange='check(this);' type="checkbox" name="" class="unchecked" idTour="{{$idTour}}" idPhuongTien="{{$phuongtienitem->ID}}" checked></td>
					<td><textarea id="{{$phuongtienitem->ID}}" idTour={{$idTour}} onchange='update(this)' name="ghichu">{{$dikem->GhiChu}}</textarea></td>
					<?php $found=1; ?>
					@break
				@endif
			@endforeach
			@if($found==0)  																								<td><input onchange='check(this);' type="checkbox" name="" class="unchecked" idTour={{$idTour}} idPhuongTien="{{$phuongtienitem->ID}}" ></td>
				<td><textarea onchange='update(this)' idTour={{$idTour}} id="{{$phuongtienitem->ID}}" name="ghichu" disabled=true;></textarea></td>
			@else
				<?php $found=0; ?>
			@endif
		</tr>
		@endforeach
	</tbody>
</table>
</form>
</div>
</div>
<div class="panel-footer">	
		<a class="linkbtn" href="{{route('admin.tour.getdetail',['id'=>$idTour])}}"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-chevron-ok">
	</span> Hoàn tất</button></a>
</div>
</div>
@section('script')
<script type="text/javascript" src="{{asset('js/ajaxPhuongTienDiKem.js')}}"></script>
@endsection
@endsection
