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
                                    href="{{ localized_route('categories') }}">{{ __('messages.user_categories') }}</a>
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
                                <form class="form form-vertical" action="{{ localized_route('store.category') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ old('id', $category->id ?? 0) }}">
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
                                            {{-- <div class="col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label for="inputGroupFile01">{{ __('messages.upload_image') }}</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input"
                                                            id="inputGroupFile01" name="image"
                                                            @if ($category->id == 0) required @endif>
                                                        <label class="custom-file-label" for="inputGroupFile01">
                                                            {{ __('messages.upload_image') }} </label>
                                                    </div>
                                                    @if (isset($category->image_url))
                                                        <div class="media">
                                                            <a href="javascript: void(0);">
                                                                <img src="{{ $category->image_url }}" class="rounded mr-75"
                                                                    alt="profile image" height="100" width="100">
                                                            </a>
                                                        </div>
                                                    @endif
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label
                                                        for="basicInputFile">{{ __('messages.select_category') }}</label>
                                                    <select class="form-control" id="users-list-role" name="parent_id">
                                                        <option value="0">{{ __('messages.select_category') }}
                                                        </option>
                                                        @foreach ($categories as $key => $item)
                                                            <option value="{{ $item->id }}"
                                                                @if (isset($category) && !empty($item->id == $category->parent_id)) selected @endif>
                                                                {{ !empty($item->name) ? $item->name : '' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 col-sm-1">
                                                <div class="form-group">
                                                    <label for="color">{{ __('messages.color') }}</label>
                                                    <input type="color" id="color" class="form-control" name="color"
                                                        value="{{ !empty($category->color) ? $category->color : '#ffffff' }}">
                                                </div>
                                            </div> --}}
                                            <div class="col-lg-2 col-md-2">
                                                <fieldset class="form-group">
                                                    <div
                                                        class="custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                        <p class="mb-0">{{ __('messages.status') }} </p>
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitchStatus" name="status"
                                                            value="1"
                                                            {{ old('status', $category->status ?? 1) == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customSwitchStatus">
                                                            <span class="switch-text-left">{{ __('messages.active') }}
                                                            </span>
                                                            <span class="switch-text-right">{{ __('messages.inactive') }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            {{-- <div class="col-lg-2 col-md-2">
                                                <fieldset class="form-group">
                                                    <div
                                                        class="custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                        <p class="mb-0">{{ __('messages.is_important') }} </p>
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitchIsImportant" name="is_important"
                                                            value="1"
                                                            {{ old('is_important', $category->is_important ?? 0) == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customSwitchIsImportant">
                                                            <span class="switch-text-left">{{ __('messages.yes') }}
                                                            </span>
                                                            <span class="switch-text-right">{{ __('messages.no') }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div> --}}
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1 mb-1">{{ __('messages.submit') }}</button>
                                                <a href="{{ localized_route('categories') }}"
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
