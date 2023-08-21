<!DOCTYPE html>

<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('assets') }}/" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Login - sportfanstickers</title>


    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frt-assets/images/sticker1.png') }}" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/fontawesome.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/flag-icons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />

    <!-- Page CSS -->
    <style>
        .dark-style .auth-cover-bg-color {
            background: none !important;
        }

        :root {
            --car-color: #ff2800;
            --window-color: #add8e6;
            --success-color: #2eff04;
            --error-color: #fd1c03;
        }

        *,
        *:after,
        *:before {
            box-sizing: border-box;
        }

        .wrapper {
            background-color: #000;
            background-image: radial-gradient(ellipse at center,
                    rgba(127, 0, 173, 0.6) 0%,
                    rgba(0, 0, 0, 0.8) 60%,
                    black 90%);
            background-size: cover;
            border: 1px solid rgba(127, 0, 173, 0.6);
            box-shadow: 0 19px 38px rgba(0, 0, 0, 0.3), 0 15px 12px rgba(0, 0, 0, 0.22);
            height: 650px;
            width: 850px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            position: absolute;
            overflow: hidden;
            perspective: 50px;
            transform-style: preserve-3d;
            border-radius: 20px;
        }

        .sun {
            position: absolute;
            border-radius: 50%;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 12.5em;
            height: 12.5em;
            background: linear-gradient(#f12711, yellow);
            box-shadow: 0 0 30px #f5af19;
        }

        .grid {
            background: #010101;
            height: 60em;
            transform: scale(1.4) rotateX(90deg);
            position: absolute;
            width: 600%;
            margin-left: -250%;
        }

        .grid::after {
            animation: 2.4s dash linear infinite;
            background-image: linear-gradient(180deg,
                    rgba(0, 0, 0, 0) 0px,
                    rgba(54, 226, 248, 0.25) 0%,
                    rgba(54, 226, 248, 0.25) 3px,
                    rgba(0, 0, 0, 0) 0px),
                linear-gradient(90deg,
                    rgba(0, 0, 0, 0) 0px,
                    rgba(54, 226, 248, 0.5) 0%,
                    rgba(54, 226, 248, 0.5) 3px,
                    rgba(0, 0, 0, 0) 0px);
            background-size: 60px 60px, 60px 60px;
            background-color: rgba(2, 40, 45, 0.5);
            content: "";
            width: 10%;
            height: 100%;
            position: absolute;
            bottom: 0;
            left: 50%;
            border: 2px solid rgba(54, 226, 248, 0.25);
            transform: translateX(-50%);
        }

        .car {
            animation: 3s sway ease-in-out infinite;
            height: 180px;
            left: 50%;
            perspective: 200px;
            position: absolute;
            width: 240px;
            top: 55.5%;
            margin-left: -120px;
            z-index: 2;
        }

        .car::before {
            animation: 3s skew ease-in-out infinite;
            content: "";
            width: 110%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            position: absolute;
            top: 75%;
            left: 50%;
            transform: rotateX(60deg) translateX(-50%);
            z-index: 0;
        }

        .car__bumper {
            border-radius: 10em 10em 8em 8em;
            background: #111;
            position: absolute;
            bottom: 10%;
            height: 35%;
            overflow: hidden;
            width: 90%;
            left: 5%;
        }

        .car__bumper::after {
            background: rgba(255, 255, 255, 0.05);
            height: 20%;
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .car__back {
            border-radius: 8em 8em 4em 4em;
            background: var(--car-color);
            position: absolute;
            bottom: 25%;
            height: 35%;
            overflow: hidden;
            width: 95%;
            left: 2.5%;
        }

        .car__back::after {
            background: rgba(0, 0, 0, 0.2);
            height: 30%;
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }

        .car__back:before {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 1em;
            position: absolute;
            content: "";
            height: 10%;
            top: 5%;
            left: 50%;
            width: 60%;
            transform: translateX(-50%);
        }

        .car__light {
            background-color: red;
            background-position: -2px -2px, -8px -8px;
            background-image: radial-gradient(white 10%, transparent 11%),
                radial-gradient(white 10%, transparent 11%);
            border-radius: 50%;
            border: 0.1em solid #8b0000;
            box-shadow: inset 0 0 0 0.3em rgba(255, 165, 0, 0.8),
                0 0 0.3em rgba(255, 0, 0, 0.8), 0 0 6px 3px #fb492b inset,
                0 0 15px 1px #fb492b;
            padding-top: 14%;
            width: 15%;
            position: absolute;
            transform: translateY(-50%);
            top: 50%;
            z-index: 2;
        }

        .car__light--small {
            background: white;
            padding-top: 9.5%;
            top: 65%;
            width: 11%;
            z-index: 3;
        }

        .car__light--left {
            left: 5%;
        }

        .car__light--small.car__light--left {
            left: 15%;
        }

        .car__light--right {
            right: 5%;
        }

        .car__light--small.car__light--right {
            right: 15%;
        }

        .car__plate {
            border-radius: 0.2em;
            border: 0.1em solid #333;
            box-shadow: 0 4px 2px -2px rgba(0, 0, 0, 0.6);
            height: 12.5%;
            font-weight: bold;
            font-size: 12px;
            letter-spacing: 0.01em;
            position: absolute;
            background: yellow;
            text-align: center;
            left: 50%;
            bottom: 15%;
            padding: 2% 0;
            transform: translateX(-50%);
            width: 28%;
        }

        .car__roof {
            border-radius: 1em 1em 0 0;
            background-color: var(--car-color);
            background-image: linear-gradient(transparent, rgba(0, 0, 0, 0.5) 70%);
            bottom: 45%;
            left: 50%;
            width: 60%;
            height: 45%;
            position: absolute;
            transform: rotateX(50deg) translateX(-50%);
        }

        .car__roof:after {
            background: var(--window-color);
            border-radius: 1em 1em 0 0;
            position: absolute;
            content: "";
            height: 70%;
            bottom: 5%;
            left: 50%;
            width: 80%;
            transform: translateX(-50%);
        }

        .car__roof:before {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 1em;
            position: absolute;
            content: "";
            height: 10%;
            top: 5%;
            left: 50%;
            width: 80%;
            transform: translateX(-50%);
        }

        .car__grill {
            background-color: #222;
            background-image: linear-gradient(#111 0.1em, transparent 0.1em);
            background-size: 100% 0.2em;
            border-radius: 0.5em;
            position: absolute;
            height: 50%;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            z-index: 1;
        }

        .car__emblem {
            border: 1px solid white;
            height: 0.85em;
            width: 0.85em;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .car__emblem::after {
            content: "";
            position: absolute;
            width: 0.3em;
            height: 0.3em;
            background: white;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }

        .car__wheel {
            animation: wheels 3s ease-in-out infinite;
            border-radius: 0.4em;
            position: absolute;
            height: 30%;
            bottom: 0;
            background: #010101;
            width: 22%;
        }

        .car__wheel::after,
        .car__wheel::before {
            animation: 1s dash linear infinite reverse;
            width: 10%;
            height: 100%;
            content: "";
            position: absolute;
            background-color: rgba(255, 255, 255, 0.025);
            background-image: linear-gradient(180deg,
                    rgba(0, 0, 0, 0) 0px,
                    rgba(255, 255, 255, 0.025) 0%,
                    rgba(255, 255, 255, 0.025) 2px,
                    rgba(0, 0, 0, 0) 0px);
            background-size: 4px 6px;
            top: 0;
        }

        .car__wheel::after {
            left: 10%;
        }

        .car__wheel::before {
            right: 10%;
        }

        .car__wheel--left {
            animation-delay: -1.5s;
            left: 2.5%;
        }

        .car__wheel--right {
            right: 2.5%;
        }

        .car__mirror {
            border-radius: 0.3em;
            position: absolute;
            top: 30%;
            background: var(--car-color);
            width: 1.5em;
            height: 1em;
        }

        .car__mirror::after {
            border-radius: 0.1em;
            content: "";
            position: absolute;
            left: 0.1em;
            right: 0.1em;
            top: 0.1em;
            bottom: 0.1em;
            background: var(--window-color);
        }

        .car__mirror::before {
            background-color: inherit;
            background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.2));
            content: "";
            width: 2em;
            height: 0.5em;
            top: 90%;
            left: 80%;
            position: absolute;
            transform: rotate(30deg);
            z-index: 0;
        }

        .car__mirror--left {
            left: 5%;
        }

        .car__mirror--right {
            right: 5%;
            transform: scaleX(-1);
        }

        .diamond {
            animation: 8s fly-forward linear infinite;
            color: white;
            border: 1px solid currentColor;
            box-shadow: 0 0 20px currentColor;
            height: 0.85em;
            width: 0.85em;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) rotate(45deg);
        }

        .diamond:nth-of-type(4) {
            animation-delay: -4s;
        }

        .diamond:nth-of-type(5) {
            animation-delay: -5s;
        }

        .diamond:nth-of-type(6) {
            animation-delay: -6s;
        }

        .diamond:nth-of-type(7) {
            animation-delay: -7s;
        }

        .diamond:nth-of-type(8) {
            animation-delay: -8s;
        }

        .circle {
            animation: 8s fly-forward-circle linear infinite;
            animation-delay: 5.5s;
            border-radius: 50%;
            color: var(--error-color);
            border: 1px solid currentColor;
            box-shadow: 0 0 20px currentColor;
            height: 0.85em;
            width: 0.85em;
            position: absolute;
            left: 50%;
            top: 50%;
            transform: scale(0) translate(-50%, -50%) rotate(45deg);
        }

        .car__exhaust {
            background: black;
            border: 0.2em solid rgba(255, 255, 255, 0.2);
            bottom: 12.5%;
            position: absolute;
            border-radius: 50%;
            height: 1.25em;
            width: 1.25em;
        }

        .car__exhaust::after {
            background: inherit;
            border: inherit;
            position: absolute;
            content: "";
            height: inherit;
            width: inherit;
            top: -0.2em;
            border-radius: inherit;
        }

        .car__exhaust--left {
            left: 12.5%;
        }

        .car__exhaust--left::after {
            left: 100%;
        }

        .car__exhaust--right {
            right: 12.5%;
        }

        .car__exhaust--right::after {
            right: 100%;
        }

        @keyframes dash {
            to {
                background-position: 0% 100%;
            }
        }

        @keyframes sway {

            0%,
            100% {
                transform: translateX(-40%) rotateZ(-4deg) rotateY(-0.5deg);
            }

            50% {
                transform: translateX(40%) rotateZ(4deg) rotateY(0.5deg);
            }
        }

        @keyframes skew {

            0%,
            100% {
                transform: skew(-50deg) rotateX(60deg) translateX(-60%);
            }

            50% {
                transform: skew(50deg) rotateX(60deg) translateX(-40%);
            }
        }

        @keyframes health {
            0% {
                width: 20%;
            }

            50% {
                width: 100%;
            }

            79% {
                color: var(--success-color);
                opacity: 1;
            }

            80% {
                color: var(--error-color);
                opacity: 0;
            }

            81% {
                opacity: 1;
            }

            82% {
                opacity: 0;
            }

            83% {
                opacity: 1;
            }

            84% {
                color: var(--error-color);
                width: 100%;
                opacity: 0;
            }

            90% {
                color: var(--success-color);
                width: 20%;
                opacity: 1;
            }

            100% {
                width: 20%;
            }
        }

        @keyframes fly-forward {
            0% {
                transform: scale(0) translate(-50%, -50%) rotate(0deg);
            }

            22% {
                color: white;
            }

            23% {
                color: var(--success-color);
            }

            100% {
                transform: scale(4) translate3D(-50%, -50%, 200px) rotate(560deg);
            }
        }

        @keyframes fly-forward-circle {
            0% {
                transform: scale(0) translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: scale(2) translate3D(-50%, -50%, 200px) rotate(560deg);
            }
        }

        @keyframes wheels {
            50% {
                transform: translateY(-20%);
            }
        }
    </style>
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <div class="wrapper">
                        <div class="score"></div>
                        <div class="sun"></div>
                        <div class="grid"></div>
                        <div class="car">
                            <div class="car__mirror car__mirror--left"></div>
                            <div class="car__mirror car__mirror--right"></div>
                            <div class="car__wheel car__wheel--left"></div>
                            <div class="car__wheel car__wheel--right"></div>
                            <div class="car__roof"></div>
                            <div class="car__bumper"></div>
                            <div class="car__back">
                                <div class="car__light car__light--left"></div>
                                <div class="car__light car__light--small car__light--left"></div>
                                <div class="car__light car__light--small car__light--right"></div>
                                <div class="car__light car__light--right"></div>
                                <div class="car__grill">
                                    <div class="car__emblem"></div>
                                </div>
                            </div>
                            <div class="car__plate" style="color: black">
                                Sport Fan
                            </div>
                            <div class="car__exhaust car__exhaust--left"></div>
                            <div class="car__exhaust car__exhaust--right"></div>
                        </div>
                        <div class="diamond"></div>
                        <div class="diamond"></div>
                        <div class="diamond"></div>
                        <div class="diamond"></div>
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-4">
                        <a href="index.html" class="app-brand-link gap-2">
                            <a href="{{ route('admin.index') }}" class="app-brand-link">
                                <img src="{{ asset('assets/img/branding/watermark.png') }}" alt="">
                            </a>
                            {{-- <span class="app-brand-logo demo">
                                <svg width="32" height="22" viewBox="0 0 32 22" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                                        fill="#7367F0" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z"
                                        fill="#161616" />
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z"
                                        fill="#161616" />
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                                        fill="#7367F0" />
                                </svg>
                            </span> --}}
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h3 class="mb-1 fw-bold">Welcome To Admin👋</h3>
                    <p class="mb-4">Please sign-in to your account and start the adventure</p>

                    <form id="formAuthentication" class="mb-3" method="POST"
                        action="{{ route('admin.login.post') }}">
                        @csrf <!-- CSRF Token -->

                        <div class="mb-3">
                            <label for="email" class="form-label">Email or Username</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email or username" autofocus />
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                {{-- <a href="#"> <!-- Replace with your forgot password route -->
                                    <small>Forgot Password?</small>
                                </a> --}}
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me" name="remember" />
                                <label class="form-check-label" for="remember-me"> Remember Me </label>
                            </div>
                        </div> --}}
                        <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                        <br>
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>

                            </div>
                        @endif

                    </form>
                    {{-- <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="auth-register-cover.html">
                            <span>Create an account</span>
                        </a>
                    </p> --}}

                    {{-- <div class="divider my-4">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                            <i class="tf-icons fa-brands fa-google fs-5"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                            <i class="tf-icons fa-brands fa-twitter fs-5"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>

    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>

    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js"></script>
    <script src="../../assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="../../assets/js/pages-auth.js"></script>
</body>

</html>
