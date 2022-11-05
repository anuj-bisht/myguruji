<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'id','student_class_id','subject_id','amount',
    ];
	
	public function StudentClass()
    {
        return $this->belongsTo('App\StudentClass');
    }
	
	public function Subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
