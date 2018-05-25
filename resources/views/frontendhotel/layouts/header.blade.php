@if(!Request::is('*homepage*'))
<div class="header-entry">
<ul>
	<li><a href="{{url('hotel/homepage')}}"><p><span class="glyphicon glyphicon-home"></span></p></a></li>
	<li><a href="{{url('hotel/hotelall/0/0/0/0/0')}}"><p><span class="glyphicon glyphicon-bed"></span> Khách sạn</p></a></li>
	<li><p><span class="glyphicon glyphicon-home"></span> Tour</p></li>
	<li><a href="{{url('blog/homepage')}}"><p><span class="glyphicon glyphicon-list"></span> Blog</p></a></li>
	@if(!Auth::check())
	<li style="float: right;"><a data-toggle="modal" href="#modal-id"><p>Login</p></a></li>
	@else
	<li style="float: right;" class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><p>{{Auth::user()->name}}</p></a>
	<ul class="dropdown-menu">
	@if(Auth::user()->level==3||Auth::user()->level==4||Auth::user()->level==3)
		<li><a href="{!! url('admin/dashbroad') !!}">Quản lý</a></li>
	@endif
		<li><a href="{!! route('user.info',['iduser'=>Auth::user()->id])!!}">User profile</a></li>
		<li><a href="{!! route('user.logout')!!}">Logout</a></li>
	</ul>

	</li>
	@endif
</ul>
</div>
@endif


    <!--      Login modal       -->
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
