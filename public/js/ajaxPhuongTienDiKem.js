function check(checkbox){
	var url;
	var idTour=checkbox.getAttribute("idTour");
	var idPhuongTien=checkbox.getAttribute("idPhuongTien");
	var _token=$("form[name='frm']").find("input[name='_token']").val();
	if(checkbox.checked){
		document.getElementById(idPhuongTien).disabled=false;
		url="/admin/phuongtiendikem/add/"+idTour+"/"+idPhuongTien;
	}else
	{	document.getElementById(idPhuongTien).disabled=true;
		url="/admin/phuongtiendikem/delete/"+idTour+"/"+idPhuongTien;
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
	idPhuongTien=textarea.getAttribute("id");
	url = "/admin/phuongtiendikem/update/"+idTour+"/"+idPhuongTien;
	data=document.getElementById(idPhuongTien).value;
	$.ajax({
		type:"POST",
		url:url,
		data:{"_token":_token,"ghichu":data},
		success:function(data){
			console.log(data);
		}
	});

}