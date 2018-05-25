<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LichTrinh;
use App\Tour;
use DB;

class LichTrinhController extends Controller
{
    public function getList($idtour){
    	$tour=Tour::where("ID",$idtour)->first();
    	$khuvuc=DB::table("khuvuc")->where("IDKhuVuc",$tour->IDKhuVuc)->first();
    	$thanhpho=DB::table("thanhpho")->where("ID",$khuvuc->IDDiaDiem)->first();
		$columns = DB::connection()->getSchemaBuilder()->getColumnListing("lichtrinh");
		$lichtrinh=LichTrinh::where("IDTour",$idtour)->get();
		$ngaythu=$lichtrinh->count();
		$Content='lichtrinh';
		return view('touradmin/lichtrinh/list',['danhsach'=>$lichtrinh,'title'=>"Lịch trình",'columns'=>$columns,'content'=>$Content,'tour'=>$tour,'ngaythu'=>$ngaythu+1,'khuvuc'=>$khuvuc->TenKV,'thanhpho'=>$thanhpho->TenThanhPho]);
	}


    public function add($id,Request $request){
    	$lichtrinh=new LichTrinh;
    	$lichtrinh->IDTour=$id;
    	$lichtrinh->NgayThu=$request->ngaythu;
    	$lichtrinh->NoiDung=$request->noidung;
    	$lichtrinh->save();
    	return redirect()->route("admin.lichtrinh.getadd",['idtour'=>$id])->with("status","Success");
    }

    public function getUpdate($id){
        $lichtrinh=LichTrinh::where("ID",$id)->first();
        $noidung=$lichtrinh->NoiDung;
        if(request()->ajax()){
        	$return['noidung']=$noidung;
        	$return['Success']=true;
        }else {
        	$return['Success']=false;
        }
        return json_encode($return);
    }

    public function update($id){
       if(request()->ajax()){
       	$noidung=request()->get("noidung");
       	DB::table("lichtrinh")->where("ID",$id)->update(["NoiDung"=>$noidung]);
       }
       $return['Success']=true;
       return json_encode($return);
    }

    public function delete($id){
        $idtour=LichTrinh::where("ID",$id)->first()->IDTour;
        DB::table("lichtrinh")->where("ID",$id)->delete();
        return redirect()->route('admin.lichtrinh.getadd',['idtour'=>$idtour])->with("status","Deleted");
    }
}
