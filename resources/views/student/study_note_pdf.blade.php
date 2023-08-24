<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Note Pdf</title>
</head>
<body >
    <h1 style="color: red; text-align: center;"><strong>EDUCARE COACHING CENTRE</strong></h1>
    <hr>
      <div class="row" >
            <div class="col-12">
                <h2>Question</h2>
                <pre>
                {{ $notes->studynote_title }}
                </pre>
            </div>
            <div class="col-12" >
                <h2>Answer</h2>
                <pre>
                {{ $notes->studynote }}
                </pre>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-4">
                <h3>Teacher's Name: <span style="color:blue">{{ $notes->t_first_name }} {{ $notes->t_last_name }}</span></h3>
            </div>
            <div class="col-4" >
               <h3> Department: <span style="color:blue">{{ $notes->department->d_name }}</span></h3>
            </div>
        </div>
    </div>

</body>
</html>
