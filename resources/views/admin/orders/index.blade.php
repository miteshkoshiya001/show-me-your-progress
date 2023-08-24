@extends('layouts.admin.template')

@section('title', __('messages.orders'))
@php
    $start_date = request()->query('start_date');
    $end_date = request()->query('end_date');
    $today_date = request()->query('today_date');
@endphp
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/data-list-view.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/ag-grid/ag-grid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/ag-grid/ag-theme-material.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/pages/aggrid.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/sweetalert2.min.css') }}">

@endsection

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
                            <li class="breadcrumb-item active">orders
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <input type="hidden" id="order_status_list" value='{!! json_encode(config('constants.order_status')) !!}'>
        <input type="hidden" id="delivery-persons" value='{!! json_encode($deliveryPersons) !!}'>
        <section id="column-selectors">
            <!-- users filter start -->
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ __('messages.filters') }}</h4>
                    <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="feather icon-chevron-down"></i></a></li>
                            <li><a data-action=""><i class="feather icon-rotate-cw users-data-filter"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="card-content collapse show">
                    <div class="card-body">
                        <div class="users-list-filter">
                            <form>
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <label for="order-list-status">{{ __('messages.status') }}</label>
                                        <fieldset class="form-group">
                                            <select class="form-control" id="order-list-status">
                                                <option value="">{{ __('messages.all') }}</option>
                                                @foreach (config('constants.order_status') as $status)
                                                    <option value="{{ $status['value'] }}">{{ $status['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                    <div class="col-12 col-sm-6 col-lg-3">
                                        <label for="delivery-list-verified">{{ __('messages.delivery_person') }}</label>
                                        <fieldset class="form-group">
                                            <select class="form-control" id="delivery-list-verified">
                                                <option value="">{{ __('messages.all') }}</option>
                                                <option value="Unassigned">Unassigned</option>
                                                @foreach ($deliveryPersons as $deliveryPerson)
                                                    <option value="{{ $deliveryPerson['name'] }}"
                                                        data-delivery-person-id="{{ $deliveryPerson['id'] }}">
                                                        {{ $deliveryPerson['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- users filter end -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="ag-grid-btns d-flex justify-content-between flex-wrap mb-1">
                                            <div class="dropdown sort-dropdown mb-1 mb-sm-0 d-flex">
                                                <button class="btn btn-white filter-btn dropdown-toggle border text-dark"
                                                    type="button" id="dropdownMenuButton6" data-toggle="dropdown"
                                                    aria-haspopup="true" aria-expanded="false">
                                                    1 - 20 of 500
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right"
                                                    aria-labelledby="dropdownMenuButton6">
                                                    <a class="dropdown-item" href="#">20</a>
                                                    <a class="dropdown-item" href="#">50</a>
                                                    <a class="dropdown-item" href="#">100</a>
                                                    <a class="dropdown-item" href="#">150</a>
                                                </div>
                                                <div class="btn-assign mx-2">
                                                    <button class="btn btn-primary ag-grid-assign-btn">
                                                        {{ __('messages.bulk_assign') }}
                                                    </button>
                                                </div>
                                                <div class="btn-assign mx-2">
                                                    <button class="btn btn-primary ag-grid-status-change-btn">
                                                        {{ __('messages.bulk_status_change') }}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="ag-btns d-flex flex-wrap">
                                                <input type="text"
                                                    class="ag-grid-filter form-control w-50 mr-1 mb-1 mb-sm-0"
                                                    id="filter-text-box" placeholder="Search...." />
                                                <div class="btn-export">
                                                    <button class="btn btn-primary ag-grid-export-btn">
                                                        {{ __('messages.export_as_CSV') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="orders" class="aggrid ag-theme-material"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- START : Modal -->
        <div class="modal fade text-left" id="order-status" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel160" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-warning white">
                        <h5 class="modal-title" id="myModalLabel160">{{ __('messages.order_status') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        {{ __('messages.are_you_sure_you_want_to_change_the_order_status') }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" id="status-change"
                            data-dismiss="modal">{{ __('messages.yes') }}</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- END : Modal -->
    </div>

    <!-- add new sidebar starts -->
    <div class="data-list-view-header">
        <div class="add-new-data-sidebar">
            <div class="overlay-bg"></div>
            <div class="add-new-data w-100">
                <div class="div mt-2 px-2 d-flex new-data-title justify-content-between">
                    <div>
                        <h4 class="text-uppercase">{{ __('messages.order_details') }}</h4>
                    </div>
                    <div class="hide-data-sidebar">
                        <i class="feather icon-x order-details-close"></i>
                    </div>
                </div>
                <div class="data-items pb-3">
                    <div class="spinner-border text-warning" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- add new sidebar ends -->
@endsection
@section('page-js')
    <script src="{{ asset('app-assets/vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/extensions/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            /*=========================================================================================
                File Name: ag-grid.js
                Description: Aggrid Table
                --------------------------------------------------------------------------------------
                Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
                Author: PIXINVENT
                Author URL: http://www.themeforest.net/user/pixinvent
            ==========================================================================================*/

            $(document).ready(function() {
                /*** COLUMN DEFINE ***/
                var customBadgeHTML = function(params) {
                    var color = "";
                    if (params.value == "Pending") {
                        color = "secondary";
                    } else if (params.value == "In progress") {
                        color = "primary";
                    } else if (params.value == "Confirmed") {
                        color = "info";
                    } else if (params.value == "Shipped") {
                        color = "warning";
                    } else if (params.value == "Delivered") {
                        color = "success";
                    } else if (params.value == "Cancelled") {
                        color = "danger";
                    }

                    var selectOptions = [{
                            value: "0",
                            label: "Pending"
                        },
                        {
                            value: "1",
                            label: "In progress"
                        },
                        {
                            value: "2",
                            label: "Confirmed"
                        },
                        {
                            value: "3",
                            label: "Shipped"
                        },
                        {
                            value: "4",
                            label: "Delivered"
                        },
                        {
                            value: "5",
                            label: "Cancelled"
                        }
                    ];
                    return `<div class="badge badge-pill badge-glow badge-${color} mr-1 mb-1">${params.value}</div>`;
                };

                var customIconsHTML = function(params) {
                    var usersIcons = document.createElement("span");
                    var editIconHTML =
                        "<a href='#'><i class= 'users-edit-icon fa fa-pencil-square mr-50 fa-2x'></i></a>"
                    var assignedUserIconHTML = document.createElement('i');
                    var attr = document.createAttribute("class")
                    attr.value = "fa fa-user-plus fa-2x"
                    assignedUserIconHTML.setAttributeNode(attr);
                    assignedUserIconHTML.addEventListener("click", function() {
                        // console.log(params.data.id);
                        initAssignedId(params);
                    });
                    usersIcons.appendChild($.parseHTML(editIconHTML)[0]);
                    usersIcons.appendChild(assignedUserIconHTML);
                    return usersIcons
                }

                var customOrderDetails = function(params) {
                    // return `<span class="cursor-pointer" onclick="initCustomOrderDetails('${params.value}');">${params.value}</span>`;
                    return `<span class="cursor-pointer">${params.value}</span>`;
                }


                var columnDefs = [{
                        headerName: "Phone",
                        field: "phone",
                        editable: false,
                        sortable: true,
                        filter: true,
                        width: 170,
                        pinned: "left"
                    }, {
                        headerName: "Name",
                        field: "name",
                        editable: false,
                        sortable: true,
                        filter: true,
                        width: 150,
                        filter: true,
                        checkboxSelection: true,
                        headerCheckboxSelectionFilteredOnly: true,
                        headerCheckboxSelection: true
                    },
                    {
                        headerName: "Order No",
                        field: "order_id",
                        editable: false,
                        sortable: true,
                        filter: true,
                        width: 150,
                        cellRenderer: customOrderDetails
                    },
                    {
                        headerName: "Amount Total",
                        field: "order_total",
                        editable: false,
                        sortable: true,
                        filter: true,
                        width: 150
                    },
                    {
                        headerName: "Status",
                        field: "status_label",
                        editable: false,
                        sortable: true,
                        filter: true,
                        width: 150,
                        cellRenderer: customBadgeHTML,
                        cellStyle: {
                            "text-align": "center"
                        }
                    },
                    {
                        headerName: "Zipcode",
                        field: "zipcode",
                        editable: false,
                        sortable: true,
                        filter: true,
                        width: 150
                    },
                    {
                        headerName: "Address",
                        field: "address1",
                        editable: false,
                        sortable: true,
                        filter: true,
                        width: 300
                    },
                    {
                        headerName: "Assinged",
                        field: "assigned_name",
                        editable: false,
                        sortable: true,
                        filter: true,
                        width: 150
                    },
                    {
                        headerName: "Action",
                        field: "action",
                        editable: false,
                        sortable: true,
                        filter: true,
                        width: 150,
                        cellRenderer: customIconsHTML,
                    }
                ];

                /*** GRID OPTIONS ***/
                var gridOptions = {
                    columnDefs: columnDefs,
                    rowSelection: "multiple",
                    floatingFilter: true,
                    filter: true,
                    pagination: true,
                    paginationPageSize: 20,
                    pivotPanelShow: "always",
                    colResizeDefault: "shift",
                    animateRows: true,
                    resizable: true,
                    onCellClicked: function(params) {
                        if (params.column.colId == 'status_label') {
                            initOrderChangeEvent(params);
                        }
                        if (params.column.colId == 'order_id') {
                            initCustomOrderDetails(params.value);
                        }
                    },
                    // set background colour on even rows again, this looks bad, should be using CSS classes
                    getRowStyle: function(params) {
                        if (params.data.color) {
                            return {
                                'background-color': params.data.color
                            };
                        }
                    },
                };

                var filterData = function agSetColumnFilter(column, val) {
                    var filter = gridOptions.api.getFilterInstance(column)
                    var modelObj = null
                    if (val !== "all") {
                        modelObj = {
                            type: "equals",
                            filter: val
                        }
                    }
                    filter.setModel(modelObj)
                    gridOptions.api.onFilterChanged()
                }
                //  filter inside delivery verified
                $("#delivery-list-verified").on("change", function() {
                    var deliveryListVerified = $("#delivery-list-verified").val();
                    filterData("assigned_name", deliveryListVerified)
                });
                //  filter inside status
                $("#order-list-status").on("change", function() {
                    gridOptions.api.showLoadingOverlay();
                    var ordersListStatus = $("#order-list-status").val();
                    agGrid
                        .simpleHttpRequest({
                            url: "{{ localized_route('order.list') }}?status=" +
                                ordersListStatus,
                        })
                        .then(function(data) {
                            gridOptions.api.setRowData(data.data);
                            var deliveryListName = $("#delivery-list-verified").val();
                            filterData("assigned_name", deliveryListName)
                        });

                });
                // filter reset
                $(".users-data-filter").click(function() {
                    $('#order-list-status').prop('selectedIndex', 0);
                    $('#order-list-status').change();
                    $('#delivery-list-verified').prop('selectedIndex', 0);
                    $('#delivery-list-verified').change();
                });

                /*** DEFINED TABLE VARIABLE ***/
                var gridTable = document.getElementById("orders");
                var start_date = "{{ $start_date }}";
                var end_date = "{{ $end_date }}";
                var today_date = "{{ $today_date }}";

                /*** GET TABLE DATA FROM URL ***/
                var url =
                    `{{ localized_route('order.list') }}?start_date=${start_date}&end_date=${end_date}&today_date=${today_date}`;

                agGrid
                    .simpleHttpRequest({
                        url: url
                    })
                    .then(function(data) {
                        // console.log(data);
                        gridOptions.api.setRowData(data.data);
                    });
                /*** FILTER TABLE ***/
                function updateSearchQuery(val) {
                    gridOptions.api.setQuickFilter(val);
                }

                $(".ag-grid-filter").on("keyup", function() {
                    updateSearchQuery($(this).val());
                });

                /*** CHANGE DATA PER PAGE ***/
                function changePageSize(value) {
                    gridOptions.api.paginationSetPageSize(Number(value));
                }

                $(".sort-dropdown .dropdown-item").on("click", function() {
                    var $this = $(this);
                    changePageSize($this.text());
                    $(".filter-btn").text("1 - " + $this.text() + " of 500");
                });

                /*** EXPORT AS CSV BTN ***/
                $(".ag-grid-export-btn").on("click", function(params) {
                    gridOptions.api.exportDataAsCsv();
                });

                /*** BULK ASSIGN BTN ***/
                $(".ag-grid-assign-btn").on("click", function(params) {
                    var selectedNodes = gridOptions.api.getSelectedNodes();
                    var selectedNodeOrderIds = [];
                    $.each(selectedNodes, function(index, selectedNode) {
                        selectedNodeOrderIds.push(selectedNode.data.id);
                    });
                    if (selectedNodeOrderIds.length == 0) {
                        errorShow("{{ __('messages.please_select_atleast_one_order') }}");
                        return;
                    }
                    bulkAssignDeliveryPerson(selectedNodeOrderIds.join(","));
                });

                $('.ag-grid-status-change-btn').on('click', function(params) {
                    var selectedNodes = gridOptions.api.getSelectedNodes();
                    var selectedNodeOrderIds = [];
                    $.each(selectedNodes, function(index, selectedNode) {
                        selectedNodeOrderIds.push(selectedNode.data.id);
                    });
                    if (selectedNodeOrderIds.length == 0) {
                        errorShow("{{ __('messages.please_select_atleast_one_order') }}");
                        return;
                    }
                    bulkStatusChange(selectedNodeOrderIds.join(","));
                });

                new agGrid.Grid(gridTable, gridOptions);
                /*** SET OR REMOVE EMAIL AS PINNED DEPENDING ON DEVICE SIZE ***/

                if ($(window).width() < 768) {
                    gridOptions.columnApi.setColumnPinned("email", null);
                } else {
                    gridOptions.columnApi.setColumnPinned("email", "left");
                }
                $(window).on("resize", function() {
                    if ($(window).width() < 768) {
                        gridOptions.columnApi.setColumnPinned("email", null);
                    } else {
                        gridOptions.columnApi.setColumnPinned("email", "left");
                    }
                });
            });

            $(".order-details-close").on('click', function() {
                $(".add-new-data").removeClass("show");
                $(".add-new-data").addClass("hide");
            });

        });

        function capitalizeFirstCharacter(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }

        function initOrderChangeEvent(params) {
            $('#order-status').modal('show');
            $('#status-change').on('click', function() {
                let options = $("#order_status_list").val();;
                console.log(options);
                var statusOptions = {};
                $.each(JSON.parse(options), function(key, value) {
                    statusOptions[key] = value.name;
                });
                const {
                    value: color
                } = Swal.fire({
                    showCloseButton: true,
                    title: "{{ __('messages.update_order_status') }}",
                    input: 'radio',
                    inputOptions: statusOptions,
                    inputValue: params.value != '' ? params.value.toLowerCase() : params.value,
                    inputValidator: (value) => {
                        if (!value) {
                            return "{{ __('messages.you_need_to_choose_something') }}"
                        } else {
                            const orderStatus = JSON.parse(options)[value]["value"];
                            const orderId = params.data.id;
                            $.ajax({
                                url: "{{ localized_route('status.change') }}",
                                type: 'POST',
                                data: {
                                    '_token': "{{ csrf_token() }}",
                                    'id': orderId,
                                    'status': orderStatus,
                                },
                                success: function(data) {
                                    if (data.status == true) {
                                        successShow(data.message);
                                        setTimeout(() => {
                                            location.reload();
                                        }, 2500);
                                    } else {
                                        errorShow(data.message);
                                    }
                                },
                                error: function(data) {
                                    errorShow(data.message);
                                }
                            });
                        }
                    }
                });
            });
        }

        function initAssignedId(params) {
            let optionDeliveryPersons = $('#delivery-persons').val();
            var assignedId = JSON.parse(optionDeliveryPersons);
            var radioOptions = {};
            $.each(assignedId, function(index, value) {
                radioOptions[value.id] = value.name;
            });

            swal.fire({
                showCloseButton: true,
                title: "{{ __('messages.assigned_delivery_person') }}",
                input: 'radio',
                inputOptions: radioOptions,
                inputValue: params.data.assigned_id !== null && params.data.assigned_id !== undefined ? params.data
                    .assigned_id.toString() : '',
                inputValidator: (value) => {
                    if (!value) {
                        return "{{ __('messages.you_need_to_choose_something') }}"
                    } else {
                        const orderId = params.data.id;
                        $.ajax({
                            url: "{{ localized_route('assigned.id') }}",
                            type: 'POST',
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'id': orderId,
                                'assignedId': value,
                            },
                            success: function(data) {
                                if (data.status == true) {
                                    successShow(data.message);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2500);
                                } else {

                                    errorShow(data.message);
                                }
                            },
                            error: function(data) {

                                errorShow(data.message);
                            }
                        });
                    }
                }
            });
        }

        function bulkAssignDeliveryPerson(orderIds) {
            let optionDeliveryPersons = $('#delivery-persons').val();
            var assignedId = JSON.parse(optionDeliveryPersons);
            var radioOptions = {};
            $.each(assignedId, function(index, value) {
                radioOptions[value.id] = value.name;
            });

            swal.fire({
                showCloseButton: true,
                title: "{{ __('messages.assigned_delivery_person') }}",
                input: 'radio',
                inputOptions: radioOptions,
                inputValue: "",
                inputValidator: (value) => {
                    if (!value) {
                        return "{{ __('messages.you_need_to_choose_something') }}"
                    } else {
                        const orderId = orderIds;
                        $.ajax({
                            url: "{{ localized_route('assigned.id') }}",
                            type: 'POST',
                            data: {
                                '_token': "{{ csrf_token() }}",
                                'id': orderId,
                                'assignedId': value,
                            },
                            success: function(data) {
                                if (data.status == true) {
                                    successShow(data.message);
                                    setTimeout(() => {
                                        location.reload();
                                    }, 2500);
                                } else {

                                    errorShow(data.message);
                                }
                            },
                            error: function(data) {

                                errorShow(data.message);
                            }
                        });
                    }
                }
            });
        }

        function bulkStatusChange(orderIds) {
            $('#order-status').modal('show');
            $('#status-change').on('click', function() {
                let options = $("#order_status_list").val();
                var statusOptions = {};
                $.each(JSON.parse(options), function(key, value) {
                    statusOptions[key] = value.name;
                });
                const {
                    value: color
                } = Swal.fire({
                    showCloseButton: true,
                    title: "{{ __('messages.update_order_status') }}",
                    input: 'radio',
                    inputOptions: statusOptions,
                    inputValidator: (value) => {
                        if (!value) {
                            return "{{ __('messages.you_need_to_choose_something') }}"
                        } else {
                            const orderStatus = JSON.parse(options)[value]["value"];
                            const orderId = orderIds;
                            $.ajax({
                                url: "{{ localized_route('status.change') }}",
                                type: 'POST',
                                data: {
                                    '_token': "{{ csrf_token() }}",
                                    'id': orderId,
                                    'status': orderStatus,
                                },
                                success: function(data) {
                                    if (data.status == true) {
                                        successShow(data.message);
                                        setTimeout(() => {
                                            location.reload();
                                        }, 2500);
                                    } else {

                                        errorShow(data.message);
                                    }
                                },
                                error: function(data) {

                                    errorShow(data.message);
                                }
                            });
                        }
                    }
                });
            });
            console.log(orderIds);
        }

        function initCustomOrderDetails(e) {
            $(".add-new-data").addClass("show");
            $.ajax({
                url: "{{ localized_route('order.details') }}",
                type: 'POST',
                data: {
                    order_id: e,
                },
                success: function(response) {
                    if (response.status == true) {
                        $('.data-items').html(response.data.content);
                        $(".order-details").DataTable();
                    } else {
                        $(".add-new-data").removeClass("show");
                        $(".add-new-data").addClass("hide");
                        errorShow(data.message);
                    }
                }
            });
        }
    </script>
@endsection
