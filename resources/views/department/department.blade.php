@extends('layout.application')
@section('page_title', 'Department List')
@section('departments','active')
@section('content')

@if(session('department_edit'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('department_edit')}}
    </div>
@endif

@if(session('department'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{session('department')}}
    </div>
@endif

@if(session('delete_department'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{session('delete_department')}}
    </div>
@endif

@if(session('import_excel'))
    <div class="alert alert-info alert-dismissible fade show" role="alert">
        {{session('import_excel')}}
    </div>
@endif
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error  )
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

<div class="container-fluid">

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Add Department
                        </button>
                    </div>
                    <h1 class="display-5" > Department</h1>
                    <h1 class="display-6" > Total Number Of Departments: {{ $d_count }}</h1>
                                      <!-- Button trigger modal -->
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <form action="{{ route('save.department') }}" method="POST">
                                @csrf
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Create Department</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form>
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Department Name:</label>
                                                <input type="text" class="form-control" id="recipient-name" name="d_name" placeholder="Enter Department name">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Create</button>
                                            </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>

                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                <tr>
                                    <th>Name of Departments</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot style="color: #d21a80; font-family: 'Bebas Neue', cursive;">
                                <tr>
                                    <th>Name of Departments</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody style="font-family: 'Fjalla One', sans-serif;">
                               @foreach ($dept as $department)
                               <tr>
                                   <td>{{ $department->d_name }}</td>
                                  <td style="color: #002b80; font-family: 'Bebas Neue', cursive;">
                                    <a href="{{ route('edit.department',['id' =>$department->id ]) }}" class="btn btn-warning" >Edit </a>
                                    {{-- <a href="{{ route('delete.department',['id' =>$department->id ]) }}" class="btn btn-danger" >Delete </a> --}}
                                  </td>
                               </tr>
                               @endforeach
                            </tbody>
                        </table>

                        <div class="row">
                            <h1>Import Department Name</h1>
                            <div class="col-md-9">
                            <form action="{{ route('import.department') }} " method="POST" enctype="multipart/form-data" >
                                @csrf
                                    <input type="file" name="file" class="form-control" >
                                    <p style="color: #e70c10;" > Only Upload .xlsx, .xls Excel File </p>
                                </div>
                                <div class="col-md-3">
                                        <button type="submit" class="btn btn-warning" > Import File</button>
                                </div>
                            </form>
                        </div>

                        <div >
                            <p >
                                {{ $dept->render('pagination::bootstrap-4') }}
                            </p>
                        </div>
                        <div>
                            Showing{{ $dept->firstItem() }} to {{ $dept->lastItem() }} of
                            {{ $dept->total() }} entries
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
