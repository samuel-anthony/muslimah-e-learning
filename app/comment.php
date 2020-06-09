<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    
    public function materi(){
        return $this->belongsTo('App\group','materi_id','id');
    }
    
    public function user(){
        return $this->belongsTo('App\user','user_id','id');
    }
}
