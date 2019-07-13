<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    protected $fillable =[
		'name','user_id','last_modified_by',  'status' 
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

}
