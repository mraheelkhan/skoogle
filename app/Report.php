<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'reported_user_id', 'id')->withDefault();
    }
    public function comment(){
        return $this->belongsTo(PostComment::class, 'reporter_id', 'id')->withDefault();
    }
   
}
