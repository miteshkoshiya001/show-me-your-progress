@extends('layouts.admin.template')

@section('title', __('messages.sorting_products'))
@section('page-css')
    <style>
        .LeftFloat {
            float: left
        }

        .RightFloat {
            float: right
        }

        .collection {
            font-family: tahoma;
        }

        .item {
            margin: 3px;
            border: 1px dashed #7a6ff1;
            background-color: #e8efff;
            height: 80px;
        }

        .item div.Commands {
            width: 60px;
        }

        .btn-up-down {
            width: 42px;
            height: 40px;
        }

        .category-img {
            width: 60px;
            height: 60px;
        }
    </style>
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
                            <li class="breadcrumb-item"><a
                                    href="{{ localized_route('categories') }}">{{ __('messages.categories') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.sorting_products') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body text-center">

        <ul class="list-group collection" id="handle-list">
            @foreach ($products as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center item mb-2"
                    id="{{ $product->id }}" data-id="{{ $product->id }}">
                    <img src="{{ !empty($product->images[0]->image_url) ? $product->images[0]->image_url : '' }}" alt="" class="category-img">
                    <span> {{ $product->title }} </span>
                    <span>
                        <button type="button" value='up'
                            class="btn btn-icon rounded-circle btn-outline-primary waves-effect waves-light btn-up-down mr-1"><i
                                class="feather icon-arrow-up"></i></button>
                        <button type="button" value='down'
                            class="btn btn-icon rounded-circle btn-outline-primary waves-effect waves-light btn-up-down"><i
                                class="feather icon-arrow-down"></i></button>
                    </span>
                </li>
            @endforeach
        </ul>
        <div id="items"></div>
    </div>
@endsection
@section('page-js')
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".collection").sortable({
                items: ".item",
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            $('.btn-up-down').click(function() {
                var btn = $(this);
                var val = btn.val();
                if (val == 'up')
                    moveUp(btn.parents('.item'));
                else
                    moveDown(btn.parents('.item'));

                // setTimeout(() => {
                //     sendOrderToServer();
                // }, 1000);
            });
            var orderList = jQuery.grep($(".collection").sortable('toArray'), function(n, i) {
                return (n !== "" && n != null);
            });

            $("#btn-save").on("click", function() {
                sendOrderToServer();
            });
        });

        function moveUp(item) {
            var prev = item.prev();
            if (prev.length == 0)
                return;
            prev.css('z-index', 999).css('position', 'relative').animate({
                top: item.height()
            }, 250);
            item.css('z-index', 1000).css('position', 'relative').animate({
                top: '-' + prev.height()
            }, 300, function() {
                prev.css('z-index', '').css('top', '').css('position', '');
                item.css('z-index', '').css('top', '').css('position', '');
                item.insertBefore(prev);
            });
        }

        function moveDown(item) {
            var next = item.next();
            if (next.length == 0)
                return;
            next.css('z-index', 999).css('position', 'relative').animate({
                top: '-' + item.height()
            }, 250);
            item.css('z-index', 1000).css('position', 'relative').animate({
                top: next.height()
            }, 300, function() {
                next.css('z-index', '').css('top', '').css('position', '');
                item.css('z-index', '').css('top', '').css('position', '');
                item.insertAfter(next);
            });
        }

        var order = [];

        function sendOrderToServer() {
            order = [];
            $('.collection li').each(function(index, element) {
                console.log(index, $(element).data('id'));
                var rowData = $(element).data('id');
                if (rowData) {
                    order.push({
                        id: rowData,
                        position: index + 1
                    });
                }
            });

            console.log(order);
            order.sort(function(a, b) {
                return a.position - b.position;
            });


            collectOrderData();
        }

        function collectOrderData() {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ localized_route('update.sorting.product.category') }}",
                data: {
                    order: order,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == true) {
                        successShow(response.message);

                    } else {
                        errorShow(response.message);
                    }
                }
            });
        }
    </script>
@endsection
