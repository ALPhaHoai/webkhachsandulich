$(document).ready(function(){
	$("#sendreg").click(function(){
		var url="/hotel/dangkykhachsan/them";
		var tenkhachsan,emailkhachsan,sdtkhachsan,tendaidien,emaildaidien,sdtdaidien;
		tenkhachsan=$("#hotelregister").find("input[name='tenkhachsan']").val();
		emailkhachsan=$("#hotelregister").find("input[name='emailkhachsan']").val();
		sdtkhachsan=$("#hotelregister").find("input[name='SDTkhachsan']").val();
		tendaidien=$("#hotelregister").find("input[name='tendaidien']").val();
		emaildaidien=$("#hotelregister").find("input[name='emaildaidien']").val();
		sdtdaidien=$("#hotelregister").find("input[name='SDTdaidien']").val();
		$.ajax({
			type:"POST",
			url:url,
			data:{'tenkhachsan':tenkhachsan,'emailkhachsan':emailkhachsan,'sdtkhachsan':sdtkhachsan,'tendaidien':tendaidien,'emaildaidien':emaildaidien,'sdtdaidien':sdtdaidien},
			success:function(data){
				$("#hotelregister").find("input").each(function(){
					$(this).val("");
				});
				var Data=JSON.parse(data);
				console.log(Data);
				displaymessage("Thông báo","Yêu cầu của bạn đã được gửi thành công");
			},
			error: function(data){
				var errors = data.responseJSON;
				var errormessage =""; 
				if(errors['tenkhachsan']!=null){
					errormessage+="<br>"+errors['tenkhachsan'];
				}
				if(errors['emailkhachsan']!=null){
					errormessage+="<br>"+errors['emailkhachsan'];
				}
				if(errors['sdtkhachsan']!=null){
					errormessage+="<br>"+errors['sdtkhachsan'];
				}
				if(errors['tendaidien']!=null){
					errormessage+="<br>"+errors['tendaidien'];
				}
				if(errors['emaildaidien']!=null){
					errormessage+="<br>"+errors['emaildaidien'];
				}
				if(errors['sdtdaidien']!=null){
					errormessage+="<br>"+errors['sdtdaidien'];
				}
				displaymessage("Thông tin lỗi",errormessage);
        		
			}

		});	


	});
	$("#closebtn").click(function(){
		$(".displaymessage").slideUp();
	});

});

function displaymessage(title,content){
	$(".displaymessage").find("div[class='panel-heading']").html(title);
	$(".displaymessage").find("div[class='panel-body']").html(content);
	$(".displaymessage").slideDown();
}