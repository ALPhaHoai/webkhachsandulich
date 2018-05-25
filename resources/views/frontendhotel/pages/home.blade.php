@extends('frontendhotel.layouts.home')

@section('content')

<div class="content-entry">
<div class="header">
    <ul>
        <li> <p onclick="window.scrollTo(0,0)"><span class="glyphicon glyphicon-home"></span></p></li>
        <li><a href="#location"><p><span class="glyphicon glyphicon-map-marker"></span> Địa điểm</p></a></li>
        <li><a href="#hotel"><p><span class="glyphicon glyphicon-bed"></span> Khách sạn</p></a></li>
        <li><a href="#tour"><p><span class="glyphicon glyphicon-plane"></span> Tour</p></a></li>
        <li><a href="{{ url('blog/homepage')}}"><p><span class="glyphicon glyphicon-book"></span> Blog</p></a></li>
       @if(!Auth::check())
        <li style="float: right;"><a data-toggle="modal" href="#modal-id"><p><span class="glyphicon glyphicon-user"> Login</p></a></li>
    @else
        <li style="float: right;" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><p>{{Auth::user()->name}}</p></a>
    <ul class="dropdown-menu">
    @if(Auth::user()->level==3||Auth::user()->level==4)
        <li><a href="{!! url('admin/dashbroad') !!}">Quản lý</a></li>
    @endif
        <li><a href="{!! route('user.info',['iduser'=>Auth::user()->id])!!}">User profile</a></li>
        <li><a href="{!! route('user.logout')!!}">Logout</a></li>
    </ul>

    </li>
    @endif
    </ul>
</div>
<div class="header" id="headeronscroll" style="display: none;">
    <ul>
        <li><p onclick="window.scrollTo(0,0)"><span class="glyphicon glyphicon-home"></span></p></li>

       <li><a href="#location"><p><span class="glyphicon glyphicon-map-marker"></span> Địa điểm</p></a></li>
        <li><a href="#hotel"><p><span class="glyphicon glyphicon-bed"></span> Khách sạn</p></a></li>
        <li><a href="#tour"><p><span class="glyphicon glyphicon-plane"></span> Tour</p></a></li>
        <li><a href="{{ url('blog/homepage')}}"><p><span class="glyphicon glyphicon-book"></span> Blog</p></a></li>
        @if(!Auth::check())
        <li style="float: right;"><a data-toggle="modal" href="#modal-id"><p><span class="glyphicon glyphicon-user"> Login</p></a></li>
    @else
        <li style="float: right;" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><p>{{Auth::user()->name}}</p></a>
    <ul class="dropdown-menu">
        <li><a href="{!! url('admin/dashbroad') !!}">Quản lý</a></li>
        <li><a href="{!! route('user.info',['iduser'=>Auth::user()->id])!!}">User profile</a></li>
        <li><a href="{!! route('user.logout')!!}">Logout</a></li>
    </ul>

    </li>
    @endif
    </ul>
</div>
<div class="parallax"></div>
<div id="bigpic parallax">
<div class="col-lg-8 col-lg-offset-2" id="searchsection">
	<div  id="tabheader">
		<p><span class="glyphicon glyphicon-bed"></span> Khách sạn </p>
		<p><span class="glyphicon glyphicon-plane"></span> Tour</p>
	</div>
	<div class="searchcontent">
	<div class="col-lg-12">
		<form action="{{route('hotel.search')}}" method="POST">
        {{ csrf_field() }}
		<div class="col-lg-12">
			<div class="form-group">
				<label>Tìm kiếm nhanh</label>
				<input type="text" name="keyword" class="form-control" onfocus="showst()" >
			</div>

		</div>
        <div class="col-lg-12 hide"  id="khuvuclist" onmouseleave="hidest()">
        <div class="panel panel-default" style="margin-left: 0;margin-right: 0;">
        <div class="panel-heading">Khu vực Phổ biến </div>
        <div class="panel-body">
            @foreach($khuvucall as $item)
            <div class="col-lg-4"><a href="{{url('hotel/location1',['idkv'=>$item->IDKhuVuc,'flag'=>0,'idloai'=>0,'min1'=>0,'max1'=>0,'idtienich'=>0])}}">{{ $item->TenKV}}</a></div>
            @endforeach
            </div>
            </div>
        </div>
		<div class="col-lg-4">
			<div class="form-group">
				<label>Ngày nhận phòng</label>
				<input type="date" name="" class="form-control">
			</div>
		</div>
		<div class="col-lg-4">
			<div class="form-group">
				<label>Ngày trả phòng</label>
				<input type="date" name="" class="form-control">
			</div>
		</div>
		<div class="col-lg-4" style="padding-top: 25px;">
			<button class="btn btn-primary form-control" type="submit" >Tìm kiếm</button>
		</div>

		</form>
		</div>
	</div>
</div>
</div>
<div class="mainwraper" id="location">
	<div class="mainheader"><p>Địa điểm phổ biến Việt Nam</p></div>
	<div class="col-lg-8 col-lg-offset-2 maincontent">
    @foreach($khuvuc as $item)
		<div class="section"><div class="read"><p>{{$item->TenKV}}</p></div><a href="{{url('hotel/location1',['idkv'=>$item->IDKhuVuc,'flag'=>0,'idloai'=>0,'min1'=>0,'max1'=>0,'idtienich'=>0])}}"><img src="{!! asset($item->anhdaidien)!!}"></a></div>
    @endforeach 
		<div class="col-lg-2 col-lg-offset-5"><a href="{{url('hotel/hotelall/0/0/0/0/0')}}"><button class="loadmore" type="button" >Load more</button></a></div>
	</div>

</div>
<div class="parallax1"><div class="testheader"><p id="fromright">Mang đậm văn hóa  </p></div></div>

<div class="mainwraper" id="hotel">
<div class="mainheader"><p>Các Khách sạn nổi bật </p></div>
<div class="container-fluid slidewraper">
    <div id="custom_carousel" class="carousel slide" data-ride="carousel" data-interval="2500">
        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            @foreach($khachsanfav as $item)
                <div class="item">
                <div class="container-fluid">
                    <div class="row">
                    <?php $img=DB::table('anh')->where('ID',$item->IDKhachSan)->get()->first(); ?>
                        <div class="col-md-3"><img src="{!! asset($img->URL) !!}" class="img-responsive"></div>
                        <div class="col-md-9">
                            <h2><a href="{{url('hotel/detail/'.$item->IDKhachSan)}}">{!! $item->TenKhachSan !!}</a></h2>
                            <p><span class="glyphicon glyphicon-map-marker"></span> {!! $item->DiaChi !!}</p>
                        </div>
                    </div>
                </div>            
            </div> 
            @endforeach
        <!-- End Item -->
        </div>
        <!-- End Carousel Inner -->
        <div class="controls">
            <ul class="nav">
            <?php $count=0; ?>
            @foreach($khachsanfav as $item)
                <?php $img=DB::table('anh')->where('ID',$item->IDKhachSan)->get()->first(); ?>
                <li data-target="#custom_carousel" data-slide-to="<?php echo $count?>"><a href="#" class="item1"><img src="{!!asset($img->URL) !!}" style="width: 100%; height: 100%;"><small>{!!$item->TenKhachSan !!}</small></a></li>
                <?php $count+=1;  ?>
            @endforeach
            </ul>
        </div>
    </div>
    <!-- End Carousel -->
    <div class="col-lg-1 col-lg-offset-5"><a href="{{url('hotel/hotelall/0/0/0/0/0')}}"><button class="loadmore" type="button" >Load more</button></a></div>
</div>
</div>
<div class="parallax2"><div class="testheader"><p id="fromright">Đầy đủ tiện nghi </p></div></div>


<div class="mainwraper" id="hotelregister">
<div class="mainheader"><p>Đăng ký cung cấp dịch vụ khách sạn </p></div>
<div class="col-lg-8 col-lg-offset-2">
     <div class="form-group col-md-4 hotelregitem">
         <label><b>Tên khách sạn :</b></label>
        
            <input  type="text" name="tenkhachsan" class="form-control" placeholder="Tên khách sạn đăng ký">
   
     </div>  
     <div class="form-group form-group col-md-4 hotelregitem">
         <label ><b>Email khách sạn:</b></label>

            <input  type="text" name="emailkhachsan" class="form-control" placeholder="Email liên hệ khách sạn">
   
     </div>    
     <div class="form-group form-group col-md-4 hotelregitem">
         <label ><b>SDT khách sạn  :</b></label>
   
            <input   type="text" name="SDTkhachsan" class="form-control" placeholder="Số điện thoại liên hệ khách sạn">
       
     </div>   
     <div class="form-group form-group col-md-4 hotelregitem">
         <label ><b>Người liên hệ , đại diện :</b></label>

            <input  type="text" name="tendaidien" class="form-control" placeholder="Tên người đại diện ">
  
     </div>    
     <div class="form-group form-group col-md-4 hotelregitem">
         <label ><b>Email người đại diện</b></label>
      
            <input  type="text" name="emaildaidien" class="form-control" for="email" placeholder="email liên hệ">
       
     </div>  
      <div class="form-group form-group col-md-4 hotelregitem">
         <label class=""><b>Số điện thoại người đại diện</b></label>
            <input type="text" name="SDTdaidien" class="form-control" placeholder="Số điện thoại liên hệ ">
      
     </div>   
    <div class="col-lg-2 col-lg-offset-5"><button type ="button" id="sendreg" class="loadmore">Gửi yêu cầu </button></div>       
</div>
</div>
</div>

<div class="displaymessage">
    <div class="panel panel-default">
        <div class="panel-heading"><b>title</b></div>
        <div class="panel-body">content</div>
        <div class="panel-footer"><button id="closebtn" type="button" class="btn btn-default">close</button></div>
    </div>
</div>



@endsection
@section('script')
<script>
	$(document).ready(function(ev){
    $('#custom_carousel').on('slide.bs.carousel', function (evt) {
      $('#custom_carousel .controls li.active').removeClass('active');
      $('#custom_carousel .controls li:eq('+$(evt.relatedTarget).index()+')').addClass('active');
    })
    $(function(){
        $(window).scroll(function(){
            if($(window).scrollTop()>20){
                $("#headeronscroll").slideDown("medium");
            }
            else{
                $("#headeronscroll").slideUp("medium");
            }

        });
    });
});
</script>
<script >
    function beingactive(){
        var activeslider=document.getElementsByClassName("item")[0];
        activeslider.className=activeslider.className+" active";
        var activeitem1=document.getElementsByClassName("item1")[0];
        activeitem1.className=activeitem1.className+" active";
    }
    function showst(){
        var khuvuclist=document.getElementById("khuvuclist");
        khuvuclist.className=khuvuclist.className.replace(" hide","");

    }
    function hidest(){
        var khuvuclist=document.getElementById("khuvuclist");
        khuvuclist.className+=" hide";
    }
</script>
<script type="text/javascript" src="{{asset('js/hotel/registersend.js')}}"></script>
@endsection