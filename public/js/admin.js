$(document).ready(function(){
	var flag=0;
	$(".sidebar-toggle").click(function(){
		$("#menu").toggle();
		if(flag==0){
			$("#content").css("left","0%");
			$("#content").css("width","100%");
			flag=1;
		}else{
			$("#content").css("left","15%");
			$("#content").css("width","80%");
			flag=0;
		}
	});

	$("#canceldel").click(function(){
		$("#displaymessage").addClass("hidden");
	});

	$(".cancelbook").click(function(){
		//alert($(this).attr('iddon'));
		$("#displaymessage").removeClass(" hidden");
		$("#iddonhuy").val($(this).attr('iddon'));

	});

	$(".cancel").click(function(){
		$("#displaymessage").addClass(" hidden");
	});

});

function showmessage(message,url){
	$("#confirmdel").attr("href",url);
	$("#message").html(message);
	$("#displaymessage").removeClass("hidden");
	return false;
}