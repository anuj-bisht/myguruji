@extends('layouts.admin')

@section('content')

<div class="app-title">
  <div>
    <h1><i class="fa fa-dashboard"></i> Chapters</h1>
    <p>View,add,edit chapters</p>
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
	    <center><a class="btn btn-primary icon-btn add_button" style='float:none;' href="javascript:void(0);" onclick='return add_chapter();' ><i class="fa fa-plus"></i>Add Chapter</a></center>
	      <div class="table-responsive">
	        <table class="table table-hover table-bordered" id="sampleTable">
	          <thead>
	            <tr>
	              <th>SN</th>
	              <th>Chapter Name</th>
				  <th>Classes</th>
				  <th>Subjects</th>
				  <th>Teacher Name</th>
				  <th>Action</th>
	            </tr>
	          </thead>
	          <tbody>
			  @foreach($chapters as $k=>$chapter)
	            <tr>
	              <td>{{ $k+1 }}</td>
	              <td>{!! $chapter->chapter_name !!}</td>
				  <td>{!! $chapter->class !!}</td>
				  <td>{!! $chapter->subject_name !!}</td>
				  <td>{!! $chapter->teacher_name !!}</td>
				  
	              <td>
					<a class="info" href="javascript:void(0);" onClick='return edit_chapter({!! $chapter->id !!});'><i class="fa fa-edit"></i></a>
					<a class="danger deletechapter" href="javascript:void(0);" data-id='{!! $chapter->id !!}'><i class="fa fa-trash"></i></a>
				  </td>
	            </tr>
				@endforeach
	           </tbody>
	        </table>
			<center><a class="btn btn-primary icon-btn add_button" style='float:none;' href="javascript:void(0);" onclick='return add_chapter();' ><i class="fa fa-plus"></i>Add Chapter</a></center>
	     </div>
	    </div>
	  </div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="add_chapter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Chapter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id='add_chapter_body'>
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
	
	
	function add_chapter(){
		$.ajax({
               type:'GET',
               url:'add_chapter',
			   beforesend:function(){			  
                  $("#add_chapter").modal('show');
			   },
               success:function(data) {
				   $("#add_chapter").modal('show');
                  $("#add_chapter_body").html(data);
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
	
	$(document).on('submit','#add_chapter_form',function(event){
		event.preventDefault();
        $("#savBtn").html('Adding..');
		if($("#chapter_name").val() === '' ){
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
		if($("#teacher").val() === '0' ){
			swal('oops!','Please select teacher','error');
			$("#savBtn").html('Add');
			return false;
		}
		
        $.ajax({
          data: $('#add_chapter_form').serialize(),
          url: "add_chapter",
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
	
	function edit_chapter(chapter_id){
		$("#exampleModalLongTitle").html('Update Chapter');
		$.ajax({
               type:'GET',
               url:'chapter/edit/'+chapter_id,
			   beforesend:function(){			  
                  $("#add_chapter").modal('show');
			   },
               success:function(data) {
				   $("#add_chapter").modal('show');
                  $("#add_chapter_body").html(data);
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
	
	$(document).on('submit','#edit_chapter_form',function(event){
		event.preventDefault();
		var teacher_id = $("#chapter_id").val();
        $("#editBtn").html('Updating..');
		if($("#chapter_name").val() === '' ){
			swal('oops!','Please enter Chapter name','error');
			$("#editBtn").html('Update');
			return false;
		}
		
        $.ajax({
          data: $('#edit_chapter_form').serialize(),
          url:'chapter/edit/'+chapter_id,
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
	
	$('body').on('click', '.deletechapter', function () {

        var chapter_id = $(this).data("id");
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
            url: "chapter/delete/"+chapter_id,
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
$('#selectteacher').select2();

</script>

@endsection

