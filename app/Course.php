<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }
}
