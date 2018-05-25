<?php

namespace App\Http\Controllers;

use App\Http\Requests\khachsanrequest;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Anh;
use App\AnhKhachSan;
use App\KhachSan;
use App\KhuVuc;
use App\loaiPhong;
use App\ChinhSach;
use App\TienIch;
use App\ChiTietTienIch;
use Illuminate\Support\Facades\Auth;

define("ACTIVE",1);
define("GIOCHOT",1);
define("NORMAL",0);
define("CANCEL",0);

class QuanLyKhachSanController extends Controller
{
    public function getInfoByManager(){

    	$quanlyid=Auth::user()->id;
        $khachsan=KhachSan::where("IDNguoiQuanLy",$quanlyid)->first();
    	if($khachsan==null){
    		return redirect()->route("admin.quanlykhachsan.getthem");
    	}else{
         $khuvuc = KhuVuc::select('IDKhuVuc','TenKV')->whereNotIn('IDKhuVuc',[$khachsan->IDKhuVuc])->get();
        $loaikhachsan=DB::table('loaikhachsan')->whereNotIn('id',[$khachsan->IDLoaiKhachSan])->get();
        $curloaikhachsan=DB::table('loaikhachsan')->where('id',$khachsan->IDLoaiKhachSan)->get()->first();
        $curkhuvuc=DB::table('khuvuc')->where('IDKhuVuc',$khachsan->IDKhuVuc)->get()->first();
        $curloaiphong=DB::table('loaiphong')->where('IDKhachSan',$khachsan->IDKhachSan)->get();
        $curanh=DB::table('anh')->where('ID',$khachsan->IDKhachSan)->get();
        $tienich=DB::table('chitiettienich')->whereNotIn('id',TienIch::where('IDKhachSan',$khachsan->IDKhachSan)->select('IDChiTiet')->get()->toArray())->get();
        $curtienich=DB::table('chitiettienich')->whereIn('id',TienIch::where('IDKhachSan',$khachsan->IDKhachSan)->select('IDChiTiet')->get()->toArray())->get();
        return view('touradmin.quanlykhachsan.info',compact('khachsan','khuvuc','loaikhachsan','curloaikhachsan','curkhuvuc','curloaiphong','curanh','tienich','curtienich'));
    	}

    }

    public function getPolicyByHotel(){

    	$quanlyid=Auth::user()->id;
        $khachsan=KhachSan::where("IDNguoiQuanLy",$quanlyid)->first();;
    	if($khachsan==null){
    		return redirect()->route("admin.quanlykhachsan.getthem");
    	}else{
         	$chinhsach=ChinhSach::where('IDKhachSan',$khachsan->IDKhachSan)->get()->toArray();
        	return view('touradmin.quanlykhachsan.policy',['idCS'=>$chinhsach['0']['IDChinhSach'],'idKS'=>$khachsan->IDKhachSan,'nhanphong'=>$chinhsach['0']['NhanPhong'],'traphong'=>$chinhsach['0']['TraPhong'],'huongdan'=>$chinhsach['0']['HuongDan'],'phuthu'=>$chinhsach['0']['PhuThu'],'dichuyen'=>$chinhsach['0']['DiChuyen'],'hoatdong'=>$chinhsach['0']['HoatDong']]);
    	}

    }

    public function suakhachsaninfo(Request $request){

    	   $sophong=0;
        $min=0;
         if(!empty($request->curtypename['0'])){
            $count=0;
            $min=$request->curtypecost[$count];
                foreach ($request->curtypename as $item) {
                    $sophong+=$request->curtypeamount[$count];
                    DB::table('loaiphong')->where('IDLoaiPhong',$request->curtypeid[$count])->update(['TenLoaiPhong'=>$request->curtypename[$count],'SoPhong'=>$request->curtypeamount[$count],'Gia'=>$request->curtypecost[$count]]);
                    if($request->curtypecost[$count]<$min){
                        $min=$request->curtypecost[$count];
                    }
                    $count+=1;
                }
            }

            if($request->curtienich!=null){

                $count2=0;
                foreach ($request->curtienich as $value) {
                    $tmp[]=$request->curtienich[$count2];
                    $count2+=1;
                }
                DB::table('tienich')->whereNotIn('IDChiTiet',$tmp)->delete();
            }else {
                DB::table('tienich')->where('IDKhachSan',$request->idKS)->delete();
            }

            if($request->newtienich!=null){
                $count3=0;
                foreach ($request->newtienich as $value) {
                $tienich= new TienIch;
               $tienich->IDKhachSan=$request->idKS;
               $tienich->IDChiTiet=$request->newtienich[$count3];
               $tienich->save();
               $count3+=1;
                }
            }

            if(!empty($request->typename['0'])){
                $count1=0;
                $min=$request->typecost[$count1];
            foreach ($request->typename as $value) {
                $sophong+=$request->typeamount[$count1];
                $loaiphong= new LoaiPhong;
                $loaiphong->IDKhachSan=$request->idKS;
                $loaiphong->TenLoaiPhong=$value;
                $loaiphong->SoPhong=$request->typeamount[$count1];
                $loaiphong->PhongTrong=$loaiphong->SoPhong;
                $loaiphong->Gia=$request->typecost[$count1];
                $loaiphong->save();
                if($request->typecost[$count1]<$min){
                    $min=$request->typecost[$count1];
                }
                $count1+=1;
            }
        }



            if($request->hotelpic!=null){
                $count=0;
                foreach($request->hotelpic as $item){
                    if(isset($item)){
                    $img=$item->getClientOriginalName();
                    $location="img/hotelimg/".$img;
                    DB::table('anh')->where('IDAnh',$request->idanh[$count])->update(['URL'=>$location]);
                    $count+=1;
                }
                }
            }

            if(Input::hasFile('hotelpicmore')){
            foreach (Input::file('hotelpicmore') as $file) {
                $anh= new Anh;
                if(isset($file)){
                    $picname=$file->getClientOriginalName();
                    $location="img/hotelimg/".$picname;
                    $file->move("img/hotelimg/",$picname);
                    $anh->URL=$location;
                    $anh->LoaiAnh='anhkhachsan';
                    $anh->ID=$request->idKS;
                    $anh->save();
                }
            }
        }
        DB::table('khachsan')->where('IDKhachSan',$request->idKS)->update(['TenKhachSan'=>$request->tenKS,'IDLoaiKhachSan'=>$request->idLKS,'DiaChi'=>$request->diachi,'IDKhuVuc'=>$request->idKV,'ThongTin'=>$request->thongtin,'LienHe'=>$request->LienHe,'SoPhong'=>$sophong,'minprice'=>$min]);
        return redirect()->route('admin.khachsaninfo')->with("Status","success");
    }



    public function suapolicy(Request $request){
        DB::table('chinhsach')->where('IDChinhSach',$request->idCS)->update(['IDKhachSan'=>$request->idKS,'NhanPhong'=>$request->nhanphong,'TraPhong'=>$request->traphong,'HuongDan'=>$request->huongdan,'PhuThu'=>$request->phuthu]);
        return redirect()->route('admin.khachsanpolicy')->with("Status","Change Success");
    }


    public function getDonByHotel(){
    	$quanlyid=Auth::user()->id;
        $khachsan=KhachSan::where("IDNguoiQuanLy",$quanlyid)->first();
    	if($khachsan==null){
    		return redirect()->route('admin.quanlykhachsan.getthem');
    	}else {

    	$dondatphongthuong=DB::table('dondatphong')->where('IDKhachSan',$khachsan->IDKhachSan)->where("TrangThai",ACTIVE)->where("GioChot",NORMAL)->get();
        $datphongthuongid=self::getArray($dondatphongthuong,"IDDon");
        $dondatphongduyetngay=DB::table('dondatphong')->where('IDKhachSan',$khachsan->IDKhachSan)->where("TrangThai",ACTIVE)->where("GioChot",GIOCHOT)->get();
        $datphongduyetngay=self::getArray($dondatphongduyetngay,"IDDon");
        $dondatphonghuy=DB::table('dondatphong')->where('IDKhachSan',$khachsan->IDKhachSan)->where("TrangThai",CANCEL)->get();
        $datphonghuy=self::getArray($dondatphonghuy,"IDDon");
        
        $danhsachthuong=DB::table('don')->where("TrangThai",ACTIVE)->whereIn('IDDon',$datphongthuongid)->get();
        $danhsachduyetngay=DB::table('don')->whereIn('IDDon',$datphongduyetngay)->where("TrangThai",ACTIVE)->where('Duyet',0)->get();
        $danhsachhuy=DB::table('don')->where("TrangThai",CANCEL)->whereIn('IDDon',$datphonghuy)->orderBy('updated_at','desc')->take(10)->get();

       
        return view('touradmin.dondatphong.danhsachtheoks',compact('danhsachthuong','khachsan','danhsachduyetngay','danhsachhuy'));
    	}
    }


    public function getArray($array,$field){
        $tmparr= array();
        foreach ($array as $value) {
            $tmparr[]=$value->$field;
        }
        return $tmparr;
    }

     public function huyDon(Request $request) {
        $iddon=$request->iddon;
        $lydohuy=$request->lydohuy;
        DB::table('dondatphong')->where('IDDon',$iddon)->update(["TrangThai"=>CANCEL,'LyDoHuy'=>$lydohuy]);
        DB::table('don')->where('IDDon',$iddon)->update(["TrangThai"=>CANCEL,'LyDoHuy'=>$lydohuy]);
        return redirect()->route('admin.dondatphong');
    }


    public function duyet(Request $request){
        foreach ($request->duyet as $value) {
            DB::table('don')->where('IDDon',$value)->update(['Duyet'=>1]);
        }
        return redirect()->back();
    }
}
