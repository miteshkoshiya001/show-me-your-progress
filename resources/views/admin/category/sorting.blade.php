@extends('layouts.admin.template')

@section('title', __('messages.Sorting_category'))
@section('page-css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/extensions/dragula.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/extensions/drag-and-drop.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/drag-drop.css') }}">
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
                                    href="{{ localized_route('categories') }}">{{ __('messages.user_categories') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('messages.Sorting_category') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">

        {{-- New Table --}}
        <section id="data-thumb-view" class="data-thumb-view-header">
            <div class="action-btns d-none">
                <div class="btn-dropdown mr-1 mb-1">
                    <div class="btn-group dropdown actions-dropodown">
                    </div>
                </div>
            </div>
        </section>

        <section id="dd-with-handle">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.Sorting_category') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        {{-- <ul class="list-group" id="handle-list-1">
                                            @foreach ($categories as $key => $category)
                                                <li class="list-group-item row1" data-id="{{ $category->id }}"><span
                                                        class="handle">+</span>
                                                    {{ !empty($category->name) ? $category->name : '' }}</li>
                                            @endforeach
                                        </ul> --}}
                                        <div id="box" class="box">
                                            @foreach ($categories as $category)
                                                <div class="catItem data-index" draggable="true" data-id="{{ $category->id }}">
                                                    {{ $category->name }}</div>
                                            @endforeach
                                        </div>
                                        <div id="catItemClip" class="catItem catItemClip hide">some item</div>
                                    </div>
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
    <script src="{{ asset('app-assets/vendors/js/extensions/dragula.min.js') }}"></script>
    <script src="{{ asset('assets/js/drag-drop.js') }}"></script>
    <script>
        function sendOrderToServer() {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ localized_route('update.sorting.category') }}",
                data: {
                    order: order,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status == true) {
                        successShow(response.message);
                    } else {
                        errorShow(response.message);
                        // console.log(response);
                    }
                }
            });
        }
        $(document).ready(function() {
            // With Handles

            dragula([document.getElementById("handle-list-1"), document.getElementById("handle-list-2")], {
                moves: function(el, container, handle) {
                    return handle.classList.contains('handle');
                }
            });






            $("#handle-list-1").on("update", collectOrderData);
        });
    </script>
@endsection
