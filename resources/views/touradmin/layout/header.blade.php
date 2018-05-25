<div class="sidebar-toggle">
	<div></div>
	<div></div>
	<div></div>
</div>
<div class="page-title">Admin</div>
<div class="searchbox">
	<div><input type="text" name="searchchar"></div>
	<div><button><span class="glyphicon glyphicon-search"></span></button></div>
</div>

	<div class="avatar">
		@if(Auth::check())
		<?php 
			$imgname=Auth::user()->anhdaidien;
			$imgpath="img/user/".$imgname;
		?>
		<img src="{{ asset($imgpath)}}">
		@endif
	</div>
	<div class="name dropdown" >
	<a href="#" class="dropdown-toggle " data-toggle="dropdown"><p>{{Auth::user()->name}}</p></a>	
  	<ul class="dropdown-menu">
    <li><a href="{!! route('user.info',['iduser'=>Auth::user()->id])!!}">User profile</a></li>
	<li><a href="{!! route('user.logout')!!}">Logout</a></li>
  </ul>
  </div>

<div class="notice">
	<span class="glyphicon glyphicon-globe "></span><span id="noticenumb" style="position: absolute; right: 2px;" class="badge">0</span>
</div>

<div class="noticepopup" style="display: none;">
	<a class="txtlink" href="#"><div class="noticeitem">Bạn hiện không có thông báo mới nào</div></a>
	<a class="txtlink" href="#"><div class="noticeitem">Bạn hiện không có thông báo mới nào</div></a>
	<a class="txtlink" href="#"><div class="noticeitem">Bạn hiện không có thông báo mới nào</div></a>
	<a class="txtlink" href="#"><div class="noticeitem">Bạn hiện không có thông báo mới nào</div></a>
</div>
	

