<div class="col-md-12">
  <div class="tile">

{{ Form::model($video_tutorials, array('url' => 'tutorial/edit/{id}', $video_tutorials->id, 'id' => 'edit_video_form')) }}    
	<input type="hidden" name="video_tutorial_id" id="video_tutorial_id" value='{!! $video_tutorials->id !!}'>
	<div class="tile-body">
		<div class="form-group row">
			{!! Form::Label('student_class_id', 'Class', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::select('student_class_id', $all_classes, $video_tutorials->class, ['class' => 'form-control', 'onChange' => 'return filter_teachers();']) !!}
			</div>
		</div>
		<div class="form-group row">
			{!! Form::Label('subject_id', 'Subject', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::select('subject_id', $subjects, $video_tutorials->subject_id, ['class' => 'form-control','onChange' => 'return filter_teachers();']) !!}
			</div>
		</div>
		<div class="form-group row">
			{!! Form::Label('teacher_id', 'Teacher Name', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8" id='filter_teacher'>
				{!! Form::select('teacher_id', $teachers, $video_tutorials->teacher_id, ['class' => 'form-control','onChange' => 'return filter_chapters();']) !!}
			</div>
		</div>
		<div class="form-group row">
			{!! Form::Label('chapter_id', 'Chapter Name', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8" id='filter_chapter'>
				{!! Form::select('chapter_id', $chapters, $video_tutorials->chapter_id, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group row">
			{!! Form::label('video_name', 'Video Name', ['class' => 'control-label col-md-3']) !!}
			<div class="col-md-8">
				{!! Form::text('video_name', null, ['class' => 'form-control']) !!}
			</div>
		</div>
		<div class="form-group row">
			{{ Form::label('video_link', 'Video Link', ['class' => 'control-label col-md-3']) }}
			<div class="col-md-8">
				{{ Form::text('video_link', null, ['class' => 'form-control']) }}
			</div>
		</div>
		<div class="form-group row">
			{{ Form::label('video_embeded_code', 'Video Code', ['class' => 'control-label col-md-3']) }}
			<div class="col-md-8">
				{{ Form::text('video_embeded_code', null, ['class' => 'form-control']) }}
			</div>
		</div>
		<div class="form-group row">
			{{ Form::label('video_description', 'Video Description', ['class' => 'control-label col-md-3']) }}
			<div class="col-md-8">
				{{ Form::textarea('video_description', null, ['class' => 'form-control', 'rows' => 2]) }}
			</div>
		</div>
		<div class="form-group row">
			{{ Form::label('is_free', 'Is this tutorial free', ['class' => 'control-label col-md-3']) }}
			<div class="col-md-8">
				{{ Form::radio('is_free', '0' , $video_tutorials->is_free == 0?true:false) }} No
				
				{{ Form::radio('is_free', '1' , $video_tutorials->is_free == 1?true:false) }} Yes
			</div>
		</div>
	</div>
	<div class="tile-footer">
		<div class="row">
			<div class="col-md-8 col-md-offset-3">
				<center>{{ Form::submit('Update Tutorial!', ['class' => 'btn btn-primary', 'id' => 'edtBtn']) }}</center>
			</div>
		</div>
	</div>

    {{ Form::close() }}
	</div>
</div>
	
<script>
function filter_teachers(){
	var class_id = '<?php echo $video_tutorials->student_class_id; ?>';
	var subject_id = '<?php echo $video_tutorials->subject_id; ?>';
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
</script>