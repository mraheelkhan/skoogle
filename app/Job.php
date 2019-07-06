<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $fillable = ['organization_id', 'user_id', 'job_title', 'job_type', 'job_location', 'deadline', 'salary_range', 'category_id', 'description']; 

    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function organization(){
        return $this->hasOne(Department::class, 'id', 'organization_id')->withDefault();
    }
}
