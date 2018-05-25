<!DOCTYPE html>
<html>
<head>
	<title> Tour data</title>
</head>
<body>
<?php
use App\Tour;
include 'simple\simple_html_dom.php'; 
$link=@mysql_connect("localhost","root","vertrigo");
mysql_select_db("webdulich1",$link);
mysql_set_charset('UTF8',$link);

$context = stream_context_create(array(
    'http' => array(
        'header' => array('User-Agent: Mozilla/5.0 (Windows; U; Windows NT 6.1; rv:2.2) Gecko/20110201'),
        'ignore_errors' => true,
    ),
));

ini_set('display_errors', 'On');
$html=file_get_html("https://dulichviet.com.vn/du-lich-trong-nuoc/du-lich-ha-noi-yen-tu-ha-long-ninh-binh-3-ngay-gia-tot-le-30-4",false,$context);

 function getinfo($html,$link){
 	$tentour=$html->find(".mda-info-title",0)->plaintext;
	$tongquan=$html->find("#mda-overview",0)->innertext;
	$idkhuvuc=1;
	$ngaykhoihanh="2018-04-28";
	$songay=3;
	$sodem=2;
	$gia=$html->find(".mda-money",0)->innertext;
	$ghichu=$html->find("#mda-policies",0)->innertext;
	$anhdaidien=$html->find("#mda-overview",0)->find("img",0)->src;
	$file=file_get_contents($anhdaidien);// Chú ý host và https:// 
	$destination=str_replace(substr($anhdaidien,0,102),"img/tourimg/",$anhdaidien);
	file_put_contents($destination, $file);
	$sql="insert into tour(TenTour,TongQuan,IDKhuVuc,NgayKhoiHanh,SoNgay,SoDem,Gia,GhiChu,AnhDaiDien) values('".$tentour."','".$tongquan."','".$idkhuvuc."','".$ngaykhoihanh."','".$songay."','".$sodem."','".$gia."','".$ghichu."','".$destination."')";
	$result=mysql_query($sql,$link);
	$a=mysql_affected_rows();
	echo $a;
	$tour=Tour::where("TenTour",$tentour)->first();
	//var_dump($tour->ID);
	return $tour->ID;
}

function getlichtrinh($songay,$idtour,$html,$link){
	for($i=0;$i<$songay;$i++){
		$ngaythu=$i+1;
		$noidung=$html->find(".mda-rr",$i)->innertext;
		$sql="insert into lichtrinh(IDTour,NgayThu,NoiDung) values('".$idtour."','".$ngaythu."','".$noidung."')";
		$result=mysql_query($sql,$link);
		$a=mysql_affected_rows();
		echo $a;
	}
}

function getlichkhoihanh($idtour,$col,$row,$step,$html,$link){
	$table=$html->find(".table",0);
	for($i=1;$i<$row*$step;$i+=$step){
		$lichkhoihanh=$table->find("tr",$i);
		for($j=0;$j<$col;$j++){
			if($j==1){
				$ngaykhoihanh=$lichkhoihanh->find("td",$j)->innertext;
			}else if($j==2){
				$dacdiem=$lichkhoihanh->find("td",$j)->innertext;
			}else if($j==3){
				$gia=$lichkhoihanh->find("td",$j)->innertext;
				$finalgia=substr($gia,0,9);
			}
		}
		$sql="insert into lichkhoihanh(IDTour,NgayKhoiHanh,DacDiem,DiaDiem,SoCho,Gia) values('".$idtour."','".$ngaykhoihanh."','".$dacdiem."','Hà Nội','45','".$gia."')";
		echo $sql;
		$result=mysql_query($sql,$link);
		$a=mysql_affected_rows();
		echo $a;	
	}
	//$lichkhoihanh=$html->find(".table",0)->find("tr",1)->innertext;
	//echo $lichkhoihanh;
}

function getanhtour($number,$idtour,$html,$link,$context){
	for($i=0;$i<$number;$i++){
		$anh=$html->find(".slides",0)->find("img",$i)->src;
		$fixed=escapefile_url($anh);
		$firsturl=str_replace('_','%90',substr($fixed,0,88));
		$finalurl=$firsturl.substr($fixed,88,strlen($fixed)-1);
		$file=file_get_contents($finalurl,false,$context);
		$destination=str_replace(substr($anh,0,102),"img/tourimg/",$anh);
		file_put_contents($destination,$file);
		$sql="insert into anhtour(IDTour,URL) values('".$idtour."','".$destination."')";
		$result=mysql_query($sql,$link);
		$a=mysql_affected_rows();
		echo $a;
	}
}

$url = array(
	"https://dulichviet.com.vn//images/bandidau/images/CH%C3%82U%20%C3%81/Free%20And%20Easy/Cocobay%20DN/cocobay-city-tour-free-easy-da-nang-2018_du-lich-viet.jpg" ,
	"https://dulichviet.com.vn//images/bandidau/images/CH%C3%82U%20%C3%81/Free%20And%20Easy/Cocobay%20DN/tour-cocobay-da-nang-gia-tot-2018-coco-champion_du-lich-viet.jpg",
	"https://dulichviet.com.vn//images/bandidau/images/CH%C3%82U%20%C3%81/Free%20And%20Easy/Cocobay%20DN/nha-hang-Bisou-Hotel-tour-cocobay-da-nang-gia-tot_du-lich-viet.jpg",
	"https://dulichviet.com.vn//images/bandidau/images/CH%C3%82U%20%C3%81/Free%20And%20Easy/Cocobay%20DN/du-lich-da-nang-tu-tuc-gia-re-2018-cocobay_du-lich-viet.jpg",
	"https://dulichviet.com.vn//images/bandidau/images/CH%C3%82U%20%C3%81/Free%20And%20Easy/Cocobay%20DN/song-han-da-nang-tour-free-easy-da-nang-2018_du-lich-viet.jpg", 
	);



function geterrorimage($urls,$context){
	foreach($urls as $url){
		$file=file_get_contents($url,false,$context);
		$destination=str_replace(substr($url,0,100),"img/tourimg/",$url);
		file_put_contents($destination,$file);
		echo $destination."\n";
	}
}

function escapefile_url($url){
  $parts = parse_url($url);
  $path_parts = array_map('rawurldecode', explode('/', $parts['path']));
  return
    $parts['scheme'] . '://' .
    $parts['host'] .
    implode('/', array_map('rawurlencode', $path_parts))
  ;
}

//https://dulichviet.com.vn//images/bandidau/images/CH%C3%82U%20%C3%81/Free%20And%20Easy/Cocobay%20DN/cocobay-city-tour-free-easy-da-nang-2018_du-lich-viet.jpg

//https://dulichviet.com.vn//images/bandidau/images/01-N%E1%BB%98I%20%C4%90%E1%BB%8AA%202018/CHAU-DOC/nui-cam-chau-doc-du-lich-an-giang-gia-tiet-kiem_du-lich-viet.jpg

//https://dulichviet.com.vn//images/bandidau/images/01-N%E1%BB%98I%20%C4%90%E1%BB%8AA%202018/CHAU-DOC/nui-cam-chau-doc-du-lich-an-giang-gia-tiet-kiem%90du-lich-viet.jpg

//https://dulichviet.com.vn//images/bandidau/images/01-N%E1%BB%98I%20%C4_%E1%BB%8AA%202018/CHAU-DOC/nui-cam-chau-doc-du-lich-an-giang-gia-tiet-kiem_du-lich-viet.jpg


//getinfo($html,$link);
//getlichtrinh(3,23,$html,$link);
//getlichkhoihanh(23,4,4,8,$html,$link);
//getanhtour(10,23,$html,$link,$context);
//geterrorimage($url,$context);
