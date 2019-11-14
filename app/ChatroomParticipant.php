<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatroomParticipant extends Model
{
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
