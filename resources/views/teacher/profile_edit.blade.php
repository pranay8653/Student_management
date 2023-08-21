@extends('layout.application')
@section('page_title', 'Edit Teacher Profile')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <a href="{{ route('teacher.profile') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                    <h2 class="card-title mb-3 text-dark" ><span style="color:rgb(240, 77, 180)">Edit Personal Information</span></h2>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error  )
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                  <form action="{{ route('teacher.profile.update') }}" method="POST" name="myForm" onsubmit="return validation()" class="user">
                    @csrf
                    @method('PUT')
                    <div class="row" >
                        <div class=" col-md-6 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">First Name </label>
                            <input type="text" class="form-control form-control-user" value="{{ $teacher_data->first_name }}" name="first_name" id="FirstName" >
                            <span id="firstnameerror" class="text-danger"></span>
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">Last Name </label>
                            <input type="text" class="form-control form-control-user" value=" {{ $teacher_data->last_name }} " name="last_name" id="LastName" >
                            <span id="lastnameerror" class="text-danger  "></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label class="cardformlabel" for="email" style="color:blue">Address</label>
                            <label for="aadress"> </label>
                                <textarea type="text" class="form-control form-control-user" id="Address" cols="30" rows="3"
                                placeholder="Enter Your Address" name="address">{{ $teacher_data->address }}</textarea>
                                <span id="addresserror" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="cardformlabel" for="email" style="color:blue">Gender</label>
                            <div class="form-group">
                                <label for="">Gender: </label>
                             <div class="col-sm-6 mb-3 mb-sm-0">
                                 <input type="radio" name="gender" value="male" {{ $teacher_data->gender == 'male' ? 'checked' : '' }} >
                                 <label for="male ">Male</label><br>
                                 <input type="radio" name="gender"  value="female" {{ $teacher_data->gender == 'female' ? 'checked' : '' }}>
                                 <label for="female ">Female</label><br>
                                 <input type="radio" name="gender"  value="others" {{ $teacher_data->gender == 'others' ? 'checked' : '' }}>
                                 <label for="others">Other</label>
                             </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact" class="cardformlabel" style="color:blue">Date Of Birth</label>
                            <input type="date" class="form-control form-control-user"
                                        id="dob" name="dob" id="dob" value="{{ $teacher_data->dob }}">
                                        <span id="doberror" class="text-danger  "></span>
                        </div>
                    </div>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button class="btn btn-primary me-md-2" type="submit">Edit Your Profile</button>
                            </div>
                    </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function validation()
    {
        var FirstName = document.forms["myForm"]["FirstName"].value;
        var LastName = document.forms["myForm"]["LastName"].value;
        var address = document.forms["myForm"]["address"].value;

        // regex pattern
        var fnamecheck = /^[A-Za-z. ]{3,20}$/;
        var lnamecheck = /^[A-Za-z. ]{3,20}$/;
        var addresscheck = /^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/;

        if (FirstName.match(fnamecheck)) {
            document.getElementById('firstnameerror').innerHTML = " ";
            } else {
            document.getElementById('firstnameerror').innerHTML = "**Should not contain digits and special characters in First Name**";
            return false;
        }
        if (LastName.match(lnamecheck)) {
            document.getElementById('lastnameerror').innerHTML = " ";
            } else {
            document.getElementById('lastnameerror').innerHTML = "**Should not contain digits and special characters in last Name**";
            return false;
        }

        if (address.match(addresscheck)) {
            document.getElementById('addresserror').innerHTML = " ";
            } else {
            document.getElementById('addresserror').innerHTML = "**Enter Your Personal Address Within 3-300Character but Not used ~!@#$%^ character **";
            return false;
        }
        if (PhoneNumber.match(phonecheck)) {
            document.getElementById('phoneerror').innerHTML = " ";
            } else {
            document.getElementById('phoneerror').innerHTML = "**Enter Your Personal valid 10 digit mobile number**";
            return false;
        }
  }

    $(document).ready(function(){
        $('#FirstName,#LastName,#Email,#Address,#Image').focus(function(){
            $(this).css('background-color','#FFE17B');
        });

        $('#FirstName,#LastName,#Email,#Address,#Image').blur(function(){
            $(this).css('background-color','');
        });

        $('#FirstName,#LastName,#Email,#Address,#Image').keypress(function(){
            $(this).css('background-color','#FD8D14');
        });
    });

</script>
@endsection
