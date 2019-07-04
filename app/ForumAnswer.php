<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumAnswer extends Model
{
    protected $fillable = ['question_id', 'answer_body', 'user_id']; 

    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }

}
