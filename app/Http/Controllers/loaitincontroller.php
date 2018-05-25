<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\LoaiTin;
use App\BaiViet;

class loaitincontroller extends Controller
{
    public static function getdanhsach(){
    	$danhsach=LoaiTin::all();
    	return view('touradmin.loaitin.danhsach',['danhsach'=>$danhsach]);
    }
    public function getthem(){
        return view('touradmin.loaitin.them');
    }
    public function them(Request $request){
    	$loaitin= new LoaiTin;
    	$loaitin->IDLoaiTin=$request->maloaitin;
    	$loaitin->TenLoaiTin=$request->ten;
    	$loaitin->save();
    	return redirect()->route('touradmin.loaitin.danhsach');
    }

    public function getsua($ma){
        $loaitin=LoaiTin::where('IDLoaiTin',$ma)->get()->toArray();
        return view('touradmin.loaitin.sua',['ma'=>$ma,'ten'=>$loaitin['0']['TenLoaiTin']]);
    }
    public function sua(Request $request){
        DB::table('loaitin')->where('IDLoaiTin',$request->ma)->update(['TenLoaiTin'=>$request->ten]);
        return redirect()->route('admin.loaitin.danhsach');
    }
    
    public function xoa($ma){
        BaiViet::where('IDLoaiTin',$ma)->delete();
        DB::table('loaitin')->where('IDLoaiTin',$ma)->delete();
        return redirect()->route('admin.loaitin.danhsach');
    
    }
}
