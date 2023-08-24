@extends('layouts.admin.template')

@section('title', __('messages.purchases'))
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
                            <li class="breadcrumb-item active">{{ __('messages.purchases') }}
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
                                        class="feather icon-plus"></i>&nbsp; {{ __('messages.add_purchase') }}</button>
                                <div class="table-responsive">
                                    <table class="table table-striped dataex-html5-selectors" id="users">
                                        <thead>
                                            <tr>
                                                <th>{{ __('messages.sr_no') }}</th>
                                                <th>{{ __('messages.prodcut_name') }}</th>
                                                <th>{{ __('messages.stock') }}</th>
                                                <th>{{ __('messages.price') }}</th>
                                                <th>{{ __('messages.description') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($purchaseHistories as $key => $user)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ !empty($user->product->title) ? $user->product->title : 'N/A' }}</td>
                                                    <td>{{ $user->stock }}</td>
                                                    <td>{{ $user->price }}</td>
                                                    <td>{{ $user->description }}</td>
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
                            <h4 class="text-uppercase">{{ __('messages.add_purchase') }}</h4>
                        </div>
                        <div class="hide-data-sidebar">
                            <i class="feather icon-x"></i>
                        </div>
                    </div>
                    <div class="data-items pb-3 ps ps--active-y">
                        <form id="savePurchase" action="{{ localized_route('store.purchase') }}" method="POST">
                            <div class="data-fields px-2 mt-3">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-name">{{ __('messages.select_product') }}</label>
                                        <select class="form-control select2" id="users-list-role" name="product_id">
                                            <option value="">{{ __('messages.select_product') }}
                                            </option>
                                            @foreach ($products as $key => $item)
                                                <option value="{{ $item->id }}">
                                                    {{ !empty($item->title) ? $item->title : 'N/A' }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-6 data-field-col">
                                        <label for="data-stock">{{ __('messages.stock') }}</label>
                                        <input type="text" name="stock" class="form-control" id="data-stock" value="{{old('stock')}}"
                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                    </div>
                                    <div class="col-sm-6 data-field-col">
                                        <label for="data-price">{{ __('messages.price') }}</label>
                                        <input type="text" name="price" class="form-control validationFloat" value="{{old('price')}}"
                                            id="data-price">
                                    </div>
                                    <div class="col-sm-12 data-field-col">
                                        <label for="data-description">{{ __('messages.description') }}</label>
                                        <textarea class="form-control" id="data-description" rows="4" name="description" 
                                            placeholder="{{ __('messages.description') }}">{{old('description')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                            </div>
                            <div class="add-data-footer d-flex justify-content-around px-3 mt-2">
                                <div class="add-data-btn">
                                    <button class="btn btn-primary mb-1" type="submit" id="saveUser">
                                        {{ __('messages.save') }}
                                    </button>
                                </div>
                                <div class="cancel-data-btn">
                                    <button type="reset" class="btn btn-outline-danger waves-effect waves-light">{{ __('messages.cancel') }}</button>
                                </div>
                            </div>
                        </form>
                        <div class="ps__rail-y" style="top: 0px; height: 439px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 314px;"></div>
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



            $("#addUser").on("click", function() {
                $(".add-new-data").addClass("show");
                $(".overlay-bg").addClass("show");
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
                buttons: []
            });
            initDelete();

            $('input.validationFloat').on('input', function() {
                this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
            });
        });
    </script>
@endsection
