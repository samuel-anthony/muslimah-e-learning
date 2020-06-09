<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materi extends Model
{
    public function materi_details(){
        return $this->hasMany('App\materi_detail','materi_id','id'); //(nama kolom dituju, id yg dituju, id model ini)
    }
    
    public function comments(){
        return $this->hasMany('App\comment','materi_id','id');
    }
}
