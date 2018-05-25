<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anh extends Model
{
    protected $table="anh";
    public $timestamps=false;
    public function anhbaiviet(){
    	return $this->hasMany('app/AnhBaiViet','IDAnh','id');
    }
}

