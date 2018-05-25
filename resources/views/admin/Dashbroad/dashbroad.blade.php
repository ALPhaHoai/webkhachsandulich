@extends('admin.layout.thongtinindex')
@section('content')
<div class="col-lg-7">
@if(Auth::user()->level==3||Auth::user()->level==4)
<div class="col-lg-12"><h2>Thông tin bài viết</h2></div>
	<div class="panel panel-default">
		<div class="panel-heading"><b>Thống kê số lượng</b></div>
		<div class="panel-body">
		<form class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-md-3">Số bài viết :</label>
				<div class="col-md-4">
				<input type="text" class="form-control" value="{{ $baivietnum}}" readonly>
				</div>
				<div class="col-md-1"><a href="{{ url('admin/baiviet/danhsach')}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list"></span></a></div>
				<div class="col-md-1"><a href="{{ url('admin/baiviet/them')}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"> Số loại tin :</label>
				<div class="col-md-4">
				<input type="text" class="form-control" value="{{ $loaitinnum}}" readonly>
				</div>
					<div class="col-md-1"><a href="{{ url('admin/loaitin/danhsach')}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list"></span></a></div>
				<div class="col-md-1"><a href="{{ url('admin/loaitin/them')}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a></div>
			</div>
			<button type="button" class="slide">Chi tiết <span class="glyphicon glyphicon-menu-down icon"></span></button>
			<div class="detail col-md-12" style="display: none;">
			@foreach($loaitin as $item)
				<?php $count=DB::table('baiviet')->where('IDLoaiTin',$item->IDLoaiTin)->count(); ?>
			<div class="form-group">
				<label class="control-label col-md-3"> {{ $item->TenLoaiTin}} :</label>
				<div class="col-md-8">
				<input type="text" class="form-control" value="{{ $count}}" readonly>
				</div>
			</div>
			@endforeach
			</div>
		</form>
		</div>
	</div>
	<div class="panel panel-default">
	<div class="panel-heading"> <b>Comment mới</b></div>
	<div class="panel-body">
		<table class="table table-striped table-bordered table-hover" style="width: 100%; table-layout: fixed;" id="myTable">
	<thead>
	<tr align="center">
	<td>Bài viết</td>
	<td>Số comment chưa đọc</td>
	</tr>
	</thead>
	<tbody>
		@foreach($baivietnewcmt as $newbv)
	<tr class="odd gradeX">
	<?php $num=DB::table('comment')->where([['IDBV',$newbv->IDBV],['DaDoc',0]])->count();  ?>
		<td><a href="{{ url('admin/baiviet/sua/'.$newbv->IDBV)}}">{{$newbv->TieuDe}}</a></td>
		<td>{{$num}}</td>

	</tr>
	@endforeach

</tbody>
</table>
	</div>
	</div>
@endif
@if(Auth::user()->level==2||Auth::user()->level==4)	
<div class="col-lg-12"><h2>Thông tin Khách sạn</h2></div>
<div class="panel panel-default">
	<div class="panel-heading"><b>Thông tin số lượng</b> </div>
	<div class="panel-body">
		<div class="form-group">
				<label class="control-label col-md-6">Số khách sạn:</label>
				<div class="col-md-4">
				<input type="text" class="form-control" value="{{ $khachsannum}}" readonly>
				</div>
				<div class="col-md-1"><a href="{{ url('admin/khachsan/danhsach')}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list"></span></a></div>
				<div class="col-md-1"><a href="{{ url('admin/khachsan/them')}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a></div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-6">Số đơn</label>
				<div class="col-md-4">
				<input type="text" class="form-control" value="{{ $dondatphongnum}}" readonly>
				</div>
				<div class="col-md-1"><a href="{{ url('admin/khachsan/danhsach')}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-list"></span></a></div>
				<div class="col-md-1"><a href="{{ url('admin/khachsan/them')}}" type="button" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span></a></div>
			</div>
	</div>
</div>
	<div class="panel panel-default">
	<div class="panel-heading"> <b>Các khách sạn có đơn đặt phong chưa duyệt</b></div>
	<div class="panel-body">
		<table class="table table-striped table-bordered table-hover" style="width: 100%; table-layout: fixed;" id="myTable">
	<thead>
	<tr align="center">
	<td>Khách sạn</td>
	<td>Số đơn</td>
	</tr>
	</thead>
	<tbody>
		@foreach($khachsannewdon as $newks)
	<tr class="odd gradeX">
	<td><a href="{{url('admin/don/dontheoks/'.$newks->IDKhachSan)}}">{{$newks->TenKhachSan}}</a></td>
	<?php $count=DB::table('dondatphong')->where('IDKhachSan',$newks->IDKhachSan)->count(); ?>
	<td>{{$count}}</td>
	</tr>
	@endforeach

</tbody>
</table>
	</div>
	</div>
</div>
@endif
@endsection
@section('script')
<script >
	$(document).ready(function(){
		var i=1;
		$('.slide').click(function(){
			if(i==1){
			$('.detail').slideDown();
			$('.icon').attr("class","glyphicon glyphicon-menu-up icon");
			i=0;
			}
			else{
				$('.detail').slideUp();
				$('.icon').attr("class","glyphicon glyphicon-menu-down icon");
			i=1;

			}
		});
	});
</script>
@endsection