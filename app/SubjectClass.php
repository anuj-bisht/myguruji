<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubjectClass extends Model
{
    protected $fillable = [
        'id','student_class_id', 'subject_id',
    ];
}
