<?php

namespace App\Http\Controllers;
use App\Comment;
use DB;
use \File;

//use Illuminate\Http\Request;
use Request;
use Illuminate\Support\Facades\Auth;
class commentcontroller extends Controller
{
    public function getdanhsach(){
    	$danhsach=Comment::all();
    	return view('admin.comment.danhsach',['danhsach'=>$danhsach]);
    }
    public function  postcomment($idbv,$iduser,Request $request){
    	$comment= new Comment;
    	$comment->IDUser=$iduser;
    	$comment->IDBV=$idbv;
    	$comment->NoiDung=$request->comment;
    	$comment->save();
    	return redirect()->route('blog.post',['id'=>$idbv]);
    }
    public function  postcomment1($idbv,$iduser){
        if(Request::ajax()){
       $comment= new Comment;
        $comment->IDUser=$iduser;
        $comment->IDBV=$idbv;
        $comment->NoiDung=Request::get('comment');
        $comment->save();
        $data=[Auth::user()->name,Auth::user()->anhdaidien,$comment->NoiDung];
        return $data;
        }

    }
    public function xoalp($idlp){
        if(Request::ajax()){
        	$loaiphong=DB::table('loaiphong')->where('IDLoaiPhong',$idlp)->first();
        	$khachsan=DB::table('khachsan')->where('IDKhachSan',$loaiphong->IDKhachSan)->first();
        	$sophongconlai=$khachsan->SoPhong-$loaiphong->SoPhong;
            DB::table('loaiphong')->where('IDLoaiPhong',$idlp)->delete();
            DB::table('KhachSan')->Where('IDKhachSan',$loaiphong->IDKhachSan)->update(['SoPhong'=>$sophongconlai]);
        }
        return "ok";

    }
    public function xoaimg($idanh){
        $location=DB::table('anh')->where('IDAnh',$idanh)->first();
        if(Request::ajax()){
            DB::table('anh')->where('IDAnh',$idanh)->delete();
        }
        if(File::exists($location->URL)){
            File::delete($location->URL);
        }
        return "ok";

    }
}    
