<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
        'id','student_class_id','subject_id','teacher_id','chapter_name',
    ];
}
