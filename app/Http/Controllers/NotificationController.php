<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\notice;


class NotificationController extends Controller
{
    public function getNotification(){
    	$return['success']=false;
    	if(request()->ajax()){
    		if(Auth::check()){
    			$notices=notice::where("IDNhan",Auth::user()->id);
    			$count=$notices->count();
    			$notices=$notices->get();
    			$return['count']=$count;
    			$numb=0;
    			foreach ($notices as $notice) {
    				$return[$numb]['noidung']=$notice->NoiDung;
    				$return[$numb]['created_at']=$notice->created_at;
    				$numb++;
    			}
    			$return['level']=Auth::user()->level;
    		}
    		$return['success']=true;
    	}
    	return json_encode($return);
    }
}
