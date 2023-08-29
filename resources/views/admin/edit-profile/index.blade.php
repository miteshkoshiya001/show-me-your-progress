@extends('layouts.admin.template')

@section('title', __('messages.change_password'))
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-list-view.css') }}">
@endsection()
@section('content')
    <!-- Content wrapper -->
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ localized_route('dashboard') }}">{{ __('messages.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{__('messages.change_password')}}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-md-12">
                <!-- Change Password -->
                <div class="card mb-4">
                    <h5 class="card-header">Change Password</h5>
                    <div class="card-body">

                        <form id="formAccountSettings" method="POST">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="currentPassword">Current Password</label>
                                    <fieldset class="form-group position-relative input-divider-right">
                                        <input type="password" class="form-control" name="currentPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                        <div class="form-control-position">
                                            <i class="feather icon-eye-off"></i>
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="newPassword">New Password</label>
                                    <fieldset class="form-group position-relative input-divider-right">
                                        <input type="password" class="form-control" id="newPassword" name="newPassword"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                        <div class="form-control-position">
                                            <i class="feather icon-eye-off"></i>
                                        </div>
                                    </fieldset>
                                </div>

                                <!-- ... Other form fields ... -->
                                <div class="mb-3 col-md-6 form-password-toggle">
                                    <label class="form-label" for="confirmPassword">Confirm New Password</label>

                                    <fieldset class="form-group position-relative input-divider-right">
                                        <input type="password" class="form-control" id="confirmPassword"
                                            name="newPassword_confirmation"
                                            placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;">
                                        <div class="form-control-position">
                                            <i class="feather icon-eye-off"></i>
                                        </div>
                                    </fieldset>
                                </div>
                                <!-- ... Other form fields ... -->

                                <div>
                                    <button type="submit" class="btn btn-primary me-2 ml-1">Save changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--/ Change Password -->
            </div>
        </div>
    </div>
    <!-- / Content -->

    <div class="content-backdrop fade"></div>

@endsection
@section('page-js')
    <script>
        $(document).ready(function() {
            // Toggle password visibility
            $('.form-password-toggle .form-control-position').click(function() {
                var input = $(this).closest('.form-password-toggle').find('input');
                var icon = $(this).find('i');

                if (input.attr('type') === 'password') {
                    input.attr('type', 'text');
                    icon.removeClass('feather icon-eye-off').addClass('feather icon-eye');
                } else {
                    input.attr('type', 'password');
                    icon.removeClass('feather icon-eye').addClass('feather icon-eye-off');
                }
            });
            // Form submit
            $('#formAccountSettings').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('admin.profile.changePassword') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        if (response.status) {
                            // Password changed successfully
                            successShow(response.message);
                            setTimeout(() => {
                                // location.reload();
                            }, 2000);
                            // Clear form fields
                            $('#formAccountSettings')[0].reset();
                        } else {
                            // Display error message
                            errorShow(response.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        // Handle AJAX error
                        console.error(error);
                        errorShow('An error occurred. Please try again.')

                    }
                });
            });
        });
    </script>
@endsection
