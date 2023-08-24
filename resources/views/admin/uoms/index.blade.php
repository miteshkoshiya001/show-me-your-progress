@extends('layouts.admin.template')

@section('title', __('messages.units'))
@section('page-css')
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
                            <li class="breadcrumb-item active">{{ __('messages.units_of_measurement_list') }}
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
                <div class="m-1">
                    <span class="btn btn-outline-primary text-primary"
                        onclick="uomModel(event,0);">{{ __('messages.add_unit') }}</span>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.units_of_measurement_list') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body card-dashboard">
                                <div class="table-responsive">
                                    <table class="table zero-configuration" id="uoms">
                                        <thead>
                                            <tr>
                                                <th>{{ __('messages.title') }}</th>
                                                <th>{{ __('messages.symbol') }}</th>
                                                <th>{{ __('messages.action') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($uoms as $uom)
                                                <tr>
                                                    <td>{{ !empty($uom->title) ? $uom->title : 'N/A' }}</td>
                                                    <td>{{ !empty($uom->symbol) ? $uom->symbol : 'N/A' }}</td>
                                                    <td class="product-action">
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button class="btn btn-outline-primary waves-effect waves-light"
                                                                onclick="uomModel(event, {{ $uom->id }});"
                                                                data-title="{{ !empty($uom->title) ? $uom->title : 'N/A' }}"
                                                                data-symbol="{{ !empty($uom->symbol) ? $uom->symbol : 'N/A' }}"><i
                                                                    class="feather icon-edit"
                                                                    data-title="{{ !empty($uom->title) ? $uom->title : 'N/A' }}"
                                                                    data-symbol="{{ !empty($uom->symbol) ? $uom->symbol : 'N/A' }}"></i></button>
                                                            <button type="button"
                                                                class="btn btn-outline-danger waves-effect waves-light action-delete"
                                                                data-module="{{ get_class($uom) }}"
                                                                data-id="{{ $uom->id }}"><i
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
        </section>
    </div>

    <div class="modal text-left uomModel" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel33">{{ __('messages.add_unit') }} </h4>
                    <button type="button" class="close" id="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <span class="text-danger errors m-1"></span>
                <form id="form" method="post" action="{{ localized_route('store.uom') }}">
                    <div class="modal-body">
                        <label>{{ __('messages.title') }}: </label>
                        <div class="form-group">
                            <input type="text" placeholder="{{ __('messages.title') }}" name="title" id="title"
                                class="form-control">
                            <input type="hidden" name="id" id="uom_id" value="" class="form-control">
                        </div>

                        <label>{{ __('messages.symbol') }}: </label>
                        <div class="form-group">
                            <input type="text" placeholder="{{ __('messages.symbol') }}" name="symbol" value=""
                                id="symbol" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                            id="submit">{{ __('messages.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-js')
    <script type="text/javascript">
        function uomModel(e, id) {
            $('#form')[0].reset();
            if (id != '') {
                $('.modal-title').html(`{{ __('messages.edit_unit') }}`);
                $('#uom_id').val(id);
                $('#title').val(e.target.getAttribute("data-title"));
                $('#symbol').val(e.target.getAttribute("data-symbol"));
            }
            if (id == '') {
                $('.modal-title').html(`{{ __('messages.add_unit') }}`);
            }
            $('.errors').empty('');
            $('#inlineForm').show();
        }
        $(document).ready(function() {
            $('#uoms').DataTable();
            initDelete();
            $('#close').click(function(e) {
                $('#inlineForm').hide();
            });
            $('#submit').click(function(e) {
                e.preventDefault();
                var form = $('#form');
                var url = form.attr('action');
                var data = form.serialize();
                $.ajax({
                    url: url,
                    type: "POST",
                    data: data,
                    success: function(response) {
                        if (response.status == true) {
                            $('#inlineForm').hide();
                            successShow(response
                                .message);
                            setTimeout(() => {
                                location.reload();
                            }, 2000);
                        } else {
                            $('.errors').html(response.message);
                        }
                    },
                });
            });

        });
    </script>
@endsection
