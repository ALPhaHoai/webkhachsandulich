<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\NhomNguoiDung;
use App\PhanQuyenNhom;
use App\QuyenNguoiDung;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;
    protected $table="users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAccessPath(){
        $nhomnguoidung=NhomNguoiDung::where("ID",Auth::user()->level)->first();
        $accesspath=$nhomnguoidung->AccessPath;
        if(isset($accesspath)){
            return $nhomnguoidung->AccessPath;
        }else {
            return false;
        }
        

    }

    public function getGroupName(){
        $nhomnguoidung=NhomNguoiDung::where("ID",Auth::user()->level)->first();
        $tennhom=$nhomnguoidung->TenNhomNguoiDung;
        return $tennhom;
    }
}