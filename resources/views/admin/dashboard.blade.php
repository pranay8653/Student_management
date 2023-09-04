@extends('layout.application')
@section('page_title', 'Admin dashboard')
@section('admin_dashboard','active')
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
        <h1 class="h3 mb-0 text-gray-800">Welcome <strong>{{ $admin->first_name }} {{ $admin->last_name }}</strong></h1>
    </div>

    <div class="row">
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Departments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $department }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-secondary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Students </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $student }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Teachers </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $teacher }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fa fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
