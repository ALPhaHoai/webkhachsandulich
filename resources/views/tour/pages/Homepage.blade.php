@extends('tour.layout.BodyContent')
@section('title') Homepage
@endsection
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('css/tour/homepage/soon.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/tour/homepage/homepage-content.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('css/tour/homepage/searchbox.css')}}">
@endsection
@section('content')
<div id="subheader">
	<div id="carousel-id" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-id" data-slide-to="0" class=""></li>
			<li data-target="#carousel-id" data-slide-to="1" class=""></li>
			<li data-target="#carousel-id" data-slide-to="2" class="active"></li>
		</ol>
		<div class="carousel-inner">
			<div class="item">
				<img data-src="holder.js/900x500/auto/#777:#7a7a7a/text:First slide" alt="First slide" src="{{asset('img/Wallpaper/best-landscape-backgrounds-18896-19383-hd-wallpapers.jpg')}}">
				<div class="container">
					<div class="carousel-caption">
						<h1>Example headline.</h1>
						<p>Note: If you're viewing this page via a <code>file://</code> URL, the "next" and "previous" Glyphicon buttons on the left and right might not load/display properly due to web browser security rules.</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
					</div>
				</div>
			</div>
			<div class="item">
				<img data-src="holder.js/900x500/auto/#666:#6a6a6a/text:Second slide" alt="Second slide" src="{{asset('img/Wallpaper/city-morning-wallpaper-hd-44709-45867-hd-wallpapers.jpg')}}">
				<div class="container">
					<div class="carousel-caption">
						<h1>Another example headline.</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
					</div>
				</div>
			</div>
			<div class="item active">
				<img data-src="holder.js/900x500/auto/#555:#5a5a5a/text:Third slide" alt="Third slide" src="{{asset('img/Wallpaper/morning-mist-27419-28136-hd-wallpapers.jpg')}}">
				<div class="container">
					<div class="carousel-caption">
						<h1>One more for good measure.</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
</div>


<div class="fav col-lg-12" >
        <div class="row">
            <div class="span12">
                <div class="well">
                    <div id="myCarousel" class="carousel fdi-Carousel slide">
                     <!-- Carousel items -->
                        <div class="carousel fdi-Carousel slide" id="eventCarousel" data-interval="0">
                            <div class="carousel-inner onebyone-carosel">
                            <?php $count=0 ?>
                            @foreach($listtourgiochot as $tourgiochot)
                            @if($count==0)
                            <div class="item active">
                            @else
                                <div class="item">
                            @endif
                                    <div class="col-md-4 countdownitem">
                                        <img src="{{asset($tourgiochot->AnhDaiDien)}}" class="img-responsive center-block">
                                        <div class="text-center"></div>
                                        <div class="countdown-clock"> <p class="countdown" id="{{'count'.$count}}" date={{$tourgiochot->NgayKhoiHanh}}></p></div>
                                        <div class="soon">
                                            <p class="soon-title">{{$tourgiochot->TenTour}}</p>
                                            <p class="soon-day">Ngày khởi hành : {{$tourgiochot->NgayKhoiHanh}}</p>
                                            @if($tourgiochot->GiaKhuyenMai!="")
                                            <p class="soon-price" style="float: left;"> {{$tourgiochot->GiaKhuyenMai}} VND
                                            </p>
                                            <p class="soon-origin-price">{{$tourgiochot->Gia}} VND</p>
                                            @else
                                            <p class="soon-price"> {{$tourgiochot->Gia}} VND</p>
                                            @endif
                                        </div>
                                        <div class="soon-detail"><a class="btnlink" href=""><button type="button" class="btn btn-default">Xem chi tiết</button></a></div>
                                    </div>
                                </div>
                                <?php $count+=1  ?>
                            @endforeach
                            </div>
                            <a class="left carousel-control" href="#eventCarousel" data-slide="prev"></a>
                            <a class="right carousel-control" href="#eventCarousel" data-slide="next"></a>
                        </div>
                        <!--/carousel-inner-->
                    </div><!--/myCarousel-->
                </div><!--/well-->
            </div>
        </div>
</div>

<div class="content-main col-lg-12" style="padding: 0px 100px 0px 100px;">
	<div class="content">
        <div class="content-title ">
            <p class="icon"><img src="{{asset('img/TourIcon/compass4.svg')}}"></p>
            <p class="title">Tour Được đặt nhiều</p>
            <p class="detail-link"><a href="">Xem thêm >></a></p>
        </div>
        @foreach($listtopbook as $topbook)
        <div class="content-item">
            <div class="content-img">
                <a href=""><img src="{{asset($topbook->AnhDaiDien)}}"></a>
            </div>
            <div class="content-item-info">
                <div class="content-item-title col-sm-12"><a href="" class="txtlink">{{$topbook->TenTour}}</a></div>
                <div class="content-item-day col-sm-6" style="z-index: 9999;"><span class="glyphicon glyphicon-time"></span> {{$topbook->SoNgay}} ngày</div>
                <div class="content-item-startday col-sm-6" style="z-index: 9999;"><span class="glyphicon glyphicon-calendar"> {{$topbook->NgayKhoiHanh}}</span></div>
                @if($topbook->GiaKhuyenMai!="")
                    <div class="content-item-price col-sm-6">{{$topbook->GiaKhuyenMai}} VND</div>
                    <div class="content-item-originprice col-sm-6">{{$topbook->Gia}} VND</div>
                @else
                    <div class="content-item-price col-sm-6">{{$topbook->Gia}} VND</div>
                @endif
                <div class="content-item-highlight"></div>
            </div>
            <div>
                
            </div>
        </div>
        @endforeach
    </div>
    <div class="content">
        <div class="content-title ">
            <p class="icon"><img src="{{asset('img/TourIcon/compass4.svg')}}"></p>
            <p class="title">Khuyến mại hấp dẫn</p>
            <p class="detail-link"><a href="">Xem thêm >></a></p>
        </div>
        @foreach($listtopsale as $topsale)
        <div class="content-item">
            <div class="content-img">
                <a href=""><img src="{{asset($topsale->AnhDaiDien)}}"></a>
            </div>
            <div class="content-item-info">
                <div class="content-item-title col-sm-12"><a href="" class="txtlink">{{$topsale->TenTour}}</a></div>
                <div class="content-item-day col-sm-6" style="z-index: 9999;"><span class="glyphicon glyphicon-time"></span> {{$topsale->SoNgay}} ngày</div>
                <div class="content-item-startday col-sm-6" style="z-index: 9999;"><span class="glyphicon glyphicon-calendar"> {{$topsale->NgayKhoiHanh}}</span></div>
                @if($topsale->GiaKhuyenMai!="")
                    <div class="content-item-price col-sm-6">{{$topsale->GiaKhuyenMai}} VND</div>
                    <div class="content-item-originprice col-sm-6">{{$topsale->Gia}} VND</div>
                @else
                    <div class="content-item-price col-sm-6">{{$topsale->Gia}} VND</div>
                @endif
                <div class="content-item-highlight"></div>
            </div>
            <div>
                
            </div>
        </div>
        @endforeach    
    </div>
    <div class="content">
       <<div class="content-title ">
            <p class="icon"><img src="{{asset('img/TourIcon/compass4.svg')}}"></p>
            <p class="title">Tour khởi hành từ hà nội</p>
            <p class="detail-link"><a href="">Xem thêm >></a></p>
        </div>
        @foreach($listkhoihanh as $khoihanh)
        <div class="content-item">
            <div class="content-img">
                <a href=""><img src="{{asset($khoihanh->AnhDaiDien)}}"></a>
            </div>
            <div class="content-item-info">
                <div class="content-item-title col-sm-12"><a href="" class="txtlink">{{$khoihanh->TenTour}}</a></div>
                <div class="content-item-day col-sm-6" style="z-index: 9999;"><span class="glyphicon glyphicon-time"></span> {{$khoihanh->SoNgay}} ngày</div>
                <div class="content-item-startday col-sm-6" style="z-index: 9999;"><span class="glyphicon glyphicon-calendar"> {{$khoihanh->NgayKhoiHanh}}</span></div>
                @if($khoihanh->GiaKhuyenMai!="")
                    <div class="content-item-price col-sm-6">{{$khoihanh->GiaKhuyenMai}} VND</div>
                    <div class="content-item-originprice col-sm-6">{{$khoihanh->Gia}} VND</div>
                @else
                    <div class="content-item-price col-sm-6">{{$khoihanh->Gia}} VND</div>
                @endif
                <div class="content-item-highlight"></div>
            </div>
            <div>
                
            </div>
        </div>
        @endforeach          
    </div>
</div>

<div id="searchbox" class="col-lg-8 col-lg-offset-2" >
    <div class="search-content">
        <div class="opac-background"></div>
        <div class="search-form">
            <div class="search-title col-lg-12"><p> <span class="glyphicon glyphicon-plane"></span> Tìm tour </p></div>
            <form action="" method="POST">
            <div class="col-lg-12 form-group">
                <input class="form-control" type="text" name="">
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
            </form>
        </div>
    </div>
</div>
@endsection
@section('script')
<script type="text/javascript">

    $('.countdown').each(function(){
        var date=$(this).attr('date');
        var id =$(this).attr('id');
        getcountdown(date,id);
    })


    function getcountdown(time,id){
        $('#'+id).countdown(time, function(event) {
        $('#'+id).html(event.strftime(' Còn %w Tuần %d Ngày %H:%M:%S'));
        });
    }
</script>
@endsection
