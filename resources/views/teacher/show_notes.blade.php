@extends('layout.application')
@section('page_title', 'Show Notes')
@section('notes','active')
@section('content')

@if(session('create_notes'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('create_notes')}}
</div>
@endif
@if(session('delete_note'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('delete_note')}}
</div>
@endif

<div class="container-fluid">

    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <div class="table-responsive" >
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('create.notes') }}" class="btn btn-outline-primary m-2">Add Notes</a>
                        </div>

                        <h1 class="display-6" > Department   "{{ $department->d_name }}"</h1>
                        <h1 class="h4" >Total Number Of Notes:<span style="color: #d21a80"> {{ $notes_count }}</span> </h1>

                            <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                <thead style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Question</th>
                                        <th>Answers</th>
                                        <th>Created At</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tfoot style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Question</th>
                                        <th>Answers</th>
                                        <th>Created At</th>
                                        <th>Actions</th>


                                    </tr>
                                </tfoot>
                                <tbody style="font-family: 'Fjalla One', sans-serif;">
                                @foreach ($notes as $items)
                                <tr>
                                    <td>{{ $items->studynote_title }} </td>
                                    <td> {{ Str::limit($items->studynote, 200) }}
                                        <a href="{{ route('load.notes',['id' =>$items->id ])}}" class="btn btn-primary">Load More</a>
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($items->created_at)->isoFormat('DD / MMM / YYYY') }} </td>
                                    <td> <a href="{{ route('delete.notes',['id' =>$items->id ]) }} " class="btn btn-danger" >Delete </a></td>
                                </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div >
                                <p >
                                    {{ $notes->render('pagination::bootstrap-4') }}
                                </p>
                            </div>
                            <div>
                                Showing{{ $notes->firstItem() }} to {{ $notes->lastItem() }} of
                                {{ $notes->total() }} entries
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
