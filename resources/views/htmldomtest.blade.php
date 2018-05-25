<!DOCTYPE html>
<html>
<head>
	<title>Domhtml test</title>
	<script type="text/javascript">
	function getdata(){
		document.getElementsByClassName("ltt-contentbox white")[0].innerHTML="";
		document.getElementsByClassName("ltt-contentbox white")[1].innerHTML="";
		document.getElementsByClassName("ltt-contentbox white")[2].innerHTML="";
	}
	</script>
</head>
<body>
<?php

include 'simple\simple_html_dom.php'; 
$link=@mysql_connect("localhost","root","vertrigo");
mysql_select_db("webdulich1",$link);
mysql_set_charset('UTF8',$link);
$a=0;
$count=18;
$sql="";
$place="";
$countlt=0;
$title="";
$sort="";
$img="";


/*$html=file_get_html('https://www.ivivu.com/blog/');
$container=$html->find('#sidebar',0)->find('#text-2',0)->find('li');
foreach ($container as $key => $lv1) {
	$lv2=$lv1->find('a');
	foreach ($lv2 as $key => $value) {
		$count=$count+1;
		$place=substr($value->title, 10);
		echo $place."<br>";
		$sql= "insert into khuvuc values('KV".$count."','".$place."');";
		$result=mysql_query($sql,$link);
	}
}
if($result){
	$a=mysql_affected_rows();
	echo "succes";
}
mysql_close($link);*/


/*$html=file_get_html('https://www.ivivu.com/blog/');
for($i=3;$i>=1;$i--){
	$index=$i+1;
$container=$html->find('.content-wrap',0)->find('#content',0)->find('#ivivu_cat_widget-'.$index);
foreach ($container as $key => $lv1) {
	$lv2=$lv1->find('h5');
	$fav1=$lv1->find('a',0);
	$htmlfav=file_get_html($fav1->href);
	$contentfav=$htmlfav->find('.entry-content');
	foreach ($contentfav as $key => $value) {
		$countlt=$countlt+1;
		$count=$count+1;
		$title=$value->find('h2',0)->plaintext;
		$sort=$value->find('em',0)->plaintext;
		$img=$value->find('img',0)->src;
		//echo $value->outertext;
		//$sql="insert into baiviet values('BV".$count."','KV0','LT".$countlt."','".$title."','".$value->outertext."','".$sort."','1','2017-04-08','2017-04-08','US1', '2017-04-08', '2017-04-08','".$img."')"; 
		//$result=mysql_query($sql,$link);
		}
	foreach ($lv2 as $key => $lv2) {
		$lv3= $lv2->find('a');
		foreach ($lv3 as $key => $lv3) {
			$html1=file_get_html($lv3->href);
			echo $lv3->href."<br>";
			$content=$html1->find('.entry-content');
			foreach ($content as $key => $value) {
				//echo $value->outertext;
				$count=$count+1;
			$title=$value->find('h2',0)->plaintext;
			$sort=$value->find('em',0)->plaintext;
			$img=$value->find('img',0)->src;
		//$sql="insert into baiviet values('BV".$count."','KV0','LT".$countlt."','".$title."','".$value->outertext."','".$sort."','0','2017-04-08','2017-04-08','US1', '2017-04-08', '2017-04-08','".$img."')"; ;
			//echo $value->outertext;
			//$result1=mysql_query($sql,$link);
			}
		}
	}

}
}*/

/*$htmlouter=file_get_html("https://www.ivivu.com/blog/category/tin-khuyen-mai/");
$containerout =$htmlouter->find('.archive-postlist',0);
$section=$containerout->find('.one-half');
for ( $i=0;$i<=3;$i++) {
	$found=$containerout->find('.one-half',$i)->find('a',0);
	$urltemp=$found->href;
	$html=file_get_html($urltemp);
	$container=$html->find('.entry-content',0);
	$title=$container->find('h2',0)->plaintext;
	$sort=$container->find('em',0)->plaintext;
	$images=$container->find('img');

	foreach ($images as $key => $value) {
		try {
		$destination=str_replace(substr($value->src, 0,31), "img/blogimg/", $value->src);
		$file=file_get_contents($value->src);
		file_put_contents($destination, $file);
		echo "success <br>";
	} catch (Exception $e){
		continue;
	}

	}
	$imgsrc=$container->find("img",0);
	$img=str_replace(substr($imgsrc->src, 0,31), "", $imgsrc->src);
	$count=$count+1;
	$sql="insert into baiviet values('BV".$count."','KV0','LT1','".$title."','".$container->outertext."','".$sort."','0','2017-04-08','2017-04-08','US1', '2017-04-08', '2017-04-08','".$img."','0')";
	$result=mysql_query($sql,$link);
	$a=mysql_affected_rows();

	echo "Đã thêm $a bài viết LT1 <br> ";
}
echo "done get data";
mysql_close($link);*/




$url="https://www.ivivu.com/blog/2017/05/ngoi-nha-co-don-nhat-the-gioi/";
$html=file_get_html($url);
echo "<input type='button' value='loc' onclick='getdata()'></input>";


$container=$html->find('.entry-content',0);
//echo $container->innertext;
$title=$container->find('h2',0)->plaintext;
$sort=$container->find('em',0)->plaintext;
$images=$container->find('img');
foreach ($images as $key => $value) {
	$destination=str_replace(substr($value->src, 0,31), "img/blogimg/", $value->src);
	$file=file_get_contents($value->src);
	$filename=substr($value->src,31);
	try{
	file_put_contents($destination, $file);
    } catch (Exception $e){
           continue;
    }
	echo "success <br>";


}
$imgsrc=$container->find("img",0);
$img=str_replace(substr($imgsrc->src, 0,31), "", $imgsrc->src);
$count=26;
$sql="insert into baiviet values('BV".$count."','KV0','LT2','".$title."','".$container->plaintext."','".$sort."','0','2017-04-08','2017-04-08','US1', '2017-04-08', '2017-04-08','".$img."','0')";
$result=mysql_query($sql,$link);
$a=mysql_affected_rows();

	echo "Đã thêm $a bài viết LT2 ";







/*foreach ($images as $key => $value) {
	try {
	$file=file_get_contents($value->src);
	$filename=substr($value->src,31);
	file_put_contents("testimage/".$filename, $file);
	}
	catch{
		continue;
	}
}*/
/*echo $images;
$file=file_get_contents($images);
$filename=substr($images,31);
echo "<br>".$filename;
$save=file_put_contents("testimage/".$filename, $file);
if($save){

}*/


?>


</body>
</html>