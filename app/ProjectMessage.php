<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMessage extends Model
{
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function project(){
        return $this->hasMany(Project::class)->withDefault();
    }
}
