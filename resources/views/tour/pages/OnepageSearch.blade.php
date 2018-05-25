@extends('tour.layout.BodyContent')
@section('title') One page change
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/tour/onepage/search-section.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/tour/onepage/item-content.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/tour/onepage/common.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/tour/onepage/side-search.css')}}">
@endsection
@section('content')
<div class="search-section col-lg-12">
	<div class="col-lg-12 form-group">
		<label>Từ cần tìm kiếm</label>
                <input class="form-control" type="text" name="" placeholder="Nhập từ">
            </div>
            <div class="col-lg-4 form-group">
            <label>Nơi khởi hành</label>
                <select class="form-control">
                    @foreach($listkhuvuc as $khuvuc)
                        <option>{{$khuvuc->TenKV}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 form-group">
            <label>Điểm đến</label>
                <select class="form-control">
                    @foreach($listkhuvuc as $khuvuc)
                        <option>{{$khuvuc->TenKV}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 form-group">
            <label>Ngày khởi hành</label>
                <input type="date" name="" class="form-control" min="{{date('Y-m-d')}}">
            </div>
            <div class="col-lg-4 form-group">
            <label>Loại tour</label>
                <select class="form-control">
                    @foreach($listloaitour as $loaitour)
                        <option>{{$loaitour->TenLoaiTour}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4 form-group">
                <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 25px;">Tìm kiếm</button>
            </div>
</div>

<div class="breadcrumb col-lg-12">
	<ol class="breadcrumb">
	@if($diadiem==true)
		<li>
			<a href="{{route('tour.homepage')}}">Home</a>
		</li>
		<li class="active" id="locationid" locateid='{{$locationid}}'>{{$locationname}}</li>
	@else
		<li>
			<a href="{{route('tour.homepage')}}">Home</a>
		</li>
		<li>
			<a href="{{route('tour.location',['iddiadiem'=>$locationid])}}">{{$locationname}}</a>
		</li>
		<li class="active" id="placeid" placeid="{{$placeid}}">{{$khuvucname}}</li>
	@endif
	</ol>
</div>




<div class="side-search col-lg-3 col-lg-offset-1">
	@if($diadiem==true)
	<div class="panel panel-default">
	<div class="panel-heading"><b>Khu vực tại {{$locationname}}</b></div>
		<div class="panel-body">
			@foreach($listkhuvucdiadiem as $khuvuc)
                   <a class="txtlink" href="{{route('tour.clocation',['idkhuvuc'=>$khuvuc->IDKhuVuc])}}"><div class="item-sidesearch"> {{$khuvuc->TenKV}} </div></a>
             @endforeach
		</div>
	</div>
	@endif
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b> Khởi hành từ</b></h3>
		</div>
		<div class="panel-body">
			<div class="form-group">
				<select id="khoihanhsearch" class="form-control" onchange="getListBySideSearch('khoihanh',0)">
				@foreach($listkhuvuc as $khuvuc)
                   	<option value="{{$khuvuc->IDKhuVuc}}">{{$khuvuc->TenKV}}</option>
             	@endforeach
             	</select>
             </div>
             <div class="hidden" id="khoihanh"></div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b> Loại tour</b></h3>
		</div>
		<div class="panel-body">
			 @foreach($listloaitour as $loaitour)
			 <div class="item-sidesearch">
                   <input type="checkbox" name="" onchange="getListBySideSearch('loaitour',{{$loaitour->ID}})"> {{$loaitour->TenLoaiTour}}
             </div>
             @endforeach
             <div class="hidden" id="loaitour"></div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b> Phương tiện đi kèm</b></h3>
		</div>
		<div class="panel-body">
			 @foreach($listphuongtien as $phuongtien)
			 <div class="item-sidesearch">
                   <input type="checkbox" name="" onchange="getListBySideSearch('phuongtien',{{$phuongtien->ID}})"> {{$phuongtien->Ten}}
             </div>
             @endforeach
             <div class="hidden" id="phuongtien"></div>
		</div>
	</div>

	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b> Dịch vụ đi kèm</b></h3>
		</div>
		<div class="panel-body">
			 @foreach($listdichvu as $dichvu)
			 <div class="item-sidesearch">
                   <input type="checkbox" name="" onchange="getListBySideSearch('dichvu',{{$dichvu->ID}})"> {{$dichvu->TenDichVu}}
             </div>
             @endforeach
             <div class="hidden" id="dichvu"></div>
		</div>
	</div>
	<button type="button" id="testajax" class="btn btn-default">button</button>
</div>


<div class="content-list col-lg-7">
	<div class="panel panel-default">
	<div class="panel-heading"><b>Danh sách tour </b></div>
		<div class="InsertTour panel-body">
		<!--<form name="frm">
		<input type="hidden" name="_token" value="{!! csrf_token() !!}">-->
			<?php $displaytour=""; ?>
			@foreach($listtour as $tour)
			<?php $displaytour.=$tour->ID.',' ?>
			<div class="content-item">
				<div class="content-img">
					<img src="{{asset($tour->AnhDaiDien)}}">
				</div>
				<div class="content-info">
					<div class="item-title col-lg-12"><b>{{$tour->TenTour}}</b></div>
					<div class="item-time col-lg-6"><span class="glyphicon glyphicon-time"></span> {{$tour->SoNgay}} ngày {{$tour->SoDem}} Đêm</div>
					<div class="item-price col-lg-6">{{$tour->Gia}} VND</div>
					<div class="item-location col-lg-12">
					<span class="glyphicon glyphicon-map-marker"></span>
						<?php 
							$khuvuc=DB::table("khuvuc")->where("IDKhuvuc",$tour->IDKhuVucKhoiHanh)->first();
							echo ' Khởi hành : '.$khuvuc->TenKV;
						 ?>
					</div>
					<div class="item-startdate col-lg-12"><span class="glyphicon glyphicon-calendar"></span> Ngày khởi hành từ : {{$tour->NgayKhoiHanh}}</div>
					<div class="detailbtn col-lg-2 col-lg-offset-9">
						<button type="button" class="btn btn-default"><b>Chi Tiết</b></button>
					</div>
				</div>
			</div>
			@endforeach
			<!--</form>-->
		</div>
		<div class="panel-footer text-center">
			<button type="button" class=" getlist btn btn-primary">Xem thêm</button>
		
			<div id="displayed" class="hidden">{{$displaytour}}</div>
		</div>
	</div>
</div>

<div class="hidden" id="isdiadiem">{{$diadiem}}</div>
@section('script')
<script type="text/javascript" src="{{asset('js/touronepage/gettourlist.js')}}"></script>
@endsection
@endsection