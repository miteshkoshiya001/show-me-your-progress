@extends('layouts.admin.template')

@section('title', $title)
@section('content')
    <div class="content-header row">
        <!-- Content header breadcrumb -->
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
                                <form class="form form-vertical" action="{{ localized_route('sticker-collection.store') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id"
                                        value="{{ old('id', $stickerCollection->id ?? 0) }}">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label
                                                        for="sticker_category_id">{{ __('messages.sticker_category') }}</label>
                                                    <select id="sticker_category_id" class="form-control"
                                                        name="sticker_category_id" required>
                                                        <option value="">{{ __('messages.select_sticker_category') }}
                                                        </option>
                                                        @foreach ($stickerCategories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ old('sticker_category_id', $stickerCollection->sticker_category_id ?? '') == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
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
                                                    <div
                                                        class="custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                        <p class="mb-0">{{ __('messages.status') }}</p>
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitchStatus" name="status" value="1"
                                                            {{ old('status', $stickerCollection->status ?? 1) == 1 ? 'checked' : '' }}>

                                                        <label class="custom-control-label" for="customSwitchStatus">
                                                            <span class="switch-text-left">{{ __('messages.active') }}
                                                            </span>
                                                            <span class="switch-text-right">{{ __('messages.inactive') }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-2 col-md-2">
                                                <fieldset class="form-group">
                                                    <div
                                                        class="custom-control custom-switch switch-lg custom-switch-primary mr-2 mb-1">
                                                        <p class="mb-0">{{ __('messages.is-premium') }}</p>
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitchPremium" name="is_premium" value="1"
                                                            {{ old('is_premium', $stickerCollection->is_premium ?? 0) == 1 ? 'checked' : '' }}>

                                                        <label class="custom-control-label" for="customSwitchPremium">
                                                            <span class="switch-text-left">{{ __('messages.no') }}</span>
                                                            <span class="switch-text-right">{{ __('messages.yes') }}</span>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-lg-2 col-md-2">
                                                <fieldset class="form-group">
                                                    <div
                                                        class="custom-control custom-switch switch-lg custom-switch-warning mr-2 mb-1">
                                                        <p class="mb-0">{{ __('messages.is-default') }}</p>
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitchDefault" name="is_default" value="1"
                                                            {{ old('is_default', $stickerCollection->is_default ?? 1) == 1 ? 'checked' : '' }}>

                                                        <label class="custom-control-label" for="customSwitchDefault">
                                                            <span class="switch-text-left">{{ __('messages.no') }}</span>
                                                            <span class="switch-text-right">{{ __('messages.yes') }}</span>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1">{{ __('messages.submit') }}</button>
                                                <a href="{{ localized_route('sticker-collection.index') }}"
                                                    class="btn btn-outline-primary mr-1">{{ __('messages.cancel') }}</a>
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
