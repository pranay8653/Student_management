@extends('layout.application')
@section('page_title', 'Show Teacher')
@section('teachers','active')
@section('content')

@if(session('department_edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('department_edit')}}
    </div>
@endif
@if(session('teacher_registration'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('teacher_registration')}}
    </div>
@endif
@if(session('teacher_update'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('teacher_update')}}
    </div>
@endif
@if(session('teacher_delete'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('teacher_delete')}}
    </div>
@endif

<div class="container-fluid">

        <div class="row">
            <div class="col-md-12 mx-auto">
                <div class="card mb-4 py-3 border-bottom-info">
                    <div class="card-body">
                        <div class="table-responsive" >
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('teacher.pdf.list') }}" class="btn btn-outline-success m-2">Export All In PDF</a>
                                <a href="{{ route('export.teacher') }}" class="btn btn-outline-secondary m-2">Export All In Excel</a>
                                <a href="{{ route('create.teacher') }}" class="btn btn-outline-info m-2"> <i class="fa fa-plus" aria-hidden="true"> Add Teacher</i></a>
                            </div>

                            <ul id="saveform_errlist"></ul>
                            <div id="success_message"></div>
                            <h1 class="display-5" > Total Number Of <span style="color: #d21a80">{{ $count }}</span> Teachers Of <span style="color: #d21a80">{{ $dept_count }}</span> Departments </h1>
                            <h1 class="display-5" > Teacher Lists</h1>
                                <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                    <thead style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                        <tr>
                                            <th>Full Name of teacher</th>
                                            <th>Email Id</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Date Of Birth</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                        <tr>
                                            <th>Full Name of teacher</th>
                                            <th>Email Id</th>
                                            <th>Phone Number</th>
                                            <th>Address</th>
                                            <th>Date Of Birth</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Department</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody style="font-family: 'Fjalla One', sans-serif;">
                                    @foreach ($teacher as $items)
                                    <tr>
                                        <td>{{ $items->first_name }} {{ $items->last_name }}</td>
                                        <td>{{ $items->email }} </td>
                                        <td>{{ $items->phone }} </td>
                                        <td>{{ $items->address }} </td>
                                        <td>{{ $items->dob }} </td>
                                        <td>{{ \Carbon\Carbon::parse($items->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days') }} </td>
                                        <td>{{ $items->gender }} </td>
                                        <td style="color: #002b80; font-family: 'Bebas Neue', cursive;">
                                            <a href="{{ route('teacher.particular.list',['id' => $items->department->id]) }}">{{ $items->department->d_name }}</a>
                                        </td>
                                        <td style="color: #002b80; font-family: 'Bebas Neue', cursive;">
                                            <a href="{{ route('edit.teacher',['id' => $items->id]) }}" class="btn btn-warning" >Edit </a>
                                             <button type="button" value="{{ $items->id }}" class="delete_teacher btn btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div >
                                    <p >
                                        {{ $teacher->render('pagination::bootstrap-4') }}
                                    </p>
                                </div>
                                <div>
                                    Showing{{ $teacher->firstItem() }} to {{ $teacher->lastItem() }} of
                                    {{ $teacher->total() }} entries
                                </div>
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12 mx-auto">
                        <h2 style="color: #d21a80; font-family: 'Bebas Neue', cursive; text-align:center">List Of Departments </h2>
                        <div class="table-responsive" >
                            <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                <tbody style="font-family: 'Fjalla One', sans-serif;">
                                    <tr>
                                        @foreach ($dept as $item)
                                                <td><a href="{{ route('teacher.particular.list',['id' => $item-> id]) }}">{{ $item->d_name }}</a></td>
                                         @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    {{--  function Of delete teacher data via Ajax --}}
    <!-- Modal -->
    <div class="modal fade" id="deleteReplyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <form id="form_data">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Delete Teacher Details</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" id="delete_reply_id">
                <h4>Are You sure ? Do You Want to Delete This Teacher details ?</h4>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-warning delete_reply_data">Yes </button>
            </div>
            </form>
        </div>
        </div>
    </div>
{{-- End function Of delete teacher data via Ajax --}}
</div>
<script>
    $(document).ready(function() {
       // delete data via ajax
       $(document).on('click','.delete_teacher', function () {
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
               url: "/admin/delete/teacher/"+delete_reply_id,
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
