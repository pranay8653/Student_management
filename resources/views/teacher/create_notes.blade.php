@extends('layout.application')
@section('page_title', 'Create Notes')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <a href="{{ route('show.notes') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    <h2 class="card-title mb-3 text-dark" ><span style="color:rgb(240, 77, 180)">Create Note</span></h2>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error  )
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                  <form action="{{ route('save.notes') }}" method="POST" name="myForm" class="user">
                    @csrf

                    <div class="row" >
                        <div class="col-md-12 mb-12">
                            <label class="cardformlabel" for="email" style="color:blue">Enter Question</label>
                            <label for="aadress"> </label>
                                <textarea type="text" class="form-control " id="Address" cols="30" rows="4"
                                name="studynote_title" > </textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label class="cardformlabel" for="email" style="color:blue">Enter Answer</label>
                            <label for="aadress"> </label>
                                <textarea type="text" class="form-control " id="Address" cols="30" rows="8"
                                name="studynote" > </textarea>
                        </div>
                    </div>
                    <br>

                    <button type="submit" class="btn btn-primary btn-user btn-block">Submit </button>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
