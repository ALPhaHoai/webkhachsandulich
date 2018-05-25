<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\PhuongTienRequest;
use App\PhuongTien;
use DB;
use File;
define("imagePath", "img/phuongtienimg/");
class PhuongTienController extends Controller
{
    public function getList(){
		$columns = DB::connection()->getSchemaBuilder()->getColumnListing("phuongtien");
		$phuongtien=PhuongTien::all();
		$Content='phuongtien';
		return view('touradmin/listpage/list',['danhsach'=>$phuongtien,'title'=>"Danh sách phương tiện",'columns'=>$columns,'content'=>$Content]);
	}

	public function getAdd(){
    	return view("touradmin/phuongtien/add");
    }

    public function add(PhuongTienRequest $request){
    	$phuongtien=new PhuongTien;
    	$phuongtien->Ten=$request->ten;
    	$phuongtien->mota=$request->mota;
    	if(Input::hasFile('anhdaidien')){
    		$pic=Input::file('anhdaidien');
    		$picname=$pic->getClientOriginalName();
    		$location=imagePath.$picname;
    		$pic->move(imagePath,$picname);
    		$phuongtien->AnhDaiDien=$location;
    	}
    	$phuongtien->save();
    	return redirect()->route('admin.phuongtien.getadd')->with("status","Success");
    }

    public function getUpdate($id){
    	//return Storage::files('public');
        $phuongtien=PhuongTien::where("ID",$id)->first();
        return view("touradmin/phuongtien/update",['phuongtien'=>$phuongtien]);
    }

    public function update($id,PhuongTienRequest $request){
    	$phuongtien=PhuongTien::where("ID",$id)->first();
    	if(Input::hasFile('anhdaidien')){
    		$pic=Input::file('anhdaidien');
    		$picname=$pic->getClientOriginalName();
    		$location=imagePath.$picname;
    		$pic->move(imagePath,$picname);
    		if(File::exists($phuongtien->AnhDaiDien)){
                File::delete($phuongtien->AnhDaiDien);
            }
    	}
        DB::table("phuongtien")->where("ID",$id)->update(['Ten'=>$request->ten,'MoTa'=>$request->mota,'AnhDaiDien'=>$location]);
        return redirect()->route('admin.phuongtien.getupdate',['id'=>$id])->with("status","Success");
    }

    public function delete($id){
        $phuongtien=DB::table("phuongtien")->where("ID",$id)->first();
        if(File::exists($phuongtien->AnhDaiDien)){
            File::delete($phuongtien->AnhDaiDien);
        }
        DB::table("phuongtien")->where("ID",$id)->delete();
        return redirect()->route('admin.list.phuongtien')->with("status","Deleted");
    }
}
