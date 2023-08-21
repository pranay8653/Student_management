@extends('layout.application_outside')
@section('page_title', 'reset password')
@section('content')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Conform Create New Password</h1>
                                </div>

                                @if(session('forgot_otp'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        {{session('forgot_otp')}}
                                    </div>
                                @endif

                                <form action="{{ route('reset.forgot.password') }}" class="sign-up-form" method="post" name="myForm" onsubmit="return validation()">
                                    @csrf

                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error  )
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                  @endif

                                    <div class="form-group">
                                        <label style="color:brown">Enter Token</label>
                                        <input type="text" class="form-control form-control-user"
                                             placeholder="Please Enter Your Token" id="token" name="token" value="{{ old('token') }}" >

                                            <span id="tokenerror" class="text-danger font-weight-bold"></span>
                                    </div>

                                    <div class="form-group">
                                        <label style="color:brown">Enter Password</label>
                                        <input type="password" class="form-control form-control-user"
                                            id="password" placeholder="Password" name="password">
                                            <span id="passworderror" class="text-danger font-weight-bold"></span>
                                    </div>
                                    <div class="form-group">
                                        <label style="color:brown">Enter Confirmed Password</label>
                                        <input type="password" class="form-control form-control-user"
                                            id="password_confirmation" placeholder=" retype Password" name="password_confirmation">
                                            <span id="repetpassworderror" class="text-danger font-weight-bold"></span>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Save now
                                    </button>

                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('forgot.password') }}">Forgot Password?</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<script>
    function validation()
     {
        var token = document.forms["myForm"]["token"].value; // ["name"]=> this is input id
        var password = document.forms["myForm"]["password"].value;
        var password_confirmation = document.forms["myForm"]["password_confirmation"].value;

        // regex pattern
        var passwordcheck = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/;

        if (token == "") {
            document.getElementById('tokenerror').innerHTML = "** You Enter Wrong OTP Please Check Your Email**";
            return false;
         }
        else
         {
            document.getElementById('tokenerror').innerHTML = " ";
         }

         if (passwordcheck.test(password)) {
        document.getElementById('passworderror').innerHTML = " ";
        } else {
        document.getElementById('passworderror').innerHTML = "** Paswword Must have At Least one 'Upper Case' & 'Lower Case' English alphabet, One Spical Character, One digit, Password length between 8 to 16  **";
        return false;
         }

         if (passwordcheck.test(password_confirmation)) {
        document.getElementById('repetpassworderror').innerHTML = " ";
        } else {
        document.getElementById('repetpassworderror').innerHTML = "** Paswword Must have At Least one 'Upper Case' & 'Lower Case' English alphabet, One Spical Character, One digit, Password length between 8 to 16  **";
        return false;
         }

         if(password.match(password_confirmation)){
            document.getElementById('repetpassworderror').innerHTML = " ";
        } else {
        document.getElementById('repetpassworderror').innerHTML = "** Both Passswords Are not matched  **";
        return false;
         }

     }

        $(document).ready(function(){
            $('#token,#password,#password_confirmation').focus(function(){
                $(this).css('background-color','#33ff33');
            });

            $('#token,#password,#password_confirmation').blur(function(){
                $(this).css('background-color','');
            });

            $('#token,#password,#password_confirmation').keypress(function(){
                $(this).css('background-color','#80aaff');
            });
        });
</script>

@endsection

