<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\StudentClass;
use App\Subject;
use App\Teacher;
use App\TeacherSubject;
use App\TeacherClass;
use App\VideoTutorial;
use App\Chapter;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse; 

class ApiController extends Controller
{
    public function search_tutorials(Request $request,$user_id,$class_id,$subject_id,$teacher_id,$chapter_id){
		//if(Auth::user()->id == $user_id){
		
		$get_tutorials = VideoTutorial::select('video_tutorials.*','chapters.chapter_name')
						->leftJoin('chapters','chapters.id','video_tutorials.chapter_id')
						->where('student_class_id',$class_id)
						->where('subject_id',$subject_id)
						->where('teacher_id',$teacher_id)
						->where('chapter_id',$chapter_id)
						->orderBy('id')
						->get()->toArray();
		$response = array(
				'status_code' => 200,
				'message' => 'success',
				'data' => $get_tutorials
			);
       return new JsonResponse($response, 200);
		/* }
		else{
		return response()->json([
                'message' => 'Unauthorized'
            ], 401);
		} */
	}
	
	public function get_teachers(Request $request,$class_id,$subject_id){
		
		$get_teacher_from_subject = TeacherSubject::where('subject_id',$subject_id)
								->orderBy('teacher_id')
								->pluck('teacher_id')->toArray();
		$get_teacher_from_class = TeacherClass::where('student_class_id',$class_id)
								->orderBy('teacher_id')
								->pluck('teacher_id')->toArray();
		//dd($get_teacher_from_class);
		$all_teachers_id=array_intersect($get_teacher_from_subject,$get_teacher_from_class);
		$teachers = Teacher::find($all_teachers_id);
		$data['teachers'] = $teachers;
		$response = array(
				'status_code' => 200,
				'message' => 'success',
				'data' => $data
			);
       return new JsonResponse($response, 200);
		
	}
	
	public function get_chapters(Request $request,$class_id,$subject_id,$teacher_id){
		$chapters = Chapter::where('subject_id',$subject_id)
								->where('student_class_id',$class_id)
								->where('teacher_id',$teacher_id)
								->orderBy('id')
								->get();
		$data['chapters'] = $chapters;
		$response = array(
				'status_code' => 200,
				'message' => 'success',
				'data' => $data
			);
       return new JsonResponse($response, 200);
		
	}
}