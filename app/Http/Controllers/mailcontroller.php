<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB,Mail;
class mailcontroller extends Controller
{
    public function getlienhe(){
    	return view('auth.pages.lienhe');
    }
    public function postlienhe(Request $request){
    	$data=['name'=>$request->name,'Content'=>$request->content];
    	Mail::send('auth.pages.blank',$data,function($msg){
    		$msg->from('mail.dat.trongnguyen961@gmail.com','Guess mail');
    		$msg->to('mail.dat.trongnguyen96@gmail.com')->subject('Guess mail');
    	});
    	$back="<script> alert('Chúng tôi sẽ liên hệ với bạn sớm nhật có thể ');
    					window.location='".url('blog/homepage')."'
    	   </script>";
    	return $back;
    	
    }
}
