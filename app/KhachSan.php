<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class KhachSan extends Model
{
    protected $table='khachsan';
    public $timestamps=false;

    public static function getHotelByManager(){
    	$quanlyid=Auth::user()->id;
    	$khachsan=KhachSan::where("IDNguoiQuanLy",$quanlyid)->first();
    	if($khachsan==null){
    		return redirect()->route("admin.quanlykhachsan.getthem");
    	}
    	return $khachsan;
    }
}
