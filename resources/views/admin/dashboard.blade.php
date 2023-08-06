@extends('layout.application')
@section('page_title', 'Admin dashboard')
@section('content')
@if(session('after_login'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{session('after_login')}}
@endif
@if(session('change_password'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{session('change_password')}}
@endif
</div>
    Admin dashboard
@endsection
