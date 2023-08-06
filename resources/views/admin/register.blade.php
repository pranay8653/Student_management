@extends('layout.application_outside')
@section('page_title', 'Register ')
@section('content')
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5" style="background-color: #FFF4F4">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                {{-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> --}}
                <div class="col-lg-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create Your Account!</h1>
                        </div>

                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error  )
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                          @endif

                        <form action="{{ route('admin.save.register') }}" method="POST" name="myForm" onsubmit="return validation()" class="user">
                            @csrf

                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="FirstName"
                                        placeholder="First Name" name="first_name" value="{{ old('first_name') }}" >

                                        <span id="firstnameerror" class="text-danger"></span>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="LastName"
                                        placeholder="Last Name" name="last_name" value="{{ old('last_name') }}">
                                        <span id="lastnameerror" class="text-danger  "></span>
                                </div>
                            </div>

                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="Email"
                                    placeholder="Email Address" name="email" value="{{ old('email') }}">
                                    <span id="emailerror" class="text-danger  "></span>
                            </div>

                            <div class="form-group">
                                <label for="aadress"> </label>
                                <textarea type="text" class="form-control form-control-user" id="Address" cols="30" rows="3"
                                placeholder="Enter Your Address" name="address">{{ old('address') }}</textarea>

                                <span id="addresserror" class="text-danger"></span>

                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                        id="PhoneNumber" placeholder="Enter Your Phone Number" name="phone" value="{{ old('phone') }}" onkeypress="return isNumber(event)">
                                        <span id="phoneerror" class="text-danger  "></span>
                                </div>
                                <div class="col-sm-6">
                                    <input type="date" class="form-control form-control-user"
                                        id="dob" name="dob" value="{{ old('dob') }}">
                                        <span id="doberror" class="text-danger  "></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Gender: </label>
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="radio" id="" name="gender" value="male" checked>
                                    <label for="male ">Male</label>
                                    <input type="radio" id="" name="gender" value="female">
                                    <label for="female ">Female</label>
                                    <input type="radio" id="" name="gender" value="others">
                                    <label for="others">Other</label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary btn-user btn-block">Register Account </button>
                        </form>

                        <hr>
                        <div class="text-center">
                            <a class="small" href="forgot-password.html">Forgot Password?</a>
                        </div>
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
            var Email = document.forms["myForm"]["Email"].value;
            var address = document.forms["myForm"]["address"].value;
            var PhoneNumber = document.forms["myForm"]["PhoneNumber"].value;
            var dob = document.forms["myForm"]["dob"].value;


            // regex pattern
            var fnamecheck = /^[A-Za-z. ]{3,20}$/;
            var lnamecheck = /^[A-Za-z. ]{3,20}$/;
            var emailcheck = /^[a-zA-Z0-9+_.-]+@[a-z]+\.[a-z]{2,4}$/;
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
            if (Email.match(emailcheck)) {
                document.getElementById('emailerror').innerHTML = " ";
                } else {
                document.getElementById('emailerror').innerHTML = "**Please Enter those types 'test@test.com or 22pM13per@test.com' pattern Valid Email **";
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
            if(dob == "")
             {
                document.getElementById('doberror').innerHTML = "**Please Select Date of birth! **";
            return false;
             }else
             {
                document.getElementById('doberror').innerHTML = "";
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
