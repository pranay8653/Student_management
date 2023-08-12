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

<div class="container-fluid">

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('create.teacher') }}" class="btn btn-info">Add Teacher</a>
                    </div>
                    <h1 class="display-5" > Teacher List</h1>
                    <h1 class="display-6" > Total Number Of Teachers: {{ $count }}</h1>

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                    <a href="#" class="btn btn-danger" >Delete </a>
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
@endsection
