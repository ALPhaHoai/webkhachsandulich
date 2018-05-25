<?php

namespace App\Http\Controllers;
use App\DichVu;
use App\Http\Requests\DichVuRequest;
use DB;
use Illuminate\Http\Request;

class DichVuController extends Controller
{
	public function getList(){
		$columns = DB::connection()->getSchemaBuilder()->getColumnListing("dichvu");
		$dichvu=DichVu::all();
		$Content='dichvu';
		return view('touradmin/listpage/list',['danhsach'=>$dichvu,'title'=>"Danh sách dịch vụ",'columns'=>$columns,'content'=>$Content]);
	}

    public function getAdd(){
    	return view("touradmin/dichvu/add");
    }
    
    public function add(DichVuRequest $request){
    	$dichvu= new DichVu;
    	$dichvu->TenDichVu=$request->ten;
    	$dichvu->MoTa=$request->mota;
    	$dichvu->save();
    	return redirect()->route('admin.dichvu.getadd')->with('status','Success');
    }

    public function getUpdate($id){
    	$dichvu=DB::table('dichvu')->where('ID',$id)->first();
    	return view("touradmin/dichvu/update",['dichvu'=>$dichvu]);
    }

    public function update($id,DichVuRequest $request){
    	DB::table('dichvu')->where('ID',$id)->update(['TenDichVu'=>$request->ten,'MoTa'=>$request->mota]);
    	return redirect()->route('admin.dichvu.getupdate',['id'=>$id])->with('status','Success');
    }

    public function delete($id){
    	DichVu::where('ID',$id)->delete();
    	return redirect()->route('admin.list.dichvu')->with('status','Delete Success');
    }
}
