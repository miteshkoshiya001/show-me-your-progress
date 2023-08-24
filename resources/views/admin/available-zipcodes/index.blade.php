@extends('layouts.admin.template')

@section('title', __('messages.zipcodes'))
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
                            <li class="breadcrumb-item active"> {{ __('messages.available_zipcodes') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content-body">
        <section class="basic-textarea">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ __('messages.available_zipcodes') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" action="{{ localized_route('store.available.zipcodes') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ old('id', $availableZipcodes->id ?? 0) }}">
                                    <p>{{ __('messages.insert') }} <code> {{ __('messages.semicolom') }}</code>
                                        {{ __('messages.after_zipcodes') }}</p>
                                    <div class="row">
                                        <div class="col-12">
                                            <fieldset class="form-group">
                                                <textarea class="form-control" id="basicTextarea" rows="3" name="zipcodes"
                                                    placeholder="{{ __('messages.available_zipcodes') }}">{{ !empty($availableZipcodes->zipcodes) ? $availableZipcodes->zipcodes : '' }}</textarea>
                                            </fieldset>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-primary mr-1 mb-1">{{ __('messages.submit') }}</button>
                                            <a href="{{ localized_route('available.zipcodes') }}"
                                                class="btn btn-outline-primary mr-1 mb-1">{{ __('messages.cancel') }}</a>
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
