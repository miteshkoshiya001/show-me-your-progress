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
                                    href="{{ localized_route('trending.offers') }}">{{ __('messages.trending_offers') }}</a>
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
                                <form class="form form-vertical" action="{{ localized_route('store.trending.offer') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ old('id', $trendingOffer->id ?? '') }}">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12 col-sm-6">
                                                <div class="form-group">
                                                    <label for="title">{{ __('messages.title') }}</label>
                                                    <input type="text" id="title" class="form-control"
                                                        value="{{ old('title', $trendingOffer->title ?? '') }}"
                                                        name="title" placeholder="{{ __('messages.title') }}" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label
                                                        for="basicInputFile">{{ __('messages.select_category') }}</label>
                                                    <select class="form-control" id="users-list-role" name="category_id">
                                                        <option value="">{{ __('messages.select_category') }}
                                                        </option>
                                                        @foreach ($categories as $key => $item)
                                                            <option value="{{ $item->id }}"
                                                                @if (isset($trendingOffer) && !empty($item->id == $trendingOffer->category_id)) selected @endif>
                                                                {{ !empty($item->name) ? $item->name : '' }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </fieldset>
                                            </div>
                                            
                                            <div class="col-lg-6 col-md-12">
                                                <fieldset class="form-group">
                                                    <label for="basicInputFile">{{ __('messages.upload_banner') }}</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="banner"
                                                            name="banner"
                                                            value="{{ old('title', $trendingOffer->banner ?? '') }}"
                                                            @if ($trendingOffer->id == 0) required @endif>
                                                        <label class="custom-file-label" for="banner">
                                                            {{ __('messages.upload_banner') }} </label>
                                                    </div>
                                                    @if (isset($trendingOffer->banner_url))
                                                        <div class="media">
                                                            <a href="javascript: void(0);">
                                                                <img src="{{ $trendingOffer->banner_url }}"
                                                                    class="rounded mr-75" alt="profile image" height="100"
                                                                    width="100">
                                                            </a>
                                                        </div>
                                                    @endif
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-2 col-md-2">
                                                <fieldset class="form-group">
                                                    <div
                                                        class="custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                        <p class="mb-0">{{ __('messages.status') }} </p>
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitchStatus" name="status"
                                                            value="1"
                                                            {{ old('status', $trendingOffer->status ?? 1) == 1 ? 'checked' : '' }}>
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
                                                        class="custom-control custom-switch switch-lg custom-switch-success mr-2 mb-1">
                                                        <p class="mb-0">{{ __('messages.is_pop_up') }} </p>
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="customSwitchIsPopUp" name="is_pop_up"
                                                            value="1"
                                                            {{ old('is_pop_up', $trendingOffer->is_pop_up ?? 0) == 1 ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="customSwitchIsPopUp">
                                                            <span class="switch-text-left">{{ __('messages.yes') }}
                                                            </span>
                                                            <span class="switch-text-right">{{ __('messages.no') }}
                                                            </span>
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit"
                                                    class="btn btn-primary mr-1 mb-1">{{ __('messages.submit') }}</button>
                                                <a href="{{ localized_route('trending.offers') }}"
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