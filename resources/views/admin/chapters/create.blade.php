<div class="col-md-12">
  <div class="tile">
	<form class="form-horizontal" id="add_chapter_form">
	<input type="hidden" name="chapter_id" id="chapter_id">
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
		  <select class='form-control' id='teacher' name='teacher_id' required>
				<option value='0'>Select Teacher</option>
				
			</select>
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Chapter Name</label>
		  <div class="col-md-8">
			<input class="form-control col-md-8" required type="text" id='chapter_name' name='chapter_name' placeholder="Enter Chapter name">
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