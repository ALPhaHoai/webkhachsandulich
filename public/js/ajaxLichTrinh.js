$(document).ready(function(){
	$("#add_btn").click(function(){
		document.getElementById(txt_ngay).disabled=false;
	});

	$('.get_noidung').click(function(){
		var idlichtrinh,_token,url;
		idlichtrinh=$(this).attr("idlichtrinh");
		_token=$("form[name='frm1']").find("input[name='_token']").val();
		url="/admin/lichtrinh/getupdate/"+idlichtrinh;
		$.ajax({
			type:"GET",
			url:url,
			data:{"_token":_token},
			success:function(data){
				var Data=JSON.parse(data);
				console.log(Data);
				$(".fr-element").text(" ");
				$(".fr-element").html(Data['noidung']);
				$(".floranote").attr("idlichtrinh",idlichtrinh);
			}
		});
		$(".dark_screen").toggle();
		$("#popup").toggle();
	});

	$('#update_btn').click(function(){
		var noidung,_token,idlichtrinh,url;
		noidung=$(".floranote").val();
		_token=$("form[name='frm1']").find("input[name='_token']").val();
		idlichtrinh=$(".floranote").attr("idlichtrinh");
		url="/admin/lichtrinh/update/"+idlichtrinh;
		$.ajax({
			type:"POST",
			url:url,
			data:{"_token":_token,"noidung":noidung},
			success:function(data){
				console.log(data);
			}
		});
		$(".dark_screen").toggle();
		$("#popup").toggle();
		$(".fr-element").text(" ");
		$("#notice").slideDown();
		setTimeout(function(){
			$("#notice").slideUp();
		},1500);
	});

	$(".dark_screen").click(function(){
		$(this).toggle();
		$("#popup").toggle();
		$(".fr-element").text(" ");
	});

	$(".closebtn").click(function(){
		$(".dark_screen").toggle();
		$("#popup").toggle();
		$(".fr-element").text(" ");
	});
})