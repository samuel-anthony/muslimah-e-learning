<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ujian extends Model
{
    public function user_ujian(){
        return $this->belongsTo('App\user_ujian','id','ujian_id');
    }
    public function pertanyaans(){
        return $this->hasMany('App\pertanyaan','ujian_id','id');
    }
}
