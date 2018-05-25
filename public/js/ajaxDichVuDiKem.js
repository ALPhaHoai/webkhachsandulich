$(document).ready(function(){

});

function check(checkbox){
	var url;
	var idTour=checkbox.getAttribute("idTour");
	var idDichVu=checkbox.getAttribute("idDichVu");
	var _token=$("form[name='frm']").find("input[name='_token']").val();
	if(checkbox.checked){
		document.getElementById(idDichVu).disabled=false;
		url="/admin/dichvudikem/add/"+idTour+"/"+idDichVu;
	}else
	{	document.getElementById(idDichVu).disabled=true;
		url="/admin/dichvudikem/delete/"+idTour+"/"+idDichVu;
	}
	$.ajax({
		type:"POST",
		url:url,
		data:{"_token":_token},
		success:function(data){
			console.log(data);
		}
	});
}

function update(textarea){
	var url,data,idTour,idDichVu;
	var _token=$("form[name='frm']").find("input[name='_token']").val();
	idTour=textarea.getAttribute("idTour");
	idDichVu=textarea.getAttribute("id");
	url = "/admin/dichvudikem/update/"+idTour+"/"+idDichVu;
	data=document.getElementById(idDichVu).value;
	$.ajax({
		type:"POST",
		url:url,
		data:{"_token":_token,"ghichu":data},
		success:function(data){
			console.log(data);
		}
	});

}