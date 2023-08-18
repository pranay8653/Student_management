@extends('layout.application')
@section('page_title', 'Student List ')
@section('student','active')
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
                                {{-- <a href="{{ route('teacher.pdf.list') }}" class="btn btn-outline-success m-2">Export All In PDF</a>
                                <a href="{{ route('export.teacher') }}" class="btn btn-outline-secondary m-2">Export All In Excel</a> --}}
                                <a href="{{ route('create.student') }}" class="btn btn-outline-info m-2"><i class="fa fa-plus" aria-hidden="true"> Add Student</i> </a>
                            </div>

                            <h1 class="display-5" > Total Number Of <span style="color: #d21a80">{{ $count }}</span> Students Of <span style="color: #d21a80">{{ $dept_count }}</span> Departments </h1>
                            <h1 class="display-5" > Student Lists</h1>
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
                                        <td style="color: #002b80; font-family: 'Bebas Neue', cursive;">
                                            <a href="{{ route('student.particular.list',['id' => $items->department->id]) }}">{{ $items->department->d_name }}</a>
                                        </td>
                                        {{-- <td>{{ $items->department->d_name }} </td> --}}
                                        <td>{{ $items->marks_10th }} </td>
                                        <td>{{ $items->percentage_10th }} </td>
                                        <td>{{ $items->hs_marks }} </td>
                                        <td>{{ $items->hs_percentage }} </td>

                                        <td style="color: #002b80; font-family: 'Bebas Neue', cursive;">
                                            <a href="{{ route('edit.student',['id' => $items->id]) }}" class="btn btn-warning" >Edit </a>
                                            {{-- <a href="{{ route('delete.teacher',['id' => $items->id]) }}" class="btn btn-danger" >Delete </a> --}}
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
                    <hr>
                    <div class="col-md-12 mx-auto">
                        <h2 style="color: #d21a80; font-family: 'Bebas Neue', cursive; text-align:center">List Of Departments </h2>
                        <div class="table-responsive" >
                            <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                <tbody style="font-family: 'Fjalla One', sans-serif;">
                                    <tr>
                                        @foreach ($dept as $item)
                                                <td><a href="{{ route('student.particular.list',['id' => $item-> id]) }}">{{ $item->d_name }}</a></td>
                                         @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
