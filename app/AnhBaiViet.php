<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AnhBaiViet extends Model
{
    protected $table="anhbaiviet";
    public function anh(){
    	return $this->belongTo('app\Anh','IDAnh','id');
    }
    public function baiviet(){
    	return $this->belongTo('app\BaiViet','IDBV','id');
    }

}
