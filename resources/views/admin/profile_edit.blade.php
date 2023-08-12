@extends('layout.application')
@section('page_title', 'Edit Admin Profile')
@section('content')



<div class="container-fluid">
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="card mb-4 py-3 border-bottom-info">
                <div class="card-body">
                    <a href="{{ route('admin.profile') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
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
                  <form action="{{ route('admin.profile.update') }}" method="POST" name="myForm" onsubmit="return validation()" class="user">
                    @csrf
                    @method('PUT')
                    <div class="row" >
                        <div class=" col-md-6 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">First Name </label>
                            <input type="text" class="form-control form-control-user" value="{{ $admin_data->first_name }}" name="first_name" id="FirstName" >
                            <span id="firstnameerror" class="text-danger"></span>
                        </div>
                        <div class=" col-md-6 mb-3">
                            <label class="cardformlabel" for="name" style="color:blue">Last Name </label>
                            <input type="text" class="form-control form-control-user" value=" {{ $admin_data->last_name }} " name="last_name" id="LastName" >
                            <span id="lastnameerror" class="text-danger  "></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="cardformlabel" for="email" style="color:blue">Email</label>
                            <h4>{{ $admin_data->email }}</h4>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact" class="cardformlabel" style="color:blue">Contact</label>
                            <input type="text" class="form-control form-control-user" value="{{ $admin_data->phone }}" id="PhoneNumber" name="phone" onkeypress="return isNumber(event)" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label class="cardformlabel" for="email" style="color:blue">Address</label>
                            <label for="aadress"> </label>
                                <textarea type="text" class="form-control form-control-user" id="Address" cols="30" rows="3"
                                placeholder="Enter Your Address" name="address">{{ $admin_data->address }}</textarea>
                                <span id="addresserror" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="cardformlabel" for="email" style="color:blue">Gender</label>
                            <div class="form-group">
                                <label for="">Gender: </label>
                             <div class="col-sm-6 mb-3 mb-sm-0">
                                 <input type="radio" name="gender" value="male" {{ $admin_data->gender == 'male' ? 'checked' : '' }} >
                                 <label for="male ">Male</label><br>
                                 <input type="radio" name="gender"  value="female" {{ $admin_data->gender == 'female' ? 'checked' : '' }}>
                                 <label for="female ">Female</label><br>
                                 <input type="radio" name="gender"  value="others" {{ $admin_data->gender == 'others' ? 'checked' : '' }}>
                                 <label for="others">Other</label>
                             </div>
                            </div>
                            {{-- <h4>{{ $profile->gender }}</h4> --}}
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="contact" class="cardformlabel" style="color:blue">Date Of Birth</label>
                            <input type="date" class="form-control form-control-user"
                                        id="dob" name="dob" id="dob" value="{{ $admin_data->dob }}">
                                        <span id="doberror" class="text-danger  "></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-12">
                            <label class="cardformlabel" for="email" style="color:blue">Age</label>
                            <h4>{{ \Carbon\Carbon::parse($admin_data->dob)->diff(\Carbon\Carbon::now())->format('%y years, %m months and %d days') }}</h4>
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
        var PhoneNumber = document.forms["myForm"]["PhoneNumber"].value;


        // regex pattern
        var fnamecheck = /^[A-Za-z. ]{3,20}$/;
        var lnamecheck = /^[A-Za-z. ]{3,20}$/;
        var addresscheck = /^[A-Za-z: A-Za-z0-9(A-Za-z0-9)\S][^~!@#$%^]{3,300}$/;
        var phonecheck = /^[0-9]{10}$/;


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

   // this function used for . Only Number Allowed
   function isNumber(evt) {
            evt = (evt) ? evt : window.event;
            var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
        }

    $(document).ready(function(){
        $('#FirstName,#LastName,#Email,#Address,#PhoneNumber,#Image').focus(function(){
            $(this).css('background-color','#FFE17B');
        });

        $('#FirstName,#LastName,#Email,#Address,#PhoneNumber,#Image').blur(function(){
            $(this).css('background-color','');
        });

        $('#FirstName,#LastName,#Email,#Address,#PhoneNumber,#Image').keypress(function(){
            $(this).css('background-color','#FD8D14');
        });
    });


</script>
@endsection
