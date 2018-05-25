$(document).ready(function(){
	$("#morebtn").click(function(){
		$("#insert").append("<tr><td><div class='form-group'><input type='date' name='ngaykhoihanh[]'></div></td><td><div class='form-group'><input type='text' name='dacdiem[]'></div></td><td><div class='form-group'><input type='text' name='diadiem[]'></div></td><td><div class='form-group'><input type='number' name='socho[]'></div></td><td><div class='form-group'><input type='number' name='gia[]'></div></td><td>&nbsp</td></tr>");
	});
});