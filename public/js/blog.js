$(document).ready(function(){
	$("#send").on("click",function(){
		var _token,idbaiviet,iduser,comment;
			_token=$("form[name='frmcmt']").find("input[name='_token']").val();
		 idbaiviet=$(this).attr('idbv');
		 iduser=$(this).attr('iduser');
		 comment=$("form[name='frmcmt']").find("textarea[name='comment']").val();
		$.ajax({
			url:"http://localhost:8000/user/comment1/"+idbaiviet+"/"+iduser,
			type:'GET',
			cache:false,
			data:{"_token":_token,"idbv":idbaiviet,"iduser":iduser,"comment":comment},
			success:function(data){
				$("#insert").append("<div class='showcmt'><div class='usercmt panel panel-default'><div class='avauser'><img src='http://localhost:8000/img/user/"+data['1']+"'></div><div class='userheader panel-heading'> "+data['0']+" </div><div class='cmtuser'>"+data['2']+"</div></div></div>");

			}


		});
		$("#txtcmt").text("");

	});
});


$("#frmpostcmt").submit(function(){
	return false;
});