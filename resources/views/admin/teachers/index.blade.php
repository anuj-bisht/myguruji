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
	    <center><a class="btn btn-primary icon-btn add_button" style='float:none;' href="javascript:void(0);" onclick='return add_teacher();' ><i class="fa fa-plus"></i>Add Teacher</a></center>
	      <div class="table-responsive">
	        <table class="table table-hover table-bordered" id="sampleTable">
	          <thead>
	            <tr>
	              <th>SN</th>
	              <th>Name</th>
				  <th>Classes</th>
				  <th>Subjects</th>
				  <th>Action</th>
	            </tr>
	          </thead>
	          <tbody>
			  @foreach($teachers as $k=>$teacher)
	            <tr>
	              <td>{{ $k+1 }}</td>
	              <td>{!! $teacher->teacher_name !!}</td>
				  <td>
					@foreach($teacher->teacher_classes as $k=>$teacher_class)
					{!! $teacher_class->class_name !!}<br/>
					@endforeach
				  </td>
				  <td>
					@foreach($teacher->teacher_subjects as $k=>$teacher_subject)
					{!! $teacher_subject->subject_name !!}<br/>
					@endforeach
				  </td>
	              <td>
					<!--<a class="info" href="javascript:void(0);" onClick='return edit_teacher({!! $teacher->id !!});'><i class="fa fa-edit"></i></a>-->
					<a class="danger deleteteacher" href="javascript:void(0);" data-id='{!! $teacher->id !!}'><i class="fa fa-trash"></i></a>
				  </td>
	            </tr>
				@endforeach
	           </tbody>
	        </table>
			<center><a class="btn btn-primary icon-btn add_button" style='float:none;' href="javascript:void(0);" onclick='return add_teacher();' ><i class="fa fa-plus"></i>Add Teacher</a></center>
	     </div>
	    </div>
	  </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="add_teacher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Teacher</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id='add_teacher_body'>
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
	
	
	function add_teacher(){
		$.ajax({
               type:'GET',
               url:'add_teacher',
			   beforesend:function(){			  
                  $("#add_teacher").modal('show');
			   },
               success:function(data) {
				   $("#add_teacher").modal('show');
                  $("#add_teacher_body").html(data);
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
	
	$(document).on('submit','#add_teacher_form',function(event){
		event.preventDefault();
        $("#savBtn").html('Adding..');
		if($("#teacher_name").val() === '' ){
			swal('oops!','Please enter teacher name','error');
			$("#savBtn").html('Update');
			return false;
		}
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
		
        $.ajax({
          data: $('#add_teacher_form').serialize(),
          url: "add_teacher",
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
	
	function edit_teacher(teacher_id){
		$("#exampleModalLongTitle").html('Update Teacher');
		$.ajax({
               type:'GET',
               url:'teacher/edit/'+teacher_id,
			   beforesend:function(){			  
                  $("#add_teacher").modal('show');
			   },
               success:function(data) {
				   $("#add_teacher").modal('show');
                  $("#add_teacher_body").html(data);
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
	
	$(document).on('submit','#edit_teacher_form',function(event){
		event.preventDefault();
		var teacher_id = $("#teacher_id").val();
        $("#editBtn").html('Updating..');
		if($("#teacher_name").val() === '' ){
			swal('oops!','Please enter teacher name','error');
			$("#editBtn").html('Update');
			return false;
		}
		if($("#student_class").val() === '0' ){
			swal('oops!','Please select class','error');
			$("#editBtn").html('Update');
			return false;
		}
		if($("#subject").val() === '0' ){
			swal('oops!','Please select subject','error');
			$("#editBtn").html('Update');
			return false;
		}
		
        $.ajax({
          data: $('#edit_teacher_form').serialize(),
          url:'teacher/edit/'+teacher_id,
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
              $('#editBtn').html('Update');
          }
      });
	});
	
	$('body').on('click', '.deleteteacher', function () {

        var teacher_id = $(this).data("id");
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
            url: "teacher/delete/"+teacher_id,
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
       

$('#selectsubject').select2();
$('#selectclass').select2();

</script>

@endsection

