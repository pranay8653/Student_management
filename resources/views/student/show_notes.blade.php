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
                        <h1 class="display-6" > Department   "{{ $department->d_name }}"</h1>
                        <h1 class="h4" >Total Number Of Study Notes:<span style="color: #d21a80"> {{ $notes_count }}</span> </h1>

                            <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                <thead style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Question</th>
                                        <th>Answers</th>
                                        <th>Techer's Name</th>
                                        <th>Created At</th>
                                        <th>Total Conversation</th>
                                    </tr>
                                </thead>
                                <tfoot style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Question</th>
                                        <th>Answers</th>
                                        <th>Techer's Name</th>
                                        <th>Created At</th>
                                        <th>Total Conversation</th>


                                    </tr>
                                </tfoot>
                                <tbody style="font-family: 'Fjalla One', sans-serif;">
                                @foreach ($notes as $items)
                                <tr>
                                    <td>{{ $items->studynote_title }} </td>
                                    <td> {{ Str::limit($items->studynote, 200) }}
                                        <a href="{{ route('student.load.notes',['id' =>$items->id ])}}" class="btn btn-primary">Load More</a>
                                    </td>
                                    <td>{{ $items->t_first_name }} {{ $items->t_last_name }}</td>
                                    <td>{{\Carbon\Carbon::parse($items->created_at)->isoFormat('DD / MMM / YYYY') }} </td>
                                    {{-- total Conversation --}}
                                    @php
                                        {{  $querry_count = DB::table('querries')->where('studynotes_id',$items->id)->count();
                                            $reply_count =   DB::table('replies')->where('studynotes_id',$items->id)->count();
                                            $count_conversation =  $querry_count + $reply_count;
                                        }}
                                    @endphp
                                    <td>{{$count_conversation}} </td>
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
