<!DOCTYPE html>
<html lang="">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Blog du lịch</title>

		<!-- Bootstrap CSS -->
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{asset('css/frontendblog/blog.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/frontendblog/full-slider.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('css/frontendblog/simple-sidebar.css')}}">


		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body onload="deleteun()">
		<div id="wrapper">
	<div id=sidebar-wrapper>
		<ul class="sidebar-nav">
			<li class="sidebar-brand">
				<a href=""></a>
			</li>
			<?php 
				$loaitinmenu=DB::table('loaitin')->get();
				foreach ($loaitinmenu as $value) {
					?>
					<li >
						<a href="{!!url('blog/themepost',['idlt'=>$value->IDLoaiTin])!!}">{!!$value->TenLoaiTin!!}</a>
					</li>
					<?php 
				}
			  ?>
			<li>
				<a href=""> About us</a>
			</li>
		</ul>
		
	</div>
		
		<div id="page-content-wrapper">
		
		@include('frontendblog.layout.header')
		
		@if(Session::has('flash_message')||count($errors)>0)
		<div class="darkerscreen" ></div>
		<div id="modalsection" class="panel panel-default">
			<div class="panel-heading">Thông báo<span class="glyphicon glyphicon-remove gly"></span></div>
			<div class="panel-body">
			@if(count($errors)>0)
				Không thành công , vui lòng kiểm tra lại thông tin
			@else
				{!! Session::get('flash_message') !!}
			@endif	
				
			</div>
			<div class="panel-footer"><button class="btn btn-primary" id="closemodal">Close</button>
		</div>
		</div>
		@endif

		
	
		@yield('content')
		

		@include('frontendblog.layout.sidebar')
		<button class="btn btn-circle tothetop" id="top"><span class="glyphicon glyphicon-triangle-top"></span></button>
		</div>
		@include('frontendblog.layout.footer')
		
	</div>

		

		

		<!-- jQuery -->
		<script src="{{asset('js/jquery-3.2.0.min.js')}}"></script>
		<!-- Bootstrap JavaScript -->
		<script src="{{asset('js/bootstrap.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('js/blog.js')}}"></script>
	<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
    <script >
    	$(window).on("load",function() {
  function fade(pageLoad) {
  	var windowBottom = $(window).scrollTop() + $(window).innerHeight();
    var min = 0;
    var max = 1;
    var threshold = 0.01;
    
    $(".fade1").each(function() {
      /* Check the location of each desired element */
      var objectBottom = $(this).offset().top + $(this).outerHeight();
      
      /* If the element is completely within bounds of the window, fade it in */
      if (objectBottom < windowBottom) { //object comes into view (scrolling down)
        if ($(this).css("opacity")<=min+threshold || pageLoad) {$(this).fadeTo('fast',max);}
      } else { //object goes out of view (scroll
      	 if ($(this).css("opacity")>=max-threshold || pageLoad) {$(this).fadeTo('fast',min);}
      }
    });
  } fade(true); //fade elements on page-load
  $(window).scroll(function(){fade(false);}); //fade elements on scroll
});

    	$("#top").hide();
    	$(function(){
    		$(window).scroll(function(){
    			if($(this).scrollTop()>20){
    				$("#top").fadeIn();
    			}else{
    				$("#top").fadeOut();
    			}
    		});

    		$("#top").click(function(){
    			$("html,body").animate({ scrollTop : 0 },'medium');
    		});

    	});




    </script>
    <script type="text/javascript">
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


 	function deleteun(){
 		var i;
 		var unessesery=document.getElementsByClassName("ltt-contentbox white");
 		for(i=0;i<unessesery.length;i++){
 			unessesery[i].innerHTML="";
 		}
 	}

 	function menueffect(x){
 		x.classList.toggle("change");
 	}
 	function closemodal(y){
 		y.classList.toggle("closemodal");
 	}

 </script>
 <script >
 	$(document).ready(function(){
 		$(".gly").click(function(){
 			$("#modalsection").hide();
 			$(".darkerscreen").hide();
 		})
 		 $("#closemodal").click(function(){
 			$("#modalsection").hide();
 			$(".darkerscreen").hide();
 		})
 	});
 </script>


	</body>
</html>