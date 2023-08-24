@extends('layouts.admin.template')

@section('title', __('messages.users'))
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-list-view.css') }}">
@endsection()
@section('content')
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a
                                    href="{{ localized_route('dashboard') }}">{{ __('messages.home') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.users') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="column-selectors" class="data-list-view-header">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <button id="addUser" class="btn btn-primary mb-2 waves-effect waves-light"><i
                                        class="feather icon-plus"></i>&nbsp; {{ __('messages.add_user') }}</button>
                                <div class="table-responsive">
                                    <table class="table table-striped dataex-html5-selectors" id="users">
                                        <thead>
                                            <tr>
                                                <th>{{ __('messages.sr_no') }}</th>
                                                <th>{{ __('messages.avatar') }}</th>
                                                <th>{{ __('messages.name') }}</th>
                                                <th>{{ __('messages.phone') }}</th>
                                                <th>{{ __('messages.email') }}</th>
                                                <th>{{ __('messages.user_type') }}</th>
                                                <th>{{ __('messages.status') }}</th>
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $key => $user)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td class="avatar p-0"><img src="{{ $user->avatar_url }}"
                                                            alt="{{ $user->name }}" class="user-img">
                                                    </td>
                                                    <td>{{ $user->name }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>{{ !empty($user->email) ? $user->email : 'en' }}</td>
                                                    <td>
                                                        @foreach (config('constants.user_types') as $key => $type)
                                                            @if (in_array($type, explode(',', $user->user_type)))
                                                                <div
                                                                    class="chip chip-{{ !empty($user->user_type == 'delivery_person') ? 'warning' : 'primary' }}">
                                                                    <div class="chip-body">
                                                                        <div class="chip-text">
                                                                            {{ !empty($user->user_type == 'delivery_person') ? 'Delivery Person' : 'Customer' }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        <div
                                                            class="chip chip-{{ !empty($user->status) ? 'success' : 'danger' }}">
                                                            <div class="chip-body">
                                                                <div class="chip-text">
                                                                    {{ !empty($user->status) ? __('messages.active') : __('messages.inactive') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button data-id="{{ $user->id }}"
                                                                data-geturl="{{ localized_route('users.show', $user->id) }}"
                                                                class="editUser btn-outline-primary waves-effect waves-light btn border-right-0"><i
                                                                    class="feather icon-edit"></i></button>
                                                            <button type="button"
                                                                class="btn btn-outline-danger waves-effect waves-light action-delete"
                                                                data-module="{{ get_class($user) }}"
                                                                data-id="{{ $user->id }}"><i
                                                                    class="feather icon-trash"></i></button>
                                                            @if (config('constants.user_types.CUSTOMER') == $user->user_type)
                                                                <button type="button"
                                                                    class="btn btn-outline-primary waves-effect waves-light wallet-history border-left-0"
                                                                    data-toggle="modal" data-target="#exampleModalLong"
                                                                    data-id="{{ $user->id }}"><i
                                                                        class="feather icon-archive"></i></button>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="add-new-data-sidebar">
                <div class="overlay-bg"></div>
                <div class="add-new-data">
                    <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                        <div>
                            <h4 class="text-uppercase">{{ __('messages.add_user') }}</h4>
                        </div>
                        <div class="hide-data-sidebar">
                            <i class="feather icon-x"></i>
                        </div>
                    </div>
                    <div class="data-items pb-3 ps ps--active-y">
                        <div class="data-fields px-2 mt-3">
                            <form id="saveUserForm">

                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">{{ __('messages.name') }}</label>
                                        <input type="text" name="name" class="form-control" id="data-name">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-phone">{{ __('messages.phone') }}</label>
                                        <input type="text" name="phone" class="form-control" id="data-phone">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">{{ __('messages.email') }}</label>
                                        <input type="text" name="email" class="form-control" id="data-email">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name"> {{ __('messages.password') }}</label>
                                        <input type="password" name="password" class="form-control" id="data-password">
                                        <input type="hidden" name="status" id="data-status" value="1">
                                        <input type="hidden" name="language" id="data-langauge" value="en">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">{{ __('messages.user_type') }}</label>
                                        <ul class="list-unstyled mb-0">
                                            <li class="d-inline-block mr-2">
                                                <fieldset>
                                                    <div class="vs-radio-con">
                                                        <input type="radio" name="user_type" checked=""
                                                            value="{{ config('constants.user_types.CUSTOMER') }}">
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span
                                                            class="">{{ ucfirst(config('constants.user_types.CUSTOMER')) }}</span>
                                                    </div>
                                                </fieldset>
                                            </li>
                                            <li class="d-inline-block mr-2">
                                                <fieldset>
                                                    <div class="vs-radio-con">
                                                        <input type="radio" name="user_type"
                                                            value="{{ config('constants.user_types.DELIVERY_PERSON') }}">
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span
                                                            class="">{{ ucfirst(str_replace('_', ' ', config('constants.user_types.DELIVERY_PERSON'))) }}</span>
                                                    </div>
                                                </fieldset>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 0px; height: 439px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 314px;"></div>
                        </div>
                    </div>
                    <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                        <div class="add-data-btn">
                            {{-- <button class="btn btn-primary waves-effect waves-light" data-url="{{ route('user.register') }}" id="saveUser">Save</button> --}}
                            <button class="btn btn-primary mb-1" type="button" id="saveUser"
                                data-url="{{ route('user.register') }}">
                                {{ __('messages.save') }}
                            </button>
                        </div>
                        <div class="cancel-data-btn">
                            <button
                                class="btn btn-outline-danger waves-effect waves-light">{{ __('messages.cancel') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">{{ __('messages.wallet_histories') }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="spinner-border" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('page-js')
    <script>
        function setLoadingBtn(btn) {
            btn.html(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                Saving...`);
            btn.attr("disabled", true);
        }

        function resetLoadingBtn(btn) {
            btn.html(`Save`);
            btn.removeAttr("disabled");
        }

        function walletUpdate() {
            var amount = $("#wallet_amount").val();
            var walletId = $("#wallet_id").val();
            var userWalletId = $("#user_wallet_id").val();
            $.ajax({
                url: "{{ localized_route('update.wallet') }}",
                method: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "amount": amount,
                    "walletId": walletId,
                    "userWalletId": userWalletId
                },
                success: function(response) {
                    if (response.status == true) {
                        successShow(response.message);
                        getWalletHistory(userWalletId)
                    } else {
                        errorShow(response.message);
                    }
                },
                error: function(error) {
                    errorShow(error.message);
                }
            });
        }
        $(document).ready(function() {

            $("#saveUser").on("click", function() {
                console.log($(this));
                var btn = $(this);
                console.log($("#saveUserForm").serialize());
                setLoadingBtn(btn);
                $.ajax({
                    url: $(this).data('url'),
                    type: "POST",
                    data: $("#saveUserForm").serialize(),
                    success: function(result) {
                        resetLoadingBtn(btn);
                        if (result.status) {
                            successShow(result.message);
                            $(".hide-data-sidebar").click();
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            errorShow(result.message);
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        resetLoadingBtn(btn);
                        errorShow(error.responseJSON.message);
                    },
                });
            });

            $("#addUser").on("click", function() {
                $(".add-new-data").addClass("show");
                $(".overlay-bg").addClass("show");
            });

            $(".editUser").on("click", function() {
                $(".add-new-data").addClass("show");
                $(".overlay-bg").addClass("show");
                var getUrl = $(this).data('geturl');
                $.ajax({
                    url: getUrl,
                    type: "GET",
                    data: {},
                    success: function(result) {
                        if (result.status) {
                            $("#data-name").val(result.data.name);
                            $("#data-email").val(result.data.email);
                            $("#data-password").val(result.data.plain_pass);
                            $("#data-phone").val(result.data.phone);
                            $("#data-status").val(result.data.status);
                            $("#data-language").val(result.data.language);
                            $("input[name='user_type'][value='" + result.data.user_type + "']")
                                .prop("checked", true);
                        } else {
                            errorShow(result.message);
                        }
                    },
                    error: function(error) {},
                });
            });

            // Close sidebar
            $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function() {
                $(".add-new-data").removeClass("show");
                $(".overlay-bg").removeClass("show");
            })
            /**************************************************************
             * js of Tab for COLUMN SELECTORS WITH EXPORT AND PRINT OPTIONS *
             ***************************************************************/
            $('#users').DataTable({
                dom: 'Bfrtip',
                order: [
                    [0, "desc"]
                ],
                buttons: [
                    /* {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: [0, ':visible']
                        }
                    }, */
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    /* {
                        text: 'JSON',
                        action: function(e, dt, button, config) {
                            var data = dt.buttons.exportData();

                            $.fn.dataTable.fileSave(
                                new Blob([JSON.stringify(data)]),
                                'Export.json'
                            );
                        }
                    }, */
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        }
                    }
                ]
            });
            initDelete();

            $(".wallet-history").on("click", function() {
                var id = $(this).data("id");
                getWalletHistory(id);
            });
        });

        function getWalletHistory(id) {
            $.ajax({
                url: "{{ localized_route('wallet.history', '') }}/" + id,
                method: 'GET',
                success: function(result) {
                    if (result.status == true) {
                        $('.modal-body').html(result.data.content);
                        $(".wallet-histories").DataTable();
                    } else {
                        console.log(result.status);
                    }
                }
            });
        }
    </script>
@endsection
