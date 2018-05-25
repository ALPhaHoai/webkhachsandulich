@extends('admin.layout.thongtinindex')
@section('content')
<h1>Khách Sạn - Sửa</h1>
	<form action="{!!route('admin.khachsan.sua')!!}" method="post" class="form-vertical" enctype="multipart/form-data" name="frmmain">
<div class="col-lg-7" >
	@if(count($errors) > 0)
		<dir class="alert alert-danger">
			<ul> 
				@foreach($errors->all() as $error) 
					<li>{!! $error!!}</li> 
				@endforeach 
			</ul>
		</dir>
	@endif
	<div class="col-lg-12 tabcontent1" id="info">
	<h2><u>Thông tin khách sạn</u></h2>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">﻿
		<div class="form-group">
			<label>Mã khách sạn</label><br />
			<input class="form-control" name="idKS" value="{!! $khachsan->IDKhachSan !!}" readonly>
		</div>
		<div class="form-group">
			<label>Tên khách sạn</label><br />
			<input class="form-control" name="tenKS" value="{!! $khachsan->TenKhachSan !!}">
		</div>
		<div class="form-group">
			<label> Loại khách sạn</label><br />
			<select name="idLKS" class="form-control">
			<option value="{!! $curloaikhachsan->id !!}">{{$curloaikhachsan->Ten}}</option>
				@foreach($loaikhachsan as $lks)
				<option value="{!! $lks->id !!}">{!! $lks->Ten !!}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Địa chỉ</label><br />
			<input class="form-control" name="diachi" value="{!! $khachsan->DiaChi!!}">
		</div>
		<div class="form-group">
			<label>Chọn khu vực</label><br />
			<select class="form-control" name="idKV">
			<option value="{!! $curkhuvuc->IDKhuVuc!!}">{!! $curkhuvuc->TenKV!!}</option>
				@foreach($khuvuc as $item)
		<option value="{!!$item->IDKhuVuc!!}">{!!$item->TenKV!!}</option>
					@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Thông tin</label><br />
			<textarea id="summernote" name="thongtin" >{!! $khachsan->ThongTin!!}</textarea>
		</div>
		<div class="form-group">
			<label>Liên hệ</label><br />
			<input class="form-control" name="lienhe" value="{!! $khachsan->LienHe!!}">
		</div>
		<div class="form-group">
			<label>Tiện ích khách sạn :</label>
			<div class="col-lg-12">
				<ul style="list-style: none;">
				@foreach($curtienich as $item)
					<li><input type="checkbox" class="tienich" value="{!! $item->id!!}" name="curtienich[]" checked>{!! $item->NoiDung !!}</li>
				@endforeach
				@foreach($tienich as $item)
					<li><input type="checkbox" class="tienich" value="{!! $item->id!!}" name="newtienich[]">{!! $item->NoiDung !!}</li>
				@endforeach
				</ul>
			</div>
		</div>
		<div class="col-lg-12"><h2><u>Ảnh khách sạn</u> </h2></div>
		<?php $count=0;  ?>
		@foreach($curanh as $anh)
			<?php $url=$anh->URL; $count+=1;  ?>
			<div class="col-lg-12 hide"><input type="text" name="idanh[]" value="{!! $anh->IDAnh!!}"></div>
			<div class="col-lg-6 form-group imgcontain" id="{{ $anh->IDAnh}}" style="position: relative;">
				<label>Hình {{$count}} </label>
				<div class="col-lg-12 curimg" style="height: 150px;">
				<img src="{!!asset($url) !!}" style="width: 100%;, height:100%;">
				</div>
				<div class="col-lg-12"><input type="file" name="hotelpic[]"></div>
				<a href="javascript:Void(0)" idanh="{{$anh->IDAnh}}" location="{{ $anh->URL}}" class="btn-danger btn-circle delimg"><span  class="glyphicon glyphicon-remove"></span></a>
			</div>
			@endforeach
			<div class="col-lg-12" id="insertimg"></div>
			<div class="col-lg-12">
				<div class="col-lg-4 more" id="moreimg" ><span class="glyphicon glyphicon-plus"></span></div>
				<div class="col-lg-4 col-lg-offset-1 more" id="lessimg"> <span class="glyphicon glyphicon-remove"></span></div>
			</div>
		<div class="col-lg-12" style="margin-top: 20px;">

		<button type="submit" class="btn btn-primary">Cập nhật</button>
		</div>
		</div>

</div>
<div class="col-lg-4">
<div class="col-lg-12"><h2>Loại phòng</h2></div>
@if($curloaiphong!=null)
		@foreach($curloaiphong as $loaiphong)
					<div class="col-lg-12 roomtype" id="{{ $loaiphong->IDLoaiPhong }}">
				<div class="form-group" style="border-top: 2px solid black">
					<label>ID</label>
					<input class="form-control" name="curtypeid[]" value="{!! $loaiphong->IDLoaiPhong!!}" readonly>
				</div>
				<div class="form-group">
					<label>Tên loại phòng</label>
					<input class="form-control" name="curtypename[]" value="{!! $loaiphong->TenLoaiPhong!!}">
				</div>
				<div class="form-group">
					<label>Số phòng</label>
					<input class="form-control" name="curtypeamount[]" value="{!! $loaiphong->SoPhong!!}">
				</div>
				<div class="form-group">
					<label>Giá (đ/ngày)</label>
					<input class="form-control" name="curtypecost[]" value="{!! $loaiphong->Gia!!}">
				</div>
				<div class="col-lg-12" style="margin-bottom: 20px; "><button  idlp="{!! $loaiphong->IDLoaiPhong!!}" type="button" class="btn btn-primary delroomtype">Xóa</button></div>
			</div>
		@endforeach
		@else
		<div class="col-lg-12 none"> <h4>Hiện khách sạn không có loại phòng nào được đăng ký</h4></div>
@endif
				<div class="col-lg-12" id="roomtype">
			
				<div class="form-group" style="border-top: 2px solid black">
					<label>Tên loại phòng</label>
					<input class="form-control" name="typename[]" placeholder="Please Enter roomtype">
				</div>
				<div class="form-group">
					<label>Số phòng</label>
					<input class="form-control" name="typeamount[]" placeholder="Please Enter amount">
				</div>
				<div class="form-group">
					<label>Giá (đ/ngày)</label>
					<input class="form-control" name="typecost[]" placeholder="Please Enter cost">
				</div>
			</div>
			<div class="col-lg-12" id="insert"></div>
			<div class="col-lg-12">
				<div class="col-lg-4 more" id="more"><span class="glyphicon glyphicon-plus"></span></div>
				<div class="col-lg-4 col-lg-offset-1 more" id="less"><span class="glyphicon glyphicon-remove"></span></div>
			</div>
	
</div>
</form>
@endsection
@section('script')
<script>
	$(document).ready(function(){
		$("#more").click(function(){
			$("#insert").append("<div class='form-group' style='border-top: 2px solid black; margin-top: 5px;'><label>Tên loại phòng</label><input class='form-control' name='typename[]' placeholder='Please Enter roomtype'></div><div class='form-group'><label>Số phòng</label><input class='form-control' name='typeamount[]' placeholder='Please Enter amount'></div><div class='form-group'><label>Giá (đ/ngày)</label><input class='form-control' name='typecost[]' placeholder='Please Enter cost'></div>");
			$('.none').html("");
		});
		$("#less").click(function(){
			$("#insert").html("");
		});
		$("#nextstep").click(function(){
			$('html, body').animate({ scrollTop: 0 }, 'fast');
		});
		$("#moreimg").click(function(){
			$("#insertimg").append("<div class='col-lg-6' style='margin-top:20px; margin-bottom:10px;'><input type='file' name='hotelpicmore[]'></div>")
		});
		$("#lessimg").click(function(){
			$("#insertimg").html("");
		});

	});


$(document).ready(function(){
	$(".delroomtype").click(function(){
		var idloaiphong =$(this).attr("idlp");
		var _token=$("form[name='frmmain']").find("input[name='_token']").val();
		$.ajax({
			url:"/admin/comment/xoalp/"+idloaiphong,
			type:'GET',
			cache:false,
			data:{"_token":_token},
			success:function(data){
				if (data=="ok") {
					$("#"+idloaiphong).html("");
				}else {
					alert("not ok");
				}
			}
		});
	});
});
$(document).ready(function(){
	$(".delimg").click(function(){
		alert("aaa");
		var idanh =$(this).attr("idanh");
		var imglocation=$(this).attr("location");
		var _token=$("form[name='frmmain']").find("input[name='_token']").val();
		$.ajax({
			url:"/admin/comment/xoaimg/"+idanh,
			type:'GET',
			cache:false,
			data:{"_token":_token,"location":imglocation},
			success:function(data){
				if (data=="ok") {
					$("#"+idanh).html("");
				}else {
					alert("not ok");
				}
			}
		});
	});
});


</script>
@endsection
