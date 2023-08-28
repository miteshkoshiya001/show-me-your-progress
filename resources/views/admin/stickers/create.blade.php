    @extends('layouts.admin.template')

    @section('title', $title)
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
                                        href="{{ localized_route('sticker-categories') }}">{{ __('messages.sticker_category') }}</a>
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
            <section id="basic-vertical-layouts">
                <div class="row match-height">
                    <div class="col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">{{ $title }}</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form form-vertical" action="{{ localized_route('store.sticker-category') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ old('id', $stickerCategory->id ?? 0) }}">
                                        <div class="form-body">
                                            <div class="row">
                                                @foreach (config('translatable.locales') as $lang)
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="name">{{ __('messages.name') }} (
                                                                {{ __('messages.' . $lang) }} )</label>
                                                            <input type="text" id="name" class="form-control"
                                                                value="{{ $translations['' . $lang . '']['name'] ?? '' }}"
                                                                name="{{ $lang }}[name]"
                                                                placeholder="{{ __('messages.name') }} ({{ __('messages.' . $lang) }})"
                                                                required>
                                                        </div>
                                                    </div>
                                                @endforeach

                                                <div class="col-lg-2 col-md-2">
                                                    <fieldset class="form-group">
                                                        <div class="custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                            <p class="mb-0">{{ __('messages.status') }} </p>
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="customSwitchStatus" name="status" value="1"
                                                                {{ old('status', $stickerCategory->status ?? 1) == 1 ? 'checked' : '' }}>
                                                            <label class="custom-control-label" for="customSwitchStatus">
                                                                <span class="switch-text-left">{{ __('messages.active') }}
                                                                </span>
                                                                <span class="switch-text-right">{{ __('messages.inactive') }}
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="col-12">
                                                    <button type="submit"
                                                        class="btn btn-primary mr-1 mb-1">{{ __('messages.submit') }}</button>
                                                    <a href="{{ localized_route('sticker-categories') }}"
                                                        class="btn btn-outline-primary mr-1 mb-1">{{ __('messages.cancel') }}</a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    @endsection
