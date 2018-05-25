@extends('auth.layout.userinterface')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 ">
			<div class="panel panel-default">
				<div class="panel panel-heading"> Đăng nhập</div>
				<div class="panel panel-body"> You are loged in ,please click <a href="{{ url('blog/homepage')}}"><strong>here</strong> </a> to return to homepage </div>
			</div>
		</div>
	</div>	
</div>
@endsection