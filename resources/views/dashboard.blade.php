@extends('layouts.admin.template')

@section('title', __('messages.dashboard'))

@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/pickadate/pickadate.css') }}">
    <style>
        #dashboard-analytics table tr td:first-child {
            padding-left: 0rem !important;
        }

        #dashboard-analytics table td {
            padding: 0rem !important;
        }
    </style>
@endsection
@section('content')
    <div class="content-header row">
    </div>
    <div class="content-body">
        <!-- Dashboard Analytics Start -->
        <section id="dashboard-analytics">
            <div class="row justify-content-end">
                <div class="col-md-2 col-12 mb-1">
                    <form>
                        <input type='text' class="form-control pickadate" id="start-date"
                            placeholder="Select Start date" />
                    </form>
                </div>
                <div class="col-md-2 col-12 mb-1">
                    <form>
                        <input type='text' class="form-control pickadate" id="end-date" placeholder="Select End date" />
                    </form>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-2">
                    <button class="btn btn-primary filter">{{ __('messages.filter') }}</button>
                    <button class="btn btn-danger reset">{{ __('messages.reset') }}</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <a href="{{ localized_route('users', ['today_date' => \Carbon\Carbon::now()->format('Y-m-d')]) }}"
                            class="text-body">
                            <div class="card-header d-flex align-items-start pb-0">
                                <div>
                                    <h2 class="text-bold-700 mb-0" id="Todays-new-customer">0</h2>
                                    <p> {{ __('messages.today_s_new_customer') }}</p>
                                </div>
                                <div class="avatar bg-rgba-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-users text-primary font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <a href="{{ localized_route('orders', ['today_date' => \Carbon\Carbon::now()->format('Y-m-d')]) }}"
                            class="text-body">
                            <div class="card-header d-flex align-items-start pb-0">
                                <div>
                                    <h2 class="text-bold-700 mb-0" id="Todays-order">0</h2>
                                    <p>{{ __('messages.today_s_order') }}</p>
                                </div>
                                <div class="avatar bg-rgba-success p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-server text-success font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">₹<span id="Todays-payment"> 0 </span></h2>
                                <p>{{ __('messages.today_s_payment') }}</p>
                            </div>
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-dollar-sign text-danger font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <a href="{{ localized_route('purchases', ['today_date' => \Carbon\Carbon::now()->format('Y-m-d')]) }}"
                            class="text-body">
                            <div class="card-header d-flex align-items-start pb-0">
                                <div>
                                    <h2 class="text-bold-700 mb-0">₹<span id="Todays-purchase"> 0 </span></h2>
                                    <p>{{ __('messages.today_s_purchase') }}</p>
                                </div>
                                <div class="avatar bg-rgba-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-dollar-sign text-warning font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <a href="{{ localized_route('orders', ['total_response' => 'total_response']) }}"
                            class="text-body query-paramter" id="href-total-orders">
                            <div class="card-header d-flex align-items-start pb-0">
                                <div>
                                    <h2 class="text-bold-700 mb-0" id="total-orders">0</h2>
                                    <p>{{ __('messages.total_orders') }}</p>
                                </div>
                                <div class="avatar bg-rgba-success p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-server text-success font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <a href="{{ localized_route('users', ['total_response' => 'total_response']) }}"
                            class="text-body query-paramter" id="href-total-customer">
                            <div class="card-header d-flex align-items-start pb-0">
                                <div>
                                    <h2 class="text-bold-700 mb-0" id="total-customer">0</h2>
                                    <p>{{ __('messages.total_customer') }}</p>
                                </div>
                                <div class="avatar bg-rgba-primary p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-users text-primary font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <a href="{{ localized_route('products', ['total_response' => 'total_response']) }}"
                            class="text-body query-paramter" id="href-total-products">
                            <div class="card-header d-flex align-items-start pb-0">
                                <div>
                                    <h2 class="text-bold-700 mb-0" id="total-products">0</h2>
                                    <p>{{ __('messages.total_products') }}</p>
                                </div>
                                <div class="avatar bg-rgba-warning p-50 m-0">
                                    <div class="avatar-content">
                                        <i class="feather icon-alert-octagon text-warning font-medium-5"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <a href="{{ localized_route('categories', ['total_response' => 'total_response']) }}"
                            class="text-body query-paramter"
                            id="href-total-categories">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0" id="total-categories">0</h2>
                                <p>{{ __('messages.total_categories') }}</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-alert-octagon text-warning font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <a href="{{ localized_route('users', ['total_response' => 'total_response', 'type' => 'delivery_person']) }}"
                            class="text-body query-paramter"
                            id="href-total-persons">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0" id="total-delivery-persons">0</h2>
                                <p>{{ __('messages.total_delivery_persons') }}</p>
                            </div>
                            <div class="avatar bg-rgba-primary p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-users text-primary font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">₹<span id="total-payment"> 0 </span></h2>
                                <p>{{ __('messages.total_payment') }}</p>
                            </div>
                            <div class="avatar bg-rgba-danger p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-dollar-sign text-danger font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 col-12">
                    <div class="card">
                        <a href="{{ localized_route('purchases', ['total_response' => 'total_response']) }}"
                            class="text-body query-paramter"
                            id="href-total-purchases">
                        <div class="card-header d-flex align-items-start pb-0">
                            <div>
                                <h2 class="text-bold-700 mb-0">₹<span id="total-purchase"> 0 </span></h2>
                                <p>{{ __('messages.total_purchase') }}</p>
                            </div>
                            <div class="avatar bg-rgba-warning p-50 m-0">
                                <div class="avatar-content">
                                    <i class="feather icon-dollar-sign text-warning font-medium-5"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                    </div>
                </div>
            </div>
            <div class="row match-height">
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4>{{ __('messages.product_orders') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @php
                                    $orderStatusArray = [
                                        'pending' => 'danger',
                                        'in progress' => 'warning',
                                        'confirmed' => 'primary',
                                        'shipped' => 'info',
                                        'delivered' => 'success',
                                        'cancelled' => 'danger',
                                    ];
                                @endphp
                                @foreach (config('constants.order_status') as $key => $status)
                                    <div class="chart-info d-flex justify-content-between mb-75">
                                        <div class="series-info d-flex align-items-center">
                                            <i
                                                class="fa fa-circle-o text-bold-700 text-{{ $orderStatusArray[$key] }}"></i>
                                            <span class="text-bold-600 ml-50">{{ $status['name'] }}</span>
                                        </div>
                                        <div class="product-result">
                                            <span id="order-status-{{ $status['value'] }}">0</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between pb-0">
                            <h4>{{ __('messages.profit_loss') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="chart-info d-flex justify-content-between mb-75 h5">
                                    <div class="series-info d-flex align-items-center">
                                        <i class="fa fa-circle-o text-bold-700 text-primary circle"></i>
                                        <span class="text-bold-600 ml-50" id="text-profit-loss">
                                            {{ __('messages.profit_loss') }} </span>
                                    </div>
                                    <div class="product-result">
                                        ₹<span id="profit-loss" class="font-weight-bolder">0</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Dashboard Analytics end -->

    </div>
@endsection

@section('page-js')
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/pickadate/picker.date.js') }}"></script>


    <script>
        // date picker
        $(".pickadate").pickadate({
            format: 'yyyy-m-d'
        });
        $(document).ready(function() {
            analytics();

            $('.filter').on('click', function() {
                var startDate = $('#start-date').val();
                var endDate = $('#end-date').val();
                if (startDate != '') {
                    analytics(startDate, endDate);
                    var hrefOrders =
                        `{{ localized_route('orders') }}?start_date=${startDate}&end_date=${endDate}`;
                    $('#href-total-orders, #href-total-orders').attr('href', hrefOrders);
                    var hrefUsers =
                        `{{ localized_route('users') }}?start_date=${startDate}&end_date=${endDate}`;
                    $('#href-total-customer').attr('href', hrefUsers);
                    var hrefDelivery =
                        `{{ localized_route('users') }}?type=delivery_person&start_date=${startDate}&end_date=${endDate}`;
                    $('#href-total-persons').attr('href', hrefDelivery);
                    var hrefproducts =
                        `{{ localized_route('products') }}?start_date=${startDate}&end_date=${endDate}`;
                    $('#href-total-products').attr('href', hrefproducts);
                    var hrefCategories =
                        `{{ localized_route('categories') }}?start_date=${startDate}&end_date=${endDate}`;
                    $('#href-total-categories').attr('href', hrefCategories);
                    var hrefpurchases =
                        `{{ localized_route('purchases') }}?start_date=${startDate}&end_date=${endDate}`;
                    $('#href-total-purchases').attr('href', hrefpurchases);
                } else {
                    errorShow("{{ __('messages.select_start_date') }}");
                }
            });

            $('.reset').on('click', function() {
                $('#start-date').val('');
                $('#end-date').val('');
                analytics();
            });

            function analytics(startDate = null, endDate = null) {
                $.ajax({
                    url: "{{ localized_route('analytics') }}",
                    type: "POST",
                    data: {
                        '_token': "{{ csrf_token() }}",
                        'startDate': startDate,
                        'endDate': endDate,
                    },
                    success: function(data) {
                        if (data.status == true) {
                            var response = data.data[0];
                            $('#Todays-new-customer').text(response.todayNewCustomer);
                            $('#Todays-order').text(response.todayOrder);
                            $('#Todays-payment').text(response.todayPayment);
                            $('#Todays-purchase').text(response.todayPurchase);
                            $('#total-orders').text(response.totalOrders);
                            $('#total-customer').text(response.totalCustomer);
                            $('#total-products').text(response.totalProducts);
                            $('#total-categories').text(response.totalCategories);
                            $('#total-delivery-persons').text(response.totalDeliveryPersons);
                            $('#total-payment').text(response.totalPayment);
                            $('#total-purchase').text(response.totalPurchase);
                            $('#order-status-0').text(response.totalOrderPending);
                            $('#order-status-1').text(response.totalOrderInProgress);
                            $('#order-status-2').text(response.totalOrderConfirmed);
                            $('#order-status-3').text(response.totalOrderShipped);
                            $('#order-status-4').text(response.totalOrderDelivered);
                            $('#order-status-5').text(response.totalOrderCancelled);
                            $('#profit-loss').text(response.totalProfitLoss);
                            if (response.totalProfitLoss < 0) {
                                $("#text-profit-loss").text("{{ __('messages.loss') }}");
                                $(".circle").removeClass("text-success text-primary").addClass(
                                    "text-danger");
                            } else if (response.totalProfitLoss > 0) {
                                $("#text-profit-loss").text("{{ __('messages.profit') }}");
                                $(".circle").removeClass("text-danger text-primary").addClass(
                                    "text-success");
                            } else {
                                $("#text-profit-loss").html("{{ __('messages.profit_loss') }}");
                                $(".circle").removeClass("text-danger text-success").addClass(
                                    "text-primary");
                            }
                        } else {
                            errorShow(data.message);
                        }
                    }
                });
            }
        });
    </script>
@endsection
