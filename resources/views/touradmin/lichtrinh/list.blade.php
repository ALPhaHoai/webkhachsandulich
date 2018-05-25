@extends('touradmin.layout.bodycontent')
@section('title') Danh sách 
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/addtour.css')}}">
@endsection
@section('content')
<div class="list-title">{{$title}}</div>
<div><ol class="breadcrumb">
	<li>
		<a href="#">Home</a>
	</li>

	<li>
		<a href="{{route('admin.tour.getdetail',['id'=>$tour->ID])}}">{{$tour->TenTour}}</a>
	</li>
	<li class="active">{{$title}}</li>
</ol>
</div>


<div class="Location col-lg-12">
	<div class="step">1</div>
	<div class="step activeloc">2</div>
	<div class="step">3</div>
	<div class="step">4</div>
	<div class="step">5</div>
</div>

<div class="panel panel-default">
	<div class="panel-heading"><b>Bước 2 : Thêm thông tin lịch trình</b></div>
</div>
<div class="table">
<table id="table_id" class="display">
	<thead>
	<tr>
		@foreach($columns as $column)
		<th>{{$column}}</th>
		@endforeach
		<th>Xóa</th>
	</tr>
	</thead>
	<tbody id="data_insert">
		@foreach($danhsach as $danhsachitem)
		<tr>
			@foreach($columns as $column)
			@if($column=="NoiDung")
			<td class="get_noidung" idlichtrinh={{$danhsachitem->ID}} style="text-align: center;"><span class="glyphicon glyphicon-file"></span></td>
			@else
			<td>{{ $danhsachitem->$column}}</td>
			@endif
			@endforeach
			<td><a href="{{url('admin/'.$content.'/delete/'.$danhsachitem->ID)}}">Xóa</a></td>
		</tr>
		@endforeach
	</tbody>
</table>
	
</div>


<div class="TourInfo panel panel-default">
	<div class="panel-heading"><b>Thông tin tour</b></div>
  	<div class="panel-body">
  	<div class="col-sm-10"><b>Tên Tour</b> : {{$tour->TenTour}}</div>
  	<div class="col-sm-10"><b>Tỉnh ,thành phố</b> : {{$thanhpho}}</div>
  	<div class="col-sm-10"><b>Khu vực</b> : {{$khuvuc}}</div>
  	</div>
</div>


<div class="AddForm panel panel-default">
	<div class="panel-heading"><b>Thêm thông tin lịch trình</b></div>
  	<div class="panel-body">
  	<form name="frm" action="{{route('admin.lichtrinh.add',['id'=>$tour->ID])}}" method="post" class="form-horizontal" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
	<input id="txt_ngay" type="hidden" name="ngaythu" class="form-control" placeholder="Ngày thứ" value="{{$ngaythu}}">
	<div class="form-group">
		<label class="control-label col-sm-2">Ngày thứ</label>
		<div class="col-sm-10"> 
		 	{{$ngaythu}}
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2">Nội dung</label>
		<div class="col-sm-10"> 
		<textarea id="floranote" name="noidung"  class="form-control"></textarea>
		</div>
	</div>
	<div style="margin-left: 300px;"><button idTour="{{$tour->ID}}" type="submit" class="btn btn-primary">Thêm</button></div>
</form>
@if(sizeof($danhsach)!=0)
<div class="panel-footer"><button type="button" class="btn btn-primary"><a href="{{route('admin.lichkhoihanh.getadd',['idtour'=>$tour->ID])}}" class="linkbtn" style="text-decoration:none;"><span class="glyphicon glyphicon-chevron-right"></span> Bước tiếp theo</button></a>
</div>
@endif
  	</div>
</div>

<div id="popup" class="panel panel-default">
	<div class="panel-heading"><p><b>Nội dung chi tiết</b></p><button type="button" class="closebtn" style="float: right; position: absolute; right: 20px; top: 15px;"><span class="glyphicon glyphicon-remove"></span></button></div>
  	<div class="panel-body">
  	<form name="frm1" action="" method="post" class="form-horizontal" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="{!! csrf_token() !!}">
	<textarea class="floranote"></textarea>
	</form>
  	</div>
  	<div class="panel-footer"><button style="margin-left: 300px; margin-top:20px;" id="update_btn" idTour="{{$tour->ID}}" type="button" class="btn btn-primary">Hoàn tất</button></div>
</div>

<div id="notice" class="panel panel-success">
	<div class="panel-heading"><b>Thông báo</b></div>
  	<div class="panel-body">
  	<b> Update thành công</b>
  	</div>
</div>

<div class="dark_screen"></div>


@section('script')
<script type="text/javascript" src="{{asset('js/ajaxLichTrinh.js')}}"></script>
@endsection
@endsection
