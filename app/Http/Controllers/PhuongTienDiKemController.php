<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PhuongTienDiKem;
use App\PhuongTien;
use DB;

class PhuongTienDiKemController extends Controller
{

    public function getAdd($id){
    	$idTour=$id;
    	$phuongtiendikem=PhuongTienDiKem::where("IDTour",$id)->get();
    	$phuongtien=PhuongTien::all();
    	$columns = DB::connection()->getSchemaBuilder()->getColumnListing("phuongtien");
    	return view("touradmin/phuongtiendikem/add",compact('idTour','phuongtiendikem','phuongtien','columns'));
    }
    
    public function add($idTour,$idPhuongTien){
    	if(request()->ajax()){
    		$phuongtiendikem=new PhuongTienDiKem;
    		$phuongtiendikem->IDPhuongTien=$idPhuongTien;
    		$phuongtiendikem->IDTour=$idTour;
    		$phuongtiendikem->save();
    	}
    	$return["success"]=true;
    	echo json_encode($return);
    }

    public function update($idTour,$idPhuongTien){
    	if(request()->ajax()){
    		$ghichu=request()->get('ghichu');
    		DB::table('phuongtiendikem')->where("IDTour",$idTour)->where("IDPhuongTien",$idPhuongTien)->update(["GhiChu"=>$ghichu]);
    	}
    	$return["success"]=true;
    	echo json_encode($return);
    }

    public function delete($idTour,$idPhuongTien){
    	if(request()->ajax()){
    		DB::table('phuongtiendikem')->where("IDTour",$idTour)->where("IDPhuongTien",$idPhuongTien)->delete();
    	}
    	$return["success"]=true;
    	echo json_encode($return);
    }
}
