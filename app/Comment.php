<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table="comment";
    public function baiviet(){
    	return $this->belongsTo('app\BaiViet','IDBV','id');
    }
    public function user(){
    	return $this->belongsTo('app\User','IDUser','id');
    }
}
