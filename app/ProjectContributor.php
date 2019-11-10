<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectContributor extends Model
{
    protected $fillable = ['project_id', 'user_id', 'status'];
    public function user(){
        return $this->belongsTo(User::class)->withDefault();
    }
    public function project(){
        return $this->hasMany(Project::class)->withDefault();
    }

}
