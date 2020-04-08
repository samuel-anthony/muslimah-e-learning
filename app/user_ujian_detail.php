<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_ujian_detail extends Model
{
    public function user_ujian(){
        return $this->belongsTo('App\user_ujian','user_ujian_id','id');
    }
}
