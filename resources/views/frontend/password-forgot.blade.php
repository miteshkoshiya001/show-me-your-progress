<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description"
        content="A minimally stocked grocery store typically offers a limited selection of essential items, focusing on providing the most commonly purchased food and household products. ">
    <meta name="keywords"
        content="milk,bader milk,grocery, Spices and seasonings, ketchup, mustard, mayonnaise, salad dressing">
    <meta name="author" content="PIXINVENT">
    <title>{{ config('app.name') }} | {{ __('messages.forgot_password') }}</title>
    <link rel="apple-touch-icon" href="{{ asset('app-assets/images/ico/apple-icon-120.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('app-assets/images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/vendors.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/components.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/dark-layout.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/themes/semi-dark-layout.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/authentication.css') }}">
    <!-- END: Page CSS-->

    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/toastr.min.css') }}">

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css') }}">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body
    class="vertical-layout vertical-menu-modern 1-column  navbar-floating footer-static bg-full-screen-image  blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-11 justify-content-center">
                        <div class="card bg-authentication rounded-0 mb-0">
                            <div class="row m-0">
                                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0">
                                    <img src="{{ asset('app-assets/images/pages/reset-password.png') }}"
                                        alt="branding logo">
                                </div>
                                <div class="col-lg-6 col-12 p-0">
                                    <div class="card rounded-0 mb-0 px-2">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="mb-0">{{ __('messages.forgot_password') }}</h4>
                                            </div>
                                        </div>
                                        {{-- <p class="px-2">Please enter your new password.</p> --}}
                                        <div class="card-content">
                                            <div class="card-body pt-1">
                                                <form>
                                                    <fieldset class="form-label-group">
                                                        <input type="text" class="form-control" id="user-mobile"
                                                            name="phone" placeholder="{{ __('messages.mobile') }}"
                                                            required>
                                                        <label for="user-mobile">{{ __('messages.mobile') }}</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group input-none d-none">
                                                        <input type="password" class="form-control" id="user-password"
                                                            name="password"
                                                            placeholder="{{ __('messages.password') }}">
                                                        <label
                                                            for="user-password">{{ __('messages.password') }}</label>
                                                    </fieldset>

                                                    <fieldset class="form-label-group input-none d-none">
                                                        <input type="password" class="form-control"
                                                            id="user-confirm-password"
                                                            placeholder="{{ __('messages.confirm_password') }}"
                                                            name="confirm_password">
                                                        <label
                                                            for="user-confirm-password">{{ __('messages.confirm_password') }}</label>
                                                    </fieldset>
                                                    <div class="row pt-2">
                                                        <div class="col-12 col-md-6 mb-1">
                                                            <button type="button"
                                                                class="btn btn-primary  btn-block px-0 next">{{ __('messages.next') }}</button>
                                                            <button type="button"
                                                                class="btn btn-primary btn-block px-0 input-none d-none save">{{ __('messages.change') }}</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('app-assets/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('app-assets/js/core/app-menu.js') }}"></script>
    <script src="{{ asset('app-assets/js/core/app.js') }}"></script>
    <script src="{{ asset('app-assets/js/scripts/components.js') }}"></script>
    <!-- END: Theme JS-->

    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>


    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <script>
        $(".next").on("click", function() {
            var mobile = $("#user-mobile").val();

            if (mobile == '') {
                toastr.error("{{ __('messages.please_enter_your_mobile_number') }}");
                return false;
            }

            $.ajax({
                url: "{{ localized_route('save.password.forgot') }}",
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'phone': mobile
                },
                success: function(data) {
                    if (data.status == true) {
                        $('.input-none').removeClass('d-none');
                        $('.next').addClass('d-none');
                        $("#user-mobile").prop("readOnly", true);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        });

        $(".save").on("click", function() {
            var mobile = $("#user-mobile").val();

            var password = $("#user-password").val();
            var confirmPassword = $("#user-confirm-password").val();

            if (password == '') {
                toastr.error("{{ __('messages.please_enter_new_password') }}");
                return false;
            }
            $.ajax({
                url: "{{ localized_route('save.password.forgot') }}",
                type: "POST",
                data: {
                    '_token': "{{ csrf_token() }}",
                    'phone': mobile,
                    'password': password,
                    'confirmPassword': confirmPassword
                },
                success: function(data) {
                    if (data.status == true) {
                        toastr.success(data.message);
                        setTimeout(() => {
                            window.location.href =
                                "{{ localized_route('password.forgot.success') }}";
                        }, 2500);
                    } else {
                        toastr.error(data.message);
                    }
                }
            });
        });
    </script>


</body>
<!-- END: Body-->

</html>
