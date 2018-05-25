@extends('frontendblog.layout.content')
@section('content')
@if($baivietpage->currentpage()==1)
<div class="abc" >
	<div id="carousel-id" class="carousel slide" data-ride="carousel">
		<ol class="carousel-indicators">
			<li data-target="#carousel-id" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-id" data-slide-to="1" class=""></li>
			<li data-target="#carousel-id" data-slide-to="2" class=""></li>
			<li data-target="#carousel-id" data-slide-to="3" class=""></li>
		</ol>
		<div class="carousel-inner">
			<div class="item active">
			<div class="darker">
				<img src="{{asset('img/salewp.jpg')}}" style="opacity: 0.9;">
			</div>	
				<div class="container">
					<div class="carousel-caption">
						<h1> Khuyến Mãi  </h1>
						<p>Nếu bạn đã chán đi biển cũng chán lên núi thì còn chần chừ gì nữa mà không tranh thủ cuối tuần đổi gió du lịch Cần Thơ với gói nghỉ dưỡng 3N2Đ tại resort Victoria Cần Thơ bao gồm xe đưa đón từ Sài Gòn và tour tham quan chợ nổi chỉ 2,5 triệu đồng/khách. </p>
						<p><div class="more"><a  href="{{ url('blog/themepost/LT1')}}" role="button">Read more</a></div></p>
					</div>
				</div>
			</div>
			<div class="item">
			<div class="darker">
				<img src="{{asset('img/roadwp2.jpg')}}" style="opacity: 0.9;">
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1>Điểm đến.</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><div class="more"><a  href="{{ url('blog/themepost/LT2')}}" role="button">Read more</a></div></p>
					</div>
				</div>
			</div>
			<div class="item">
			<div class="darker">
				<img src="{{asset('img/foodwp.jpg')}} " style="opacity: 0.9;">
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1 style="color: white;">Ẩm thực</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><div class="more"><a  href="{{ url('blog/themepost/LT3')}}" role="button">Read more</a></div></p>
					</div>
				</div>
			</div>
			<div class="item">
			<div class="darker">
				<img src="{{asset('img/slider4.png')}}" style="opacity: 0.9;">
				</div>
				<div class="container">
					<div class="carousel-caption">
						<h1>Mẹo.</h1>
						<p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
						<p><div class="more"><a  href="{{ url('blog/themepost/LT4')}}" role="button">Read more</a></div></p>
					</div>
				</div>
			</div>
		</div>
		<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
		<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
	</div>
</div>
@endif

<!-- CONTENT================================-->


<div class="outer-wrap" id="content">
	<div class="inner-wrap">
	<div class="attention">
		<div class="attentionheader"><p> Hot New </p></div>
		<div class="attentioncontent">
		
		<?php 
		for($i=0;$i<=3;$i++){
			$imgpath="img/blogimg/".$hotnew[$i]->anhdaidien;
				$url="blog/post/".$hotnew[$i]->IDBV; ?>
			<div class="attentionitem"><a href=""><img src="{!! asset($imgpath) !!}">
			<div class="overlay">
				<div class="txttitle">{{$hotnew[$i]->TieuDe}}</div>
				<div class="btnread"><a href="{!! url($url) !!}">Read more</a></div>
			</div>
			</a></div>
		<?php } 
		?>
			
		</div>
	</div>
@if($baivietpage->currentpage()==1)
		@foreach($loaitin as $loaitin1)
		<?php $postnum=DB::table('baiviet')->where('IDLoaiTin',$loaitin1->IDLoaiTin)->count(); 
			if($postnum >=5){
		?>
		<div class="section" >
			<div class="section-header"><p class="header-text"> {{$loaitin1->TenLoaiTin}}</p></div>
			<div class="fav-post">
				<?php 
			$baiviet12=DB::table('baiviet')->where('IDLoaiTin',$loaitin1->IDLoaiTin)->orderBy('created_at','desc')->take(5)->get()->toArray();
				$title=$baiviet12['0']->IDBV;
				$imgnamefav=$baiviet12['0']->anhdaidien;
				$imgfile="img/blogimg/".$imgnamefav;
				 ?>
				<div class="fav-post-img fade1" ><a href="{{url('blog/post',['id'=>$title]) }}"><img style="width: 100%; height: 100%;" src="{{ asset($imgfile)}}"></a></div>
				<div class="fav-title fade1">
					<p><a href="{{url('blog/post',['id'=>$title]) }}"><?php echo $baiviet12['0']->TieuDe;  ?></a>
					</p>
					
				</div>
				<div class="fav-short-content fade1">
				<p><span class="glyphicon glyphicon-time"> </span><small style="font-style: italic;"><?php echo " ".$baiviet12['0']->created_at;  ?></small></p>
					<p><?php echo $baiviet12['0']->TomTat;  ?></p>
				</div>
			</div>
			<!-- fav-post -->
			<div class="side-posts">
				@for($i=1;$i<=4;$i++)
				<?php
				 $iditem=$baiviet12[$i]->IDBV;
				 $imgname=$baiviet12[$i]->anhdaidien;
				 $imgfile= "img/blogimg/".$imgname;  ?>
				<div class="side-item fade1">
					<div class="side-img"><a href="{{url('blog/post',['id'=>$iditem])}}"><img src="{!! asset($imgfile)!!}"></a></div>
					<div class="side-title"><p><a href="{{url('blog/post',['id'=>$iditem])}}">{{ $baiviet12[$i]->TieuDe}}</a></p>
					</div>
					<div class="timedisplay"><p><span class="glyphicon glyphicon-time"> </span><?php echo " ".$baiviet12[$i]->created_at;  ?></p></div>
				</div>
				@endfor
			</div>
		</div>
		<?php
		}  ?>
		@endforeach
		
@endif

		<div class="section-onehalf" style="margin-top: 30px;">
			<div class="section-header"><p class="header-text"> Tổng hợp </p></div>
			@foreach($baivietpage as $baivietpagecontent)
				<?php 
				$iditem=$baivietpagecontent->IDBV;
				$imgname=$baivietpagecontent->anhdaidien;
				$imgfile="img/blogimg/".$imgname;
				 ?>
				<div class="one-half">
				<div class="one-half-img fade1"><a href="{{url('blog/post',['id'=>$iditem])}}"><img src="{{asset($imgfile)}}" style="width: 100%; height: 100%;"></a></div>
				<div class="one-half-title fade1">
					<a href="{{url('blog/post',['id'=>$iditem])}}">{{ $baivietpagecontent->TieuDe }}</a>
				</div>
				<div class="one-half-short fade1">
					{{ $baivietpagecontent->TomTat }}
				</div>
			</div>
			@endforeach
			<div class="paginatespace">
			<ul class="pagination">
			@if($baivietpage->currentpage()!=1)
				<li><a href="{{$baivietpage->url($baivietpage->currentpage()-1)}}">&laquo;</a></li>
			@endif
				@for($i=1;$i<=$baivietpage->lastpage();$i++)
				<li class="{{($baivietpage->currentpage()==$i) ? 'active' : ''}}"><a href="{{$baivietpage->url($i)}}">{{$i}}</a></li>
				@endfor
			@if($baivietpage->currentpage()!=$baivietpage->lastpage())
				<li><a href="{{$baivietpage->url($baivietpage->currentpage()+1)}}">&raquo;</a></li>
			@endif
			</ul>
			</div>
		</div>

	</div>
	
</div>

@endsection