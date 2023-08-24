@extends('layouts.admin.template')

@section('title', __('messages.settings'))

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
                            <li class="breadcrumb-item active"> {{ __('messages.settings') }}
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
                            <h4 class="card-title">{{ __('messages.settings') }}</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form form-vertical" action="{{ localized_route('store.setting') }}"
                                    method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ old('id', $settings->id ?? 0) }}">
                                    <div class="row">
                                        <div class="col-12 col-sm-3">
                                            <fieldset class="form-group">
                                                <label for="min_item_count">{{ __('messages.minimum_item') }}</label>
                                                <input type="text" id="min_item_count" class="form-control"
                                                    value="{{ old('min_item_count', !empty($settings->min_item_count) ? $settings->min_item_count : '') }}"
                                                    name="min_item_count" placeholder="{{ __('messages.minimum_item') }}"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                            </fieldset>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <fieldset class="form-group">
                                                <label
                                                    for="min_order_amount">{{ __('messages.minimum_order_amount') }}</label>
                                                <input type="text" id="min_order_amount" class="form-control"
                                                    value="{{ old('min_order_amount', !empty($settings->min_order_amount) ? $settings->min_order_amount : '') }}"
                                                    name="min_order_amount"
                                                    placeholder="{{ __('messages.minimum_order_amount') }}">
                                            </fieldset>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <fieldset class="form-group">
                                                <label
                                                    for="coupon_expiry_time">{{ __('messages.coupon_expiry_time') }}</label>
                                                <input type="text" id="coupon_expiry_time" class="form-control"
                                                    value="{{ old('coupon_expiry_time', !empty($settings->coupon_expiry_time) ? $settings->coupon_expiry_time : '') }}"
                                                    name="coupon_expiry_time"
                                                    placeholder="{{ __('messages.coupon_expiry_time') }}"
                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                                            </fieldset>
                                        </div>
                                        <div class="col-12 col-sm-3">
                                            <fieldset class="form-group">
                                                <label
                                                    for="privacy_policy_url">{{ __('messages.privacy_policy_url') }}</label>
                                                <input type="text" id="privacy_policy_url" class="form-control"
                                                    value="{{ old('privacy_policy_url', !empty($settings->privacy_policy_url) ? $settings->privacy_policy_url : '') }}"
                                                    name="privacy_policy_url"
                                                    placeholder="{{ __('messages.privacy_policy_url') }}">
                                            </fieldset>
                                        </div>
                                        <div class="col-12 col-sm-12">
                                            <fieldset class="form-group">
                                                <label
                                                    for="terms_and_conditions">{{ __('messages.terms_and_conditions') }}</label>
                                                <textarea class="form-control" id="terms_and_conditions" rows="10" name="terms_and_conditions"
                                                    placeholder="{{ __('messages.terms_and_conditions') }}">{{ !empty($settings->terms_and_conditions) ? $settings->terms_and_conditions : '' }}</textarea>
                                            </fieldset>
                                        </div>
                                        <div class="col-12 col-sm-3 mt-2">
                                            <button type="submit"
                                                class="btn btn-primary mr-1 mb-1">{{ __('messages.submit') }}</button>
                                            <a href="{{ localized_route('setting') }}"
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
@section('page-js')
    <script src="https://cdn.ckeditor.com/ckeditor5/38.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#terms_and_conditions'))
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
