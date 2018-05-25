@if(Auth::check())
<div class="col-md-2" style=" padding: 0;" id="usersidebar">
			<div class="panel panel-default">
				<div class="panel-heading"><b>User menu</b></div>
				<div class="panel-body">
					<?php 
						$imgname=Auth::user()->anhdaidien;
						$imgpath="img/user/".$imgname;
					 ?>
					<div class="useravatar" style="width: 100%; height: 200px; padding: 10px;"><img src="{{ asset($imgpath)}}" style="width: 100%;height: 100%;"></div>
					<div class="changeimg" style="width: 100%; overflow:hidden;">
						<form enctype="multipart/form-data" method="POST" action="{{ route('user.postimg')}}" name="frm1">
						{{ csrf_field() }}
							<input type="file" name="anhdaidien" onchange="clicked()" id="inputimg" >
						</form>
					</div>
					<div class="usermenu">
						<ul class="nav nav-fill">
							<li><a href="{!! route('user.info',['iduser'=>Auth::user()->id])!!}">Info</a></li>
							<li><a href="{!! route('user.getcmt',['iduser'=>Auth::user()->id])!!}">Comments</a></li>
							<li><a href="{!! url('user/donphonginfo/'.Auth::user()->id)!!}">Đơn đặt phòng</a></li>
							<li><a href="{!! route('getlienhe')!!}">Contact</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>

@endif