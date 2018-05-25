<?php

namespace App\Http\Controllers;

use DB;
use App\KhachSan;
use App\Http\Requests\ChinhSachRequest;
use App\Http\Controllers\Controller;
use App\ChinhSach;
use Validator;
use Illuminate\Http\Request;

class chinhsachcontroller extends Controller
{
     public function getsua($idKS){
        $chinhsach=ChinhSach::where('IDKhachSan',$idKS)->get()->toArray();
        return view('touradmin.chinhsach.sua',['idCS'=>$chinhsach['0']['IDChinhSach'],'idKS'=>$idKS,'nhanphong'=>$chinhsach['0']['NhanPhong'],'traphong'=>$chinhsach['0']['TraPhong'],'huongdan'=>$chinhsach['0']['HuongDan'],'phuthu'=>$chinhsach['0']['PhuThu'],'dichuyen'=>$chinhsach['0']['DiChuyen'],'hoatdong'=>$chinhsach['0']['HoatDong']]);
    }
    public function sua(Request $request){
        DB::table('chinhsach')->where('IDChinhSach',$request->idCS)->update(['IDKhachSan'=>$request->idKS,'NhanPhong'=>$request->nhanphong,'TraPhong'=>$request->traphong,'HuongDan'=>$request->huongdan,'PhuThu'=>$request->phuthu]);
        return redirect()->route('admin.khachsan.danhsach');
    }
}
