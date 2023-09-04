@extends('layout.application')
@section('page_title', 'Show Notes')
@section('notes','active')
@section('content')

@if(session('note_update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('note_update')}}
    </div>
@endif

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <a href="{{ route('show.notes') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>

                    <div class="row">
                        <div class="col-3">
                            <label class="cardformlabel" for="name" style="color:blue">Study Note's Created by: </label>
                        </div>
                        <div class="col-6">
                            <h4><strong>{{ $notes->t_first_name }} {{ $notes->t_last_name }}</strong></h4>
                        </div>
                    </div>

                    <div class="row" >
                        <div class=" col-md-12 mb-3">
                            <input type="hidden" value="{{ $notes->id }}" class="note_id form-control">
                            <label class="cardformlabel" for="name" style="color:blue">Question </label>
                            <h4>{{ $notes->studynote_title }}</h4>
                        </div>

                        <div class="col-md-12 mb-3" >
                            <label class="cardformlabel" for="email" style="color:blue">Answer's</label>
                            <p >
                                <pre>
                                {{ $notes->studynote }}
                                </pre>
                            </p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('edit.notes',['id' => $notes->id]) }}" class="btn btn-primary btn-sm">Edit Note</a>
            </div>
            <div class="row">
                <div class="col-3">
                    <label class="cardformlabel" for="name" style="color:blue">Study Note's Created by: </label>
                </div>
                <div class="col-6">
                    <h4><strong>{{ $notes->t_first_name }} {{ $notes->t_last_name }}</strong></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="hidden" value="{{ Auth::id() }}" class="log_user_id form-control">
            <h3><center>Conversation</center></h3>
            <div class="d-flex justify-content-center"><strong>Total Conversation:</strong><strong style="color: blue"><div class="total_querry"></div></strong></div>
            <div id="success_message"></div>

                <div class="media-body">
                    <div class="media-body">
                        <div class="querry_reply"></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{--  function Of update Instruction  via Ajax --}}
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="form_data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Your Instruction</h5>
        </div>
        <div class="modal-body">

            <ul id="updateform_errlist"></ul>
            <input type="hidden" id="edit_querry_id">

          <div class="form-froup">
            <label>Edit Your Instruction</label>
            <textarea id="edit_querry" cols="30" rows="4" class="update_querry form-control" placeholder="Enter Your Querry Here"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary update_student">Update </button>
        </div>
        </form>
      </div>
    </div>
  </div>
{{-- End function Of update Instruction via Ajax --}}

{{--  function Of delete Instruction via Ajax --}}
  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="form_data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Your Instruction</h5>
        </div>
        <div class="modal-body">
             <input type="hidden" id="delete_stu_id">
            <h4>Are You sure ? Want to Delete Your Instruction ?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-warning delete_querry">Yes </button>
        </div>
        </form>
      </div>
    </div>
  </div>
{{-- End Function Of delete Instruction via Ajax --}}

{{--  function Of Add Teacher's Reply via Ajax --}}
  <!-- Modal -->
  <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="add_reply_data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"> Teacher's Reply </h5>
        </div>
        <div class="modal-body">

            <ul id="Replyform_errlist"></ul>
            <input type="hidden" id="querry_id">

          <div class="form-froup">
            <label>Add Reply</label>
            <textarea id="querry_reply_data" cols="30" rows="4" class="add_reply form-control" placeholder="Enter Your Reply Here"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary add_reply">Reply </button>
        </div>
        </form>
      </div>
    </div>
  </div>
{{-- End function Of Add Teacher's Reply via Ajax --}}

{{--  function Of Teacher's Reply update via Ajax --}}
  <!-- Modal -->
  <div class="modal fade" id="teacherReplyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="form_data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Your Reply</h5>
        </div>
        <div class="modal-body">

            <ul id="updateform_errlist"></ul>

            <input type="hidden" id="edit_reply_id">

          <div class="form-froup">
            <label>Edit Your Reply</label>
            <textarea id="edit_reply_data" cols="30" rows="4" class="update_reply_data form-control" placeholder="Enter Your Reply Here"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary update_reply">Update Your Reply </button>
        </div>
        </form>
      </div>
    </div>
  </div>
{{-- End function Of Teacher's Reply update via Ajax --}}

{{--  function Of delete Reply via Ajax --}}
  <!-- Modal -->
  <div class="modal fade" id="deleteReplyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="form_data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Your Reply</h5>
        </div>
        <div class="modal-body">
             <input type="hidden" id="delete_reply_id">
            <h4>Are You sure ? Want to Delete Your Reply ?</h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-warning delete_reply_data">Yes </button>
        </div>
        </form>
      </div>
    </div>
  </div>
{{-- End function Of delete Reply via Ajax --}}

    {{-- Enter Teacher Instruction --}}
    <h6 class="mt-5 mb-3 text-center">Write Instruction here</h6>
    <hr>
    <form id="add_quuerry_data">
        <ul id="saveform_errlist"></ul>
        <div class="form-row">
            <div class="col-12 form-group">
                <textarea id="" cols="30" rows="4" class="instruction form-control" placeholder="Enter Your Instruction Here"></textarea>
            </div>
            <div class="form-group col-12">
                <button class="btn btn-info btn-block add_instruction">Enter Instruction</button>
            </div>
        </div>
    </form>

</div>
<script>
    $(document).ready(function() {
        showquerry();
        //Show Querry
        function showquerry()
        {
            var note_id = $('.note_id').val();
            var auth = $('.log_user_id').val(); // find login user id
            $.ajax({
                type: "GET",
                url: "/teacher/show/querry/"+note_id,
                success: function (response){
                    var countquerry = response.count_conversation;   // querry_count is response
                        $('.total_querry').text(countquerry); // print Single value Show
                        $('.querry_reply').html("");
                        var s_role = "student";
                    $.each(response.querry, function (key,item){

                        if(item.user_id == auth) // this if function written as only login user can modify
                        {
                            $('.querry_reply').append('<hr><h2 class="mt-0"><strong>'+item.user_role+'</strong></h2> <h5><strong>Instruction: </strong>'+item.querry+'</h5><button type="button"  value="'+item.id+'" class="edit_querry badge badge-pill badge-info">Edit</button> <button type="button" value="'+item.id+'" class="delete_querry_data badge badge-pill badge-danger">Delete</button> ');
                        }
                        else if(item.user_role ==  s_role)
                        {
                            $('.querry_reply').append('<hr><h2 class="mt-0">'+item.user.first_name+' '+item.user.last_name+'(<strong>'+item.user_role+'</strong>)</h2> <h5><strong>Queries: </strong>'+item.querry+'</h5> <button type="button" value="'+item.id+'" class="reply badge badge-pill badge-secondary">Reply</button> </div> ');
                        }

                        // nested if
                        $.each(item.replies, function (key1,item1) // replies is relatioship name
                        {
                            // $('.querry_reply').append('<p><strong>answer: </strong>'+item1.reply+'</p>');
                            $('.querry_reply').append('<div class="media-body align-items-center"> <h2 class="mt-0"><strong>'+item1.user_role+'</strong></h2> </><p><strong>Answer: </strong>'+item1.reply+'</p> </div><button type="button"  value="'+item1.id+'" class="edit_reply badge badge-pill badge-info">Edit</button> <button type="button" value="'+item1.id+'" class="delete_reply badge badge-pill badge-danger">Delete</button>');

                        });

                    });
                 }
            });
        }

        //open reply panel function vai ajax
        $(document).on('click', '.reply', function (e) {
            e.preventDefault();
            var querry_id = $(this).val();
            // console.log(querry_id);
            $('#replyModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/teacher/open/reply/"+querry_id,
                success: function (response){
                    // console.log(response);
                    if(response.status == 404)
                    {
                        $("#success_message").html("");
                        $("#success_message").addClass('alert alert-danger');
                        $("#success_message").text(response.message);
                    }else {
                        // this function show old data
                        $('#edit_querry').val(response.querry_id.querry);
                        $('#querry_id').val(querry_id);
                    }
                }
            });
        });

        // Add Reply function via ajax
        $(document).on('click', '.add_reply', function(e) {
            e.preventDefault();
            var querry_id = $('#querry_id').val();
            var data = {
                'reply': $('#querry_reply_data').val(),
                'querry_id' : querry_id,
                'studynotes_id': $('.note_id').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/teacher/querry/reply",
                data: data,
                datatype: "json",
                success: function (response){
                    if(response.status == 404)
                      {
                        $("#Replyform_errlist").html("");
                        $("#success_message").addClass('alert alert-success');
                        $("#success_message").text(response.message);
                      }
                    else if( response.status == 400)
                     {
                        $("#Replyform_errlist").html("");
                        $("#Replyform_errlist").addClass('alert alert-danger');
                        // $.each is jquerry foreach loop
                        $.each(response.errors, function (key, err_values) {
                            $('#Replyform_errlist').append('<li>'+err_values+'</li>');
                        });
                     }
                    else
                     {
                        $('#add_reply_data').trigger('reset');
                        $("#Replyform_errlist").html("");
                        $("#success_message").html("");
                        $("#success_message").addClass('alert alert-success');
                        $("#success_message").text(response.message);
                        $('#replyModal').modal('hide');   // for hide model
                        showquerry(); // after add data. show data list
                     }
                }
            });
        });

        // Add Querry
        $(document).on('click', '.add_instruction', function(e) {
            e.preventDefault();
            var data = {
                'querry': $('.instruction').val(),
                'studynotes_id': $('.note_id').val(),
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/teacher/create/instruction",
                data: data,
                datatype: "json",
                success: function (response){
                    if(response.status == 400)
                     {
                        $("#saveform_errlist").html("");
                        $("#saveform_errlist").addClass('alert alert-danger');
                        // $.each is jquerry foreach loop
                        $.each(response.errors, function (key, err_values) {
                            $('#saveform_errlist').append('<li>'+err_values+'</li>');
                        });
                     }
                     else
                     {
                        $("#saveform_errlist").html("");
                        $("#success_message").addClass('alert alert-success');
                        $('#add_quuerry_data').trigger('reset');// after submit refresh input field
                        $("#success_message").text(response.message);
                        showquerry(); // after add data. show data list
                     }
                }
            });
        });

        //edit function using ajax
        $(document).on('click', '.edit_querry', function (e) {
            e.preventDefault();
            var querry_id = $(this).val();
            // console.log(stu_id);
            $('#editModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/teacher/edit/querry/"+querry_id,
                success: function (response){
                    // console.log(response);
                    if(response.status == 404)
                    {
                        $("#success_message").html("");
                        $("#success_message").addClass('alert alert-danger');
                        $("#success_message").text(response.message);
                    }else {
                        // this function show old data
                        $('#edit_querry').val(response.querry_id.querry);
                        $('#edit_querry_id').val(querry_id);
                    }
                }
            });
        });

        // Update function via ajax
        $(document).on('click', '.update_student', function(e) {
            e.preventDefault();
            $(this).text("Updating");
            var querry_id = $('#edit_querry_id').val();
            var data = {
                'querry': $('#edit_querry').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/teacher/update/querry/"+querry_id,
                data: data,
                datatype: "json",
                success: function (response){
                    // console.log(response);
                    if( response.status == 400)
                     {
                        $("#updateform_errlist").html("");
                        $("#updateform_errlist").addClass('alert alert-danger');
                        // $.each is jquerry foreach loop
                        $.each(response.errors, function (key, err_values) {
                            $('#updateform_errlist').append('<li>'+err_values+'</li>');
                        });
                        $('.update_student').text("Update");
                     }
                     else if(response.status == 404)
                      {
                        $("#updateform_errlist").html("");
                        $("#success_message").addClass('alert alert-success');
                        $("#success_message").text(response.message);
                        $('.update_student').text("Update");
                      }
                      else
                     {
                        $("#updateform_errlist").html("");
                        $("#success_message").html("");
                        $("#success_message").addClass('alert alert-success');
                        $("#success_message").text(response.message);
                        $('#editModal').modal('hide');   // for hide model
                        $('.update_student').text("Update");
                        showquerry(); // after add data. show data list
                     }
                }
            });
        });

        // delete data via ajax
        $(document).on('click','.delete_querry_data', function (e) {
            e.preventDefault();
            var delete_querry_id = $(this).val();
            $('#delete_stu_id').val(delete_querry_id);
            $('#deleteModal').modal('show');
        });
        $(document).on('click','.delete_querry', function (e) {
            e.preventDefault(); // this function used not reload the page
            var delete_querry_id = $('#delete_stu_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "GET",
                url: "/teacher/delete/querry/"+delete_querry_id,
                success: function (response){
                    $("#success_message").addClass('alert alert-success');
                    $("#success_message").text(response.message);
                    $('#deleteModal').modal('hide');   // for hide model
                    showquerry(); // show function . dono't write this, so not show data
                }
            });
        });

        //edit Your Reply function using ajax
        $(document).on('click', '.edit_reply', function (e) {
            e.preventDefault();
            var reply_id = $(this).val();
            $('#teacherReplyModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/teacher/edit/reply/"+reply_id,
                success: function (response){
                    // console.log(response);
                    if(response.status == 404)
                    {
                        $("#success_message").html("");
                        $("#success_message").addClass('alert alert-danger');
                        $("#success_message").text(response.message);
                    }else {
                        // this function show old data
                        $('#edit_reply_data').val(response.reply_id.reply);
                        $('#edit_reply_id').val(reply_id);
                    }
                }
            });
        });

        // Update Reply function via ajax
        $(document).on('click', '.update_reply', function(e) {
            e.preventDefault();
            var reply_id = $('#edit_reply_id').val();
            var data = {
                'reply': $('#edit_reply_data').val(),
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "PUT",
                url: "/teacher/update/reply/"+reply_id,
                data: data,
                datatype: "json",
                success: function (response){
                    if( response.status == 400)
                     {
                        $("#updateform_errlist").html("");
                        $("#updateform_errlist").addClass('alert alert-danger');
                        // $.each is jquerry foreach loop
                        $.each(response.errors, function (key, err_values) {
                            $('#updateform_errlist').append('<li>'+err_values+'</li>');
                        });
                     }
                     else if(response.status == 404)
                      {
                        $("#updateform_errlist").html("");
                        $("#success_message").addClass('alert alert-success');
                        $("#success_message").text(response.message);
                      }
                      else
                     {
                        $("#updateform_errlist").html("");
                        $("#success_message").html("");
                        $("#success_message").addClass('alert alert-success');
                        $("#success_message").text(response.message);
                        $('#teacherReplyModal').modal('hide');   // for hide model
                        showquerry(); // after add data. show data list
                     }
                }
            });
        });

        // delete data via ajax
        $(document).on('click','.delete_reply', function (e) {
            e.preventDefault();
            var delete_reply_id = $(this).val();
            $('#delete_reply_id').val(delete_reply_id);
            $('#deleteReplyModal').modal('show');
        });

        $(document).on('click','.delete_reply_data', function (e) {
            e.preventDefault(); // this function used not reload the page
            var delete_reply_id = $('#delete_reply_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "GET",
                url: "/teacher/delete/reply/"+delete_reply_id,
                success: function (response){
                    $("#success_message").addClass('alert alert-success');
                    $("#success_message").text(response.message);
                    $('#deleteReplyModal').modal('hide');   // for hide model
                    showquerry(); // show function . dono't write this, so not show data
                }
            });
        });
    });
</script>
@endsection
