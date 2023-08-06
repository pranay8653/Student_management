@extends('layout.application')
@section('page_title', 'Change Password')
{{-- @section('dashboard_select','active') --}}
@section('content')

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            {{-- <div class="col-lg-6 d-none d-lg-block bg-login-image"></div> --}}
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Change Password</h1>
                                    </div>

                                    @if(session('forgot_otp'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{session('forgot_otp')}}
                                            </div>
                                        @endif

                                    <form action="{{ route('save.change.password') }}" class="sign-up-form" method="post" name="myForm" onsubmit="return validation()">
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
                                        <label for="current_password" class="pl-3">Current Password</label>
                                        <input type="password" class="form-control form-control-user" name="current_password" value="{{ old('current_password') }}" id="current_password" placeholder="Enter your current password" >
                                        <span id="current_passworderror" class="text-danger  "></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="new_password" class="pl-3">New Password</label>
                                        <input type="password" class="form-control form-control-user" name="new_password" value="{{ old('new_password') }}" id="new_password" placeholder="New password" >
                                        <span id="new_passworderror" class="text-danger  "></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="new_password_confirmation" class="pl-3">Confirm Password</label>
                                        <input type="password" class="form-control form-control-user" name="new_password_confirmation" value="{{ old('new_password_confirmation') }}" id="new_confirm_password" placeholder="Enter Confirm password" >
                                        <span id="new_confirm_passworderror" class="text-danger  "></span>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user col-md-3">Change Password</button>

                                    </form>
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
            var current_password = document.forms["myForm"]["current_password"].value; // ["name"]=> this is input id
            var new_password = document.forms["myForm"]["new_password"].value;
            var new_confirm_password = document.forms["myForm"]["new_confirm_password"].value;

            // regex pattern
            var passwordcheck = /^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,16}$/;

            if (current_password == "") {
                document.getElementById('current_passworderror').innerHTML = "** Please Enter Current Login Password **";
                return false;
             }
            else
             {
                document.getElementById('current_passworderror').innerHTML = " ";
             }

             if (passwordcheck.test(new_password)) {
            document.getElementById('new_passworderror').innerHTML = " ";
            } else {
            document.getElementById('new_passworderror').innerHTML = "** Paswword Must have At Least one 'Upper Case' & 'Lower Case' English alphabet, One Spical Character, One digit, Password length between 8 to 16  **";
            return false;
             }

             if (passwordcheck.test(new_confirm_password)) {
            document.getElementById('new_confirm_passworderror').innerHTML = " ";
            } else {
            document.getElementById('new_confirm_passworderror').innerHTML = "** Paswword Must have At Least one 'Upper Case' & 'Lower Case' English alphabet, One Spical Character, One digit, Password length between 8 to 16  **";
            return false;
             }

             if(new_password.match(new_confirm_password)){
                document.getElementById('new_confirm_passworderror').innerHTML = " ";
            } else {
            document.getElementById('new_confirm_passworderror').innerHTML = "** Both Passswords Are not matched  **";
            return false;
             }

         }

            $(document).ready(function(){
                $('#current_password,#new_password,#new_confirm_password').focus(function(){
                    $(this).css('background-color','#33ff33');
                });

                $('#current_password,#new_password,#new_confirm_password').blur(function(){
                    $(this).css('background-color','');
                });

                $('#current_password,#new_password,#new_confirm_password').keypress(function(){
                    $(this).css('background-color','#80aaff');
                });
            });
    </script>

@endsection
