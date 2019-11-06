<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseVideo extends Model
{
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }

    public function course(){
        return $this->belongsTo(Course::class)->withDefault();
    }
}
