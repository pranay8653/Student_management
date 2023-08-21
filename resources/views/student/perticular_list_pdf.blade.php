<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Teacher List</title>
</head>
<body>
    <div width="50%">

        {{-- <h1 class="display-3" > Teacher List</h1> --}}
        <h1 class="display-6" > Total Number Of Teachers: <span style="color: #d21a80">{{ $count }}</span> Of <span style="color: #d21a80">"{{ $department->d_name }}"</span> Department's </h1>
    </h1>

            <table class="table table-bordered"   >
                <thead style="color: #d21a80; " >
                    <tr>
                        <th>Full Name of teacher</th>
                        <th>Email Id</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th>Date Of Birth</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Department</th>
                    </tr>
                </thead>
                <tbody style="color: #1d1ad2; " >
                    @foreach ($teacher as $items)
                    <tr>
                        <td  style="font-size: 10px;">{{ $items->first_name }} {{ $items->last_name }}</td>
                        <td  style="font-size: 10px;" >{{ $items->email }} </td>
                        <td  style="font-size: 10px;">{{ $items->phone }} </td>
                        <td  style="font-size: 10px;">{{ $items->address }} </td>
                        <td  style="font-size: 10px;">{{ $items->dob }} </td>
                        <td  style="font-size: 10px;">{{ \Carbon\Carbon::parse($items->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days') }} </td>
                        <td  style="font-size: 10px;">{{ $items->gender }} </td>
                        <td  style="font-size: 10px;">{{ $items->department->d_name }} </td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
    </div>


</body>
</html>
