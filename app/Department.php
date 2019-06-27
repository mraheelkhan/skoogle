<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
     //
	protected $fillable =[
		'deptname','user_id','last_modified_by'
	];
	
	protected $dates = [
		'created_at',
		'updated_at'
	];
	
	public function createdby(){
		return $this->belongsTo('App\User','user_id');
	}
    
    public function modifiedby(){
		return $this->belongsTo('App\User','last_modified_by');
	}

	public function hrlead(){
		return $this->belongsTo('App\Hrlead','department_id');
	}
	
}
