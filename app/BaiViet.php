<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaiViet extends Model
{
    protected $table="baiviet";
    public function anhbaiviet(){
    	return $this->hasMany('App\AnhBaiViet','IDBV');
    }
    public function comment(){
    	return $this->hasMany('App\Comment','IDBV');
    }
    public function loaitin(){
    	return $this->belongsTo('App\LoaiTin');
    }
}
