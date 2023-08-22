<!DOCTYPE html>
<html lang="en">

<head>
    <title>fitness-app | Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" href="{{ asset('frt-assets/images/sticker1.png') }}" type="image/png">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frt-assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css"
        href="{{ asset('frt-assets/fonts/iconic/css/material-design-iconic-font.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/vendor/animate/animate.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/vendor/css-hamburgers/hamburgers.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/vendor/animsition/css/animsition.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/vendor/select2/select2.min.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/vendor/daterangepicker/daterangepicker.css') }}">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/css/util.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/css/main.css') }}">
    <style>
        .wrap-login100 {
            width: 500px;
        }
    </style>
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('{{ asset('frt-assets/images/bg-01.jpg') }}')">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-38">
                <form class="login100-form validate-form" method="POST" action="{{ route('login.post') }}">
                    @csrf
                    <span class="login100-form-title p-b-4 mb-5">
                        Login
                    </span>
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong> {{ session('error') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach ($errors->all() as $error)
                                <strong>{{ $error }}</strong>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    <div class="wrap-input100 validate-input m-b-23">
                        <span class="label-input100">Username or Email</span>
                        <input class="input100" type="text" value="{{ old('username') }}" name="username"
                            placeholder="Enter your username or email" value="{{ old('username') }}">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>


                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        <span class="focus-input100">
                            <span class="focus-input100 " data-symbol="&#xf190;"></span>
                        </span>

                    </div>
                    <div class="text-right p-t-8 p-b-31">
                        <a href="#">
                            Forgot password?
                        </a>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button type="submit" class="login100-form-btn">
                                Login
                            </button>
                        </div>
                    </div>

                    <div class="txt1 text-center p-t-40 p-b-20">
                        <span>
                            Or
                        </span>
                    </div>

                    <div class="flex-c-m">
                        <a href="{{ url('auth/google') }}" class="login100-social-item bg3">
                            <i class="fa fa-google"></i>
                        </a>
                    </div>

                    <div class="flex-col-c p-t-15">
                        <span class="txt1 p-b-17">
                            Don't have an account?
                        </span>
                        <a href="{{ route('register') }}" class="txt2">
                            Sign Up
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="{{ asset('frt-assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frt-assets/vendor/animsition/js/animsition.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frt-assets/vendor/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('frt-assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frt-assets/vendor/select2/select2.min.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frt-assets/vendor/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('frt-assets/vendor/daterangepicker/daterangepicker.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frt-assets/vendor/countdowntime/countdowntime.js') }}"></script>
    <!--===============================================================================================-->
    <script src="{{ asset('frt-assets/js/main.js') }}"></script>

</body>

</html>
