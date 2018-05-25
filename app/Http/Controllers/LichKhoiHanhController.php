<?php

namespace App\Http\Controllers;
use App\LichKhoiHanh;
use Illuminate\Http\Request;
use DB;

class LichKhoiHanhController extends Controller
{
    public function getAdd($idtour){
    	$listlichkhoihanh=LichKhoiHanh::where('IDTour',$idtour)->get();
    	return view("touradmin/lichkhoihanh/add",['idtour'=>$idtour,'listlichkhoihanh'=>$listlichkhoihanh]);
    }

    public function add(Request $request){


    	if(isset($request->ngaykhoihanh)){
    		$count=0;
    		foreach($request->ngaykhoihanh as $value){
    			if(isset($value)){
    			$lichkhoihanh= new LichKhoiHanh();
    			$lichkhoihanh->IDTour=$request->idtour;
    			$lichkhoihanh->NgayKhoiHanh=$request->ngaykhoihanh[$count];
    			$lichkhoihanh->DacDiem=$request->dacdiem[$count];
    			$lichkhoihanh->DiaDiem=$request->diadiem[$count];
    			$lichkhoihanh->SoCho=$request->socho[$count];
    			$lichkhoihanh->Gia=$request->gia[$count];
    			$lichkhoihanh->save();
    			$count++;
    			}
    		}
    	}
    }

    public function update(Request $request){
    	if(isset($request->updngaykhoihanh)){
    		$count=0;
    		foreach($request->updngaykhoihanh as $value){
    			if(isset($value)){
    				DB::table("lichkhoihanh")->where("ID",$request->idlichkhoihanh[$count])->update(["NgayKhoiHanh"=>$request->updngaykhoihanh[$count],"DacDiem"=>$request->upddacdiem[$count],"DiaDiem"=>$request->upddiadiem[$count],"SoCho"=>$request->updsocho[$count],"Gia"=>$request->updgia[$count]]);
    			$count++;
    			}
    		}
    	}
    }

    public function complete(Request $request){
    	self::update($request);
    	self::add($request);
    	return redirect()->route('admin.lichkhoihanh.getadd',['idtour'=>$request->idtour]);
    }

    public function delete($id){
    	$idtour=LichKhoiHanh::where("ID",$id)->first()->IDTour;
    	LichKhoiHanh::where("ID",$id)->delete();
    	return redirect()->route('admin.lichkhoihanh.getadd',['idtour'=>$idtour])->with("status","Success");
    }
}
