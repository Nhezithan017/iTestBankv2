<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = [];

    public function questions(){
        return $this->hasMany('App\Question','dept_id', 'id');
    }
    public function user(){
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }
   
}
