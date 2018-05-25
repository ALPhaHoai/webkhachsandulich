<?php

namespace App\Http\Controllers;
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
use Illuminate\Http\Request;
use App\Http\Requests\TourRequest;
use Illuminate\Support\Facades\Input;
use File;
use Illuminate\Support\Facades\Validator;
define("TourimagePath","img/tourimg/");
define("ACTIVE",1);
define("GIOCHOT",1);

class TourController extends Controller
{
    //
	public function getList(){
		$tour=Tour::all();
		return view('touradmin/tour/list',['danhsach'=>$tour]);
	}

    public function getAdd(){
        $listloaitour=LoaiTour::all();
        $listthanhpho=ThanhPho::all();
        $listkhuvuc=KhuVuc::all();
    	return view('touradmin/tour/add',['listthanhpho'=>$listthanhpho,'listkhuvuc'=>$listkhuvuc,'listloaitour'=>$listloaitour]);
    }

    public function add(TourRequest $request){

    	$tour = new Tour;
        if($request->khuvuc==0){
            return redirect()->route("admin.tour.getadd")->with("error","Vui lòng chọn khu vực ");
        }
        if($request->giakhuyenmai>=$request->gia){
            return redirect()->route("admin.tour.getadd")->with("error","Giá khuyến mãi phải nhỏ hơn giá ");
        }
        $day=strtotime($request->ngaykhoihanh) - time();
        $daydiff=round($day/(60*60*24));
        if($daydiff<0){
            return redirect()->route("admin.tour.getadd")->with("error","Ngày khởi hành phải lớn hơn ngày tạo tour ");
        }else if($daydiff<=7){
            $tour->Status=ACTIVE;
            $tour->GioChot=GIOCHOT;
        }else {
            $tour->Status=ACTIVE;
            $tour->GioChot=0;
        }
        $tour->IDKhuVucKhoiHanh=$request->khoihanh;
        $tour->NgayHieuLuc=$daydiff;
        $tour->LuotBook=0;
    	$tour->TenTour=$request->ten;
    	$tour->TongQuan=$request->tongquan;
    	$tour->IDKhuVuc=$request->khuvuc;
        $tour->IDLoaiTour=$request->idloaitour;
    	$tour->NgayKhoiHanh=$request->ngaykhoihanh;
        $tour->SoNgay=$request->songay;
        $tour->SoDem=$request->sodem;
    	$tour->Gia=$request->gia;
        $tour->GiaKhuyenMai=$request->giakhuyenmai;
    	$tour->GhiChu=$request->ghichu;
        if(Input::hasFile('anhdaidien')){
            $pic=Input::file('anhdaidien');
            $picname=$pic->getClientOriginalName();
            $location=TourimagePath.$picname;
             while ( File::exists($location)) {
                $picname=str_random(4).$picname;
                $location=TourimagePath.$picname;
            } 
            $pic->move(TourimagePath,$picname);
            $tour->AnhDaiDien=$location;
        }
        $tour->save();

        $newtour=DB::table("tour")->where("TenTour",$request->ten)->where("TongQuan",$request->tongquan)->where("IDKhuVuc",$request->khuvuc)->where("NgayKhoiHanh",$request->ngaykhoihanh)->where("Gia",$request->gia)->first();
        if(Input::hasFile('anhtour')){
            foreach(Input::file('anhtour') as $anh){
                $anhtour=new AnhTour;
                if(isset($anh)){
                    $picname=$anh->getClientOriginalName();
                    $location=TourimagePath.$picname;
                    while ( File::exists($location)) {
                        $picname=str_random(4).$picname;
                        $location=TourimagePath.$picname;
                    } 
                    $anh->move(TourimagePath,$picname);
                    $anhtour->IDTour=$newtour->ID;
                    $anhtour->URL=$location;
                    $anhtour->save();
                }
            }
        }
        $newtour=Tour::where("TenTour",$request->ten)->where("TongQuan",$request->tongquan)->first();
        return redirect()->route("admin.list.lichtrinh",['id'=>$newtour->ID])->with("status","Success");
    } 

    public function getDetail($id){
        $listanhtour=AnhTour::where('IDTour',$id)->get();
        $listlichkhoihanh=LichKhoiHanh::where("IDTour",$id)->get();
        $listlichtrinh=lichTrinh::where("IDTour",$id)->get();
        $listdichvu=DichVu::whereIn("ID",DichVuDiKem::select("IDDichVu")->where("IDTour",$id)->get()->toArray())->get();
        $listphuongtien=PhuongTien::whereIn("ID",PhuongTienDiKem::select("IDPhuongTien")->where("IDTour",$id)->get()->toArray())->get();
        $tour=Tour::where("ID",$id)->first();
        $curkhuvuc=KhuVuc::where("IDKhuVuc",$tour->IDKhuVuc)->first();
        $listkhuvuc=KhuVuc::whereNotIn("IDKhuVuc",[$curkhuvuc->IDKhuVuc])->get();
        $curloaitour=LoaiTour::where("ID",$tour->IDLoaiTour)->first();
        $listloaitour=LoaiTour::whereNotIn("ID",[$curloaitour->ID])->get();
        $curkhuvuckhoihanh=KhuVuc::where("IDKhuVuc",$tour->IDKhuVucKhoiHanh)->first();
        $listkhuvuckhoihanh=KhuVuc::whereNotIn("IDKhuVuc",[$curkhuvuckhoihanh->IDKhuVuc])->get();
        return view("touradmin/tour/detail",['tour'=>$tour,'listlichtrinh'=>$listlichtrinh,'listlichkhoihanh'=>$listlichkhoihanh,'listanhtour'=>$listanhtour,'listdichvu'=>$listdichvu,'listphuongtien'=>$listphuongtien,'curloaitour'=>$curloaitour,'listloaitour'=>$listloaitour,'listkhuvuc'=>$listkhuvuc,'curkhuvuc'=>$curkhuvuc,'curkhuvuckhoihanh'=>$curkhuvuckhoihanh,'listkhuvuckhoihanh'=>$listkhuvuckhoihanh]);
    }
    public function updateInfo($idtour,Request $request){
        $Status=0;
        $GioChot=0;
        $tour=Tour::where("ID",$idtour)->first();
        $day=strtotime($request->ngaykhoihanh) - time();
        $daydiff=round($day/(60*60*24));
        if($daydiff<0){
            return redirect()->route("admin.tour.getdetail",['idtour'=>$idtour])->with("error","Ngày khởi hành phải lớn hơn ngày update ");
        }else if($daydiff<=7){
            $Status=ACTIVE;
            $GioChot=GIOCHOT;
        }else {
            $Status=ACTIVE;
            $GioChot=0;
        }
        if(Input::hasFile("anhdaidien")){
            $pic=Input::file('anhdaidien');
            $picname=$pic->getClientOriginalName();
            $location=TourimagePath.$picname;
            $pic->move(TourimagePath,$picname);
            $tour->AnhDaiDien=$location;
            if(File::exists($tour->AnhDaiDien)){
                File::delete($tour->AnhDaiDien);
            }
            DB::table("tour")->where("ID",$idtour)->update(["TenTour"=>$request->tentour,"TongQuan"=>$request->tongquan,"IDKhuVuc"=>$request->khuvuc,"NgayKhoiHanh"=>$request->ngaykhoihanh,'Gia'=>$request->gia,'GhiChu'=>$request->ghichu,'AnhDaiDien'=>$location,'IDLoaiTour'=>$request->idloaitour,'GiaKhuyenMai'=>$request->giakhuyenmai,'Status'=>$Status,'GioChot'=>$GioChot,'NgayHieuLuc'=>$daydiff,'IDKhuVucKhoiHanh'=>$request->khoihanh]);
        }
         DB::table("tour")->where("ID",$idtour)->update(["TenTour"=>$request->tentour,"TongQuan"=>$request->tongquan,"IDKhuVuc"=>$request->khuvuc,"NgayKhoiHanh"=>$request->ngaykhoihanh,'Gia'=>$request->gia,'GhiChu'=>$request->ghichu,'IDLoaiTour'=>$request->idloaitour,'GiaKhuyenMai'=>$request->giakhuyenmai,'Status'=>$Status,'GioChot'=>$GioChot,'NgayHieuLuc'=>$daydiff,'IDKhuVucKhoiHanh'=>$request->khoihanh]);

        return redirect()->route("admin.tour.getdetail",['idtour'=>$idtour])->with("status","Success");

    }


    public function delImg($idanh){
        $anhtour=DB::table("anhtour")->where("ID",$idanh)->first();
         if(File::exists($anhtour->URL)){
            File::delete($anhtour->URL);
        }
        DB::table("anhtour")->where("ID",$idanh)->delete();
        $return['error']=false;
        return json_encode($return);
    }

    public function updateImg($idtour){
        if(Input::hasFile("anhtour")){
            foreach(Input::file('anhtour') as $pic){
                $anhtour=new AnhTour();
                $picname=$pic->getClientOriginalName();
                $location=TourimagePath.$picname;
                while ( File::exists($location)) {
                    $picname=str_random(4).$picname;
                    $location=TourimagePath.$picname;
                } 
                $pic->move(TourimagePath,$picname);
                $anhtour->IDTour=$idtour;
                $anhtour->URL=$location;
                $anhtour->save();
            }    
        }
        return redirect()->route("admin.tour.getdetail",['idtour'=>$idtour])->with("status","Update tour image success");
    }

    public function delete($idtour){
        $tour=Tour::where("ID",$idtour)->first();
         if(File::exists($tour->AnhDaiDien)){
                File::delete($tour->AnhDaiDien);
            }
        $listanhtour=AnhTour::where('IDTour',$idtour)->get();
        foreach($listanhtour as $anhtour){
            if(File::exists($anhtour->URL)){
                File::delete($anhtour->URL);
            }
        }
        AnhTour::where('IDTour',$idtour)->delete();

        LichKhoiHanh::where("IDTour",$idtour)->delete();
        lichTrinh::where("IDTour",$idtour)->delete();
        DichVuDiKem::where("IDTour",$idtour)->delete();
        PhuongTienDiKem::where("IDTour",$idtour)->delete();
        Tour::where("ID",$idtour)->delete();
        return redirect()->route("admin.list.tour");
    }


}
