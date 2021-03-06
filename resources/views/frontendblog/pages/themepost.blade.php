@extends('frontendblog.layout.content')
@section('content')

<div class="outer-wrap" onload="">
	<div class="inner-wrap">
	<div class="breadcrumbcontainer"> 
		<ol class="breadcrumb1">
			<li><a href="{!! url('blog/homepage') !!}">Home ></a></li>
			<li><a href="{!! url('blog/themepost',['idlt'=>$loaitintheme->IDLoaiTin]) !!}">{{ $loaitintheme->TenLoaiTin }} </a></li>
		</ol>
	</div>
@if($baivietpage!=null && $baiviettheme!=null)
	<div class="newpost">
	<?php $imgname=$baiviettheme['0']->anhdaidien;
			$imgfile="img/blogimg/".$imgname;
	  ?>
		<div class="newpostimg"><a href="{!! url('blog/post',['id'=>$baiviettheme['0']->IDBV]) !!}"><img src="{!! asset($imgfile) !!}"></a> </div>
		<div class="newposttitle"><a href="{!! url('blog/post',['id'=>$baiviettheme['0']->IDBV]) !!}">{!! $baiviettheme['0']->TieuDe !!} </a></div>
		<div class="newpostsort">{!! $baiviettheme['0']->TomTat !!}</div>
	</div>
		<div class="section-onehalf" style="margin-top: 30px;">
			@foreach($baivietpage as $baivietpagecontent)
				<?php 
				$iditem=$baivietpagecontent->IDBV;
				$imgname=$baivietpagecontent->anhdaidien;
				$imgfile="img/blogimg/".$imgname;
				 ?>
				<div class="one-half">
				<div class="one-half-img "><a href="{{url('blog/post',['id'=>$iditem])}}"><img src="{{asset($imgfile)}}" style="width: 100%; height: 100%;"></a></div>
				<div class="one-half-title">
					<a href="{{url('blog/post',['id'=>$iditem])}}">{{ $baivietpagecontent->TieuDe }}</a>
				</div>
				<div class="one-half-short ">
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
		@else
		<div class=" panel panel-default">
		<div class="panel-heading">Thông báo</div>
		<div class="panel-body">Hiện không có bài viết nào trong mục này</div>
		 </div>
		 @endif
	</div>
</div>
@endsection
	