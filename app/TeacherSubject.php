<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TeacherSubject extends Model
{
    protected $fillable = [
        'id','teacher_id','subject_id','subject_name'
    ];
	
	public function Teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
}
