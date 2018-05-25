<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\Khachhang;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\userrequest;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    public function getregister(){
        return view('auth.pages.register');
    } 

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function postregister(userrequest $request)
    {    
        $user= new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->remember_token=$request->_token;
        $user->level=1;
        $user->save();
        $khachhang=new Khachhang;
        $khachhang->IDTaiKhoan=$user->id;
        $khachhang->HoTen=$user->name;
        $khachhang->Email=$user->email;
        $khachhang->save();
        return redirect()->route('blog.homepage');
    }
}
