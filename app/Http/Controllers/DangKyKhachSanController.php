<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ThongTinDangKyKhachSan;
use App\Http\Requests\DangKyKhachSanRequest;
use Illuminate\Support\Facades\Auth;
define("NOT_READED",1);

class DangKyKhachSanController extends Controller
{
    public function add(DangKyKhachSanRequest $request){
    	$return["success"]=false;
    	if(request()->ajax()){
    		$dangkykhachsan=new ThongTinDangKyKhachSan;
    		$dangkykhachsan->TenKhachSan=$request->tenkhachsan;
    		$dangkykhachsan->EmailKhachSan=$request->emailkhachsan;
    		$dangkykhachsan->SDTKhachSan=$request->sdtkhachsan;
    		$dangkykhachsan->TenDaiDien=$request->tendaidien;
    		$dangkykhachsan->EmailDaiDien=$request->emaildaidien;
    		$dangkykhachsan->SDTDaiDien=$request->sdtdaidien;
    		$dangkykhachsan->DaDoc=NOT_READED;
    		if(Auth::check()){
    			$dangkykhachsan->IDUser=Auth::user()->id;
    		}else {
    			$dangkykhachsan->IDUser=0;
    		}
    		$dangkykhachsan->save();
    		$return["success"]=true;
    	}
    	
    	return json_encode($return);
    }

    public function getList(){
        $dangkylist=ThongTinDangKyKhachSan::all();
        return view('touradmin/dangkykhachsan/list',['dangkylist'=>$dangkylist]);
    }


    public function duyet(DangKyKhachSanRequest $request){
        
    }
}
