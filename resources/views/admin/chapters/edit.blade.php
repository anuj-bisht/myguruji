<div class="col-md-12">
  <div class="tile">

{{ Form::model($chapter, array('url' => 'chapter/edit/{id}', $chapter->id, 'id' => 'edit_chapter_form')) }}    
	<input type="hidden" name="chapter_id" id="chapter_id" value='{!! $chapter->id !!}'>
	<input type="hidden" name="student_class_id" id="student_class_id" value='{!! $chapter->student_class_id !!}'>
	<input type="hidden" name="subject_id" id="subject_id" value='{!! $chapter->subject_id !!}'>
	<input type="hidden" name="teacher_id" id="teacher_id" value='{!! $chapter->teacher_id !!}'>
	<input type="hidden" name="edit_chapter" id="edit_chapter" value='edit_chapter'>
	<div class="tile-body">
		
		<div class="form-group row">
			{{ Form::label('chapter_name', 'Chapter Name', ['class' => 'control-label col-md-3']) }}
			<div class="col-md-8">
				{{ Form::text('chapter_name', null, ['class' => 'form-control']) }}
			</div>
		</div>
	</div>
	<div class="tile-footer">
		<div class="row">
			<div class="col-md-8 col-md-offset-3">
				<center>{{ Form::submit('Update Chapter!', ['class' => 'btn btn-primary', 'id' => 'edtBtn']) }}</center>
			</div>
		</div>
	</div>

    {{ Form::close() }}
	</div>
</div>