@extends('layout.application')
@section('page_title', 'dashboard')
@section('content')
@if(session('after_login'))
<div class="alert alert-info alert-dismissible fade show" role="alert">
    {{session('after_login')}}
@endif
</div>
    testing middleware checking
@endsection
