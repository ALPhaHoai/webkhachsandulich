<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoaiTin extends Model
{
    protected $table="loaitin";

    public $timestamps = false;
    
    public function baiviet()
    {
    	return $this->hasMany('App\BaiViet');
    }
}
