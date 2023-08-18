@extends('layout.application')
@section('page_title', 'Perticular Student List')
@section('student','active')
@section('content')

<div class="container-fluid">

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card mb-4 py-3 border-bottom-info">
                    <div class="card-body">
                        <div class="table-responsive" >
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                {{-- <a href="{{ route('teacher.particular.list.pdf',['id' => $department->id]) }}" class="btn btn-outline-success m-2">Export This Into PDF</a> --}}
                                <a href="{{ route('show.student') }}" class="btn btn-outline-info m-2">Return To Main List</a>
                            </div>

                            <h1 class="display-6" > Department Name: {{ $department->d_name }}</h1>
                            <h1 class="h4" >Total Number Of Student:<span style="color: #d21a80"> {{ $student_count }}</span> Of <span style="color: #d21a80">"{{ $department->d_name }}"</span> Department's </h1>

                                <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                    <thead style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                        <tr>
                                            <th>Full Name of Student</th>
                                            <th>Full Name of Guardian</th>
                                            <th>Guardian Phone Number</th>
                                            <th>Student Email Id</th>
                                            <th>Student Phone Number</th>
                                            <th>Address</th>
                                            <th>Date Of Birth</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Department</th>
                                            <th>10th Class Marks</th>
                                            <th>10th Class Percentage</th>
                                            <th>12th Class Marks</th>
                                            <th>12th Class Percentage</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                        <tr>
                                            <th>Full Name of Student</th>
                                            <th>Full Name of Guardian</th>
                                            <th>Guardian Phone Number</th>
                                            <th>Student Email Id</th>
                                            <th>Student Phone Number</th>
                                            <th>Address</th>
                                            <th>Date Of Birth</th>
                                            <th>Age</th>
                                            <th>Gender</th>
                                            <th>Department</th>
                                            <th>10th Class Marks</th>
                                            <th>10th Class Percentage</th>
                                            <th>12th Class Marks</th>
                                            <th>12th Class Percentage</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody style="font-family: 'Fjalla One', sans-serif;">
                                    @foreach ($student as $items)
                                    <tr>
                                        <td>{{ $items->first_name }} {{ $items->last_name }}</td>
                                        <td>{{ $items->guardian_name }} </td>
                                        <td>{{ $items->guardian_number }} </td>
                                        <td>{{ $items->email }} </td>
                                        <td>{{ $items->phone }} </td>
                                        <td>{{ $items->address }} </td>
                                        <td>{{ $items->dob }} </td>
                                        <td>{{ \Carbon\Carbon::parse($items->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days') }} </td>
                                        <td>{{ $items->gender }} </td>
                                        <td>{{ $items->department->d_name }} </td>
                                        <td>{{ $items->marks_10th }} </td>
                                        <td>{{ $items->percentage_10th }} </td>
                                        <td>{{ $items->hs_marks }} </td>
                                        <td>{{ $items->hs_percentage }} </td>
                                        <td style="color: #002b80; font-family: 'Bebas Neue', cursive;">
                                            <a href="{{ route('edit.student',['id' => $items->id]) }}" class="btn btn-warning" >Edit </a>
                                            <a href="{{ route('delete.student',['id' => $items->id]) }}" class="btn btn-danger" >Delete </a>
                                        </td>
                                    </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                <div >
                                    <p >
                                        {{ $student->render('pagination::bootstrap-4') }}
                                    </p>
                                </div>
                                <div>
                                    Showing{{ $student->firstItem() }} to {{ $student->lastItem() }} of
                                    {{ $student->total() }} entries
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
@endsection
