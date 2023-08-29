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
                                    {{-- <button id="addUser" class="btn btn-primary mb-2 waves-effect waves-light"><i
                                            class="feather icon-plus"></i>&nbsp; {{ __('messages.add_user') }}</button> --}}
                                    <div class="table-responsive">
                                        <table class="table table-striped dataex-html5-selectors" id="users">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('messages.sr_no') }}</th>
                                                    <th>{{ __('messages.avatar') }}</th>
                                                    <th>{{ __('messages.first_name') }}</th>
                                                    <th>{{ __('messages.last_name') }}</th>
                                                    <th>{{ __('messages.user_name') }}</th>
                                                    <th>{{ __('messages.phone') }}</th>
                                                    <th>{{ __('messages.email') }}</th>
                                                    <th>{{ __('messages.user_type') }}</th>
                                                    <th>{{ __('messages.referral_code') }}</th>
                                                    <th>{{ __('messages.parent_id') }}</th>
                                                    <th>{{ __('messages.language_type') }}</th>
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
                                                        <td>{{ $user->first_name }}</td>
                                                        <td>{{ $user->last_name }}</td>
                                                        <td>{{ $user->username }}</td>
                                                        <td>{{ !empty($user->phone) ? $user->phone : '--' }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->user_category }}
                                                        </td>
                                                        <td>{{ $user->referral_code }}</td>
                                                        <td>{{ $user->parent_id }}</td>
                                                        <td>{{ $user->language }}</td>
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
                                                            <div class="btn-group" role="group"
                                                                aria-label="Basic example">
                                                                <button data-id="{{ $user->id }}"
                                                                    data-geturl="{{ localized_route('users.edit', $user->id) }}"
                                                                    class="editUser btn-outline-primary waves-effect waves-light btn border-right-0">
                                                                    <i class="feather icon-edit"></i>
                                                                </button>

                                                                <button type="button"
                                                                    class="btn btn-outline-danger waves-effect waves-light action-delete"
                                                                    data-module="{{ get_class($user) }}"
                                                                    data-id="{{ $user->id }}"><i
                                                                        class="feather icon-trash"></i></button>
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
                                <h4 class="text-uppercase">{{ __('messages.edit_user') }}</h4>
                            </div>
                            <div class="hide-data-sidebar">
                                <i class="feather icon-x"></i>
                            </div>
                        </div>
                        <div class="data-items pb-3 ps ps--active-y">
                            <div class="data-fields px-2 mt-3">
                                @isset($user)
                                    <form id="saveUserForm">
                                        <input type="hidden" name="user_id" id="data-id" value="">
                                        <div class="row">
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-firstname">{{ __('messages.first_name') }}</label>
                                                <input type="text" name="first_name" class="form-control"
                                                    id="data-firstname"
                                                    value="{{ !empty($user->first_name) ? $user->first_name : null }}">
                                            </div>
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-lastname">{{ __('messages.last_name') }}</label>
                                                <input type="text" name="last_name" class="form-control"
                                                    id="data-lastname" value="{{ $user->last_name }}">
                                            </div>
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-username">{{ __('messages.user_name') }}</label>
                                                <input type="text" name="username" class="form-control"
                                                    id="data-username" value="{{ $user->username }}">
                                            </div>
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-phone">{{ __('messages.phone') }}</label>
                                                <input type="text" name="phone" class="form-control" id="data-phone"
                                                    value="{{ $user->phone }}">
                                            </div>
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-email">{{ __('messages.email') }}</label>
                                                <input type="text" name="email" class="form-control" id="data-email"
                                                    value="{{ $user->email }}">
                                            </div>
                                            <div class="col-sm-12 data-field-col">
                                                <label for="user_category_filter">{{ __('messages.user_type') }}</label>
                                                <select class="form-control" id="user_category_filter"
                                                    name="user_category_id">
                                                    <option value="">{{ __('messages.user_type') }}</option>
                                                    @foreach ($userCategories as $category)
                                                        <option value="{{ $category->id }}"
                                                            {{ $category->id === $user->user_category_id ? 'selected' : '' }}>
                                                            {{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-12 data-field-col">
                                                <label for="data-language">{{ __('messages.language') }}</label>
                                                <input type="text" name="language" class="form-control"
                                                    id="data-language" value="{{ $user->language }}">
                                            </div>
                                            <div class="col-lg-2 col-md-2 data-field-col">
                                                <fieldset class="form-group">
                                                    <div
                                                        class="custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                        <label class="mb-0">{{ __('messages.status') }}</label>
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitchStatus" name="status" value="1"
                                                            {{ $user->status == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customSwitchStatus">
                                                            <span
                                                                class="switch-text-left">{{ __('messages.active') }}</span>
                                                            <span
                                                                class="switch-text-right">{{ __('messages.inactive') }}</span>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </form>
@endisset
                            </div>
                            <!-- ... -->
                        </div>
                        <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                            <div class="add-data-btn">
                                <button class="btn btn-primary mb-1" type="button" id="saveUser"
                                    data-url="{{ localized_route('users.update', '') }}">
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


            $(document).ready(function() {

                $("#saveUser").on("click", function() {
                    console.log("Save button clicked.");
                    var btn = $(this);
                    var userId = $("#data-id").val();
                    var dataUrl = btn.data('url') + '/' + userId;
                    // var dataUrl = btn.data('url');
                    // console.log("data-url:", dataUrl);
                    var form = btn.closest('.add-new-data').find('#saveUserForm');

                    setLoadingBtn(btn);

                    $.ajax({
                        url: dataUrl,
                        type: "POST",
                        data: form.serialize(),
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
                                // Populate form fields
                                $("#data-id").val(result.data.id);
                                $("#data-firstname").val(result.data.first_name);
                                $("#data-lastname").val(result.data.last_name);
                                $("#data-username").val(result.data.username);
                                $("#data-phone").val(result.data.phone);
                                $("#data-email").val(result.data.email);
                                $("#user_category_filter").val(result.data.user_category_id);
                                $("#data-language").val(result.data.language);

                                if (result.data.status == 1) {
                                    $("#customSwitchStatus").prop("checked", true);
                                } else {
                                    $("#customSwitchStatus").prop("checked", false);
                                }
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
        </script>
    @endsection
