@extends('layout.application')
@section('page_title', 'Perticular List')
@section('teachers','active')
@section('content')

<div class="container-fluid">

        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="card mb-4 py-3 border-bottom-info">
                    <div class="card-body">
                        <div class="table-responsive" >
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="{{ route('teacher.particular.list.pdf',['id' => $department->id]) }}" class="btn btn-outline-success m-2">Export This Into PDF</a>
                                <a href="{{ route('show.teacher') }}" class="btn btn-outline-info m-2">Return To Main List</a>
                            </div>

                            <h1 class="display-6" > Department Name: {{ $department->d_name }}</h1>
                            <h1 class="h4" >Total Number Of Teachers:<span style="color: #d21a80"> {{ $teacher_count }}</span> Of <span style="color: #d21a80">"{{ $department->d_name }}"</span> Department's </h1>

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
                                        <td>{{ $items->department->d_name }} </td>
                                        <td style="color: #002b80; font-family: 'Bebas Neue', cursive;">
                                            <a href="{{ route('edit.teacher',['id' => $items->id]) }}" class="btn btn-warning" >Edit </a>
                                            <a href="{{ route('delete.teacher',['id' => $items->id]) }}" class="btn btn-danger" >Delete </a>
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
                </div>
            </div>
        </div>

</div>
@endsection
