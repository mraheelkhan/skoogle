<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     //
	protected $fillable =[
		'deptname','last_modified_by', 'user_id',
	];
	
	protected $dates = [
		'updated_at',
		'created_at'
		
	];
	public function modifiedby(){
		return $this->belongsTo('App\User','last_modified_by');
	}
	public function createdby(){
		return $this->belongsTo('App\User','user_id');
	}
    
   

	
}
