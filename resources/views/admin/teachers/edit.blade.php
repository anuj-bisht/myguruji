<div class="col-md-12">
  <div class="tile">

{{ Form::model($teacher, array('url' => 'teacher/edit/{id}', $teacher->id, 'id' => 'edit_teacher_form')) }}    
	<input type="hidden" name="teacher_id" id="teacher_id" value='{!! $teacher->id !!}'>
	<input type="hidden" name="edit_teacher" id="edit_teacher" value='edit_teacher'>
	<div class="tile-body">
		
		<div class="form-group row">
			{{ Form::label('teacher_name', 'Teacher Name', ['class' => 'control-label col-md-3']) }}
			<div class="col-md-8">
				{{ Form::text('teacher_name', null, ['class' => 'form-control']) }}
			</div>
		</div>
	</div>
	<div class="tile-footer">
		<div class="row">
			<div class="col-md-8 col-md-offset-3">
				<center>{{ Form::submit('Update Teacher!', ['class' => 'btn btn-primary', 'id' => 'edtBtn']) }}</center>
			</div>
		</div>
	</div>

    {{ Form::close() }}
	</div>
</div>
	
