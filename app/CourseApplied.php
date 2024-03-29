<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourseApplied extends Model
{
    protected $fillable = ['course_id', 'user_id'];
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
