$(document).ready(function(){

});

function getauthlist(){
	var groupid=$("#usergroup").val();
	var _token=_token=$("form[name='frm1']").find("input[name='_token']").val();
	var url="/admin/phanquyentheonhom/ajaxgetrightlist";
	var i;
	$.ajax({
		type:"POST",
		url:url,
		data:{'groupid':groupid},
		success: function(data){
			var Data= JSON.parse(data);
			console.log(Data);
			$("#allowinsert").html("");
			$("#notallowinsert").html("");
			if(Data['allow']!=null){
				for(i=0;i<Data['allow'].length;i++){
					if(Data['allow'][i]['accessonly']==false){
						$("#allowinsert").append("<tr><td>"+Data['allow'][i]['tenchucnang']+"</td><td><input type='checkbox' idchucnang='"+Data['allow'][i]['idchucnang']+"' class='cpermit' permittype='add' onchange='registerCPermit(this);'  "+returnCheck(Data['allow'][i]['add'])+"></td><td><input type='checkbox' idchucnang='"+Data['allow'][i]['idchucnang']+"' class='cpermit' permittype='update' onchange='registerCPermit(this);' "+returnCheck(Data['allow'][i]['update'])+"></td><td><input type='checkbox' idchucnang='"+Data['allow'][i]['idchucnang']+"' class='cpermit' permittype='delete' onchange='registerCPermit(this);' "+returnCheck(Data['allow'][i]['delete'])+"></td><td style='text-align:center;'><button type='button' idchucnang='"+Data['allow'][i]['idchucnang']+"' class='removepermit btn btn-primary'><span class='glyphicon glyphicon-remove'></span></button></td></tr>");
					}else {
						$("#allowinsert").append("<tr><td>"+Data['allow'][i]['tenchucnang']+"</td><td> Granted By Default</td><td>Granted By Default</td><td>Granted By Default</td><td style='text-align:center;'><button type='button' idchucnang='"+Data['allow'][i]['idchucnang']+"' class='removepermit btn btn-primary'><span class='glyphicon glyphicon-remove'></span></button></td></tr>");
					}
				}
			}
			if(Data['notallow']!=null){
				for(i=0;i<Data['notallow'].length;i++){
					$("#notallowinsert").append("<tr><td>"+Data['notallow'][i]['tenchucnang']+"</td><td style='text-align:center;'><button type='button' idchucnang='"+Data['notallow'][i]['idchucnang']+"' class='addpermit btn btn-primary'><span class='glyphicon glyphicon-plus'></span></button></td></tr>");
				}
			}
			addPermittion();
			deletePermittion();
			registerCPermit();
		}
	});
}

function returnCheck(booleanvar){
	if(booleanvar==true){
		return 'checked';
	}else {
		return '';
	}
}

function addPermittion(){
	var groupid=$("#usergroup").val();
	var url="/admin/phanquyentheonhom/ajaxaddpermit";
	$(".addpermit").click(function(){
		var permitid=$(this).attr("idchucnang");
		$.ajax({
		type:"POST",
		url:url,
		data:{'groupid':groupid,'permitid':permitid},
		success: function(data){
			var Data= JSON.parse(data);
			console.log(Data);
			getauthlist();
		}
	});
	});
}

function deletePermittion(){
	var groupid=$("#usergroup").val();
	var url="/admin/phanquyentheonhom/ajaxremovepermit";
	$(".removepermit").click(function(){
		var permitid=$(this).attr("idchucnang");
		$.ajax({
		type:"POST",
		url:url,
		data:{'groupid':groupid,'permitid':permitid},
		success: function(data){
			var Data= JSON.parse(data);
			console.log(Data);
			getauthlist();
		}
	});
	});
}

function registerCPermit(a){
	var groupid=$("#usergroup").val();
	var action=$(a).attr("permittype");
	var permitid=$(a).attr("idchucnang");
	var url="/admin/phanquyentheonhom/ajaxaddcpermit";
	if(a!=null){
		$.ajax({
			type:"POST",
			url:url,
			data:{'groupid':groupid,'permitid':permitid,'action':action},
			success: function(data){
				var Data= JSON.parse(data);
				console.log(Data);
				getauthlist();
			}
		});
	}
}