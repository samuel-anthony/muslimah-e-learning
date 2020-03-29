<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class materi_detail extends Model
{
    public function materi(){
        return $this->belongsTo('App\materi','materi_id','id');
    }
}
