@extends('layout.application')
@section('page_title', 'Show Notes')
@section('notes','active')
@section('content')

@if(session('note_update'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('note_update')}}
                        </div>
                    @endif
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <a href="{{ route('student.show.notes') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    {{-- <a href="" class="btn btn-primary btn-sm">Get PDF</a> --}}
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('student.pdf.notes',['id' => $notes->id]) }}" class="btn btn-outline-primary m-2">Get Notes In PDF</a>
                    </div>
                    <div class="row" >
                        <div class=" col-md-12 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">Question </label>
                            <h4>{{ $notes->studynote_title }}</h4>
                        </div>

                        <div class="col-md-12 mb-3" >
                            <label class="cardformlabel" for="email" style="color:blue">Answer's</label>
                            <p >
                                <pre>
                                {{ $notes->studynote }}
                                </pre>
                            </p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('student.pdf.notes',['id' => $notes->id]) }}" class="btn btn-primary btn-sm">Get Notes In PDF</a>
            </div>
        </div>
    </div>
</div>

@endsection
