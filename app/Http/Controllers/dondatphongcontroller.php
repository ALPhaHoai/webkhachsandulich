<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Don;
use App\DonDatphong;
use App\Khachhang;
use DB;
define("ACTIVE",1);
define("CANCEL",0);

class dondatphongcontroller extends Controller
{
    function getdanhsach(){
        $dondatphong=DB::table('dondatphong')->get();
        $tmparr[]=0;
        foreach ($dondatphong as $value) {
            $tmparr[]=$value->IDDon;
        }
        $danhsach=DB::table('don')->whereIn('IDDon',$tmparr)->get();
        return view('touradmin.dondatphong.danhsach',compact('danhsach'));
    }
    function getdanhsachtheoks($idks){
        $khachsan=DB::table('khachsan')->where('IDKhachSan',$idks)->get()->first();
        $dondatphong=DB::table('dondatphong')->where('IDKhachSan',$idks)->get();
        $tmparr[]=0;
        foreach ($dondatphong as $value) {
            $tmparr[]=$value->IDDon;
        }
        $danhsach=DB::table('don')->whereIn('IDDon',$tmparr)->get();
        return view('touradmin.dondatphong.danhsachtheoks',compact('danhsach','khachsan'));
    }

    function them(Request $request){
    	$don= new Don;
    	$dondatphong=new DonDatphong;
    	$loaiphong=DB::table('loaiphong')->where('IDLoaiPhong',$request->idlp)->get()->first();
    	$price=$loaiphong->Gia;
    	$don->LoaiThanhToan=$request->thanhtoan;
    	$don->ThanhTien=$price;
        $don->TrangThai=ACTIVE;
    	$don->IDKH=Auth::user()->id;
    	$don->save();

    	$dondatphong->IDDon=$don->id;
    	$dondatphong->IDKhachSan=$request->idks;
    	$dondatphong->IDLoaiPhong=$request->idlp;
    	$dondatphong->NgayDi=$request->ngaydi;
        $day=strtotime($request->ngaydi) - time();
        $daydiff=round($day/(60*60*24));
        if($daydiff<3){
            $dondatphong->GioChot=1;
        }else {
            $dondatphong->GioChot=0;
        }
        $dondatphong->TrangThai=ACTIVE;
    	$dondatphong->NgayVe=$request->ngayve;
    	$firstdate=strtotime($request->ngaydi);
    	$seconddate=strtotime($request->ngayve);
    	$secnum=abs($firstdate-$seconddate);
    	$daynum=floor($secnum/(60*60*24));
    	$dondatphong->SoNgay=$daynum;
    	$dondatphong->save();

    	Khachhang::where('IDTaiKhoan',Auth::user()->id)->update(['SDT'=>$request->sdt,'GioiTinh'=>$request->gioitinh,'DiaChi'=>$request->diachi,'CMT'=>$request->cmt]);
    	return redirect()->back();

    }
    public function xoa($id) {
        DB::table('dondatphong')->where('IDDon',$id)->update(["TrangThai"=>CANCEL]);
        DB::table('don')->where('IDDon',$id)->update(["TrangThai"=>CANCEL]);
        return redirect()->route('admin.don.dondatphong');
    }
    public function duyet(Request $request){
        foreach ($request->duyet as $value) {
            DB::table('don')->where('IDDon',$value)->update(['Duyet'=>1]);
        }
        return redirect()->back();
    }
}
