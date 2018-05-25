<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\ChiTietTienIch;

class tienichcontroller extends Controller
{
    public function getdanhsach(){
    	$danhsach=DB::table('chitiettienich')->get();
    	return view('touradmin.chitiettienich.danhsach',compact('danhsach'));
    }
    public function getthem(){
    	return view('touradmin/chitiettienich/them');
    }
    public function them(Request $request){
    	$tienich= new ChiTietTienIch;
    	$tienich->NoiDung=$request->noidung;
    	$tienich->save();
    	return redirect()->route('admin.tienich.danhsach');
    }
    public function getsua($idtienich){
    	$tienich=DB::table('chitiettienich')->where('id',$idtienich)->get()->first();
    	return view('touradmin/chitiettienich/sua',compact('tienich'));
    }
    public function sua(Request $request){
    	DB::table('chitiettienich')->where('id',$request->id)->update(['NoiDung'=>$request->noidung]);
    	return redirect()->route('admin.tienich.danhsach');
    }
    public function xoa($idtienich){
        DB::table('tienich')->where('id',$idtienich)->delete();
    	DB::table('chitiettienich')->where('id',$idtienich)->delete();
    	return redirect()->route('admin.tienich.danhsach');
    }
}
