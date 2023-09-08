<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Mark Sheet</title>
</head>
<body>
    <div class="border">
        <div class="container">
            <h2 ><strong style="color:#1a1aff "><center>EDUCARE COACHING CENTRE</center></strong></h2>

            <div class="row">
                <div class="col-1"></div>
                <div class="col-10">
                    @foreach ($result as $item )
                    <h5 >Name<strong style="color:#1a1aff "> {{ $item->student->first_name }}  {{ $item->student->last_name }}</strong></h5>
                    <h5 >Guardien Name<strong style="color:#1a1aff "> {{ $item->student->guardian_name }} </strong></h5>
                    <h5 >Department Name<strong style="color:#1a1aff "> {{ $item->department_name->d_name }} </strong></h5>
                    @endforeach
                </div>
            </div>

            <div class="row">
                {{-- <div class="col-1"></div> --}}
                <div class="col-10">
                    @foreach ($result as $item )
                        <table  class="table table-bordered table-striped" >
                            <thead style="color: #d21a80; font-family: 'Bebas Neue', cursive;" >
                            <tr>
                                <th><center>Subject</center></th>
                                <th><center>Full Marks</center></th>
                                <th><center>Obtained Marks</center></th>
                            </tr>
                            </thead>
                                <tbody style="font-family: 'Fjalla One', sans-serif">
                                <td> <center>Subject 1</center></td>
                                <td>  <center>100 </center></td>
                                <td>  <center>{{ $item->sub_1 }}</center> </td>
                                </tbody>

                                <tbody style="font-family: 'Fjalla One', sans-serif">
                                <td> <center>Subject 2</center></td>
                                <td>  <center>100 </center></td>
                                <td>  <center>{{ $item->sub_2 }}</center> </td>
                                </tbody>
                                <tbody style="font-family: 'Fjalla One', sans-serif">
                                <td> <center>Subject 3</center></td>
                                <td>  <center>100 </center></td>
                                <td>  <center>{{ $item->sub_3 }}</center> </td>
                                </tbody>
                                <tbody style="font-family: 'Fjalla One', sans-serif">
                                <td> <center>Subject 4</center></td>
                                <td>  <center>100 </center></td>
                                <td>  <center>{{ $item->sub_4 }}</center> </td>
                                </tbody>
                                <tbody style="font-family: 'Fjalla One', sans-serif">
                                <td> <center>Subject 5</center></td>
                                <td>  <center>100 </center></td>
                                <td>  <center>{{ $item->sub_5 }}</center> </td>
                                </tbody>
                                <tbody style="font-family: 'Fjalla One', sans-serif">
                                <td> <center>Subject 6</center></td>
                                <td>  <center>100 </center></td>
                                <td>  <center>{{ $item->sub_6 }}</center> </td>
                                </tbody>
                                <tbody style="font-family: 'Fjalla One', sans-serif">
                                <td> <center>Subject 7</center></td>
                                <td>  <center>100 </center></td>
                                <td>  <center>{{ $item->sub_7 }}</center> </td>
                                </tbody>
                                <tbody style="font-family: 'Fjalla One', sans-serif">
                                <td> <center>Total</center></td>
                                <td>  <center>700 </center></td>
                                <td>  <center>{{ $item->total }}</center> </td>
                                </tbody>
                        </table>
                </div>
                @endforeach
            </div>
            @foreach ($result as $item )
            <div class="row">
                <div class="col-3">
                    <p>Overall Percentage <span><strong>{{  $item->percentage }}</strong>%</span> </p>
                </div>
                <div class="col-3">
                    <p>Obtained Gread<span><strong>{{  $item->grade }}</strong></span>  </p>
                </div>
                <div class="col-3">
                    <p><span><strong>{{\Carbon\Carbon::parse($item->created_at)->isoFormat('Do MMMM  YYYY') }}</strong></span></p>
                </div>
            </div>

            @endforeach

        </div>
        </div>
    </div>
</body>
</html>
