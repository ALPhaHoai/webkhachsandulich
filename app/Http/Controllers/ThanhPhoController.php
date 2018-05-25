<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ThanhPho;
use DB;
use App\Http\Requests\ThanhPhoRequest;

class ThanhPhoController extends Controller
{
    public function getList(){
		$columns = DB::connection()->getSchemaBuilder()->getColumnListing("thanhpho");
		$thanhpho=ThanhPho::all();
		$Content='thanhpho';
		return view('touradmin/listpage/list',['danhsach'=>$thanhpho,'title'=>"Danh sách thành phố",'columns'=>$columns,'content'=>$Content]);
	}

	public function getAdd(){
    	return view("touradmin/thanhpho/add");
    }
    public function add(ThanhPhoRequest $request){
    	$thanhpho= new ThanhPho;
    	$thanhpho->TenThanhPho=$request->ten;
    	$thanhpho->GioiThieu=$request->gioithieu;
    	$thanhpho->save();
    	return redirect()->route('admin.thanhpho.getadd')->with('status','Success');
    }

    public function getUpdate($id){
        $thanhpho=DB::table('thanhpho')->where('ID',$id)->first();
        return view("touradmin/thanhpho/update",['thanhpho'=>$thanhpho]);
    }

    public function update($id,ThanhPhoRequest $request){
        DB::table("thanhpho")->where("ID",$id)->update(['TenThanhPho'=>$request->ten,'GioiThieu'=>$request->gioithieu]);
        return redirect()->route('admin.thanhpho.getupdate',['id'=>$id])->with("status","Success");
    }

    public function delete($id){
        DB::table("thanhpho")->where("ID",$id)->delete();
        DB::table("khuvuc")->where("IDDiaDiem",$id)->delete();
        return redirect()->route('admin.list.thanhpho')->with("status","Deleted");
    }
}
