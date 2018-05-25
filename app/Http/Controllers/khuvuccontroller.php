<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Input;
use DB;
use App\KhuVuc;
use Illuminate\Http\Request;
use App\Http\Requests\khuvucrequest;
use App\BaiViet;
use File;
use App\ThanhPho;
//use App\Http\Requests\KhuVucRequest;

class khuvuccontroller extends Controller
{
    public function getList(){
        $columns = DB::connection()->getSchemaBuilder()->getColumnListing("khuvuc");
        $khuvuc=KhuVuc::all();
        $Content='khuvuc';
        return view('touradmin/khuvuc/list',['danhsach'=>$khuvuc,'title'=>"Danh sách Khu vực",'columns'=>$columns,'content'=>$Content]);
    }

    public function getAdd(){
        $listthanhpho=ThanhPho::all();
        return view("touradmin/khuvuc/add",compact('listthanhpho'));
    }

     public function add(KhuVucRequest $request){
        $img=Input::file('anhdaidien');
        $imgname=$img->getClientOriginalName();
        $imgurl="img/localimg/".$imgname; 
        while ( File::exists($imgurl)) {
            $imgname=str_random(4).$imgname;
            $imgurl="img/localimg/".$imgname; 
        } 
        
        $request->file('anhdaidien')->move("img/localimg/",$imgname);     

        $khuvuc=new KhuVuc;
        $khuvuc->anhdaidien=$imgurl;
        $khuvuc->IDDiaDiem=$request->thanhpho;
        $khuvuc->TenKV=$request->tenkhuvuc;
        $khuvuc->GioiThieu=$request->gioithieu;
        $khuvuc->save();
        return redirect()->route('admin.khuvuc.getadd')->with("status","Success");
    }

    public function getUpdate($id){
        $khuvuc=KhuVuc::where("IDKhuVuc",$id)->first();
        $listthanhpho=ThanhPho::all();
        return view("touradmin/khuvuc/update",['khuvuc'=>$khuvuc,'listthanhpho'=>$listthanhpho]);
    }

    public function update($id,KhuVucRequest $request){
        $img=Input::file('anhdaidien');
        $imgname=$img->getClientOriginalName();
        $imgurl="img/localimg/".$imgname; 
        while ( File::exists($imgurl)) {
            $imgname=str_random(4).$imgname;
            $imgurl="img/localimg/".$imgname; 
        } 
        
        $request->file('anhdaidien')->move("img/localimg/",$imgname);

        DB::table("khuvuc")->where("IDKhuVuc",$id)->update(['TenKV'=>$request->tenkhuvuc,'IDDiaDiem'=>$request->thanhpho,'GioiThieu'=>$request->gioithieu,'anhdaidien'=>$imgurl]);
        return redirect()->route('admin.khuvuc.getupdate',['id'=>$id])->with("status","Success");
    }

    public function delete($id){
        DB::table("khuvuc")->where("IDKhuVuc",$id)->delete();
        return redirect()->route('admin.list.khuvuc')->with("status","Deleted");
    }

    public function getKhuVuc($idThanhPho){
        if(request()->ajax()){
            $listkhuvuc=KhuVuc::where("IDDiaDiem",$idThanhPho)->get();
        }
        return json_encode($listkhuvuc);
    }




    public function getdanhsach(){
    	$danhsach=KhuVuc::all();
    	return view('admin.khuvuc.danhsach',['danhsach'=>$danhsach]);
    }
    public function getthem(){
    	return view('admin.khuvuc.them');
    }
    public function them(khuvucrequest $request){
        $imgname=$request->file('anhdaidien')->getClientOriginalName();
        $imgurl="img/localimg/".$imgname; 
        while ( File::exists($imgurl)) {
            $imgname=str_random(4).$imgname;
            $imgurl="img/localimg/".$imgname; 
        } 
        
        $request->file('anhdaidien')->move("img/localimg/",$imgname);      

    	$khuvuc=new KhuVuc;
    	$khuvuc->IDKhuVuc=$request->ma;
    	$khuvuc->TenKV=$request->tenkhuvuc;
        $khuvuc->anhdaidien=$imgurl;
    	$khuvuc->save();
    	return redirect()->route('admin.khuvuc.danhsach');
    }
    public function getsua($idkv){
    	$khuvuc=DB::table('khuvuc')->where('IDKhuVuc',$idkv)->get()->toArray();
    	return view('admin.khuvuc.sua',['khuvuc'=>$khuvuc['0']]);
    }
    public function sua(Request $request){
        if($request->file('anhdaidien')!=null){
            $imgname=$request->file('anhdaidien')->getClientOriginalName();
            $imgurl="img/localimg/".$imgname; 
            while ( File::exists($imgurl)) {
            $imgname=str_random(4).$imgname;
            $imgurl="img/localimg/".$imgname; 
        } 
        
        $request->file('anhdaidien')->move("img/localimg/",$imgname);      
            KhuVuc::where('IDKhuVuc',$request->ma)->update(['TenKV'=>$request->tenkhuvuc,'anhdaidien'=>$imgurl]);
        }else{
    	KhuVuc::where('IDKhuVuc',$request->ma)->update(['TenKV'=>$request->tenkhuvuc]);
        }
    	return redirect()->route('admin.khuvuc.danhsach');
    }
    public function xoa($idkv){
    	BaiViet::where('IDKhuVuc',$idkv)->delete();
    	KhuVuc::where('IDKhuVuc',$idkv)->delete();
    	return redirect()->route('admin.khuvuc.danhsach');
    }
}
