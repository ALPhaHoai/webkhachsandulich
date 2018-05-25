<?php

namespace App\Http\Controllers;
use App\HTTP\Requests\useradminrequest;
use App\HTTP\Requests\userinforequest;
use App\User;
use App\Khachhang;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Http\Request;
use Hash;

class usercontroller extends Controller
{
    public static function getdanhsach(){
        if(Auth::user()->level==4){
    	$danhsach=DB::table('users')->whereNotIn('level',[4])->get();
        }else
         if(Auth::user()->level==3){
            $danhsach=DB::table('users')->where('level',1)->orWhere('level',2)->get();
        }else
        if(Auth::user()->level==2){
            $danhsach=DB::table('users')->where('level',1)->get();
        }
        
    	return view('touradmin.user.danhsach',compact('danhsach'));
    }
     public function getthem(){
    	return view('touradmin.user.them');
    }
    public function them(useradminrequest $request){
    	$user=new User;
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->password=Hash::make($request->password);
    	$user->remember_token=$request->_token;
    	$user->level=$request->level;
   		$user->save();
   		return redirect()->route('admin.user.danhsach');

    }
    public function getsua($iduser){
    	$user=DB::table('users')->where('id',$iduser)->get()->first();
        
    	return view('touradmin.user.sua',['user'=>$user]);
    }
    public function sua(Request $request){
        if($request->password!=""){
        User::where('id',$request->ma)->update(['name'=>$request->name,'password'=>Hash::make($request->password),'remember_token'=>$request->_token]);
        }
        else {
            User::where('id',$request->ma)->update(['name'=>$request->name,'level'=>$request->level]);
        }
    	return redirect()->route('admin.user.danhsach');
    }
    public function xoa($iduser){
    	User::where('id',$iduser)->delete();
    	return redirect()->route('admin.user.danhsach');
    }
    public function getinfo($iduser){
        $khachhang=DB::table('khachhang')->where('IDTaiKhoan',$iduser)->first();
        $user=DB::table('users')->where('id',$iduser)->get()->first();
        return view('auth.pages.userinfo',compact('user','khachhang'));
    }
    public function postimg(Request $request){
        $file=$request->file('anhdaidien');
        $name=$file->getClientOriginalName();
        $request->file('anhdaidien')->move("img/user",$name);
        User::where('id',Auth::user()->id)->update(['anhdaidien'=>$name]);
        return redirect()->route('user.info',['iduser'=>Auth::user()->id]);
    }
    public function postinfo(userinforequest $request){
        Khachhang::where('IDTaiKhoan',Auth::user()->id)->update(['SDT'=>$request->sdt,'GioiTinh'=>$request->gioitinh,'DiaChi'=>$request->diachi,'CMT'=>$request->cmt]);
        if($request->password!=""){
        User::where('id',Auth::user()->id)->update(['name'=>$request->username,'password'=>Hash::make($request->password),'remember_token'=>$request->_token]);
        }
        else {
            User::where('id',Auth::user()->id)->update(['name'=>$request->username]);
        }
        return redirect()->route('user.info',['iduser'=>Auth::user()->id]);
    }
    public function getcmt($iduser){
        $comment=DB::table('comment')->select('IDBV')->where('IDUser',$iduser)->distinct()->get();
        return view('auth.pages.comments',compact('comment'));
    }
    public function getsuccess(){
        return view('auth.pages.success');
    }
    public function getdashbroad(){
        $dondatphongnum=DB::table('dondatphong')->count();
        $khachsannum=DB::table('khachsan')->count();
        $baivietnum=DB::table('baiviet')->count();
        $loaitin=DB::table('loaitin')->get();
        $loaitinnum=DB::table('loaitin')->count();
        $newdon=DB::table('don')->where('Duyet',0)->get();

        $iddon[]='0';
        foreach ($newdon as $value) {
            $iddon[]=$value->IDDon;
        }
         $newdondatphong=DB::table('dondatphong')->whereIn('IDDon',$iddon)->get();
             $idks[]='0';
            foreach ($newdondatphong as $value) {
                $idks[]=$value->IDKhachSan;
            }

        $khachsannewdon=DB::table('khachsan')->whereIn('IDKhachSan',$idks)->get();
        
       
        
        $newcmt=DB::table('comment')->where('DaDoc',0)->orWhere('DaDoc',null)->get();
        foreach($newcmt as $item){
            $idbv[]=$item->IDBV;
        }
        $baivietnewcmt=DB::table('baiviet')->whereIn('IDBV',$idbv)->get();
        return view('admin.Dashbroad.dashbroad',compact('baivietnum','loaitin','loaitinnum','baivietnewcmt','khachsannum','dondatphongnum','khachsannewdon'));
    }

     public function getdonphonginfo($iduser){
        $don=DB::table('don')->where('IDKH',$iduser)->get();
        
            $tmparr[]=1;
        if($don!=null){
        foreach ($don as $value) {
            $tmparr[]=$value->IDDon;
        }
    }
        $dondetail=DB::table('dondatphong')->whereIn('IDDon',$tmparr)->get();
        return view('auth.pages.donphong',compact('don','dondetail'));

        
    }

}
