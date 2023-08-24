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
            <link rel="stylesheet" type="text/css"
                href="{{ asset('frt-assets/vendor/bootstrap/css/bootstrap.min.css') }}">
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
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.css">
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
                <div class="container-login100"
                    style="background-image: url('{{ asset('frt-assets/images/bg-01.jpg') }}">
                    <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-38">
                        <h1 id="errorH1" style="display: none; color: red; text-align: center; font-weight:bold;">
                            Invalid
                            Referral Code.
                        </h1>
                        <a href="{{ route('login.show') }}" id="errorbtn"
                            style="display: none; color: #697fec; text-align: center; font-weight:bold; font-size:25px;">Goback</a>

                        <div class="step radio" id="step1">
                            <span class="login100-form-title p-b-49">
                                Choose User Type
                            </span>
                            <center>
                                <input type="radio" name="payment" id="parent" checked="checked" />
                                <label for="parent">Parent</label>
                                <input type="radio" name="payment" id="trainer" />
                                <label for="trainer">Trainer</label>
                                <input type="radio" name="payment" id="teacher" />
                                <label for="teacher">Teacher</label>

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

                            <form class="login100-form validate-form" method="POST" action="{{ route('register') }}"
                                enctype="multipart/form-data">
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
                                        <div class="wrap-input100 validate-input m-b-23"
                                            data-validate="Email is required">
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
                                        <div class="wrap-input100 validate-input"
                                            data-validate="Password is required">
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
                                        <div class="wrap-input100 validate-input"
                                            data-validate="First Name is required">
                                            <span class="label-input100">First Name</span>
                                            <input class="input100" type="text" value="{{ old('first_name') }}"
                                                name="first_name" placeholder="Enter your first name">
                                            <span class="focus-input100">
                                                <i class="fa fa-address-card custom-icon" aria-hidden="true"></i>
                                            </span>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="wrap-input100 validate-input"
                                            data-validate="Last Name is required">
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
                                    <div class="col-md-6">
                                        <div class="wrap-input100 validate-input" data-validate="Avatar is required">
                                            <span class="label-input100">Avatar</span>

                                            <div class='file-input'>
                                                <input type='file' id="avatarInput">
                                                <span class='button'>Choose</span>
                                                <span class='label' data-js-label>No file selected</label>
                                            </div>
                                            {{-- <span class="focus-input100">
                                                <i class="fa fa-camera custom-icon" aria-hidden="true"></i>
                                            </span> --}}
                                        </div>
                                    </div>


                                    <input type="hidden" name="cropped_image_data" id="croppedImageData">

                                    <input type="hidden" name="referral_code" id="generatedReferralCode">
                                    <input type="hidden" id="parentIDInput" name="parent_id" value="">
                                </div>
                                <div class="container-login100-form-btn p-t-31">
                                    <div class="wrap-login100-form-btn">
                                        <div class="login100-form-bgbtn"></div>
                                        <button type="submit" class="login100-form-btn">
                                            Register
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
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="cropModal" tabindex="-1" role="dialog" aria-labelledby="cropModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="" id="cropme-image">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" id="cancle-button"
                                data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-primary" id="crop-button">Crop</button>
                        </div>
                    </div>
                </div>
            </div>


            <div id="dropDownSelect1"></div>

            {{-- <script src="{{ asset('frt-assets/vendor/jquery/jquery-3.2.1.min.js') }}"></script> --}}
            <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
                crossorigin="anonymous"></script>

            <!--===============================================================================================-->
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
            <script src="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.js"></script>

            <!--===============================================================================================-->
            <script src="{{ asset('frt-assets/js/main.js') }}"></script>



            <script>
                // Also see: https://www.quirksmode.org/dom/inputfile.html

                var inputs = document.querySelectorAll('.file-input')

                for (var i = 0, len = inputs.length; i < len; i++) {
                    customInput(inputs[i])
                }

                function customInput(el) {
                    const fileInput = el.querySelector('[type="file"]')
                    const label = el.querySelector('[data-js-label]')

                    fileInput.onchange =
                        fileInput.onmouseout = function() {
                            if (!fileInput.value) return

                            var value = fileInput.value.replace(/^.*[\\\/]/, '')
                            el.className += ' -chosen'
                            label.innerText = value
                        }
                }
                $(document).ready(function() {
                    var crop; // To hold the Cropme instance

                    // When the avatar input changes
                    $("#avatarInput").change(function() {
                        var selectedImage = this.files[0];
                        if (selectedImage) {
                            if (crop) {
                                crop.cropme("destroy");
                                $("#cropme-image").remove();
                                crop = null; // Reset the crop variable
                            }
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                $(".modal-body").prepend('<img src="" id="cropme-image">');
                                $("#cropme-image").attr("src", e.target.result);
                                $("#cropme-image").on("load", function() {
                                    $("#cropModal").modal("show"); // Show the modal
                                });
                            };
                            reader.readAsDataURL(selectedImage);
                        }
                    });

                    // Initialize Cropme when the modal is shown for the first time
                    $("#cropModal").on("shown.bs.modal", function() {
                        if (!crop) {
                            crop = $("#cropme-image").cropme({
                                container: {
                                    width: "100%",
                                    height: 400,
                                },
                                viewport: {
                                    width: 200,
                                    height: 200,
                                    type: "circle",
                                    border: {
                                        width: 2,
                                        enable: true,
                                        color: "#fff",
                                    },
                                },
                                zoom: {
                                    enable: true,
                                    mouseWheel: true,
                                    slider: true,
                                },
                                rotation: {
                                    slider: true,
                                    enable: true,
                                    position: "left",
                                },
                                transformOrigin: "viewport",
                            });
                        }
                    });

                    function base64ToImage(base64Data) {
                        const blob = new Blob([base64Data], {
                            type: 'image/png'
                        }); // Adjust the MIME type if needed
                        const imageUrl = URL.createObjectURL(blob);

                        const image = new Image();
                        image.src = imageUrl;

                        return image;
                    }

                    // Handle Crop button click
                    $("#crop-button").click(function() {
                        if (crop) {
                            crop.cropme('crop', {
                                type: 'base64',
                                width: 800
                            }).then(function(croppedImageData) {
                                // Populate the input field with the cropped image data
                                $("#croppedImageData").val(croppedImageData);

                                // Manually remove the modal backdrop and reset modal state
                                $("body").removeClass("modal-open");
                                $(".modal-backdrop").remove();

                                // Hide the modal
                                $("#cropModal").hide();

                                // // Display the cropped image in an image tag
                                // var croppedImage = new Image();
                                // croppedImage.src = croppedImageData;
                                // // Append the image to a container element or display it in any way you prefer
                                // $("#croppedImageContainer").empty().append(
                                //     croppedImage
                                // ); // Replace "croppedImageContainer" with your container's ID or class
                            }).catch(function(error) {
                                console.error("Error while cropping image:", error);
                            });
                        }
                    });

                    $("#cancle-button").click(function() {
                        $("body").removeClass("modal-open");
                        $(".modal-backdrop").remove();
                        $("#cropModal").hide();

                    })
                });
                const nextStepBtn = document.getElementById('nextStepBtn');
                const backStepBtn = document.getElementById('backStepBtn');
                const step1 = document.getElementById('step1');
                const step2 = document.getElementById('step2');
                const errorH1 = document.getElementById('errorH1');
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
                                    errorH1.style.display = 'none';
                                    step1.style.display = 'none';
                                    step2.style.display = 'block';
                                    // Set user type based on referral code type
                                    const userType = response.user_type;
                                    generatedReferralCodeInput.value =
                                        selectedUserTypeInput.value = referralCodeInUrl;
                                    userType; // Set user type in the hidden input field
                                } else {
                                    errorH1.innerText = 'Invalid referral code.';
                                    errorH1.style.display = 'block';
                                    step1.style.display = 'none';
                                    step2.style.display = 'none';
                                    errorbtn.style.display = 'block';
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
                    if (!selectedUserType) {
                        alert('Please select a user type.');
                        return;
                    }
                    selectedUserTypeInput.value = selectedUserType;

                    if (step2.style.display !== 'none') {
                        const referralCode = '{{ request()->query('referral_code') }}';
                        if (referralCode) {
                            try {
                                const isValid = await checkReferralCodeValidity(referralCode);
                                if (!isValid) {
                                    errorH1.innerText = 'Invalid referral code. Please enter a valid referral code.';
                                    errorH1.style.display = 'block';
                                    return;
                                }
                            } catch (error) {
                                alert('An error occurred while checking referral code validity.');
                                return;
                            }
                        }

                        // Populate the generated referral code in the hidden input field
                        // generatedReferralCodeInput.value = '{{ session('generated_referral_code') }}';
                    }

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
                    errorH1.style.display = 'none'; // Hide error message when going back
                });
            </script>
        </body>

        </html>
