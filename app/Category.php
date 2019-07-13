<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	
    protected $fillable = ['category_name', 'parent_category_id','type','status','is_deleted'];
}
