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
define("GIOCHOT",1);
define("ACTIVE",1);
define("HANOI",16);

class TourFrontEndController extends Controller
{
     public function getHomepage(){
    	$khuvuc=KhuVuc::all();
    	$loaitour=LoaiTour::all();
    	$tour=Tour::where("ID",13)->first();
    	$listtourgiochot=Tour::where('GioChot',GIOCHOT)->where('Status',ACTIVE)->get();
    	$listtopbook=Tour::where('Status',ACTIVE)->orderBy('LuotBook','desc')->take(4)->get();
    	$listtopsale=Tour::where('Status',ACTIVE)->orderBy('GiaKhuyenMai','desc')->take(4)->get();
    	$listkhoihanh=Tour::where('Status',ACTIVE)->where('IDKhuVucKhoiHanh',HANOI)->take(4)->get();
        return view("tour/pages/Homepage",['listkhuvuc'=>$khuvuc,'listloaitour'=>$loaitour,'tour'=>$tour,'listtourgiochot'=>$listtourgiochot,'listtopbook'=>$listtopbook,'listtopsale'=>$listtopsale,'listkhoihanh'=>$listkhoihanh]);
    }

}
