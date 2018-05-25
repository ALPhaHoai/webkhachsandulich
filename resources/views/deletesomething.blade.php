<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Title Page</title>
				<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
	<script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
	<script src="{{asset('js/bootstrap.min.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/header_admin.css')}}">
	<script src="{{asset('js/summernote.js')}}"></script>
	<link rel="stylesheet" type="text/css" href="{{asset('css/summernote.css')}}">
    <script type="text/javascript" src="{{asset('js/myjs.js')}}"></script>
    <script type="text/javascript" src="{{asset('css/admin/jquery.dataTables.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/admin/jquery.dataTables.min.css')}}">
		<script type="text/javascript">
			function delete1(){
				document.getElementsByClassName("ltt-contentbox white")[0].innerHTML="";
				document.getElementsByClassName("ltt-contentbox white")[1].innerHTML="";
				document.getElementsByClassName("ltt-contentbox white")[2].innerHTML="";
				var deleted =document.getElementByClassName("entry-content")[0];
				document.getElementById('new').value=deleted.innerHTML;
			}
		</script>
		<script >
			$(document).ready(function(){
				
				$(".btn").click(function(){
					$("#new").html($("#old").html());
				});
			});
		</script>


		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('css/bootstrap-theme.min.css')}}">
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<script src="{{asset('js/summernote.js')}}"></script>
		<link rel="stylesheet" type="text/css" href="{{asset('css/summernote.css')}}">


		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
		<?php

		$a=$danhsach['NoiDung'];

		  ?>
	</head>
	<body>
		<h1 class="text-center">Hello World</h1>
		<form name="frm" action="">
		<textarea id="old"><?php echo $danhsach['NoiDung'] ; ?></textarea>
		<textarea name="noidung" id="new"></textarea>
		<input type="button" class="btn" value="nút" onclick="delete1()">
				<input type="text" name="" maxlength="500000" value="<?php echo $danhsach['NoiDung'] ; ?>">
		</form>

		<!-- jQuery -->
		<script src="//code.jquery.com/jquery.js"></script>
		<!-- Bootstrap JavaScript -->
		<script type="text/javascript">
	
        $(document).ready(function() {
            $('#summernote').summernote({
              height:300,
            });
        });
		</script>
	</body>
</html>