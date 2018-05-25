<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#" ></a>

		</div>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav">
				<li><a href="#menu-toggle" id="menu-toggle">
				<div class="menuicon" onclick="menueffect(this)">
					<div class="bar1"></div>
					<div class="bar2"></div>
					<div class="bar3"></div>
				</div>
				</a></li>
				<li><a class="navbar-brand" href="{{url('hotel/homepage')}}" ><span class="glyphicon glyphicon-bed"></span> Hotel </a></li>
			</ul>
			<form class="navbar-form navbar-left" role="search" action="{{ route('blog.searchpost') }}" method="post">
			{{ csrf_field() }}
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search" name="searchkey">
				</div>
				<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				@if(!Auth::check())
					<li><a data-toggle="modal" href="#modal-id">Login</a></li>
				@endif
				@if(Auth::check())
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php if(Auth::check()){
						echo Auth::user()->name;
						} else echo "Action"; ?><b class="caret"></b></a>
						
					<ul class="dropdown-menu">
						@if(Auth::user()->level>=2)
						<?php

						$accesspath=Auth::user()->getAccessPath();
						$tennhom=Auth::user()->getGroupName();
						  ?>
						@if($accesspath)
							<li><a href='{{route($accesspath)}}' >{{$tennhom}}</a></li>
						@endif
						@endif
						<li id="loginbtn"><a href="{!! route('user.info',['iduser'=>Auth::user()->id])!!}"> User Profile</a></li>
						<li id="loginbtn"><a href="{!! route('user.logout')!!}">logout</a></li>

						
					</ul>
					
				</li>
				@endif
			</ul>
		</div>
		<!-- /.navbar-collapse -->

	</div>
</nav>
<!--                          LOGIN MOLDAL             -->
	<div class="modal fade" id="modal-id">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<div class="tabheader">
						<button class="tablink1" id="login1"  onclick="display1(event,'logincontent')">Đăng nhập</button>
						<button class="tablink1" id="login2" onclick=" display1(event,'registercontent')">Đăng ký</button>
					</div>
					
				</div>
				<div class="modal-body">
					<div class="tabcontent1" id="logincontent">
						@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ route('user.postlogin') }}" >
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Remember Me
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">Login</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Forgot Your Password?</a>
							</div>
						</div>
					</form> 
					</div>
					<div class="tabcontent1" id="registercontent">
						@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ route('user.postregister') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">Name</label>
							<div class="col-md-6">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail Address</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Confirm Password</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Register
								</button>
							</div>
						</div>
					</form>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>



