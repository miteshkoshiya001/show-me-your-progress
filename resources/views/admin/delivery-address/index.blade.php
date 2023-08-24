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
                            <li class="breadcrumb-item active">{{ __('messages.delivery_address_list') }}
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
                            <h4 class="card-title">{{ __('messages.delivery_address_list') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="delivery-address">
                                        <thead>
                                            <tr>
                                                <th>{{ __('messages.name') }}</th>
                                                <th>{{ __('messages.address') }}</th>
                                                <th>{{ __('messages.landmark') }}</th>
                                                <th>{{ __('messages.zipcode') }}</th>
                                                <th>{{ __('messages.type') }}</th>
                                                <th>{{ __('messages.status') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($deliveryAddress as $deliveryAddres)
                                            <tr>
                                                <td>{{!empty($deliveryAddres->getUser->name) ? $deliveryAddres->getUser->name : 'N/A' }}</td>
                                                <td>{{!empty($deliveryAddres->address1) ? $deliveryAddres->address1 : 'N/A' }}</td>
                                                <td>{{!empty($deliveryAddres->landmark) ? $deliveryAddres->landmark : 'N/A' }}</td>
                                                <td>{{!empty($deliveryAddres->zipcode) ? $deliveryAddres->zipcode : 'N/A' }}</td>
                                                <td>{{!empty($deliveryAddres->type) ? $deliveryAddres->type : 'N/A' }}</td>
                                                <td>
                                                    <div class="chip chip-{{ !empty($deliveryAddres->status) ? 'success' : 'danger' }}">
                                                        <div class="chip-body">
                                                            <div class="chip-text"> {{ !empty($deliveryAddres->status) ? __('messages.yes') : __('messages.no') }} </div>
                                                        </div>
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
        </section>
    </div>
@endsection
@section('page-js')
    <script>
        $(document).ready(function() {
            /**************************************************************
             * js of Tab for COLUMN SELECTORS WITH EXPORT AND PRINT OPTIONS *
             ***************************************************************/
             $('#delivery-address').DataTable();
            initDelete();
        });
    </script>
@endsection