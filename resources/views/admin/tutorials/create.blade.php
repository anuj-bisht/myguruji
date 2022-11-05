<div class="col-md-12">
  <div class="tile">
	<form class="form-horizontal" id="add_video_form">
	<input type="hidden" name="video_tutorial_id" id="video_tutorial_id">
	<div class="tile-body">
		<div class="form-group row">
		  <label class="control-label col-md-3">Class</label>
		  <div class="col-md-8">
			<select class="form-control" id='student_class' name='student_class_id' onChange="return filter_teachers();" required>
				<option value='0'>Select Class</option>
				@foreach($classes as $k=>$class)
					<option value='{!! $class->id !!}'>{!! $class->class !!}</option>
				@endforeach
			</select>
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Subject</label>
		  <div class="col-md-8">
		  <select class='form-control' id='subject' name='subject_id' onChange="return filter_teachers();" required>
				<option value='0'>Select Subject</option>
				@foreach($subjects as $k=>$subject)
					<option value='{!! $subject->id !!}'>{!! $subject->subject_name !!}</option>
				@endforeach
			</select>
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Teacher</label>
		  <div class="col-md-8" id="filter_teacher">
		  <select class='form-control' id='teacher' name='teacher_id' onChange="filter_chapters();" required>
				<option value='0'>Select Teacher</option>
				
			</select>
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Chapter</label>
		  <div class="col-md-8" id="filter_chapter">
		  <select class='form-control' id='chapter' name='chapter_id' required>
				<option value='0'>Select Chapter</option>
				
			</select>
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Video Name</label>
		  <div class="col-md-8">
			<input class="form-control col-md-8" required type="text" id='video_name' name='video_name' placeholder="Enter video name">
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Video Link</label>
		  <div class="col-md-8">
			<input class="form-control col-md-8" required type="text" id='video_link'  name='video_link' placeholder="Enter video link">
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Video code</label>
		  <div class="col-md-8">
			<input class="form-control col-md-8" type="text" name='video_embeded_code' placeholder="Enter video code">
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Video Description</label>
		  <div class="col-md-8">
			<textarea class="form-control" rows="2" name='video_description' placeholder="Video Description"></textarea>
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Is this tutorial free</label>
		  <div class="col-md-9">
			<div class="form-check">
			  <label class="form-check-label">
				<input class="form-check-input" type="radio" name="is_free" value='0' checked>No
			  </label>
			</div>
			<div class="form-check">
			  <label class="form-check-label">
				<input class="form-check-input" type="radio" name="is_free" value='1'>Yes
			  </label>
			</div>
		  </div>
		</div>
	</div>
	<div class="tile-footer">
	  <div class="row">
		<div class="col-md-8 col-md-offset-3">
		  <center><button class="btn btn-primary" type="submit" id='savBtn'><i class="fa fa-fw fa-lg fa-check-circle"></i>Add</button></center>
		</div>
	  </div>
	</div>
	</form>
  </div>
</div>
<div class="clearix"></div>


<script>
function filter_teachers(){
	var class_id = $("#student_class").val();
	var subject_id = $("#subject").val();
	$.ajax({
		   type:'GET',
		   url:'get_teachers_sub_class'+'/'+class_id+'/'+subject_id,
		   beforesend:function(){			  
			  //$("#add_chapter").modal('show');
		   },
		   success:function(data) {
				$("#filter_teacher").html(data);
				var chapter_html = "<select class='form-control' id='chapter' name='chapter_id' required><option value='0'>Select Chapter</option></select>";
				$("#filter_chapter").html(chapter_html);
		   },
		   error:function(){
			   swal('oops','something went wrong','error');
			   /* $.notify({
					title: "oops!!:  ",
					message: "Something went wrong",
					icon: 'fa fa-error' 
				},{
					type: "error"
				}); */
		   }
		});
	}
	
function filter_chapters(){
	var class_id = $("#student_class").val();
	var subject_id = $("#subject").val();
	var teacher_id = $("#teacher").val();
	$.ajax({
		   type:'GET',
		   url:'get_chapter_teacher_sub_class'+'/'+class_id+'/'+subject_id+'/'+teacher_id,
		   beforesend:function(){			  
			  //$("#add_chapter").modal('show');
		   },
		   success:function(data) {
				$("#filter_chapter").html(data);
		   },
		   error:function(){
			   swal('oops','something went wrong','error');
			   /* $.notify({
					title: "oops!!:  ",
					message: "Something went wrong",
					icon: 'fa fa-error' 
				},{
					type: "error"
				}); */
		   }
		});
	}
</script>