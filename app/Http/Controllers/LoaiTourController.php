<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTour;
use DB;

class LoaiTourController extends Controller
{
    public function getList(){
		$columns = DB::connection()->getSchemaBuilder()->getColumnListing("loaitour");
		$loaitour=LoaiTour::all();
		$Content='loaitour';
		return view('touradmin/listpage/list',['danhsach'=>$loaitour,'title'=>"Danh sách loại tour",'columns'=>$columns,'content'=>$Content]);
	}

	public function getAdd(){
    	return view("touradmin/loaitour/add");
    }

    public function add(Request $request){
    	$loaitour= new LoaiTour;
    	$loaitour->TenLoaiTour=$request->ten;
    	$loaitour->GhiChu=$request->ghichu;
    	$loaitour->save();
    	return redirect()->route('admin.loaitour.getadd')->with('status','Success');
    }


    public function getUpdate($id){
    	$loaitour=DB::table('loaitour')->where('ID',$id)->first();
    	return view("touradmin/loaitour/update",['loaitour'=>$loaitour]);
    }

    public function update($id,Request $request){
    	DB::table('loaitour')->where('ID',$id)->update(['TenLoaiTour'=>$request->ten,'GhiChu'=>$request->ghichu]);
    	return redirect()->route('admin.loaitour.getupdate',['id'=>$id])->with('status','Success');
    }

    public function delete($id){
    	LoaiTour::where('ID',$id)->delete();
    	return redirect()->route('admin.list.loaitour')->with('status','Delete Success');
    }
}
