<!DOCTYPE html>
<html>
<head>
	<title> Hotel data</title>
</head>
<body>
<?php
include 'simple\simple_html_dom.php'; 
$link=@mysql_connect("localhost","root","vertrigo");
mysql_select_db("webdulich1",$link);
mysql_set_charset('UTF8',$link);
$a=0;
$count=0;
$sql="";
$place="";
$countlt=0;
$title="";
$sort="";
$img="";
$html=file_get_html("https://www.ivivu.com/khach-san-nha-trang/sunrise-nha-trang-beach-hotel-spa");
$idkhachsan="KS10001";
$idkhuvuc="KV100002"; # Đà Nẵng /mỗi khu vực lấy 5;


/*       Khách sạn                      */
/*
$tenkhachsan=$html->find("#hotel-name-detail",0)->plaintext;
$idloai=1;
$diachi=$html->find(".hotelAddress",0)->find(".htldtl-address",0)->plaintext;
$sophong=60;
$danhgia=0;
$thongtin=$html->find(".htdt-description",0)->find('.txt-justify',0)->innertext;
$locthongtin=str_replace("'", "", $thongtin);
$sql="insert into khachsan values('".$idkhachsan."','".$tenkhachsan."','','".$idloai."','".$diachi."','".$idkhuvuc."','".$sophong."','".$danhgia."','".$locthongtin."','')";
$result=mysql_query($sql,$link);
$a=mysql_affected_rows();

echo "Đã thêm $a ,$sql";
*/




/*       Chính sách                        */

$container=$html->find(".htdt-policy",0);
$nhanphong=$container->find("article",1)->find(".txt-justify",0)->plaintext;
$traphong=$container->find("article",2)->find(".txt-justify",0)->plaintext;
$dichuyen=$container->find("article",3)->find(".txt-justify",0)->innertext;
$hoatdong="Làm gì đó";
$huongdan=$container->find("article",4)->find(".txt-justify",0)->innertext;
$phuthu=$container->find("article",5)->find(".txt-justify",0)->innertext;
//echo $nhanphong,$traphong,$huongdan,$phuthu;
$locdichuyen=str_replace("'", "", $dichuyen);
$lochoatdong=str_replace("'", "", $hoatdong);
$lochuongdan=str_replace("'", "", $huongdan);
$locphuthu=str_replace("'", "", $phuthu);
$sql="insert into chinhsach values('CS10','".$nhanphong."','".$traphong."','".$locdichuyen."','".$lochoatdong."','".$lochuongdan."','".$locphuthu."')";
$result=mysql_query($sql,$link);
$a=mysql_affected_rows();

echo "Đã thêm $a ,$sql";


/*       Loại phòng 




/*       Ảnh */
/*
$container=$html->find(".jslides",0);
$container1=$container->find("div");
$count=250;
for ($i=5;$i<=9;$i++){
	$count=$count+1;
	$imgurl=$container1[$i]->find("img",0)->src;
	$file=file_get_contents("https:".$imgurl);
	$destination=str_replace(substr($imgurl,0,36),"img/hotelimg",$imgurl);
	try{
	file_put_contents($destination, $file);
    } catch (Exception $e){
           continue;
    }
	$sql1="insert into anh values('".$destination."',NULL)";
	$result1=mysql_query($sql1,$link);
	$sql2="insert into anhkhachsan values('".$count."','".$idkhachsan."',NULL)";
	$result2=mysql_query($sql2,$link);
		echo "success $sql1,$sql2<br>";
}
*/

?>

</body>
</html>