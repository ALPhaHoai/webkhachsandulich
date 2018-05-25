<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\BaiViet;
use App\KhuVuc;
use App\Anh;
use App\Http\Requests\baivietrequest;
use Illuminate\Support\Facades\Input;
include 'def.php';

class baivietcontroller extends Controller
{
    public static function getdanhsach(){
    	$danhsach=BaiViet::all();
    	return view('touradmin.baiviet.danhsach',['danhsach'=>$danhsach]);
    }
    public function getthem(){
        $loaitin=DB::table('loaitin')->select('IDLoaiTin','TenLoaiTin')->get()->toArray();
        $khuvuc=DB::table('khuvuc')->select('IDKhuVuc','TenKV')->get()->toArray();
        $nguoidang=DB::table('users')->where('level',NHANVIEN_ID)->orWhere('level',4)->get();
    	return view('touradmin.baiviet.them',compact('loaitin','khuvuc','nguoidang','nhanvienid'));
    }
    public function them(baivietrequest $request){

        $file_name=$request->file('anhdaidien')->getClientOriginalName();
    	$baiviet=new BaiViet;
    	$baiviet->IDBV=$request->ma;
    	$baiviet->IDLoaiTin=$request->loaitin;
    	$baiviet->IDKhuVuc=$request->khuvuc;
    	$baiviet->TieuDe=$request->tieude;
    	$baiviet->TomTat=$request->tomtat;
    	$baiviet->NoiDung=$request->noidung;
    	$baiviet->NgayViet=$request->ngaydang;
    	$baiviet->NgayCapNhat=$request->ngaycapnhat;
    	$baiviet->IDNhanVien=$request->nguoidang;
        $baiviet->anhdaidien=$file_name;
        $baiviet->luotxem=0;
        $request->file('anhdaidien')->move("img/blogimg/",$file_name);
    	$baiviet->save();
    	return redirect()->route('admin.baiviet.danhsach');
    }
    public function getsua($idbv){
        $comment=DB::table('comment')->where('IDBV',$idbv)->get();
    	$baiviet=DB::table('baiviet')->where('IDBV',$idbv)->first();
        $curloaitin=DB::table('loaitin')->where('IDLoaiTin',$baiviet->IDLoaiTin)->first();
        $curkhuvuc=DB::table('khuvuc')->where('IDKhuVuc',$baiviet->IDKhuVuc)->first();
        $nguoidang=DB::table('users')->where("id",$baiviet->IDNhanVien)->first();
    	return view('touradmin.baiviet.sua',['baiviet'=>$baiviet,'curloaitin'=>$curloaitin,'curkhuvuc'=>$curkhuvuc,'comments'=>$comment,'nguoidang'=>$nguoidang]);
    }
    public function sua(Request $request){
        if($request->dadoc!=null){
        DB::table('comment')->where('IDBV',$request->ma)->update(['DaDoc'=>'1']);
        }
        if($request->file('anhdaidien')!=null){

            $file_name=$request->file('anhdaidien')->getClientOriginalName();
            $request->file('anhdaidien')->move("img/blogimg/",$file_name);        
            BaiViet::where('IDBV',$request->ma)->update(['IDLoaiTin'=>$request->loaitin,'IDKhuVuc'=>$request->khuvuc,'TieuDe'=>$request->tieude,'TomTat'=>$request->tomtat,'NoiDung'=>$request->noidung,'NgayViet'=>$request->ngaydang,'NgayCapNhat'=>$request->ngaycapnhat,'IDNhanVien'=>$request->nguoidang,'anhdaidien'=>$file_name]);

        }else {
    	BaiViet::where('IDBV',$request->ma)->update(['IDLoaiTin'=>$request->loaitin,'IDKhuVuc'=>$request->khuvuc,'TieuDe'=>$request->tieude,'TomTat'=>$request->tomtat,'NoiDung'=>$request->noidung,'NgayViet'=>$request->ngaydang,'NgayCapNhat'=>$request->ngaycapnhat]);
		}

    	return redirect()->route('admin.baiviet.danhsach');
    }
    public function xoa($idbv){
    	BaiViet::where('IDBV',$idbv)->delete();
    	return redirect()->route('admin.baiviet.danhsach');
    }

    public function gethomepage(){
        $baivietpage=DB::table('baiviet')->paginate(6);
        $khuvuc=DB::table('khuvuc')->take(18)->get();
        $loaitin=DB::table('loaitin')->get();
        $hotnew=DB::table('baiviet')->orderBy('created_at','desc')->orderBy('luotxem','desc')->take(4)->get()->toArray();
        return view('frontendblog.pages.home',['baivietpage'=>$baivietpage,'khuvuc'=>$khuvuc,'loaitin'=>$loaitin,'hotnew'=>$hotnew]);
    }

    public function getpost($id){
        $khuvuc=DB::table('khuvuc')->take(18)->get();
        $baivietpost=DB::table('baiviet')->where('IDBV',$id)->get()->first();
        $loaitin=DB::table('loaitin')->where('IDLoaiTin',$baivietpost->IDLoaiTin)->first();
        $commentnum=DB::table('comment')->where('IDBV',$id)->count();
        if($commentnum<=0){
            $comment=null;
        }
        else {
            $comment=DB::table('comment')->where('IDBV',$id)->orderBy('created_at','desc')->get();
        }
        return view('frontendblog.pages.post',compact('khuvuc','baivietpost','loaitin','comment'));
    }

    public function getthemepost($idlt){
        $khuvuc=DB::table('khuvuc')->take(18)->get();
        $baiviettheme=DB::table('baiviet')->where('IDLoaiTin',$idlt)->orderBy('created_at','desc')->get()->toArray();
        $loaitintheme=DB::table('loaitin')->where('IDLoaiTin',$idlt)->first();
        $baivietpage=DB::table('baiviet')->where('IDLoaiTin',$idlt)->paginate(6);
        $baivietfav=DB::table('baiviet')->where('IDLoaiTin',$idlt)->orderBy('luotxem','desc')->get()->first();
        return view('frontendblog.pages.themepost',compact('khuvuc','baiviettheme','loaitintheme','baivietpage','baivietfav'));
    }

    public function getsearch( Request $request){
        $s=$request->searchkey;
        $khuvuc=DB::table('khuvuc')->take(18)->get();
        $baivietpage=DB::table('baiviet')->where('TieuDe','like','%'.$s.'%')->paginate(6);
        return view('frontendblog.pages.search',compact('khuvuc','baivietpage'))->with(['s'=>$s]);
    }
    
    public function getdeletepart(){
        $baiviet=BaiViet::where('IDBV','BV2')->get()->toArray();
        return view('deletesomething',['danhsach'=>$baiviet['0']]);
    }
    public function savedeleted(Request $request,$ma){
        BaiViet::where('IDBV',$ma)->update(['NoiDung'=>$request->noidung]);    
    }
    public function xoacmt($idcmt,$idbv){
        DB::table('comment')->where('IDCM',$idcmt)->delete();
        return redirect()->route('admin.baiviet.getsua',['idbv'=>$idbv]);
    }
    public function locationpost($idkhuvuc){
        $khuvuc=DB::table('khuvuc')->take(18)->get();
        $baivietpage=DB::table('baiviet')->where('IDKhuVuc',$idkhuvuc)->paginate(6);
        $curkhuvuc=DB::table('khuvuc')->where('IDKhuVuc',$idkhuvuc)->get()->first();
        $baivietfav=DB::table('baiviet')->where('IDKhuVuc',$idkhuvuc)->orderBy('luotxem','desc')->get()->first();
        return view('frontendblog.pages.locationpost',compact('khuvuc','baivietpage','curkhuvuc','baivietfav'));
    }
}
