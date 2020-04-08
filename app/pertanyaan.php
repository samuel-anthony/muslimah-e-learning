<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pertanyaan extends Model
{
    public function ujian(){
        return $this->belongsTo('App\ujian','id','ujian_id');
    }
}
