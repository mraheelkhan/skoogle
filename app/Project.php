<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function contributor(){
        return $this->hasMany(ProjectContributor::class)->withDefault();
    }
    public function message(){
        return $this->hasMany(ProjectMessage::class)->withDefault();
    }
}
