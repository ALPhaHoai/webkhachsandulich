<?php

namespace App\Http\Controllers;
use App\NhomNguoiDung;
use App\PhanQuyenNhom;
use App\QuyenNguoiDung;
use Illuminate\Http\Request;

class PhanQuyenTheoNhomController extends Controller
{
    function getList(){
    	$listnhomnguoidung=NhomNguoiDung::all();
    	return view('touradmin/quanlyphanquyentheonhom/list',['listnhomnguoidung'=>$listnhomnguoidung]);
    }

     // Hàm xử lý ajax khi id nhóm người dùng được gửi lên
    function ajaxGetList(Request $request){
    	$return['sucess']=false;
    	if(request()->ajax()){
    		$groupid=$request->groupid;
    		$listallow=PhanQuyenNhom::where("IDNhomNguoiDung",$groupid)->get();
    		$count=0;
    		$listpermitid=[];
    		foreach($listallow as $allow){
    			$listpermitid[$count]=$allow->IDChucNang;
    			$return['allow'][$count]['idchucnang']=$allow->IDChucNang;
                $Permit=QuyenNguoiDung::where("ID",$allow->IDChucNang)->first();
    			$return['allow'][$count]['tenchucnang']=$Permit->TenQuyenQuanLy;
                if($Permit->AccessOnly==1){
                    $return['allow'][$count]['accessonly']=true;
                }else {
                    $return['allow'][$count]['accessonly']=false;
                }
    			if($allow->Them==1){
    				$return['allow'][$count]['add']=true;
    			}else {
    				$return['allow'][$count]['add']=false;
    			}
    			if($allow->Xoa==1){
    				$return['allow'][$count]['delete']=true;
    			}else {
    				$return['allow'][$count]['delete']=false;
    			}
    			if($allow->Sua==1){
    				$return['allow'][$count]['update']=true;
    			}else {
    				$return['allow'][$count]['update']=false;
    			}
    			$count++;
    		}
    		$listpermitnotallow=QuyenNguoiDung::whereNotIn('ID',$listpermitid)->get();
    		$count=0;
    		foreach($listpermitnotallow as $notallow){
    			$return['notallow'][$count]['idchucnang']=$notallow->ID;
    			$return['notallow'][$count]['tenchucnang']=$notallow->TenQuyenQuanLy;
    			$count++;
    		}
    		$return['sucess']=true;
    		$return['id']=$request->groupid;
    	}
    	return json_encode($return);
    }

    function ajaxAddPermit(Request $request){
    	$return['sucess']=false;
    	if(request()->ajax()){
    		$groupid=$request->groupid;
    		$permitid=$request->permitid;
    		$phanquyennhom=new PhanQuyenNhom();
    		$phanquyennhom->IDNhomNguoiDung=$groupid;
    		$phanquyennhom->IDChucNang=$permitid;
    		$phanquyennhom->TruyCap=1;
    		$phanquyennhom->Them=0;
    		$phanquyennhom->Xoa=0;
    		$phanquyennhom->Sua=0;
    		$phanquyennhom->Disable=0;
    		$phanquyennhom->save();
    		$return['sucess']=true;
    	}
    	return json_encode($return);
    }

    function ajaxRemovePermit(Request $request){
    	$return['sucess']=false;
    	if(request()->ajax()){
    		$groupid=$request->groupid;
    		$permitid=$request->permitid;
    		PhanQuyenNhom::where("IDChucNang",$permitid)->where("IDNhomNguoiDung",$groupid)->delete();
    		$return['sucess']=true;
    	}
    	return json_encode($return);
    }

    function ajaxAddCPermit(Request $request){
        $return['sucess']=false;
        if(request()->ajax()){
            $groupid=$request->groupid;
            $action=$request->action;
            $permitid=$request->permitid;
            $phanquyennhom=PhanQuyenNhom::where("IDChucNang",$permitid)->where("IDNhomNguoiDung",$groupid);
            if($action=='add'){
                if($phanquyennhom->first()->Them==1){
                    $phanquyennhom->update(['Them'=>0]);
                }else{
                    $phanquyennhom->update(['Them'=>1]);
                }
            }else if($action=='update'){
                if($phanquyennhom->first()->Sua==1){
                    $phanquyennhom->update(['Sua'=>0]);
                }else{
                    $phanquyennhom->update(['Sua'=>1]);
                }

            }else if($action=='delete'){
                 if($phanquyennhom->first()->Xoa==1){
                    $phanquyennhom->update(['Xoa'=>0]);
                }else{
                    $phanquyennhom->update(['Xoa'=>1]);
                }

            }
            $return['sucess']=true;
        }
        return json_encode($return);
    }
}
