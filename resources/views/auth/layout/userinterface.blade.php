<!DOCTYPE html>
<html>
<head>
	<title>User</title>
	<meta charset="utf-8" http-equiv="content" Content="text/html">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
	<script src="//code.jquery.com/jquery.js"></script>
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
	<script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('css/admin/jquery.dataTables.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/jquery.dataTables.min.css')}}">
</head>
<body>
@include('auth.layout.header')

<div class="col-lg-12" id="content">
<div class="container-fluid">
	<div class="row">
	@include('auth.layout.sidebar')
	@yield('content')
	</div>
</div>	
</div>
@include('auth.layout.footer')
@yield('script')
</body>
</html>