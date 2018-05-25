@extends('frontendhotel.layouts.home')
@section('content')
<div class="content-entry">
	<div class="col-lg-12 col-lg-offset-1 bread-crumb">
		<ul>
			<li><a href="{{ url('hotel/homepage')}}">Home </a> > </li>
			<li><a href="{{ url('hotel/homepage')}}">Search </a> > </li>
			<li>{{$key}}   </li>
	</div>
	<div class="col-lg-8 col-lg-offset-1">
		<form method="POST" action="{{route('hotel.search')}}">
		{{ csrf_field() }}
			<div class="form-group">
				<div class="col-lg-12"><label>Tìm kiếm khách sạn</label></div>
				<div class="col-lg-8">
				<input type="text" name="keyword" class="form-control">
				</div>
				<div class="col-lg-4">
					<button type="submit" class="btn btn-primary">Tìm Kiếm</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-lg-8 col-lg-offset-1"><h2>Search for : {{$key}} </h2></div>
	<div class="col-lg-8 col-lg-offset-1">
	@if($khachsan!=null)
	@foreach($khachsan as $item)
	<?php $img=DB::table('anh')->where('ID',$item->IDKhachSan)->get()->first();
			if($img!=null){
			if($img!=null){
			    	$url=$img->URL;
			    	}
			    	else {
			    		$url="img/coollogo_com-18451102.png";
			    	}	
		}else
			$url="img/coollogo_com-18451102.png";
			$extra=DB::table('tienich')->where('IDKhachSan',$item->IDKhachSan)->get();
	 ?>
		<div class="hotelitem">
			<div class="detailsearch imgsearch"><a href=""><img src="{{asset($url)}}"></a></div>
			<div class="detailsearch infosearch">
				<p class="hotelname"><a href="">{{$item->TenKhachSan}}</a></p>
				<p class="hotellocal"><span class="glyphicon glyphicon-map-marker"></span> {{$item->DiaChi}}</p>
				@if($extra!=null)
						<div class="hotelextra">
						<ul>
							@foreach($extra as $ex)
							<?php $tienich=DB::table('chitiettienich')->where('id',$ex->IDChiTiet)->get()->first(); ?>
							<li>{{$tienich->NoiDung}}</li>
							@endforeach
						</ul>
						</div>
						@endif
			</div>
			<div class="detail">
				<div style="margin-top: 30px" class="price">2000VND</div>
				<a href="{{url('hotel/detail/'.$item->IDKhachSan)}}"><button type="button">Chi tiết</button></a>
			</div>
		</div>
		@endforeach
		@else
		<div class="col-lg-12">KHông có kết quả</div>
		@endif
		<div class="col-lg-12 paginatespace">
				<ul class="pagination">
			@if($khachsan->currentpage()!=1)
				<li><a href="{{$khachsan->url($khachsan->currentpage()-1)}}">&laquo;</a></li>
			@endif
				@for($i=1;$i<=$khachsan->lastpage();$i++)
				<li class="{{($khachsan->currentpage()==$i) ? 'active' : ''}}"><a href="{{$khachsan->url($i)}}">{{$i}}</a></li>
				@endfor
			@if($khachsan->currentpage()!=$khachsan->lastpage())
				<li><a href="{{$khachsan->url($khachsan->currentpage()+1)}}">&raquo;</a></li>
			@endif
			</ul>
			</div>
	</div>
</div>
@endsection