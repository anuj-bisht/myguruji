<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model
{
    protected $fillable = [
        'id','class',
    ];
	
	public function plan()
    {
        return $this->hasMany('App\Plan');
    }
}
