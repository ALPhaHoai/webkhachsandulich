$(document).ready(function(){
	$(".notice").click(function(){
		$(".noticepopup").toggle();
		//noticerequest();
	});
	noticerequest();

});

function noticerequest(){
	var url="/notice/getnotice";
	$.ajax({
		type:"GET",
		url:url,
		data:{},
		success:function(data){
			var Data=JSON.parse(data);
			console.log(Data);
			$("#noticenumb").html("");
			$("#noticenumb").html(Data['count']);
			if(Data['count']!=0){
				$(".noticepopup").html("");
				for(i=0;i<Data['count'];i++){
					$(".noticepopup").append("<a class='txtlink' href='#'><div class='noticeitem'>"+Data[i]['noidung']+"</div></a>")
				}
			}
		},
		complete:function(data){
			setTimeout(function(){noticerequest();},3000);
		}

	});
}