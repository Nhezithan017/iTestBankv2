<?php

namespace App;
use App\Department;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = [];

    public function department(){
    	return $this->belongsTo('App\Department', 'dept_id', 'id');
    }
    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
    
}
