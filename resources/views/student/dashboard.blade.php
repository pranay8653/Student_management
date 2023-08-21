@extends('layout.application')
@section('page_title', 'Student dashboard')
@section('student_dashboard','active')
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
    Student's dashboard
@endsection
