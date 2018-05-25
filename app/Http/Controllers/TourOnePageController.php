<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Tour;
use App\lichTrinh;
use App\LichKhoiHanh;
use App\ThanhPho;
use App\KhuVuc;
use App\AnhTour;
use App\DichVuDiKem;
use App\DichVu;
use App\PhuongTienDiKem;
use App\PhuongTien;
use App\LoaiTour;
define("ACTIVE",1);
define("LOCAL",1);
define("ABOARD",2);
class TourOnePageController extends Controller
{	

    function getByDiaDiem($iddiadiem){
    	$diadiem=ThanhPho::where("ID",$iddiadiem)->first();
    	$listkhuvucdiadiem=KhuVuc::where("IDDiaDiem",$iddiadiem)->get();
    	$count=0;
    	foreach($listkhuvucdiadiem as $khuvuc){
    		$listidkhuvuc[$count]=$khuvuc->IDKhuVuc;
    		$count++;
    	}
    	$listtour=Tour::where('Status',1)->whereIn("IDKhuVuc",$listidkhuvuc)->take(4)->get();
    	$listkhuvuc=KhuVuc::where("loai",LOCAL)->get();
		$listloaitour=LoaiTour::all();
		$listphuongtien=PhuongTien::all();
		$listdichvu=DichVu::all();
    	return view("tour/pages/OnepageSearch",['listkhuvuc'=>$listkhuvuc,'listloaitour'=>$listloaitour,'listtour'=>$listtour,'locationname'=>$diadiem->TenThanhPho,'listkhuvucdiadiem'=>$listkhuvucdiadiem,'diadiem'=>true,'listphuongtien'=>$listphuongtien,'listdichvu'=>$listdichvu,'locationid'=>$diadiem->ID,'placeid'=>0]);
    }

    function getByKhuVuc($idkhuvuc){
    	$khuvuc=KhuVuc::where("IDKhuVuc",$idkhuvuc)->first();
    	$diadiem=ThanhPho::where("ID",$khuvuc->IDDiaDiem)->first();
    	$listtour=Tour::where("Status",ACTIVE)->where("IDKhuVuc",$idkhuvuc)->take(6)->get();
    	$listkhuvuc=KhuVuc::where("loai",LOCAL)->get();
		$listloaitour=LoaiTour::all();
		$listphuongtien=PhuongTien::all();
		$listdichvu=DichVu::all();
    	return view("tour/pages/OnepageSearch",['listkhuvuc'=>$listkhuvuc,'listloaitour'=>$listloaitour,'listtour'=>$listtour,'locationname'=>$diadiem->TenThanhPho,'listkhuvucdiadiem'=>$listkhuvuc,'diadiem'=>false,'locationid'=>$diadiem->ID,'khuvucname'=>$khuvuc->TenKV,'listphuongtien'=>$listphuongtien,'listdichvu'=>$listdichvu,'placeid'=>$khuvuc->IDKhuVuc]);
    }

    function getList(Request $request){
    	if(request()->ajax()){
    		$listid=explode(',',$request->displaylist);
    		$return['displayed']=$request->displaylist;
    		$listtour=Tour::where('Status',1)->whereNotIn("ID",$listid)->take(4)->get();
    		$count=0;
    		foreach ($listtour as $tour) {
    			$return[$count]['anhdaidien']=$tour->AnhDaiDien;
    			$return[$count]['tentour']=$tour->TenTour;
    			$return[$count]['songay']=$tour->SoNgay;
    			$return[$count]['sodem']=$tour->SoDem;
    			$noikhoihanh=KhuVuc::where('IDKhuVuc',$tour->IDKhuVucKhoiHanh)->first();
    			$return[$count]['noikhoihanh']=$noikhoihanh->TenKV;
    			$return[$count]['ngaykhoihanh']=$tour->NgayKhoiHanh;
    			$return[$count]['Gia']=$tour->Gia;
    			$return['displayed'].=$tour->ID.",";
    			$count++;
    		}
    	}
    	$return["success"]=true;
    	echo json_encode($return);
    }

    function ajaxSearch(Request $request){
    	$return['success']=false;
    	if(request()->ajax()){
    		$islocation=$request->islocation;
    		$idlocation=$request->idlocation;
    		$idstartlocation=$request->idstartlocation;
    		$strloaitour=$request->strloaitour;
    		$strphuongtien=$request->strphuongtien;
    		$strdichvu=$request->strdichvu;
    		$tour= DB::table("tour")->where("Status",ACTIVE);
    		if($islocation){
    			$listkhuvucdiadiem=KhuVuc::where("IDDiaDiem",$idlocation)->get();
    			$count=0;
    			foreach($listkhuvucdiadiem as $khuvuc){
    				$listidkhuvuc[$count]=$khuvuc->IDKhuVuc;
    				$count++;
    			}
    			$tour=$tour->whereIn('IDKhuVuc',$listidkhuvuc);
    		}else{
    			$tour=$tour->where('IDKhuVuc',$idlocation);
    		}

    		if($idstartlocation!=""){
    			$tour=$tour->where("IDKhuVucKhoiHanh",$idstartlocation);
    		}

    		if($strloaitour!=""){
    			$listloaitourid=explode(',',$strloaitour);
    			$return['loaitourid']=self::takeOutSpace($listloaitourid);
    			$tour=$tour->WhereIn("IDLoaiTour",$listloaitourid);
    		}

    		if($strphuongtien!=""){
    			$listphuongtienid=explode(',',$strphuongtien);
    			$listtourid=PhuongTienDiKem::select("IDTour")->whereIn("IDPhuongTien",$listphuongtienid)->distinct()->get();
    			$tour=$tour->WhereIn("ID",$listtourid);
    		}

    		if($strdichvu!=""){
    			$listdichvuid=explode(',',$strdichvu);
    			$listtourid=DichVuDiKem::select("IDTour")->whereIn("IDDichVu",$listdichvuid)->distinct()->get();
    			$tour=$tour->WhereIn("ID",$listtourid);
    		}

    		if($request->more==1){
    			$displayed=explode(",", $request->displaylist);
    			$tour=$tour->whereNotIn("ID",$displayed);
    			$return['displayed']=$request->displaylist;
    		}else {
    			$return['displayed']="";
    		}
    		$listtour=$tour->take(4)->get();
    		$count=0;
    		foreach ($listtour as $tour) {
    			$return[$count]['anhdaidien']=$tour->AnhDaiDien;
    			$return[$count]['tentour']=$tour->TenTour;
    			$return[$count]['songay']=$tour->SoNgay;
    			$return[$count]['sodem']=$tour->SoDem;
    			$noikhoihanh=KhuVuc::where('IDKhuVuc',$tour->IDKhuVucKhoiHanh)->first();
    			$return[$count]['noikhoihanh']=$noikhoihanh->TenKV;
    			$return[$count]['ngaykhoihanh']=$tour->NgayKhoiHanh;
    			$return[$count]['Gia']=$tour->Gia;
    			$return['displayed'].=$tour->ID.",";
    			$count++;
    		}

    		$return['success']=true;
    	}
    	return json_encode($return);
    }

    function takeOutSpace($array){
    	$newarray;
    	$count=0;
    	foreach ($array as $value) {
    		if($value!=""){
    			$newarray[$count]=$value;
    			$count++;
    		}
    	}
    	return $newarray;
    }
}
