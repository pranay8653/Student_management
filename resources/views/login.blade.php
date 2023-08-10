@extends('layout.application_outside')
@section('page_title', 'login')
@section('content')

<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" >

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row" style="background-color: #F2EAD3">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4" style="font-family: 'Lucida Handwriting', cursive;">Educare Coaching Centre </h1>
                                </div>
                                <form action="{{ route('post.login') }}" class="user" class="sign-up-form" method="post">
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

                                        @if(session('admin_register'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{session('admin_register')}}
                                            </div>
                                        @endif
                                        @if(session('logout'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{session('logout')}}
                                            </div>
                                        @endif
                                        @if(session('new_password'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{session('new_password')}}
                                            </div>
                                        @endif


                                    <div class="form-group">
                                        <label class="cardformlabel" for="email" style="color:blue">Enter Email-id/Mobile Number</label>
                                        <input type="text" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Enter Your Email or Phone Number..." name="username" value={{ old('username') }}>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Password" name="password" value={{ old('password') }}>
                                    </div>

                                    <button type="submit" class="btn btn-primary btn-user btn-block"> Login</button>

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
@endsection
