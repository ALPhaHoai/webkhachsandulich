<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
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
				<li><a href="{{url('blog/homepage')}}" id="menu-toggle">
					<span class="glyphicon glyphicon-home"></span>
				</a></li>
			</ul>
			<form class="navbar-form navbar-left" role="search" action="{{ route('blog.searchpost') }}" method="post">
			{{ csrf_field() }}
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Search" name="searchkey">
				</div>
				<button type="submit" class="btn btn-default">Search</button>
			</form>
			<ul class="nav navbar-nav navbar-right">
				@if(Auth::check())
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php if(Auth::check()){
						echo Auth::user()->name;
						} else echo "Action"; ?><b class="caret"></b></a>
						
					<ul class="dropdown-menu">
						@if(Auth::user()->level==2||Auth::user()->level==4)
						<li><a href="{!! url('admin/loaitin/danhsach') !!}">Quản lý</a></li>
						@endif
						<li id="loginbtn"><a href="{!! route('user.info',['iduser'=>Auth::user()->id])!!}">User profile</a></li>
						<li id="loginbtn"><a href="{!! route('user.logout')!!}">logout</a></li>
						
					</ul>
					
				</li>
				@endif
			</ul>
		</div>
		<!-- /.navbar-collapse -->

	</div>
</nav>
