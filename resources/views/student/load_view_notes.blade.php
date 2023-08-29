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
                    <a href="{{ route('student.show.notes') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    {{-- <a href="" class="btn btn-primary btn-sm">Get PDF</a> --}}
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('student.pdf.notes',['id' => $notes->id]) }}" class="btn btn-outline-primary m-2">Get Notes In PDF</a>
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
                <a href="{{ route('student.pdf.notes',['id' => $notes->id]) }}" class="btn btn-primary btn-sm">Get Notes In PDF</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <input type="hidden" value="{{ Auth::id() }}" class="log_user_id form-control">
            <h3><center>Querries</center></h3>
            <div class="d-flex justify-content-center"><strong>Total Querries:</strong><strong style="color: blue"><div class="total_querry"></div></strong></div>
            {{-- <div class="display-flex"></div> --}}
            <div class="querry_reply">
            </div>
        </div>
    </div>

    {{--  function Of update Data via Ajax --}}
  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="form_data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

            <ul id="updateform_errlist"></ul>

            <input type="text" id="edit_querry_id">

          <div class="form-froup">
            <label>Edit Querry</label>
            <textarea id="edit_querry" cols="30" rows="4" class=" form-control" placeholder="Enter Your Querry Here"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary update_student">Save </button>
        </div>
        </form>
      </div>
    </div>
  </div>

{{-- End edit function  Data via Ajax --}}

  <h6 class="mt-5 mb-3 text-center">Write Your Querry</h6>
    <div id="success_message"></div>
    <hr>
    <form id="form_data">
        <ul id="saveform_errlist"></ul>
        <div class="form-row">
            <div class="col-12 form-group">
                {{-- <input type="hidden" name="slug" value=" "> --}}
                <textarea id="" cols="30" rows="4" class="querry form-control" placeholder="Enter Your Querry Here"></textarea>
            </div>
            <div class="form-group col-12">
                <button class="btn btn-info btn-block add_querry">Enter Querry</button>
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
            var auth = $('.log_user_id').val(); // find login user
            $.ajax({
                type: "GET",
                url: "/show/querry/"+note_id,
                success: function (response){
                    var countquerry = response.querry_count;   // querry_count is response
                        $('.total_querry').text(countquerry); // print Single value Show
                        $('.querry_reply').html("");
                    $.each(response.querry, function (key,item){
                        if(item.user_id == auth)
                        {
                            $('.querry_reply').append('<h2>'+item.user.first_name+' '+item.user.last_name+'('+item.user_role+') </h2><h5><strong>Question:</strong> '+item.querry+'</h5><button type="button"  value="'+item.id+'" class="edit_querry badge badge-pill badge-info">Edit</button> <button type="button" value="'+item.id+'" class="delete_student badge badge-pill badge-danger">Delete</button>');
                        }
                        else
                        {
                            $('.querry_reply').append('<h2>'+item.user.first_name+' '+item.user.last_name+'('+item.user_role+') </h2><h5><strong>Question:</strong> '+item.querry+'</h5>');
                        }
                    });
                 }
            });
        }

        // edit function vai ajax
        $(document).on('click', '.edit_querry', function (e) {
            e.preventDefault();
            var querry_id = $(this).val();
            // console.log(stu_id);
            $('#editModal').modal('show');
            $.ajax({
                type: "GET",
                url: "/edit/querry/"+querry_id,
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

        // Add Querry
        $(document).on('click', '.add_querry', function(e) {
            e.preventDefault();
            var data = {
                'querry': $('.querry').val(),
                'studynotes_id': $('.note_id').val(),
            }
            // console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "/create/querry",
                data: data,
                datatype: "json",
                success: function (response){
                    // console.log(response);
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
                        $('#form_data').trigger('reset');// after submit refresh input field
                        $("#success_message").text(response.message);
                        showquerry();; // after add data. show data list
                     }
                }
            });
        });
   });
</script>
@endsection
