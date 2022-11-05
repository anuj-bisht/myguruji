@extends('layouts.admin')

@section('content')

<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Tutorials</h1>
    <p>View,add,edit tutorials</p>
  </div>
  <ul class="app-breadcrumb breadcrumb">
    <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
  </ul>
</div>

<div class="row">
	<div class="col-md-12">
	  <div class="tile">
	    <div class="tile-body">
	    <center><a class="btn btn-primary icon-btn add_button" style='float:none;' href="javascript:void(0);" onclick='return add_video();' ><i class="fa fa-plus"></i>Add Tutorial	</a></center>
	      <div class="table-responsive">
	        <table class="table table-hover table-bordered" id="sampleTable">
	          <thead>
	            <tr>
	              <th>SN</th>
	              <th>Name</th>
	              <th>Link</th>
				  <th>Code</th>
	              <th>Desc</th>
	              <th>Class</th>
	              <th>Subject</th>
	              <th>Chapter</th>
				  <th>Is Free</th>
				  <th>Action</th>
	            </tr>
	          </thead>
	          <tbody>
			  @foreach($tutorials as $k=>$tutorial)
	            <tr>
	              <td>{{ $k+1 }}</td>
	              <td>{!! $tutorial->video_name !!}</td>
	              <td><a href='{!! $tutorial->video_link !!}' target='_blank'>{!! $tutorial->video_link !!}</a></td>
				  <td>{!! $tutorial->video_embeded_code !!}</td>
	              <td><em>{!! $tutorial->video_description !!}</em></td>
	              <td>{!! $tutorial->class_name !!}</td>
	              <td>{!! $tutorial->subject_name !!}</td>
	              <td>{!! $tutorial->chapter_name !!}</td>
				  <td>{{ ($tutorial->is_free == 1) ? 'yes' : 'No'  }}</td>
	              <td>
					<a class="info" href="javascript:void(0);" onClick='return edit_video({!! $tutorial->id !!});'><i class="fa fa-edit"></i></a>
					<a class="danger deleteCustomer" href="javascript:void(0);" data-id='{!! $tutorial->id !!}'><i class="fa fa-trash"></i></a>
				  </td>
	            </tr>
				@endforeach
	           </tbody>
	        </table>
	     </div>
		 <center><a class="btn btn-primary icon-btn add_button" style='float:none;' href="javascript:void(0);" onclick='return add_video();' ><i class="fa fa-plus"></i>Add Tutorial	</a></center>
	    </div>
	  </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="add_video" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Tutorials</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id='add_video_body'>
        Loading......
      </div>
    </div>
  </div>
</div>

@endsection


@section('client_side_scripting')

<script>

$.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });
	
	
	function add_video(){
		$.ajax({
               type:'GET',
               url:'add_tutorial',
			   beforesend:function(){			  
                  $("#add_video").modal('show');
			   },
               success:function(data) {
				   $("#add_video").modal('show');
                  $("#add_video_body").html(data);
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
	
	$(document).on('submit','#add_video_form',function(event){
		event.preventDefault();
        $("#savBtn").html('Adding..');
		if($("#student_class").val() === '0' ){
			swal('oops!','Please select class','error');
			$("#savBtn").html('Add');
			return false;
		}
		if($("#subject").val() === '0' ){
			swal('oops!','Please select subject','error');
			$("#savBtn").html('Add');
			return false;
		}
		if($("#teacher").val() === '0' ){
			swal('oops!','Please select teacher','error');
			$("#savBtn").html('Add');
			return false;
		}
		if($("#video_name").val().trim() === ''){
			swal('oops!','Please enter video name','error');
			$("#savBtn").html('Add');
			return false;
		}
		if($("#video_link").val().trim() === '' ){
			swal('oops!','Please enter video link','error');
			$("#savBtn").html('Add');
			return false;
		}
        $.ajax({
          data: $('#add_video_form').serialize(),
          url: "add_tutorial",
          type: "POST",
          dataType: 'json',
          success: function (data) {
			  if(data.status === 200){
              swal('yuppi!!',data.msg,'success');
              location.reload(true);
			  }else{
				swal('Oops!!',data.msg,'error');
			  }

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
	});
	
	function edit_video(video_id){
		$("#exampleModalLongTitle").html('Update Tutorial');
		$.ajax({
               type:'GET',
               url:'tutorial/edit/'+video_id,
			   beforesend:function(){			  
                  $("#add_video").modal('show');
			   },
               success:function(data) {
				   $("#add_video").modal('show');
                  $("#add_video_body").html(data);
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
	
/* 	$(document).on('click','#saveBtn',function (e) {
		 e.preventDefault();
        $(this).html('Sending..');

        $.ajax({
          data: $('#add_video_form').serialize(),
          url: "",
          type: "POST",
          dataType: 'json',
          success: function (data) {

              $('#add_video_form').trigger("reset");
              $('#add_video').modal('hide');
              location.reload(true);

          },
          error: function (data) {
              console.log('Error:', data);
              $('#saveBtn').html('Save Changes');
          }
      });
	}) */
	
	$(document).on('submit','#edit_video_form',function(event){
		event.preventDefault();
		var video_id = $("#video_tutorial_id").val();
        $("#edtBtn").html('Updating..');
		if($("#student_class").val() === '0' ){
			swal('oops!','Please select class','error');
			$("#savBtn").html('Add');
			return false;
		}
		if($("#subject").val() === '0' ){
			swal('oops!','Please select subject','error');
			$("#savBtn").html('Add');
			return false;
		}
		if($("#teacher").val() === '0' ){
			swal('oops!','Please select teacher','error');
			$("#savBtn").html('Add');
			return false;
		}
		if($("#video_name").val().trim() === ''){
			swal('oops!','Please enter video name','error');
			$("#savBtn").html('Add');
			return false;
		}
		if($("#video_link").val().trim() === '' ){
			swal('oops!','Please enter video link','error');
			$("#savBtn").html('Add');
			return false;
		}
        $.ajax({
          data: $('#edit_video_form').serialize(),
          url:'tutorial/edit/'+video_id,
          type: "POST",
          dataType: 'json',
          success: function (data) {
			  if(data.status === 200){
              swal('yuppi!!',data.msg,'success');
              location.reload(true);
			  }else{
				swal('Oops!!',data.msg,'error');
			  }

          },
          error: function (data) {
              console.log('Error:', data);
              $('#editBtn').html('Save Changes');
          }
      });
	});
	
	$('body').on('click', '.deleteCustomer', function () {

        var video_tutorial_id = $(this).data("id");
        swal({
      		title: "Are you sure?",
      		text: "do you want to delete ?",
      		type: "warning",
      		showCancelButton: true,
      		confirmButtonText: "Yes, delete it!",
      		cancelButtonText: "No, cancel plx!",
      		closeOnConfirm: false,
      		closeOnCancel: true
      	}, function(isConfirm) {
      		if (isConfirm) {
      			$.ajax({
            type: "DELETE",
            url: "tutorial/delete/"+video_tutorial_id,
			dataType: 'json',
            success: function (data) {
                if(data.status === 200){
				  swal('yuppi!!',data.msg,'success');
				  location.reload(true);
				  }else{
					swal('Oops!!',data.msg,'error');
				  }
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
      		} else {
      			//swal("Cancelled", "Your imaginary file is safe :)", "error");
      		}
      	});

    });
       

</script>

@endsection

