<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\VideoTutorial;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoTutorial extends Model
{
	use SoftDeletes;
	protected $dates = ['deleted_at'];
	protected $fillable = [
        'id','student_class_id','subject_id','teacher_id','video_name','video_link','video_description','video_embeded_code','class_name','subject_name','teacher_name','is_free','chapter_id',
    ];
	
	protected $attributes = [
        'is_free' => false,
    ];
	
	
    public function get_all_tutorials(){
		$tutorials = VideoTutorial::select('video_tutorials.*','chapters.chapter_name')
					->leftJoin('chapters','chapters.id','video_tutorials.chapter_id')
					->orderBy('student_class_id', 'asc')->get();
		return $tutorials;
	}
}
