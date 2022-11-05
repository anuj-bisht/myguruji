<select class='form-control' id='chapter' name='chapter_id' required>
	<option value='0'>Select Chapter</option>
	@foreach($chapters as $k=>$chapter)
		<option value='{!! $chapter->id !!}'>{!! $chapter->chapter_name !!}</option>
	@endforeach
</select>