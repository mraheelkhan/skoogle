<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    protected $fillable = ['cover_letter', 'user_id', 'job_id', 'cv_file_name', 'salary_expected']; 

    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
}
