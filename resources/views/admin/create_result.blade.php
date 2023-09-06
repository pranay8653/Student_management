@extends('layout.application')
@section('page_title', 'Result')
@section('result','active')
@section('content')

@if(session('create_notes'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('create_notes')}}
</div>
@endif


<div class="container-fluid">

    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#resultModal">
                            Create Student result
                        </button>
                    </div>
                    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form  id="form_data">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Create Student Marks</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <select  name="student_id" id="student" class="form-control">
                                                <option value="">Select Student Name</option>
                                                @foreach ($student as $stu)
                                                <option value="{{ $stu->id }}">{{ $stu->first_name }} {{ $stu->last_name }}</option>
                                                @endforeach
                                            </select>
                                        <br>
                                            <select  id="department" class="form-control">
                                                <option value="">AutoSelect Department</option>
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                             <label for="recipient-name" class="col-form-label">Subject 1:</label>
                                            <input type="text"  class="sub1 form-control"  placeholder="Enter Marks of Subject 1">
                                        </div>
                                        <div class="mb-3">
                                             <label for="recipient-name" class="col-form-label">Subject 2:</label>
                                            <input type="text"  class="sub2 form-control"  placeholder="Enter Marks of Subject 2">
                                        </div>
                                        <div class="mb-3">
                                             <label for="recipient-name" class="col-form-label">Subject 3:</label>
                                            <input type="text"  class="sub3 form-control"  placeholder="Enter Marks of Subject 3">
                                        </div>
                                        <div class="mb-3">
                                             <label for="recipient-name" class="col-form-label">Subject 4:</label>
                                            <input type="text"  class="sub4 form-control"  placeholder="Enter Marks of Subject 4">
                                        </div>
                                        <div class="mb-3">
                                             <label for="recipient-name" class="col-form-label">Subject 5:</label>
                                            <input type="text"  class="sub5 form-control"  placeholder="Enter Marks of Subject 5">
                                        </div>
                                        <div class="mb-3">
                                             <label for="recipient-name" class="col-form-label">Subject 6:</label>
                                            <input type="text"  class="sub6 form-control"  placeholder="Enter Marks of Subject 6">
                                        </div>
                                        <div class="mb-3">
                                             <label for="recipient-name" class="col-form-label">Subject 7:</label>
                                            <input type="text"  class="sub7 form-control"  placeholder="Enter Marks of Subject 7">
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary add_result">Create</button>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <ul id="saveform_errlist"></ul>
                    <div id="success_message"></div>

                    <div class="table-responsive" >
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <div id="success_message"></div>
                            {{-- <a href="{{ route('create.notes') }}" class="btn btn-outline-primary m-2">Add Notes</a> --}}
                        </div>

                        {{-- <h1 class="display-6" > Department   "{{ $department->d_name }}"</h1>
                        <h1 class="h4" >Total Number Of Study Notes:<span style="color: #d21a80"> {{ $notes_count }}</span> </h1> --}}
                        <ul id="saveform_errlist"></ul>

                            <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                <thead style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Department Name</th>
                                        <th>Subject 1</th>
                                        <th>Subject 2</th>
                                        <th>Subject 3</th>
                                        <th>Subject 4</th>
                                        <th>Subject 5</th>
                                        <th>Subject 6</th>
                                        <th>Subject 7</th>
                                        <th>Total Marks</th>
                                        <th>Overall Percentage</th>
                                        <th>Overall Gread</th>
                                        <th>Created</th>

                                    </tr>
                                </thead>
                                <tfoot style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Department Name</th>
                                        <th>Subject 1</th>
                                        <th>Subject 2</th>
                                        <th>Subject 3</th>
                                        <th>Subject 4</th>
                                        <th>Subject 5</th>
                                        <th>Subject 6</th>
                                        <th>Subject 7</th>
                                        <th>Total Marks</th>
                                        <th>Overall Percentage</th>
                                        <th>Overall Gread</th>
                                        <th>Created</th>

                                    </tr>
                                </tfoot>
                                <tbody style="font-family: 'Fjalla One', sans-serif;">
                                    @foreach ($result as $item )
                                    <tr>
                                        <td>{{ $item->student->first_name }} {{ $item->student->last_name }} </td>
                                        <td>{{ $item->department_name->d_name }} </td>
                                        <td>{{ $item->sub_1 }} </td>
                                        <td>{{ $item->sub_2 }} </td>
                                        <td>{{ $item->sub_3 }} </td>
                                        <td>{{ $item->sub_4 }} </td>
                                        <td>{{ $item->sub_5 }} </td>
                                        <td>{{ $item->sub_6 }} </td>
                                        <td>{{ $item->sub_7 }} </td>
                                        <td>{{ $item->total }} </td>
                                        <td>{{ $item->percentage }}% </td>
                                        <td>{{ $item->grade }} </td>
                                        <td>{{\Carbon\Carbon::parse($item->created_at)->isoFormat('Do MMMM  YYYY') }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div >
                                <p >
                                    {{ $result->render('pagination::bootstrap-4') }}
                                </p>
                            </div>
                            <div>
                                Showing{{ $result->firstItem() }} to {{ $result->lastItem() }} of
                                {{ $result->total() }} entries
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
     $(document).ready(function() {
        // Auto Select Department
        $('#student').change(function() {
            var student_id = $(this).val();
            $('#department').html('<option value="">Select Department Name</option>')
            // alert(student_id);
            $.ajax({
                type: "POST",
                url: "/get_department",
                data: 'student_id='+student_id+'&_token={{ csrf_token() }}',
                success: function (result){
                    $('#department').html(result);
                }
            });
        });

        $(document).on('click', '.add_result', function(e){
            e.preventDefault();
            var data = {
                'student_id': $('#student').val(),
                'dept_id': $('#department').val(),
                'sub_1': $('.sub1').val(),
                'sub_2': $('.sub2').val(),
                'sub_3': $('.sub3').val(),
                'sub_4': $('.sub4').val(),
                'sub_5': $('.sub5').val(),
                'sub_6': $('.sub6').val(),
                'sub_7': $('.sub7').val(),

            }
            // console.log(data);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/save_result",
                data: data,
                datatype: "json",
                success: function (response){
                    // return(response);
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
                        $('#form_data').trigger('reset');// after submit refresh input field
                        $("#saveform_errlist").html("");
                        $("#success_message").html("");
                        $("#success_message").addClass('alert alert-success');
                        $("#success_message").text(response.message);
                        $('#resultModal').modal('hide');
                     }
                }
            });

          });

     });
</script>



@endsection
