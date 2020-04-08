<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_ujian extends Model
{
    public function user_ujian_details(){
        return $this->hasMany('App\user_ujian_detail','user_ujian_id','id');
    }
    public function user(){
        return $this->hasOne('App\User','id','user_id');
    }
    public function ujian(){
        return $this->hasOne('App\ujian','id','ujian_id');
    }
}
