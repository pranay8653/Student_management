@extends('layout.application')
@section('page_title', 'Result')
@section('result','active')
@section('content')

@if(session('create_notes'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{session('create_notes')}}
</div>
@endif


<div class="container-fluid">

    <div class="row">
        <div class="col-md-12 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('export.result.particular.department') }}" class="btn btn-outline-secondary m-2">Export All In Excel</a>
                        </div>

                    <ul id="saveform_errlist"></ul>
                    <div id="success_message"></div>

                    <h1 class="display-5" > Student Result Lists</h1>
                    <div class="table-responsive" >
                            <table class="table table-bordered" id="dataTable"  cellspacing="0">
                                <thead style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Department Name</th>
                                        <th>Subject 1</th>
                                        <th>Subject 2</th>
                                        <th>Subject 3</th>
                                        <th>Subject 4</th>
                                        <th>Subject 5</th>
                                        <th>Subject 6</th>
                                        <th>Subject 7</th>
                                        <th>Total Marks</th>
                                        <th>Overall Percentage</th>
                                        <th>Overall Gread</th>
                                        <th>Created</th>

                                    </tr>
                                </thead>
                                <tfoot style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Department Name</th>
                                        <th>Subject 1</th>
                                        <th>Subject 2</th>
                                        <th>Subject 3</th>
                                        <th>Subject 4</th>
                                        <th>Subject 5</th>
                                        <th>Subject 6</th>
                                        <th>Subject 7</th>
                                        <th>Total Marks</th>
                                        <th>Overall Percentage</th>
                                        <th>Overall Gread</th>
                                        <th>Created</th>

                                    </tr>
                                </tfoot>
                                <tbody style="font-family: 'Fjalla One', sans-serif;">
                                    @foreach ($result as $item )
                                    <tr>
                                        <td>{{ $item->student->first_name }} {{ $item->student->last_name }} </td>
                                        <td>{{ $item->department_name->d_name }} </td>
                                        <td>{{ $item->sub_1 }} </td>
                                        <td>{{ $item->sub_2 }} </td>
                                        <td>{{ $item->sub_3 }} </td>
                                        <td>{{ $item->sub_4 }} </td>
                                        <td>{{ $item->sub_5 }} </td>
                                        <td>{{ $item->sub_6 }} </td>
                                        <td>{{ $item->sub_7 }} </td>
                                        <td>{{ $item->total }} </td>
                                        <td>{{ $item->percentage }}% </td>
                                        <td>{{ $item->grade }} </td>
                                        <td>{{\Carbon\Carbon::parse($item->created_at)->isoFormat('Do MMMM  YYYY') }}</td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div >
                                <p >
                                    {{ $result->render('pagination::bootstrap-4') }}
                                </p>
                            </div>
                            <div>
                                Showing{{ $result->firstItem() }} to {{ $result->lastItem() }} of
                                {{ $result->total() }} entries
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
