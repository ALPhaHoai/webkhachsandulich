@extends('frontendblog.layout.content')
@section('content')

<div class="outer-wrap" onload="deleteun()">
	<div class="inner-wrap">
	<div class="breadcrumbcontainer"> 
		<ol class="breadcrumb1">
			<li><a href="{!! url('blog/homepage') !!}">Home ></a></li>
			<li><a href="{!! url('blog/themepost',['idlt'=>$loaitin->IDLoaiTin]) !!}">{!!$loaitin->TenLoaiTin !!} ></a></li>
			<li><a href="">{!!$baivietpost->TieuDe!!} </a></li>
		</ol>
	</div>
		<div class="postheader">
			<p> {!!$baivietpost->TieuDe!!}</p>
		</div>
		<div class="postcontent">
			{!! $baivietpost->NoiDung!!}	
			
		</div>
		</div>
	<div class="commentsection">
		<div class="commentheader">Bình luận</div>
		<div class="writesection">
	
			@if(Auth::check())
			<form method="post" id="frmpostcmt" action="{{ route('user.comment1',['idbv'=>$baivietpost->IDBV,'iduser'=>Auth::user()->id]) }}" name="frmcmt">
			<?php
				$img=Auth::user()->anhdaidien;
				$imgurl="img/user/".$img; 
			 ?>
			<input type="hidden" name="_token" value="{!! csrf_token() !!}">
			<div class="avatarimg"><img src="{{ asset($imgurl) }}"></div>
			<div class="txtcomment"><textarea id="txtcmt" cols="100" rows="2" class="textarea" name="comment"></textarea> </div>
			<div class="showbtn">
			<button class="btn btn-primary" id="send" type="submit" idbv="{!! $baivietpost->IDBV !!}" iduser="{!!Auth::user()->id !!}">Gửi</button>
			</div>
			</form>
			@else
			<div class="avatarimg"><img src="{{ asset('img/user/default-user-image.png') }}"></div>
			<div class="txtcomment"><textarea cols="90" rows="4" class="textarea" name="comment" id="write"></textarea> </div>
			<div class="showbtn">
			<a data-toggle="modal" href="#modal-id" class="btn btn-primary">Login</a> 
			</div>
			@endif
		</div> 
		<div id="insert"></div>
		@if($comment!=NULL)
		@foreach($comment as $cmt)
			<div class="showcmt">
			<div class="usercmt panel panel-default">
				<?php
				$user=DB::table('users')->where('id',$cmt->IDUser)->get()->first();
				$img=$user->anhdaidien;
				$imgurl="img/user/".$img;
				 ?>
				<div class="avauser"><img src="{{ asset($imgurl) }}"></div>
				<div class="userheader panel-heading"><?php $username=DB::table('users')->where('id',$cmt->IDUser)->get()->first(); echo $username->name."   -     <small>".$cmt->created_at."</small>";  ?></div>
				<div class="cmtuser">{!! $cmt->NoiDung !!}</div>
			</div>

		</div>
		@endforeach
		@endif
	</div>
	
	
	</div>
</div>
@endsection