<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
  	
  		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



		 <!-- Include external CSS. -->
    	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.css">

		<!-- Include Editor style. -->
    	<link href="{{asset('css/froala_editor.pkgd.min.css')}}" rel="stylesheet" type="text/css" />
    	<link href="{{asset('css/froala_style.min.css')}}" rel="stylesheet" type="text/css" />


		<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
		<script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		
		<!-- Summer Note Component -->
		<script src="{{asset('js/summernote.js')}}"></script>
		<link rel="stylesheet" type="text/css" href="{{asset('css/summernote.css')}}"> 

		<!-- datatable Components -->
		<link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">

		<link rel="stylesheet" type="text/css" href="{{ asset('css/admin/admincss.css') }}">
		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet"> 


		@yield("css")
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<div id='header'>
			@include('touradmin.layout.header')
		</div>
		<div id="menu">
			@include('touradmin.layout.menu')
		</div>
		<div id='content' style="padding-left: 20px;">
			@yield('content')
		</div>

		<div id='footer'>
			@include('touradmin.layout.footer')
		</div>
		<div id="displaymessage" class="hidden">
			@include('touradmin.layout.displaymessage')
		</div>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

		    <!-- Include external JS libs. -->
    	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/codemirror.min.js"></script>
    	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/codemirror/5.25.0/mode/xml/xml.min.js"></script>

		<!-- Include Editor JS files. -->
    	<script type="text/javascript" src="{{asset('js/froala_editor.pkgd.min.js')}}"></script>

    	<script type="text/javascript" charset="utf8" src="{{asset('js/jquery.dataTables.min.js')}}"></script>

		<script type="text/javascript" src="{{ asset('js/admin.js') }}"></script>
		<script type="text/javascript" src="{{ asset('js/notification/noticeAjax.js') }}"></script>
		<script> $(function() { $('#floranote').froalaEditor() });
		$(function() { $('.floranote').froalaEditor() });
		$(document).ready( function () {
    	$('#table_id').DataTable();
    	$('.table_id').DataTable();
		} );
		</script>
		@yield('script')
	</body>
</html>