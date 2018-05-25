<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\userrequest;
use App\Http\Requests\loginrequest;
use Hash;

class authcontroller extends Controller
{
	public function getdangky(){
        return view('auth.pages.register');
    }
     protected function register(userrequest $request)
    {
    	$user = new User;
    	$user->name=$request->name;
    	$user->email=$request->email;
    	$user->password=Hash::make($request->password);
    	$user->remembertoken=$request->_token;
    	$user->save();
    	return "Đăng ký thành công";
    }

    public function getlogin(){
        return view('auth.pages.login');
    }
    public function postlogin(loginrequest $request){
    	$auth = array('email' => $request->email,
    					'password'=>$request->password
    	 );
    	if($this->auth->atempt($auth)){
    		return redirect()->route('admin.baiviet.danhsach');
    	}else{
    		echo "thất bại";
    	}
    }
}
