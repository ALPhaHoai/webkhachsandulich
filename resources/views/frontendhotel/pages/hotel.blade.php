@extends('frontendhotel.layouts.home')
@section('content')
<div class="content-entry">
<div class="col-lg-12 col-lg-offset-1 bread-crumb">
		<ul>
			<li><a href="{{ url('hotel/homepage')}}">Home </a> > </li>
			<li><a href="{{ url('hotel/location/'.$khuvuc->IDKhuVuc.'/0/0/0/0/0')}}">{{$khuvuc->TenKV}} </a> > </li>
			<li><a href="{{ url('hotel/detail/'.$khachsan->IDKhachSan)}}">{{$khachsan->TenKhachSan}} </a> </li>
		</ul>
</div>
<div class="col-lg-3 col-lg-offset-1 sidebar">
	<div class="panel panel-default">
		<div class="panel-heading">Các khách sạn hot trong khu vực</div>
		<div class="panel-body">
		@if($sidehotel!=null)
		@foreach($sidehotel as $side)
		<?php $img=DB::table('anh')->where('ID',$side->IDKhachSan)->get()->first();
			if($img!=null){
			    	$url=$img->URL;
			    	}
			    	else {
			    		$url="img/coollogo_com-18451102.png";
			    	}	
			?>
			<div class="sidehotel">
				<div style="width: 30%; height: 100%; float: left;" class="imgsidehotel"><img style="width: 100%;height: 100%;" src="{{asset($url)}}"></div>
				<div style="width: 65%;height: 100%; float: right; overflow:hidden;"><a href="">{{$side->TenKhachSan}}</a></div>
			</div>
		@endforeach
		@endif
			<div class="sidehotel">
				<div style="width: 30%; height: 100%; float: left;" class="imgsidehotel"><img style="width: 100%;height: 100%;" src="{{asset('img/slider1.png')}}"></div>
				<div style="width: 65%;height: 100%; float: right; overflow:hidden;"><a href="">aaaaa</a></div>
			</div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Khu Vực</div>
		<div class="panel-body hotellocation" >
		<div class="col-lg-12"><a href=""> Tất cả</a></div>
			@foreach($khuvucall as $all)
				<div class="col-lg-12"> <a href="{{url('hotel/location1',['idkv'=>$all->IDKhuVuc,'flag'=>0,'idloai'=>0,'min1'=>0,'max1'=>0,'idtienich'=>0])}}">{{$all->TenKV}}</a></div>
			@endforeach
		</div>
	</div>
</div>
<div class="col-lg-7">
	<div class="col-lg-12"><h3>{{$khachsan->TenKhachSan}}</h3></div>
	<div class="col-lg-12">
	<div id="carousel-id" class="carousel slide" data-ride="carousel" style="width: 100%; height:400px;">
		<?php $img=DB::table('anh')->where('ID',$khachsan->IDKhachSan)->get(); 
		$count=0;?>
		<ol class="carousel-indicators">
		@if($img!=null)
		@foreach($img as $hotelimg)
			<li data-target="#carousel-id" data-slide-to="{{$count}}" class="indi"></li>
			<?php $count+=1 ?>
		@endforeach
		@endif
		</ol>
		<div class="carousel-inner">
		@if($img!=null)
		@foreach($img as $hotelimg)
			<div class="item">
				<img style="width: 100%;height: 400px;" src="{{asset($hotelimg->URL)}}">
				<div class="container">
					<div class="carousel-caption">
						<h1></h1>
						<p> </p>
					</div>
				</div>
			</div>
		@endforeach
		@endif
		</div>
		<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
	</div>
	<div class="col-lg-12" style="margin-top: 30px;">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Thông tin khách sạn</b></div>
			<div class="panel-body">
				<p> Khách sạn {{$khachsan->TenKhachSan}}</p>
				<p class="minprice"> Giá ưu đãi :{{$khachsan->minprice}} VND  </p><p><button type="button" class="btnorder" onclick="showmodal()"> Đặt phòng</button></p>
				<p>{!!$khachsan->ThongTin!!}</p>
			</div>
		</div>
	</div>
	<div class="col-lg-12" style="">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Loại phòng khách sạn</b></div>
			<?php $loaiphong=DB::table('loaiphong')->where('IDKhachSan',$khachsan->IDKhachSan)->get(); 
			 $img=DB::table('anh')->where('ID',$khachsan->IDKhachSan)->get()->first();
			 $url=$img->URL;
			 ?>
			<div class="panel-body">
			<table class="table table-hover table-bordered table-center">
				<thead>
					<tr>
						<td>Ảnh</td>
						<td>Tên Loại</td>
						<td>Tình trạng</td>
						<td>Giá phòng(VND/người)</td>
						<td>Đặt</td>
					</tr>
				</thead>
				<tbody>
				@foreach($loaiphong as $item)
				<tr>
					<td><img style="width: 50px; height: 50px;" src="{{asset($url)}}"></td>
					<td>{{$item->TenLoaiPhong}}</td>
					<td><?php if($item->SoPhong>0) { echo "Avalable";} else { echo "Invalid";} ?></td>
					<td>{{$item->Gia}} VND</td>
					<td><button type="button" class="btnorder" onclick="showmodal()"> Đặt phòng</button></td>
				</tr>
				@endforeach
					
				</tbody>
			</table>
			</div>
		</div>
	</div>
	<div class="col-lg-12" style="">
		<div class="panel panel-default">
			<div class="panel-heading"><b>Chính sách</b></div>
			<?php $chinhsach=DB::table('chinhsach')->where('IDKhachSan',$khachsan->IDKhachSan)->get()->first(); 
			 ?>
			<div class="panel-body">
			@if($chinhsach!=null)
			<table class="table table-hover table-bordered table-center">
				<thead>
					<tr>
						<td>Tên</td>
						<td>Nội Dung</td>
					</tr>
					
				</thead>
				<tbody>
				<tr>
					<td>Thời gian nhận phòng </td>
					<td>{{$chinhsach->NhanPhong}}</td>
				</tr>
				<tr>
					<td>Thời gian trả phòng </td>
					<td>{{$chinhsach->TraPhong}}</td>
				</tr>
				<tr>
					<td>Di Chuyển </td>
					<td>{{$chinhsach->DiChuyen}}</td>
				</tr>
				<tr>
					<td>Hoạt Động </td>
					<td>{{$chinhsach->HoatDong}}</td>
				</tr>
				<tr>
					<td>Hướng dẫn </td>
					<td>{{$chinhsach->HuongDan}}</td>
				</tr>
				<tr>
					<td>Phụ thu</td>
					<td>{{$chinhsach->PhuThu}}</td>
				</tr>
					
				</tbody>
			</table>
			@endif
			</div>
		</div>
	</div>

</div>
</div>
<div class=" col-lg-8  col-lg-offset-2 hide" id="modal1">
	<div class="panel panel-default">
	@if(Auth::check())
		<div class="panel-heading"><b>Thông tin đặt phòng</b><span onclick="closemodal()" style="float: right; cursor: pointer" class="glyphicon glyphicon-remove"></span></div>
		<div class="panel-body">
			<form method="POST" action="{{route('admin.datdon.them')}}">
			{{ csrf_field() }}
			<input type="hidden" name="idks" value="{{$khachsan->IDKhachSan}}">
				<div class="form-group">
					<label>Loại Phòng muốn đặt :</label>
					<select class="form-control" name="idlp">
					<?php $loaiphong=DB::table('loaiphong')->where('IDKhachSan',$khachsan->IDKhachSan)->get(); ?>
						@foreach($loaiphong as $item)
							<option value="{{$item->IDLoaiPhong}}">{{$item->TenLoaiPhong}}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label>Loại Thanh toán :</label>
					<select class="form-control" name="thanhtoan">
						<option value="Trực tiếp">Trực tiếp </option>
						<option value="Qua ngân hàng"> Qua ngân hàng  </option>
					</select>
				</div>
				<div class="form-group">
					<label>Ngày đi :</label>
					<input class="form-control" type="Date" name="ngaydi" placeholder="Please enter days">
				</div>
				<div class="form-group">
					<label>Ngày Về :</label>
					<input class="form-control" type="Date" name="ngayve" placeholder="Please enter days">
				</div>
				<div class="col-lg-12" style="margin-bottom: 10px;"> <b>Vui lòng nhập lại thông tin liên hệ </b> ( Các thông tin này sẽ được sử dụng để liên hệ với quý khách )</div>
				<div class="form-group">
						<label>Số điện thoại</label><br />
						<input class="form-control" name="sdt" placeholder="Please enter phonenumber" >
					</div>
					<div class="form-group">
						<label>Giới tính</label><br />
						<input type="radio" name="gioitinh" value="M" checked> Nam
						<input type="radio" name="gioitinh" value="F"> Nữ
					</div>
					<div class="form-group">
						<label>Địa chỉ</label><br/>
						<input class="form-control" name="diachi" placeholder="Please enter Address" >
					</div>
					<div class="form-group">
						<label>CMT</label><br />
						<input class="form-control" name="cmt" placeholder="Please enter IDnumber">
					</div>

				<button type="submit" class="btn btn-primary">Gửi đơn</button>
			</form>
		</div>
		@else
		<div class="panel-heading"><b>Thông báo</b><span onclick="closemodal()" style="float: right; cursor: pointer" class="glyphicon glyphicon-remove"></span></div>
		<div class="panel-body">Bạn chưa đăng nhập , vui lòng <a data-toggle="modal" href="#modal-id" onclick="closemodal()">Đăng nhập</a> để sử dụng dịch vụ</div>
		@endif
	</div>
</div>
<div id="darker" class=" hide" onclick="closemodal()"></div>
@endsection
@section('script')
<script >
	function beingactive(){
		var item=document.getElementsByClassName('item');
		item[0].className=item[0].className+" active";
		var indi=document.getElementsByClassName('indi');
		indi[0].className=indi[0].className+" active";
	}
	function showmodal(){
		var modal1,darker;
		modal1=document.getElementById('modal1');
		darker=document.getElementById('darker');
		darker.className=darker.className.replace(" hide","");
		modal1.className=modal1.className.replace(" hide","");
		window.scrollTo(0,0);

	}
	function closemodal(){
		var modal1,darker;
		modal1=document.getElementById('modal1');
		darker=document.getElementById('darker');
		darker.className=darker.className+" hide";
		modal1.className=modal1.className+" hide";
	}
</script>
@endsection