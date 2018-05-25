$(document).ready(function(){
	$(".tourimg").click(function(){
		
	});
	$("#plus").click(function(){
		$(".insert_more").append("<div class='form-group'><input type='file' name='anhtour[]' class='form-control'></div>");
	});
	$("#minus").click(function(){
		$(".insert_more").html("");
	});

	$(".delimg").click(function(){
		var url,_token,idanh;
		idanh=$(this).attr("idanh");
		url="/admin/tour/delimg/"+idanh;
		_token=$("form[name='imgform']").find("input[name='_token']").val();
		$.ajax({
			type:"GET",
			url:url,
			data:{'_token':_token},
			success: function(data){
				var Data= JSON.parse(data);
				if(Data['error']==false){
					$(".touritem").each(function(){
						if($(this).attr("idanh")==idanh){
							$(this).css("display","none");
						}
					});
				}
			}
		});
	});
});	