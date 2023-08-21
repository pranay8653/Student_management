<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Student List</title>
</head>
<body >
    {{-- <div width="50%"> --}}

        <h1 class="display-3" > Student List</h1>
        <h1 class="display-6" > Total Number Of Student: {{ $count }}</h1>
            <table class="table table-bordered table-striped" >
                <thead style="color: #d21a80;">
                    <tr class="table-active">
                        <th style="font-size: 5px;">Full Name of Student</th>
                        <th style="font-size: 5px;">Full Name of Guardian</th>
                        <th style="font-size: 5px;">Guardian Phone Number</th>
                        <th style="font-size: 5px;">Student Email Id</th>
                        <th style="font-size: 5px;">Student Phone Number</th>
                        <th style="font-size: 5px;">Address</th>
                        <th style="font-size: 5px;">Date Of Birth</th>
                        <th style="font-size: 5px;">Age</th>
                        <th style="font-size: 5px;">Gender</th>
                        <th style="font-size: 5px;">Department</th>
                        <th style="font-size: 5px;">10th Class Marks</th>
                        <th style="font-size: 5px;">10th Class Percentage</th>
                        <th style="font-size: 5px;">12th Class Marks</th>
                        <th style="font-size: 5px;">12th Class Percentage</th>
                    </tr>
                </thead>
                <tbody style="color: #1d1ad2; " >
                    @foreach ($student as $items)
                    <tr >
                        <td style="font-size: 5px;">{{ $items->first_name }} {{ $items->last_name }}</td>
                        <td style="font-size: 5px;">{{ $items->guardian_name }} </td>
                        <td style="font-size: 5px;">{{ $items->guardian_number }} </td>
                        <td style="font-size: 5px;">{{ $items->email }} </td>
                        <td style="font-size: 5px;">{{ $items->phone }} </td>
                        <td style="font-size: 5px;">{{ $items->address }} </td>
                        <td style="font-size: 5px;">{{ $items->dob }} </td>
                        <td style="font-size: 5px;">{{ \Carbon\Carbon::parse($items->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days') }} </td>
                        <td style="font-size: 5px;">{{ $items->gender }} </td>
                        <td style="font-size: 5px;">{{ $items->department->d_name }} </td>
                        <td style="font-size: 5px;">{{ $items->marks_10th }} </td>
                        <td style="font-size: 5px;">{{ $items->percentage_10th }} </td>
                        <td style="font-size: 5px;">{{ $items->hs_marks }} </td>
                        <td style="font-size: 5px;">{{ $items->hs_percentage }} </td>
                    </tr>
                    @endforeach
                    </tbody>
            </table>
    </div>


</body>
</html>
