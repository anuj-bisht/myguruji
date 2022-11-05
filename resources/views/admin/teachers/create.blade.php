<div class="col-md-12">
  <div class="tile">
	<form class="form-horizontal" id="add_teacher_form">
	<input type="hidden" name="teacher_id" id="teacher_id">
	<input type="hidden" name="teacher_student_class_id" id="teacher_student_class_id">
	<input type="hidden" name="teacher_subject_id" id="teacher_subject_id">
	<div class="tile-body">
		<div class="form-group row">
		  <label class="control-label col-md-3">Teacher Name</label>
		  <div class="col-md-8">
			<input class="form-control col-md-8 @error('teacher_name') is-invalid @enderror" type="text" value="{{ old('teacher_name') }}" name='teacher_name' id='teacher_name' placeholder="Enter Teacher Name" required>
			@error('teacher_name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Class</label>
		  <div class="col-md-8">
			<select class="form-control" id='student_class' name='student_class_id[]' id="selectclass" multiple="" required>
				<optgroup label="Select Class">
				@foreach($classes as $k=>$class)
					<option value='{!! $class->id !!}'>{!! $class->class !!}</option>
				@endforeach
				</optgroup>
			</select>
		  </div>
		</div>
		<div class="form-group row">
		  <label class="control-label col-md-3">Subject</label>
		  <div class="col-md-8">
		  <select class='form-control' id='subject' name='subject_id[]' id="selectsubject" multiple="" required>
			  <optgroup label="Select Subject">
					@foreach($subjects as $k=>$subject)
						<option value='{!! $subject->id !!}'>{!! $subject->subject_name !!}</option>
					@endforeach
				</optgroup>
			</select>
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
