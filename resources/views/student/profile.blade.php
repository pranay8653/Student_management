@extends('layout.application')
@section('page_title', 'Student profile')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <h2 class="card-title mb-3 text-dark" ><span style="color:rgb(240, 77, 180)">Personal Information</span></h2>


                    @if(session('admin_picture'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('admin_picture')}}
                        </div>
                    @endif
                    @if(session('admin_profile_update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('admin_profile_update')}}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label class="cardformlabel" for="Profile" style="color:blue">Your Profile Picture</label>
                            <div class="row">
                                <div class="col-sm-12 mr-2">
                                    <img src="{{ asset('upload/student/profile_picture/'.$profile->image) }}" class="img-fluid" alt="Student Profile piture">
                                    <form action="{{ route('student.profile.picture') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error  )
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <input type="file" placeholder="Insert your Image" name="image" >
                                    <button class="btn btn-primary md-3" type="submit">Change Profile Picture</button>
                                   </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row" >
                        <div class=" col-md-6 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">Student Name </label>
                            <h4>{{ $profile->first_name }} {{ $profile->last_name }}</h4>
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">Student Contact Number </label>
                            <h4>{{ $profile->phone }}</h4>
                        </div>
                    </div>
                    <div class="row" >
                        <div class=" col-md-6 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">Guardian Name </label>
                            <h4>{{ $student_data->guardian_name }} </h4>
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">Guardian Contact Number </label>
                            <h4>{{ $student_data->guardian_number }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="cardformlabel" for="email" style="color:blue">Student Email</label>
                            <h4>{{ $profile->email }}</h4>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact" class="cardformlabel" style="color:blue">Department</label>
                            <h4>{{ $student_data->department->d_name }}<h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label class="cardformlabel" for="email" style="color:blue">Address</label>
                            <h4>{{ $student_data->address }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="cardformlabel"  style="color:blue">Gender</label>
                            <h4>{{ $student_data->gender }}</h4>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact" class="cardformlabel" style="color:blue">Date Of Birth</label>
                            <h4>{{ $student_data->dob }}</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="cardformlabel"  style="color:blue">10th Class Obtained Marks</label>
                            <h4>{{ $student_data->marks_10th }}</h4>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact" class="cardformlabel" style="color:blue">10th Class Obtained Percentage</label>
                            <h4>{{ $student_data->percentage_10th }}%</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="cardformlabel"  style="color:blue">12th Class Obtained Marks</label>
                            <h4>{{ $student_data->hs_marks }}</h4>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact" class="cardformlabel" style="color:blue">12th Class Obtained Percentage</label>
                            <h4>{{ $student_data->hs_percentage }} %</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label class="cardformlabel" for="email" style="color:blue">Age</label>
                            <h4>{{ \Carbon\Carbon::parse($student_data->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days') }}</h4>
                        </div>
                        <div class="col-md-6 mb-6">
                            <label class="cardformlabel" for="email" style="color:blue">You Are</label>
                            <h4> {{ $profile->role }}</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label class="cardformlabel" for="email" style="color:blue">Profile Created</label>
                            <h4> {{ $profile->created_at->diffForHumans() }}</h4>
                        </div>
                    </div>
                    <hr>

                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                        <div class="btn-group mr-2" role="group" aria-label="First group">

                            <a href="{{ route('student.change.password') }}" class="btn btn-info ml-3"> <i class="fa fa-unlock" aria-hidden="true"> Change Password</i> </a>
                        </div>
                        <div class="btn-group mr-2" role="group" aria-label="Second group">
                            <a href="{{ route('student.profile.edit') }}" class="btn btn-success ml-3">Edit Profile</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
