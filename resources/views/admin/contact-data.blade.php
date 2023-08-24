@extends('layouts.admin.template')

@section('title', __('messages.address'))
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
                            <li class="breadcrumb-item active">{{ __('messages.contacts') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="basic-datatable">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.contacts') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="contact-data">
                                        <thead>
                                            <tr>
                                                <th>{{ __('messages.name') }}</th>
                                                <th>{{ __('messages.email') }}</th>
                                                <th>{{ __('messages.phone') }}</th>
                                                <th>{{ __('messages.message') }}</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($contactForms as $contactForm)
                                                <tr>
                                                    <td>{{ $contactForm->name }}</td>
                                                    <td>{{ $contactForm->email }}</td>
                                                    <td>{{ $contactForm->phone }}</td>
                                                    <td>{{ $contactForm->message }}</td>

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
        </section>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).ready(function() {
            /**************************************************************
             * js of Tab for COLUMN SELECTORS WITH EXPORT AND PRINT OPTIONS *
             ***************************************************************/
            $('#contact-data').DataTable();
            initDelete();
        });
    </script>
@endsection
