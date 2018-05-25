$(document).ready(function(){
});

function getkhuvuc(select){
	var _token,url,i;
	var ThanhPhoID=$("#sl_thanhpho").val();
	_token=$("form[name='frm']").find("input[name='_token']").val();
		url="/admin/khuvuc/getkhuvuclist/"+ThanhPhoID;
	if(ThanhPhoID!=0){
		$("#khuvucInsert").html("");
		$.ajax({
			type:"GET",
			url:url,
			data:{'_token':_token},
			success:function(data){
				console.log(data);
				var Data=JSON.parse(data);
				document.getElementById("khuvucInsert").disabled=false;
				$("#khuvucInsert").append("<option value='0'>--Select Khu vực---</option>");
				for(i=0;i<Data.length;i++){
					$("#khuvucInsert").append("<option value='"+Data[i]['IDKhuVuc']+"'>"+Data[i]['TenKV']+"</option>");
				}
			}
		});
		$("#khuvucInput").removeClass("hidden");
	}else {
		$("#khuvucInput").addClass("hidden");
		alert("Please chose a location");
	}
}

function getvalue(selectbox){
	var value=$("#khuvucInsert").val();

	$("#khuvucInsert").val(value);
}