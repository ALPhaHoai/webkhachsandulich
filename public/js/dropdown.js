// JavaScript Document
$(document).ready(function(e) {
    $("#menu ul li").hover(function(e) {
        $(this).find("ul").stop().slideToggle(400);
	 });
});