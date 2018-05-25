@extends('frontendhotel.layouts.home')
@section('content')
<div class="content-entry">
	<div class="col-lg-12 col-lg-offset-1 bread-crumb">
		<ul>
			<li><a href="{{ url('hotel/homepage')}}">Home </a> > </li>
			<li><a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>0,'min1'=>0,'max1'=>0,'idtienich'=>0])}}">{{$khuvuc->TenKV}}</a></li>
			<?php
			if($idloai!=0){
				$loaiks=DB::table('loaikhachsan')->where('id',$idloai)->get()->first();
				?>
				<li> > <a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>0,'max1'=>0,'idtienich'=>0])}}"> {{$loaiks->Ten}} </a></li>
			<?php
			} 
			if($min1!=0 && $max1==0){ ?>
				<li> > <a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>$min,'max1'=>0,'idtienich'=>0])}}"> Dưới {{$min1}} </a></li>
				<?php
			}
			if($min1==0 && $max1!=0){
				?>
			<li> > <a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>0,'max1'=>$max,'idtienich'=>0])}}"> Trên {{$max}} </a></li>
				<?php
			}
			if($min1!=0 && $max1!=0){?>
				<li> > <a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>$min1,'max1'=>$max1,'idtienich'=>0])}}"> Từ {{$min1}} đến {{$max1}} </a></li>
		<?php
			}
			 ?>
		</ul>
	</div>
	<div class="col-lg-8 col-lg-offset-1">
	</div>
	<div class="col-lg-12 col-lg-offset-1"><h2> Khách sạn {{$khuvuc->TenKV}}</h2></div>
	<div class="col-lg-3 col-lg-offset-1 sidebar">
	<div class="panel panel-default">
	<div class="panel-heading">Tìm kiếm tên khách sạn</div>
	<div class="panel-body">
	<div class="input-group">
	<form action="{{route('hotel.search')}}" method="POST">
	{{ csrf_field() }}
    <input type="text" name="keyword" class="form-control" placeholder="Search...">
        <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
      </div>
	</div>
	</form>
	</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Loại Khách sạn</div>
		<div class="panel-body hoteltype">
		<div class="col-lg-12"><a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>0,'min1'=>$min1,'max1'=>$max1,'idtienich'=>0])}}"> Tất cả</a></div>
		@foreach($loaikhachsan as $loai)
		<div class="col-lg-12"><a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$loai->id,'min1'=>$min1,'max1'=>$max1,'idtienich'=>0])}}"> {{ $loai->Ten}}</a></div>
		@endforeach
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Mức giá</div>
		<div class="panel-body hotelprize" >
		<div class="col-lg-12"><a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>0,'max1'=>0,'idtienich'=>0])}}"> Tất cả</a></div>
			<div class="col-lg-12"><a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>$min,'max1'=>0,'idtienich'=>0])}}">Dưới {{ $min }}</a></div>
			<div class="col-lg-12"> <a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>$min,'max1'=>$array[0],'idtienich'=>0])}}">Từ {{ $min }} đến {{ $array[0] }}</a></div>
			@for($i=0;$i<(count($array)-1);$i++)
				<div class="col-lg-12"> <a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>$array[$i],'max1'=>$array[$i+1],'idtienich'=>0])}}">Từ {{ $array[$i] }} đến {{ $array[$i+1] }}</a></div>
			@endfor
			<div class="col-lg-12"><a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>0,'max1'=>$max,'idtienich'=>0])}}">Trên {{ $max }}</a></div>
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">Tiện ích</div>
		<div class="panel-body hotelextra1">
		<div class="col-lg-12"><a href=""> Tất cả</a></div>
			@foreach($tienichall as $all)
				<div class="col-lg-12"> <input type="checkbox" class="tienichlist" idactive="0">{{ $all->NoiDung}}</div>
			@endforeach
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
	<div class="col-lg-7 content-main">
	<?php if($flag==1){ $flag=0;}else{$flag=1;} 
		$tienichlist="";
?>
		<div class="panel panel-default" >
			<div class="panel-heading" id="selector"><b>Sắp xếp theo :</b>
			<a href="{{url('hotel/location1',['idkv'=>$idkv,'flag'=>$flag,'idloai'=>$idloai,'min1'=>$min1,'max1'=>$max1,'idtienich'=>0])}}"><button type="button">Giá <span class="glyphicon glyphicon-menu-down"></span></button></a>
			<button type="button">Hạng sao <span class="glyphicon glyphicon-menu-down"></span></button>
			</div>
			<div class="panel-body">
			@if($khachsan!=null)
			@foreach($khachsan as $item)
			    <?php $img=DB::table('anh')->where('ID',$item->IDKhachSan)->get()->first();
			    	if($img!=null){
			    	$url=$img->URL;
			    	}
			    	else {
			    		$url="img/coollogo_com-18451102.png";
			    	}	
			    	$extra=DB::table('tienich')->where('IDKhachSan',$item->IDKhachSan)->get();
			     ?>
				<div class="hotelitem">
					<div class="hotelimg"><img src="{{ asset($url)}}"></div>
					<div class="detail"><div style="margin-top: 30px;" class="price">{{$item->minprice}} VND</div><a href="{{url('hotel/detail/'.$item->IDKhachSan)}}"><button type="button">Chi tiết</button></a></div>
					<div class="hotelinfo">
						<p class="hotelname">{{$item->TenKhachSan}}</p>
						<p class="hotelloca"><span class="glyphicon glyphicon-map-marker"></span> {{$item->DiaChi}}</p>
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
				</div>
				@endforeach
				@else
				<div>
					Hiện tại không có khách sạn nào
				</div>
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
	</div>
</div>

@endsection
@section('script')
<script >
	$(document).ready(function(){
		$(".tienichlist").change(function(){
			//window.alert("aaa");
			if($(this).attr('idactive')=="0"){
				$(this).parent().css('background-color','#81F7F3');
				$(this).attr('idactive','1');
			}else {
				$(this).parent().css('background-color','white');
				$(this).attr('idactive','0');
			}
		})
	});
</script>
@endsection