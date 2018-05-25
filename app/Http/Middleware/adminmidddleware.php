<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\NhomNguoiDung;
use App\PhanQuyenNhom;
use App\QuyenNguoiDung;
use Illuminate\Support\Facades\Auth;
class adminmidddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $found=false;
        if(Auth::check()){
            if(Auth::user()->level>1){
                
                //var_dump($request->path());
                $nhomnguoidung=NhomNguoiDung::where("ID",Auth::user()->level)->first();
                $listpermit=PhanQuyenNhom::where("IDNhomNguoiDung",$nhomnguoidung->ID)->get();
                foreach ($listpermit as $permit) {
                    //var_dump($permit->IDChucNang);
                    $quyennguoidung=QuyenNguoiDung::where("ID",$permit->IDChucNang)->first();
                    //var_dump($quyennguoidung->Path);
                    if($quyennguoidung->Path!=''){
                        if($request->is("*".$quyennguoidung->Path."*")){
                            $found=true;
                            //var_dump($quyennguoidung->Path);
                            break;
                        }
                    }
                }
                
                if($found==true){
                    $found=false;
                    return $next($request);
                }else {
                    return redirect()->route('blog.homepage');
                }
                //return $next($request);
            }
            else{
                return redirect()->route('blog.homepage');
            }
        }
        else  { return redirect()->route('user.getlogin'); }
       
    }
}
