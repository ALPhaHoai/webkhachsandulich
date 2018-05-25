@extends('touradmin.layout.bodycontent')
@section('title') Thêm thông tin khách sạn
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/admin/admin.css')}}">
@endsection
@section('content')
<h1>Khách Sạn- thêm</h1>
<div class="col-lg-12 tabnav">
	<div class="tabbutton1" id="button1" onclick="sometab(event,'info')"> Bước 1</div>
	<div class="tabbutton1" id="button2" onclick="sometab(event,'policy')"> Bước 2</div>
</div>
@if($isadmin==true)
	<form action="{!!route('admin.khachsan.them')!!}" method="post" class="form-vertical" enctype="multipart/form-data">
@else
	<form action="{!!route('admin.quanlykhachsan.them')!!}" method="post" class="form-vertical" enctype="multipart/form-data">
@endif
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
			<label>Tên khách sạn</label><br />
			<input class="form-control" name="tenKS" placeholder="Please Enter TenKhachSan">
		</div>
		<div class="form-group">
			<label> Loại khách sạn</label><br />
			<select name="idLKS" class="form-control">
				@foreach($loaikhachsan as $lks)
				<option value="{!! $lks->id !!}">{!! $lks->Ten !!}</option>
				@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Địa chỉ</label><br>
			<input class="form-control" name="diachi" placeholder="Please Enter DiaChi">
		</div>
		<div class="form-group">
			<label>Chọn khu vực</label><br />
			<select class="form-control" name="idKV">
		<option value="0">Please Choose Location</option>
				@foreach($khuvuc as $item)
		<option value="{!!$item['IDKhuVuc']!!}">{!!$item["TenKV"]!!}</option>
					@endforeach
			</select>
		</div>
		<div class="form-group">
			<label>Thông tin</label><br />
			<textarea id="summernote" name="thongtin"></textarea>
		</div>
		<div class="form-group">
			<label>Liên hệ</label><br />
			<input class="form-control" name="lienhe" placeholder="Please Enter LienHe">
		</div>
		<div class="form-group">
			<label>Tiện ích khách sạn :</label>
			<div class="col-lg-12">
				<ul style="list-style: none;">
				@foreach($tienich as $item)
					<li><input type="checkbox" value="{!! $item->id!!}" name="tienich[]">{!! $item->NoiDung !!}</li>
				@endforeach
				</ul>
			</div>
		</div>
		@if($isadmin==true)
		<div class="form-group">
			<label>Người quản lý :</label>
			<div class="col-lg-12">
				<select name="hoteladminid" class="form-control">
					@foreach($listhoteladmin as $hoteladmin)
						<option value="{{$hoteladmin->id}}">{{$hoteladmin->name}}</option>
					@endforeach
				</select>
			</div>
		</div>
	
		@endif
		
		<div class="btn btn-primary" id="nextstep" style="margin-top: 20px;" onclick="nextone()">Bước tiếp <span class="glyphicon glyphicon-menu-right"></span></div>
		</div>

<div class="col-lg-12 tabcontent1" id="policy">
		<h2><u>Chính sách</u></h2>
		<div class="form-group">
			<label>Thời gian nhận phòng</label><br />
			<input class="form-control" name="nhanphong"  type="time">
		</div>
		<div class="form-group">
			<label>Thời gian trả phòng</label><br/>
			<input class="form-control" name="traphong"  type="time">
		</div>
		<div class="form-group">
			<label>Di chuyển</label><br/>
			<textarea name="dichuyen" class="form-control" placeholder="Please Enter schedual"></textarea>
		</div>
		<div class="form-group">
			<label>Hoạt Động</label><br/>
			<textarea name="hoatdong" class="form-control" placeholder="Please Enter Activity"></textarea>
		</div>
				<div class="form-group">
			<label>Hướng dẫn</label><br/>
			<textarea name="huongdan" class="form-control" placeholder="Please Enter instruction"></textarea>
		</div>
		<div class="form-group">
			<label>Phụ Thu </label><br/>
			<textarea name="phuthu" class="form-control" placeholder="Please Enter extra"></textarea>
		</div>
		<div class="btn btn-primary" id="displayall" onclick="displayall()">abc</div>
		<button type="submit" class="btn btn-primary"> Hoàn tất </button>
		<button type="reset" class="btn btn-primary"> Reset </button>
</div>	

</div>
<div class="col-lg-4">
<div class="col-lg-12"><h2>Loại phòng</h2></div>
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
			
			<div class="col-lg-12"><h2>Ảnh khách sạn</h2></div>
			<div class="col-lg-12">
			@for($i=1;$i<=10;$i++)
			<div class="form-group">
				<label>Hình {!!$i!!} </label>
				<input type="file" name="hotelpic[]">
			</div>
			@endfor	
			</div>
	
</div>
</form>
<div class="col-lg-12" id="scriptmore"></div>
@endsection
@section('script')
<script>
	$(document).ready(function(){
		var count=0;
		$("#more").click(function(){
			$("#insert").append("<div class='col-lg-12' id='"+count+"'><div class='col-lg-1 delroomtypeitem'><button type='button' class='btn btn-circle delroomtype' onclick='delitem("+count+")'><span class='glyphicon glyphicon-remove'></span></button></div><div class='form-group' style='border-top: 2px solid black; margin-top: 5px;'><label>Tên loại phòng</label><input class='form-control' name='typename[]' placeholder='Please Enter roomtype'></div><div class='form-group'><label>Số phòng</label><input class='form-control' name='typeamount[]' placeholder='Please Enter amount'></div><div class='form-group'><label>Giá (đ/ngày)</label><input class='form-control' name='typecost[]' placeholder='Please Enter cost'></div></div>");
				count+=1;
		});
		$("#less").click(function(){
			$("#insert").html("");
		});
		$("#nextstep").click(function(){
			$('html, body').animate({ scrollTop: 0 }, 'fast');
		});
		$(".delroomtypeitem").click(function(){
			alert("aaaa");
			var id=$(this).attr('roomtypeid');
			//alert(id);
		});

	});
</script>
<script>
	function sometab(event,idcontent){
		var i,tabcontent,tablink;
 	tabcontent=document.getElementsByClassName("tabcontent1");
 	if(idcontent=="info"){
 		document.getElementById("info").className=document.getElementById(idcontent).className.replace(" hide","");
 		document.getElementById("policy").className+=" hide";
 	}
 	else {document.getElementById("policy").className=document.getElementById(idcontent).className.replace(" hide","");
 		document.getElementById("info").className+=" hide";
 	}

 	tablink=document.getElementsByClassName("tabbutton1");
 	for(i=0;i<tablink.length;i++){
 		tablink[i].className=tablink[i].className.replace(" active","");
 	}

 	//document.getElementById(idcontent).className=document.getElementById(idcontent).className.replace(" hide","");
 	event.currentTarget.className += " active";
 	
 	}

 	document.getElementById("button1").click();
 	function nextone(){

 		document.getElementById("button2").click();
 	}
 	function displayall(){
 		var i,tabcontent,tabnav;
 		tabcontent=document.getElementsByClassName("tabcontent1");
 		for(i=0;i<tabconten.length;i++){
 			tabcontent[i].style.display="block";
 		}
 	}
 	function delitem(count){
 		document.getElementById(count).innerHTML="";
 	}
</script>
@endsection