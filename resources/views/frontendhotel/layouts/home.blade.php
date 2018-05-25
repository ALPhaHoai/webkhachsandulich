<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{ asset('css/frontendhotel/hotel.css')}}">

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body onload="beingactive()">
		@include('frontendhotel.layouts.header')	

		
		@yield('content')
		

		@include('frontendhotel.layouts.footer')

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		@yield('script')


<script >
	function display1(event,idcontent){
 		var i,tabcontent,tablink;
 	tabcontent=document.getElementsByClassName("tabcontent1");

 	for(i=0;i<tabcontent.length;i++){
 		tabcontent[i].style.display="none";
 	}
 	tablink=document.getElementsByClassName("tablink1");
 	for(i=0;i<tablink.length;i++){
 		tablink[i].className=tablink[i].className.replace(" active","");
 	}

 	document.getElementById(idcontent).style.display="block";
 	event.currentTarget.className += " active";
 	
 	}
 	document.getElementById("login1").click();
</script>

	</body>


</html>