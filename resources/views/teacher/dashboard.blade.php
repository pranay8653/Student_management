@extends('layout.application')
@section('page_title', 'Teacher dashboard')
@section('teacher_dashboard','active')
@section('content')
@if(session('after_login'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{session('after_login')}}
</div>
@endif
@if(session('change_password'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{session('change_password')}}
@endif
</div>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Welcome <strong>{{ $teacher->first_name }} {{ $teacher->last_name }}</strong></h1>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Study Notes</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $notes_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Students Of Department </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Teachers Of Department </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $teacher_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <table class="table table-bordered "   >
                        <thead style="color: #d21a80; " >
                            <tr>
                                <th>List Of Question's </th>
                                <th>Created By</th>
                            </tr>
                        </thead>
                        <tbody style="color: #1d1ad2; " >
                            @foreach ($notes as $items)
                             <tr>
                                <td>{{ $items->studynote_title }}</td>
                                <td>{{ $items->t_first_name }} {{ $items->t_last_name }}</td>
                            </tr>
                            @endforeach
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
