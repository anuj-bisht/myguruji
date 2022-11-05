<select class='form-control' id='teacher' name='teacher_id'  onChange="filter_chapters();" required>
	<option value='0'>Select Teacher</option>
	@foreach($teachers as $k=>$teacher)
		<option value='{!! $teacher->id !!}'>{!! $teacher->teacher_name !!}</option>
	@endforeach
</select>