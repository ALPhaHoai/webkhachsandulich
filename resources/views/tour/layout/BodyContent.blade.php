<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>@yield('title')</title>

		<!-- Bootstrap CSS 
		<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
		-->
		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/tour/tour.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/tour/header.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/tour/footer.css')}}">
		@yield('css')
		<script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
		<script src="{{asset('js/bootstrap.min.js')}}"></script>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
	<div style="width: 100%; height: 100%;" class="row nopadding">
		<div id="header" class="col-lg-12 nopadding">
			@include('tour.layout.header')
		</div>

		<div id='content' class="col-lg-12 nopadding">
			@yield('content')
		</div>

		<div id="footer" class="col-lg-12 nopadding">
			@include('tour.layout.footer')
		</div>
	</div>
		<!-- jQuery -->
		
		<!-- Bootstrap JavaScript -->
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/tour/homepage.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/countdownclock/jquery.countdown.js')}}"></script>
		<script type="text/javascript">
			$.ajaxSetup({
    			headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    			}
			})
		</script>
		@yield('script')
	</body>
</html>
