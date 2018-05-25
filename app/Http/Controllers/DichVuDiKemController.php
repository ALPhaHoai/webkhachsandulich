<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DichVuDiKem;
use App\DichVu;
use DB;
class DichVuDiKemController extends Controller
{
    public function getAdd($id){
    	$idTour=$id;
    	$dichvudikem=DichVuDiKem::where("IDTour",$id)->get();
    	$dichvu=DichVu::all();
    	$columns = DB::connection()->getSchemaBuilder()->getColumnListing("dichvu");
    	return view("touradmin/dichvudikem/add",compact('idTour','dichvudikem','dichvu','columns'));
    }
    
    public function add($idTour,$idDichVu){
    	if(request()->ajax()){
    		$dichvudikem= new DichVuDiKem;
    		$dichvudikem->IDTour=$idTour;
    		$dichvudikem->IDDichVu=$idDichVu;
    		$dichvudikem->save();
    	}
    	$return["success"]=true;
    	echo json_encode($return);
    }

    public function update($idTour,$idDichVu){
    	if(request()->ajax()){
    		$ghichu=request()->get('ghichu');
    		DB::table('dichvudikem')->where("IDTour",$idTour)->where("IDDichVu",$idDichVu)->update(["GhiChu"=>$ghichu]);
    	}
    	$return["success"]=true;
    	echo json_encode($return);
    }

    public function delete($idTour,$idDichVu){
    	if(request()->ajax()){
    		DB::table('dichvudikem')->where("IDTour",$idTour)->where("IDDichVu",$idDichVu)->delete();
    	}
    	$return["success"]=true;
    	echo json_encode($return);
    }
}
