@extends('layout.application')
@section('page_title', 'Create Department')
@section('departments','active')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <a href="{{ route('departments') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    <h2 class="card-title mb-3 text-dark" ><span style="color:rgb(240, 77, 180)">Edit Department Information</span></h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error  )
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                  <form action="{{route('update.department',['id' => $dept->id]) }}" method="POST" name="myForm" onsubmit="return validation()" class="user">
                    @csrf
                    @method('PUT')
                    <div class="row" >
                        <div class=" col-md-12 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">First Name </label>
                            <input type="hidden" class="form-control form-control-user" value="{{ $dept->id }}" name="id" id="FirstName" >
                            <input type="text" class="form-control form-control-user" value="{{ $dept->d_name }}" name="d_name" id="FirstName" >
                        </div>

                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary me-md-2" type="submit">Edit Department Name</button>
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
