$(document).ready(function(){
	var protocol = location.protocol;
	var slashes = protocol.concat("//");
	var host = slashes.concat(window.location.hostname)+":"+location.port+"/";
	$('.getlist').click(function(){
		var more=1;
		/*var _token=$("form[name='frm']").find("input[name='_token']").val();
		var url="/Tour/tourlist";

		$.ajax({
			type:"POST",
			url:url,
			data:{"_token":_token,"displaylist":displaylist},
			success:function(data){
				var Data=JSON.parse(data);
				console.log(Data);
				if(Data[0]==null){
					$('.getlist').hide();
				}
				else {
					for(i=0;i<4;i++){
							$('.InsertTour').append("<div class='inserted content-item'><div class='content-img'><img src='"+host+Data[i]['anhdaidien']+"'></div><div class='content-info'><div class='item-title col-lg-12'><b>"+Data[i]['tentour']+"</b></div><div class='item-time col-lg-6'><span class='glyphicon glyphicon-time'></span> "+Data[i]['songay']+" ngày "+Data[i]['sodem']+" Đêm</div><div class='item-price col-lg-6'>"+Data[i]['Gia']+" VND</div><div class='item-location col-lg-12'><span class='glyphicon glyphicon-map-marker'></span> Khởi hành : "+Data[i]['noikhoihanh']+"</div><div class='item-startdate col-lg-12'><span class='glyphicon glyphicon-calendar'></span> Ngày khởi hành từ : "+Data[i]['ngaykhoihanh']+"</div><div class='detailbtn col-lg-2 col-lg-offset-9'><button type='button' class='btn btn-default'><b>Chi Tiết</b></button></div></div></div>");
					}
				}
				$('#displayed').html(Data['displayed']);


			}
		});*/
		getTourListBySearch(more);

	});

});


// Lấy dữ liệu danh sách các tour bằng một chuỗi string là các điều kiện tìm kiếm
function getListBySideSearch(idlist,iditem){
	var more=0;
	var idkhoihanh,curSearchString,i,newSearchString="";
	var poiterindex; // thứ tự của dấu phẩy cần phải bỏ vì trung lặp id
	var curid=""; //id của danh sách hiện tại
	if(idlist=='khoihanh'){
		idkhoihanh=document.getElementById("khoihanhsearch").value;
		$("#khoihanh").html(idkhoihanh);
	}else {
		curSearchString=$("#"+idlist).html();
		if(curSearchString.includes(iditem)==true){
			for(i=0;i<curSearchString.length;i++){
				if(curSearchString.charAt(i)!=','){
					curid+=curSearchString.charAt(i);
				}else {
					if(curid==iditem){
						poiterindex=i;
					}else {
						newSearchString+=curid+",";
					}
					curid="";
				}
			}
		}else {
			newSearchString=curSearchString+iditem+',';
		}
		$("#"+idlist).html(newSearchString);
	}
	getTourListBySearch(more);
}

//Lấy dữ liệu sau khi đã cập nhật searchString
function getTourListBySearch(more){
	var protocol = location.protocol;
	var slashes = protocol.concat("//");
	var host = slashes.concat(window.location.hostname)+":"+location.port+"/";
	var islocation=$("#isdiadiem").html(); // Trang hiện tại là thuộc khu vực hay địa điểm
	var _token=$('meta[name="csrf-token"]').attr('content');
	var url="/Tour/tourlist_ajaxsearch";
	var idstartlocation=$("#khoihanh").html();
	var strloaitour=$("#loaitour").html();
	var strphuongtien=$("#phuongtien").html();
	var strdichvu=$("#dichvu").html();
	var idlocation;
	var displaylist=$('#displayed').html();
	if(islocation){
		idlocation=$("#locationid").attr('locateid');
	}else {
		idlocation=$("#placeid").attr('placeid');
	}


	$.ajax({
			type:"POST",
			url:url,
			data:{'idstartlocation':idstartlocation,'strloaitour':strloaitour,'strphuongtien':strphuongtien,'strdichvu':strdichvu,'islocation':islocation,'idlocation':idlocation,'more':more,'displaylist':displaylist},
			success:function(data){
				var Data=JSON.parse(data);
				console.log(Data);
				
				if(Data[0]==null){
					$('.getlist').hide();
				}
				else {
					if(more==1){
						for(i=0;i<4;i++){
							if(Data[i]===undefined){
								break;
							}
							$('.InsertTour').append("<div class='inserted content-item'><div class='content-img'><img src='"+host+Data[i]['anhdaidien']+"'></div><div class='content-info'><div class='item-title col-lg-12'><b>"+Data[i]['tentour']+"</b></div><div class='item-time col-lg-6'><span class='glyphicon glyphicon-time'></span> "+Data[i]['songay']+" ngày "+Data[i]['sodem']+" Đêm</div><div class='item-price col-lg-6'>"+Data[i]['Gia']+" VND</div><div class='item-location col-lg-12'><span class='glyphicon glyphicon-map-marker'></span> Khởi hành : "+Data[i]['noikhoihanh']+"</div><div class='item-startdate col-lg-12'><span class='glyphicon glyphicon-calendar'></span> Ngày khởi hành từ : "+Data[i]['ngaykhoihanh']+"</div><div class='detailbtn col-lg-2 col-lg-offset-9'><button type='button' class='btn btn-default'><b>Chi Tiết</b></button></div></div></div>");
						}
					}else {
						$('.InsertTour').html("");
						for(i=0;i<4;i++){
							if(Data[i]===undefined){
								break;
							}
							$('.InsertTour').append("<div class='inserted content-item'><div class='content-img'><img src='"+host+Data[i]['anhdaidien']+"'></div><div class='content-info'><div class='item-title col-lg-12'><b>"+Data[i]['tentour']+"</b></div><div class='item-time col-lg-6'><span class='glyphicon glyphicon-time'></span> "+Data[i]['songay']+" ngày "+Data[i]['sodem']+" Đêm</div><div class='item-price col-lg-6'>"+Data[i]['Gia']+" VND</div><div class='item-location col-lg-12'><span class='glyphicon glyphicon-map-marker'></span> Khởi hành : "+Data[i]['noikhoihanh']+"</div><div class='item-startdate col-lg-12'><span class='glyphicon glyphicon-calendar'></span> Ngày khởi hành từ : "+Data[i]['ngaykhoihanh']+"</div><div class='detailbtn col-lg-2 col-lg-offset-9'><button type='button' class='btn btn-default'><b>Chi Tiết</b></button></div></div></div>");
						}
						$('.getlist').show();
					}
					more=0;
					$('#displayed').html(Data['displayed']);
				}
			}
	});
}