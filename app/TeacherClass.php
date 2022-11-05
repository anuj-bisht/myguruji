<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherClass extends Model
{
    protected $fillable = [
        'id','teacher_id','student_class_id','class_name'
    ];
	
	public function Teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
