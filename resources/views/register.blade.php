    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>SportFanStickers | Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!--===============================================================================================-->
        <link rel="icon" type="image/x-icon" href="{{ asset('frt-assets/images/sticker1.png') }}" />

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
        <link rel="stylesheet" type="text/css"
            href="{{ asset('frt-assets/vendor/css-hamburgers/hamburgers.min.css') }}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('frt-assets/vendor/animsition/css/animsition.min.css') }}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/vendor/select2/select2.min.css') }}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css"
            href="{{ asset('frt-assets/vendor/daterangepicker/daterangepicker.css') }}">
        <!--===============================================================================================-->
        <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/css/util.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('frt-assets/css/main.css') }}">
        <!--===============================================================================================-->
        <style>
            .wrap-login100 {
                width: 700px;
            }
        </style>
    </head>

    <body>

        <div class="limiter">
            <div class="container-login100" style="background-image: url('{{ asset('frt-assets/images/bg-01.jpg') }}">
                <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-38">
                    <h1 id="errorH1" style="display: none; color: red; text-align: center; font-weight:bold;">Invalid Referral Code.
                    </h1>

                    <div class="step" id="step1">
                        <span class="login100-form-title p-b-49">
                            Choose User Type
                        </span>
                        <center>
                            <input type="radio" name="payment" id="parent" checked="checked" />
                            <label for="parent">Parent</label>
                            <input type="radio" name="payment" id="trainer" />
                            <label for="trainer">Trainer</label>
                        </center>
                        <div class="container-login100-form-btn p-t-31">
                            <div class="wrap-login100-form-btn">
                                <div class="login100-form-bgbtn"></div>
                                <button id="nextStepBtn" class="login100-form-btn">
                                    Next
                                </button>
                            </div>
                        </div>
                        <div class="flex-col-c p-t-15">
                            <span class="txt1 p-b-17">
                                Already have an account?
                            </span>
                            <a href="{{ route('login.show') }}" class="txt2">
                                Login
                            </a>
                        </div>
                    </div>
                    <div class="step" id="step2" style="display: none;">

                        <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="back-btn">
                                <a href="#" id="backStepBtn"><i class="fa fa-arrow-left"></i> Back</a>
                            </div>
                            <span class="login100-form-title p-b-49">
                                Register
                            </span>
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
                            <input type="hidden" name="user_type" id="selectedUserTypeInput" value="">


                            <div class="row mt-5">
                                <div class="col-md-6">
                                    <div class="wrap-input100 validate-input m-b-23" data-validate="Email is required">
                                        <span class="label-input100">Email</span>
                                        <input class="input100" type="email" value="{{ old('email') }}"
                                            name="email" placeholder="Type your email">
                                        <span class="focus-input100">
                                            <i class="fa fa-envelope custom-icon" aria-hidden="true"></i>

                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wrap-input100 validate-input m-b-23"
                                        data-validate="Username is required">
                                        <span class="label-input100">Username</span>
                                        <input class="input100" type="text" value="{{ old('username') }}"
                                            name="username" placeholder="Enter your username">
                                        <span class="focus-input100">
                                            <i class="fa fa fa-user custom-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                                        <span class="label-input100">Password</span>
                                        <input class="input100" type="password" name="password"
                                            placeholder="Type your password" data-symbol="&#xf190;">
                                        <span class="focus-input100">
                                            <i class="fa fa-lock custom-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="wrap-input100 validate-input"
                                        data-validate="Confirm Password is required">
                                        <span class="label-input100">Confirm Password</span>
                                        <input class="input100" type="password" name="password_confirmation"
                                            placeholder="Confirm your password" data-symbol="&#xf190;">
                                        <span class="focus-input100">
                                            <i class="fa fa-lock custom-icon" aria-hidden="true"></i>
                                        </span>
                                    </div>
                                </div>

                            </div>



                            <div class="row mt-4">

                                <div class="col-md-6">
                                    <div class="wrap-input100 validate-input" data-validate="First Name is required">
                                        <span class="label-input100">First Name</span>
                                        <input class="input100" type="text" value="{{ old('first_name') }}"
                                            name="first_name" placeholder="Enter your first name">
                                        <span class="focus-input100">
                                            <i class="fa fa-address-card custom-icon" aria-hidden="true"></i>
                                        </span>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="wrap-input100 validate-input" data-validate="Last Name is required">
                                        <span class="label-input100">Last Name</span>
                                        <input class="input100" type="text" value="{{ old('last_name') }}"
                                            name="last_name" placeholder="Enter your last name">
                                        <span class="focus-input100">
                                            <i class="fa fa-address-card custom-icon" aria-hidden="true"></i>

                                        </span>

                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="wrap-input100 validate-input" data-validate="Phone is required">
                                        <span class="label-input100">Phone</span>
                                        <input class="input100" type="text" value="{{ old('phone') }}"
                                            name="phone" placeholder="Enter your phone number">
                                        <span class="focus-input100">
                                            <i class="fa fa-phone custom-icon" aria-hidden="true"></i>
                                        </span>



                                    </div>
                                </div>
                                {{-- <div class="col-md-6">

                                        <div class="wrap-input100 validate-input"
                                            data-validate="Referral Code is required">
                                            <span class="label-input100">Referral Code</span>
                                            <input class="input100" type="text" value="{{ old('referral_code') }}"
                                                name="referral_code" placeholder="Enter your referral code">
                                            <span class="focus-input100">
                                                <i class="fa fa-share-alt custom-icon" aria-hidden="true"></i>
                                            </span>

                                        </div>
                                </div> --}}
                                <input type="hidden" name="referral_code" id="generatedReferralCode">

                            </div>
                            {{-- <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="wrap-input10 validate-input" data-validate="user type is required">
                                    <span class="label-input100">User Type</span>
                                    <div class="input10 mt-3 ml-1">
                                        <input type="radio" id="parent" name="user_type" value="parent"
                                            {{ old('user_type') === 'parent' ? 'checked' : '' }}>
                                        <span class="label-input100">Parent</span>

                                        <input type="radio" id="trainer" name="user_type" value="trainer"
                                            {{ old('user_type') === 'trainer' ? 'checked' : '' }}>
                                        <span class="label-input100">trainer</span>

                                    </div>
                                </div>
                            </div>
                        </div> --}}

                            <div class="container-login100-form-btn p-t-31">
                                <div class="wrap-login100-form-btn">
                                    <div class="login100-form-bgbtn"></div>
                                    <button type="submit" class="login100-form-btn">
                                        Register
                                    </button>

                                </div>
                            </div>
                            {{-- <div class="container-login100-form-btn p-t-5">
                                <div class="wrap-login100-form-btn">
                                    <div class="login100-form-bgbtn"></div>
                                    <button type="button" id="backStepBtn" class="login100-form-btn"
                                        style="margin-left: 10px;">
                                        Back
                                    </button>

                                </div>
                            </div> --}}
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

                            {{-- <div class="flex-col-c p-t-15">
                                <span class="txt1 p-b-17">
                                    Already have an account?
                                </span>
                                <a href="{{ route('login.show') }}" class="txt2">
                                    Login
                                </a>
                            </div> --}}
                        </form>

                    </div>
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
        <script>
            const nextStepBtn = document.getElementById('nextStepBtn');
            const step1 = document.getElementById('step1');
            const step2 = document.getElementById('step2');
            const selectedUserTypeInput = document.getElementById('selectedUserTypeInput');

            const generatedReferralCodeInput = document.getElementById('generatedReferralCode');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            $(document).ready(function() {
                const referralCodeInUrl = '{{ request()->query('referral_code') }}';
                if (referralCodeInUrl) {
                    $.ajax({
                        url: '{{ route('checkReferralCodeValidity') }}',
                        method: 'GET',
                        data: {
                            referral_code: referralCodeInUrl
                        },
                        success: function(response) {
                            if (response.valid) {
                                generatedReferralCodeInput.value = referralCodeInUrl;
                                errorH1.style.display = 'none'; // Hide error message if previously shown
                                step1.style.display = 'none';
                                step2.style.display = 'block';
                            } else {
                                errorH1.innerText =
                                    'Invalid referral code.'; // Display error message in <h1>
                                errorH1.style.display = 'block';
                                step1.style.display = 'none';
                                step2.style.display = 'none';
                            }
                        }
                    });
                }
            });
            // Function to show step2
            function showStep2() {
                step1.style.display = 'none';
                step2.style.display = 'block';
            }

            nextStepBtn.addEventListener('click', async function() {
                const selectedUserType = document.querySelector('input[name="payment"]:checked').id;
                selectedUserTypeInput.value = selectedUserType;

                const referralCode = '{{ Request::query('referral_code') }}';
                if (referralCode) {
                    try {
                        const isValid = await checkReferralCodeValidity(referralCode);
                        if (!isValid) {
                            alert('Invalid referral code. Please enter a valid referral code.');
                            return;
                        }
                    } catch (error) {
                        alert('An error occurred while checking referral code validity.');
                        return;
                    }
                }

                // Populate the generated referral code in the hidden input field
                generatedReferralCodeInput.value = '{{ session('generated_referral_code') }}';

                // Store the selected user type in a session using AJAX
                $.ajax({
                    url: '{{ route('storeSelectedUserType') }}',
                    method: 'POST',
                    headers: {
                        'X-CSRF-Token': csrfToken
                    },
                    data: {
                        user_type: selectedUserType
                    },
                    success: function(response) {
                        showStep2();
                    }
                });
            });

            backStepBtn.addEventListener('click', function() {
                step2.style.display = 'none';
                step1.style.display = 'block';
            });
        </script>




    </body>

    </html>
