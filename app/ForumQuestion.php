<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumQuestion extends Model
{
    protected $fillable = ['question_title', 'question_body', 'category_id', 'user_id']; 

	public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function category(){
        return $this->belongsTo(Category::class)->withDefault();
    }
    
}
