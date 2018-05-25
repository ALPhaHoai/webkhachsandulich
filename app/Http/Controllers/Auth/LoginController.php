<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\loginrequest;
use Illuminate\Support\Facades\Auth;
use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function getlogin(){
        return view('auth.pages.login');
    }


    public function postlogin(loginrequest $request){
        $auth = array('email' => $request->email,
                        'password'=>$request->password

         );
        $remember=$request->remember;


        if(Auth::attempt($auth,$remember)){
            if(Auth::user()->level==2||Auth::user()->level==4||Auth::user()->level==3){
                return redirect()->back();
            }else
            {
               return redirect()->back();
            }
            
        }
        else{
             return redirect()->route('user.getlogin')->with(['flash_message'=>'Email hoặc password bạn nhập không đúng , vui lòng nhập lại']);
        }
    }
    public function logout(){
        Auth::logout();
        return redirect()->route("blog.homepage");
    }
}
