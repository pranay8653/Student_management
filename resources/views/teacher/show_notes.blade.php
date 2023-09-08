@extends('layout.application')
@section('page_title', 'Show Notes')
@section('notes','active')
@section('content')

@if(session('create_notes'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('create_notes')}}
</div>
@endif
@if(session('delete_note'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('delete_note')}}
</div>
@endif

<div class="container-fluid">

{{--  function Of delete Reply via Ajax --}}
  <!-- Modal -->
  <div class="modal fade" id="deleteReplyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="form_data">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Study Note</h5>
        </div>
        <div class="modal-body">
             <input type="hidden" id="delete_reply_id">
            <h4>Are You sure ? Do You Want to Delete Your Study Note ?</h4>
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

    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <div class="table-responsive" >
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('create.notes') }}" class="btn btn-outline-primary m-2">Add Notes</a>
                        </div>
                        <ul id="saveform_errlist"></ul>
                        <div id="success_message"></div>
                        <h1 class="display-6" > Department   "{{ $department->d_name }}"</h1>
                        <h1 class="h4" >Total Number Of Study Notes:<span style="color: #d21a80"> {{ $notes_count }}</span> </h1>

                            <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                <thead style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Question</th>
                                        <th>Answers</th>
                                        <th>Note Created </th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                        <th>Total Conversation</th>
                                    </tr>
                                </thead>
                                <tfoot style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Question</th>
                                        <th>Answers</th>
                                        <th>Note Created </th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                        <th>Total Conversation</th>
                                    </tr>
                                </tfoot>
                                <tbody style="font-family: 'Fjalla One', sans-serif;">
                                @foreach ($notes as $items)
                                <tr>
                                    <td>{{ $items->studynote_title }} </td>
                                    <td> {{ Str::limit($items->studynote, 200) }}
                                        <a href="{{ route('load.notes',['id' =>$items->id ])}}" class="btn btn-primary">Load More</a>
                                    </td>

                                    <td>{{ $items->t_first_name }} {{ $items->t_last_name }} </td>
                                    <td>{{\Carbon\Carbon::parse($items->created_at)->isoFormat('DD / MMM / YYYY') }} </td>
                                    <td> <button type="button" value="{{ $items->id }}" class="delete_note btn btn-danger">Delete</button></td>
                                     @php
                                     {{  $querry_count = DB::table('querries')->where('studynotes_id',$items->id)->count();
                                         $reply_count =   DB::table('replies')->where('studynotes_id',$items->id)->count();
                                         $count_conversation =  $querry_count + $reply_count;
                                     }}
                                 @endphp
                                 <td>{{$count_conversation}} </td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div >
                                <p >
                                    {{ $notes->render('pagination::bootstrap-4') }}
                                </p>
                            </div>
                            <div>
                                Showing{{ $notes->firstItem() }} to {{ $notes->lastItem() }} of
                                {{ $notes->total() }} entries
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
     $(document).ready(function() {
        // delete data via ajax
        $(document).on('click','.delete_note', function () {
            var delete_reply_id = $(this).val();
            $('#delete_reply_id').val(delete_reply_id);
            $('#deleteReplyModal').modal('show');
        });

        $(document).on('click','.delete_reply_data', function () {
            var delete_reply_id = $('#delete_reply_id').val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "GET",
                url: "/teacher/delete/note/"+delete_reply_id,
                success: function (response){
                    $("#success_message").addClass('alert alert-success');
                    $("#success_message").text(response.message);
                    $('#deleteReplyModal').modal('hide');   // for hide model
                        // below function reload the page after 3 second
                        setTimeout(function(){// wait for 3 secs(2)
                            window.location.reload(); // then reload the page.(3)
                        }, 3000);

                }
            });
        });
     });
</script>

@endsection
