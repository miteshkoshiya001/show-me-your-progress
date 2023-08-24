@extends('layouts.admin.template')

@section('title', $title)
@section('page-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/file-uploaders/dropzone.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/css/plugins/file-uploaders/dropzone.css') }}">
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
                            <li class="breadcrumb-item"><a
                                    href="{{ localized_route('products') }}">{{ __('messages.products') }}</a>
                            </li>
                            <li class="breadcrumb-item active"> {{ $title }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section id="basic-vertical-layouts" class="products">
            <div class="row match-height">
                <div class="col-md-12 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $title }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <form class="form form-vertical" action="{{ localized_route('store.product') }}"
                                            method="post" enctype="multipart/form-data" id="store-product">
                                            @csrf
                                            <input type="hidden" name="id" id="product-id"
                                                value="{{ old('id', $product->id ?? 0) }}">
                                            <div class="form-body">
                                                <div class="row">
                                                    @foreach (config('translatable.locales') as $lang)
                                                        <div class="col-12 col-sm-6 col-lg-6">
                                                            <div class="form-group">
                                                                <label for="title">{{ __('messages.title') }} (
                                                                    {{ __('messages.' . $lang) }} )</label>
                                                                <input type="text" id="title" class="form-control"
                                                                    value="{{ $translations['' . $lang . '']['title'] ?? '' }}"
                                                                    name="{{ $lang }}[title]"
                                                                    placeholder="{{ __('messages.title') }} ({{ __('messages.' . $lang) }})">
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    @foreach (config('translatable.locales') as $language)
                                                        <div class="col-12 col-sm-6">
                                                            <fieldset class="form-group">
                                                                <label
                                                                    for="{{ $language }}-description">{{ __('messages.description') }}
                                                                    ({{ __('messages.' . $language) }})
                                                                </label>
                                                                <textarea class="form-control" id="{{ $language }}-description" rows="4"
                                                                    name="{{ $language }}[description]"
                                                                    placeholder="{{ __('messages.description') }} ({{ __('messages.' . $language) }})">{{ $translations['' . $language . '']['description'] ?? '' }}</textarea>
                                                            </fieldset>
                                                        </div>
                                                    @endforeach
                                                    <div class="col-lg-3 col-md-12">
                                                        <fieldset class="form-group">
                                                            <label
                                                                for="basicInputFile">{{ __('messages.select_category') }}</label>
                                                            <select class="form-control" id="users-list-role"
                                                                name="category_id">
                                                                <option value="">{{ __('messages.select_category') }}
                                                                </option>
                                                                @foreach ($categories as $key => $category)
                                                                    <option value="{{ $category->id }}"
                                                                        @if (isset($product) && !empty($category->id == $product->category_id)) selected @endif>
                                                                        {{ !empty($category->name) ? $category->name : '' }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-lg-3 col-md-12">
                                                        <fieldset class="form-group">
                                                            <label
                                                                for="basicInputFile">{{ __('messages.select_unit') }}</label>
                                                            <select class="form-control" id="users-list-role"
                                                                name="uom_id">
                                                                <option value="">{{ __('messages.select_unit') }}
                                                                </option>
                                                                @foreach ($uoms as $key => $uom)
                                                                    <option value="{{ $uom->id }}"
                                                                        @if (isset($product) && !empty($uom->id == $product->uom_id)) selected @endif>
                                                                        {{ !empty($uom->symbol) ? $uom->symbol : '' }}
                                                                        ({{ !empty($uom->title) ? $uom->title : '' }})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-12 col-sm-3">
                                                        <div class="form-group">
                                                            <label
                                                                for="unit_number">{{ __('messages.unit_number') }}</label>
                                                            <input type="text" id="unit_number" class="form-control validationFloat"
                                                                value="{{ old('unit_number', !empty($product->unit_number) ? $product->unit_number : '') }}"
                                                                name="unit_number"
                                                                placeholder="{{ __('messages.unit_number') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-3">
                                                        <div class="form-group">
                                                            <label for="stock">{{ __('messages.stock') }}</label>
                                                            <input type="text" id="stock" class="form-control"
                                                                value="{{ old('stock', !empty($product->stock) ? $product->stock : '') }}"
                                                                name="stock" placeholder="{{ __('messages.stock') }}"
                                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-3 col-md-2">
                                                        <div class="form-group">
                                                            <label for="price">{{ __('messages.price') }}</label>
                                                           
                                                            <input type="text" id="price"
                                                                class="form-control validationFloat"
                                                                value="{{ old('price', !empty($product->price) ? $product->getAttributes()['price'] : '') }}"
                                                                name="price" placeholder="{{ __('messages.price') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-3 col-md-2">
                                                        <div class="form-group">
                                                            <label
                                                                for="actual_price">{{ __('messages.actual_price') }}</label>
                                                            <input type="text" id="actual_price"
                                                                class="form-control validationFloat"
                                                                value="{{ old('actual_price', !empty($product->actual_price) ? $product->actual_price : '') }}"
                                                                name="actual_price"
                                                                placeholder="{{ __('messages.actual_price') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-3 col-md-2">
                                                        <div class="form-group">
                                                            <label
                                                                for="fake_price">{{ __('messages.fake_price') }}</label>
                                                            <input type="text" id="fake_price"
                                                                class="form-control validationFloat"
                                                                value="{{ old('fake_price', !empty($product->fake_price) ? $product->fake_price : 0) }}"
                                                                name="fake_price"
                                                                placeholder="{{ __('messages.fake_price') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-3">
                                                        <div class="form-group">
                                                            <label
                                                                for="user_discount">{{ __('messages.user_discount') }}</label>
                                                            <input type="text" id="user_discount"
                                                                class="form-control validationFloat"
                                                                value="{{ old('user_discount', !empty($product->user_discount) ? $product->user_discount : 0) }}"
                                                                name="user_discount"
                                                                placeholder="{{ __('messages.user_discount') }}">
                                                        </div>
                                                    </div>


                                                    <div class="col-lg-2 col-md-2">
                                                        <fieldset class="form-group">
                                                            <div
                                                                class="custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                                <p class="mb-0">{{ __('messages.status') }} </p>
                                                                <input type="checkbox" class="custom-control-input"
                                                                    id="customSwitchStatus" name="status" value="1"
                                                                    {{ old('status', $product->status ?? 0) == 1 ? 'checked' : '' }}>
                                                                <label class="custom-control-label"
                                                                    for="customSwitchStatus">
                                                                    <span
                                                                        class="switch-text-left">{{ __('messages.active') }}
                                                                    </span>
                                                                    <span
                                                                        class="switch-text-right">{{ __('messages.inactive') }}
                                                                    </span>
                                                                </label>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="button" class="btn btn-primary mr-1 mb-1"
                                                            id="submit">{{ __('messages.submit') }}</button>
                                                        <a href="{{ localized_route('products') }}"
                                                            class="btn btn-outline-primary mr-1 mb-1">{{ __('messages.cancel') }}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-12 col-lg-6">
                                        <form class="dropzone dropzone-area" id="dpz-multiple-files">
                                            @csrf
                                            <div class="dz-message">{{ __('messages.drop_files_here_to_upload') }}</div>
                                        </form>
                                        <div class="dropzone-previews mt-3" id="file-previews"></div>
                                        <div class="d-none" id="uploadPreviewTemplate">
                                            <div class="card mt-1 mb-0 shadow-none border">
                                                <div class="p-1 dropzone-selected-image">
                                                    <div class="row align-items-center">
                                                        <div class="col-auto">
                                                            <img data-dz-thumbnail src="#"
                                                                class="avatar-sm rounded bg-light show-image"
                                                                alt="">
                                                        </div>
                                                        <div class="col ps-0">
                                                            <a href="javascript:void(0);" class="fw-bold"
                                                                data-dz-name></a>
                                                        </div>
                                                        <div class="col-auto deleted-images">
                                                            <a href="" class="btn btn-link btn-lg text-muted"
                                                                data-dz-remove>
                                                                <i class="feather icon-trash-2 fa-2x text-danger"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="dz-error-message"><span data-dz-errormessage></span></div>
                                                </div>
                                            </div>
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
    <script type="text/javascript">
        Dropzone.autoDiscover = false;
        var myDropzone = null;
        var tempDropZone = [];
        var dropzone = new Dropzone("#dpz-multiple-files", {
            method: "POST",
            parallelUploads: 5,
            maxFiles: 5,
            uploadMultiple: true,
            paramName: "product_images[]",
            autoProcessQueue: false,
            url: "{{ url('admin/product/store-images/') }}",
            previewTemplate: document.getElementById('uploadPreviewTemplate').innerHTML,
            previewsContainer: document.getElementById('file-previews'),
            dictMaxFilesExceeded: 'Only 5 images are allowed',
            removedfile: function(file) {
                const deleteDialog = new duDialog(
                    null,
                    "Are you sure want to delete this item?", {
                        buttons: duDialog.OK_CANCEL,
                        yesText: "Delete",
                        noText: "Cancel",
                        callbacks: {
                            okClick: function() {
                                this.setLoading(true,
                                    true); // set loading to `true`, and cancellable to `true`
                                // peform delete
                                $.ajax({
                                    url: window.location.origin + '/admin/' + "delete-item",
                                    // url: "delete-item",
                                    type: "DELETE",
                                    data: {
                                        id: file.imageId,
                                        object: 'App\\Models\\ProductImages',
                                    },
                                    success: function(result) {
                                        deleteDialog.hide();
                                        file.previewElement.remove();
                                        successShow(result.message);
                                    },
                                    error: function(error) {
                                        deleteDialog.hide();
                                        file.previewElement.remove();
                                        errorShow(error.responseJSON.message);
                                    },
                                });
                            },
                        },
                    }
                );
            },
            init: function() {
                myDropzone = this;
                tempDropZone = myDropzone;

                /* Get already uploaded images */
                $.ajax({
                    url: "{{ url('admin/product/images') }}/" + $('#product-id').val(),
                    type: "GET",
                    success: function(result) {
                        if (result.status == false) {
                            return;
                        }
                        if (result.data.length > 0) {
                            $.each(result.data, function(key, value) {
                                if ($('.dropzone-selected-image').length < 6) {
                                    var mockFile = {
                                        name: value.image,
                                        imageId: value.id
                                    };
                                    myDropzone.emit("addedfile", mockFile);
                                    myDropzone.emit("thumbnail", mockFile, value.image_url);
                                    myDropzone.emit("remove", mockFile, value.id);
                                }
                            });
                        }
                    },
                    error: function() {
                        console.log("error");
                    }
                });

                myDropzone.on("addedfile", function(file) {
                    if (($('.dropzone-selected-image').length) > 6) {
                        errorShow("{{ __('messages.product_images_must_be_less_then_5') }}");
                        return false;
                    }
                });

                myDropzone.on("queuecomplete", function(file) {
                    console.log(file);
                    successShow("{{ __('messages.product_has_been_update_successfully') }}");
                    setTimeout(() => {
                        window.location.href = "{{ localized_route('products') }}";
                    }, 2500);

                });
                /* Get already uploaded images */
            },
        });

        function updateDropzoneAction(dropzone, id) {
            if (dropzone != '') {
                dropzone.options.url = "{{ url('admin/product/store-images/') }}" + '/' + id;
            }
        }

        $(document).ready(function() {
            $('input.validationFloat').on('input', function() {
                this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');
            });

            // Add/Edit
            $('#submit').on('click', function(e) {
                e.preventDefault();
                var form = $('#store-product');
                if (($('.dropzone-selected-image').length) == 1) {
                    errorShow("{{ __('messages.please_select_product_images') }}");
                    return false;
                }
                if (($('.dropzone-selected-image').length) > 6) {
                    errorShow("{{ __('messages.product_images_must_be_less_then_5') }}");
                    return false;
                }
                $.ajax({
                    url: form.attr('action'),
                    type: 'POST',
                    data: form.serialize(),
                    success: function(result) {
                        if (result.status == true) {
                            updateDropzoneAction(myDropzone, result.data['product_id']);
                            if (myDropzone.files.length > 5) {
                                errorShow(
                                    "{{ __('messages.product_images_must_be_less_then_5') }}"
                                );
                            } else {
                                myDropzone.processQueue();
                                successShow(result
                                    .message);
                            }
                        } else {
                            errorShow(result
                                .message);
                        }
                    },
                    error: function(data) {
                        errorShow(data.responseJSON['message']);
                    },
                });
            });
        });
    </script>
@endsection
