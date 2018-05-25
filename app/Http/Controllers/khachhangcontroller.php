<?php

namespace App\Http\Controllers;
use App\Khachhang;
use DB;
use Illuminate\Http\Request;

class khachhangcontroller extends Controller
{
    public function getdanhsach(){
    	$danhsach=DB::table('khachhang')->get();
    	return view('touradmin.khachhang.danhsach',compact('danhsach'));
    }
    public function getthem(){
        return view('admin.khachhang.them');
    }
    public function them(KhachHangRequest $request){
        $khachhang= new KhachHang;
        $khachhang->IDKH=$request->idkh;
        $khachhang->IDTaiKhoan=$request->idtk;
        $khachhang->HoTen=$request->ten;
        $khachhang->SDT=$request->sdt;
        $khachhang->GioiTinh=$request->gioitinh;
        $khachhang->DiaChi=$request->diachi;
        $khachhang->CMT=$request->cmt;
        $khachhang->Email=$request->email;
        $khachhang->save();
        return redirect()->route('admin.khachhang.danhsach');
    }

    public function getsua($idkh){
        $khachhang=KhachHang::where('IDKH',$idkh)->get()->toArray();
        return view('admin.khachhang.sua',['idkh'=>$idkh,'idtk'=>$khachhang['0']['IDTaiKhoan'],'ten'=>$khachhang['0']['HoTen'],'sdt'=>$khachhang['0']['SDT'],'gioitinh'=>$khachhang['0']['GioiTinh'],'diachi'=>$khachhang['0']['DiaChi'],'cmt'=>$khachhang['0']['CMT'],'email'=>$khachhang['0']['Email']]);
    }
    public function sua(Request $request){
        DB::table('khachhang')->where('IDKH',$request->idkh)->update(['IDTaiKhoan'=>$request->idtk,'HoTen'=>$request->ten,'SDT'=>$request->sdt,'GioiTinh'=>$request->gioitinh,'DiaChi'=>$request->diachi,'CMT'=>$request->cmt,'Email'=>$request->email]);
        return redirect()->route('admin.khachhang.danhsach');
    }
    
    public function xoa($idkh){
        DB::table('khachhang')->where('IDKH',$idkh)->delete();
        return redirect()->route('admin.khachhang.danhsach');
    
    }
    

}
