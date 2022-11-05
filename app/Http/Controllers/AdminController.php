<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VideoTutorial;
use App\User;
use App\Teacher;
use App\TeacherClass;
use App\TeacherSubject;
use App\StudentClass;
use App\Subject;
use App\Chapter;
use Illuminate\Support\Facades\Validator;
use DB;

class AdminController extends Controller
{
    public function index(){
		$videotutorials = new VideoTutorial();
		$tutorials = $videotutorials->get_all_tutorials();
		return view('admin.tutorials.index',['tutorials' => $tutorials]);
	}
	
	public function create(){
		$data['teachers'] = Teacher::all();
		$data['classes'] = StudentClass::all();
		$data['subjects'] = Subject::all();
		return view('admin.tutorials.create', $data);
	}
	
	public function store(Request $request){
		$class_id = $request->student_class_id;
		$subject_id = $request->subject_id;
		$teacher_id = $request->teacher_id;
		$chapter_id = $request->chapter_id;
		$class_name = StudentClass::select('class')->where('id',$class_id)->first();
		//echo $class_name->class; die;
		$subject_name = Subject::select('subject_name')->where('id',$subject_id)->first();
		$teacher_name = Teacher::select('teacher_name')->where('id',$teacher_id)->first();
		$save = VideoTutorial::updateOrCreate(['id' => $request->video_tutorial_id],
                ['student_class_id' => $class_id, 'subject_id' => $subject_id,
				'teacher_id' => $teacher_id, 'subject_id' => $subject_id,
				'class_name' => $class_name->class, 'subject_name' => $subject_name->subject_name,
				'teacher_name' => $teacher_name->teacher_name, 'video_link' => $request->video_link,
				'video_name' => $request->video_name, 'video_embeded_code' => $request->video_embeded_code,
				'video_description' => $request->video_description, 'is_free' => $request->is_free,'chapter_id'=>$chapter_id]);        
		if($save){
			return response()->json(['status'=>200,'msg'=>'Tutorial saved succussfully']);
		}else{
			//echo json_encode(['status'=>500,'msg'=>'Something went wrong']);
			return response()->json(['status'=>500,'msg'=>'Something went wrong']);
		}
	}
	
	public function edit($id){
		$data['all_classes'] = StudentClass::pluck('class','id');
		$data['subjects'] = Subject::pluck('subject_name','id');
		$data['teachers'] = Teacher::pluck('teacher_name','id');
		$data['chapters'] = Chapter::pluck('chapter_name','id');
		$data['video_tutorials'] = VideoTutorial::find($id);
		return view('admin.tutorials.edit', $data);

	}
	
	public function destroy($id)
    {
        VideoTutorial::find($id)->delete();

        return response()->json(['status'=>200,'msg'=>'Tutorial deleted']);
    }
	
	public function get_teachers(){
		$teachers = Teacher::all();
		return view('admin.teachers.index',['teachers' => $teachers]);
	}
	
	public function add_teacher(){
		$data['classes'] = StudentClass::all();
		$data['subjects'] = Subject::all();
		return view('admin.teachers.create',$data); 
	}
	
	public function store_teacher(Request $request){
		
		DB::transaction(function() use ($request)
		{
			$teacher_name = $request->teacher_name;
			$teacher_id = $request->teacher_id;
			$teacher = Teacher::updateOrCreate(['id' => $request->teacher_id],
                ['teacher_name' => $teacher_name]);
			if(isset($request->edit_teacher) && $request->edit_teacher == 'edit_teacher'){
				return response()->json(['status'=>200,'msg'=>'Teacher updated succussfully']);
				die;
			}
			foreach($request->student_class_id as $k=>$class_id){
			$class_name = StudentClass::select('class')->where('id',$class_id)->first();
			$teacher_class = TeacherClass::Create(
                ['teacher_id' => $teacher->id, 'student_class_id' => $class_id, 'class_name' => $class_name->class]);
			}
			foreach($request->subject_id as $k=>$sub_id){
			$subject_name = Subject::select('subject_name')->where('id',$sub_id)->first();
			$teacher_subject = TeacherSubject::Create(
                ['teacher_id' => $teacher->id, 'subject_id' => $sub_id, 'subject_name' => $subject_name->subject_name]);
			}
			if($teacher && $teacher_class && $teacher_subject){
				return response()->json(['status'=>200,'msg'=>'Teacher saved succussfully']);
			}else{
				return response()->json(['status'=>500,'msg'=>'Something went wrong']);
			}
		});
		return response()->json(['status'=>200,'msg'=>'Teacher saved succussfully']);
	}
	
	public function edit_teacher($id){
		$data['teacher'] = Teacher::find($id);
		return view('admin.teachers.edit', $data);

	}
	
	public function destroy_teacher($id)
    {
        Teacher::find($id)->delete();

        return response()->json(['status'=>200,'msg'=>'Teacher deleted']);
    }
	
	public function get_chapters(){
		$chapters = Chapter::select('chapters.*','student_classes.class','subjects.subject_name','teachers.teacher_name')
					->join('student_classes', 'student_classes.id', '=', 'chapters.student_class_id')
					->join('subjects', 'subjects.id', '=', 'chapters.subject_id')
					->join('teachers', 'teachers.id', '=', 'chapters.teacher_id')->get();
		
		return view('admin.chapters.index',['chapters' => $chapters]);
	}
	
	public function add_chapter(){
		$data['classes'] = StudentClass::all();
		$data['subjects'] = Subject::all();
		$data['teachers'] = Teacher::all();
		return view('admin.chapters.create',$data); 
	}
	
	public function store_chapter(Request $request){
		$class_id = $request->student_class_id;
		$subject_id = $request->subject_id;
		$teacher_id = $request->teacher_id;
		$chapter_name = $request->chapter_name;;
		$save = Chapter::updateOrCreate(['id' => $request->chapter_id],
                ['student_class_id' => $class_id, 'subject_id' => $subject_id,
				'teacher_id' => $teacher_id, 'chapter_name' => $chapter_name
				]);        
		if($save){
			return response()->json(['status'=>200,'msg'=>'Chapter saved succussfully']);
		}else{
			//echo json_encode(['status'=>500,'msg'=>'Something went wrong']);
			return response()->json(['status'=>500,'msg'=>'Something went wrong']);
		}
	}
	
	public function edit_chapter($id){
		$data['chapter'] = Chapter::find($id);
		return view('admin.chapters.edit', $data);

	}
	
	public function destroy_chapter($id)
    {
        Chapter::find($id)->delete();

        return response()->json(['status'=>200,'msg'=>'Chapter deleted']);
    }
	
	public function get_teachers_sub_class(Request $request,$class_id,$subject_id){
		
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
		return view('admin.chapters.teachers', $data);
		
	}
	
	public function get_chapter_teacher_sub_class(Request $request,$class_id,$subject_id,$teacher_id){
		
		$chapters = Chapter::where('subject_id',$subject_id)
								->where('student_class_id',$class_id)
								->where('teacher_id',$teacher_id)
								->orderBy('id')
								->get();
		$data['chapters'] = $chapters;
		return view('admin.chapters.chapters', $data);
		
	}
}
