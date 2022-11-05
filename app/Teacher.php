<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Teacher extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	
	protected $rules = [
    'teacher_name' => 'required',
	];
	
    protected $fillable = [
        'id','teacher_name'
    ];
	
	public function teacher_classes()
    {
        return $this->hasMany('App\TeacherClass');
    }
	
	public function teacher_subjects()
    {
        return $this->hasMany('App\TeacherSubject');
    }
}
