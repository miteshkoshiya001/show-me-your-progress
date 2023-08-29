@php

    use App\Helpers\Helper;

@endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item mr-auto"><a class="navbar-brand" href="{{ localized_route('dashboard') }}">
                    {{-- <div class="brand-logo"></div> --}}
                    <img src="{{{asset('app-assets/images/logo/logo.png')}}}" style="width: 50px; margin-left:-7px;">
                    <h2 class="brand-text mb-0">{{ config('app.name') }}</h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0 mt-1" data-toggle="collapse"><i
                        class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i
                        class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary"
                        data-ticon="icon-disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main mt-2" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="nav-item {{ Helper::isActiveUrl('dashboard') }}">
                <a href="{{ localized_route('dashboard') }}">
                    <i class="feather icon-home"></i>
                    <span class="menu-title" data-i18n="Dashboard">
                        {{ __('messages.dashboard') }}
                    </span>
                </a>
            </li>
            <li class="nav-item {{ Helper::isActiveUrl('user') }}">
                <a href="{{ localized_route('users') }}">
                    <i class="feather icon-users"></i>
                    <span class="menu-title" data-i18n="Users">
                        {{ __('messages.users') }}
                    </span>
                </a>
            </li>

            <li class="nav-item {{ Helper::isActiveUrl('category') }}">
                <a href="{{ localized_route('categories') }}"><i class="feather icon-list"></i><span class="menu-title"
                        data-i18n="Categories">{{ __('messages.user_categories') }}</span></a>
            </li>
            {{-- <li class="nav-item {{ Helper::isActiveUrl('sticker-categories') }}">
                <a href="{{ localized_route('sticker-categories') }}"><i class="feather icon-list"></i><span class="menu-title"
                        data-i18n="StickerCategories">{{ __('messages.sticker_category') }}</span></a>
            </li> --}}
            {{-- <li class="nav-item {{ Helper::isActiveUrl('sticker-collection') }}">
                <a href="{{ localized_route('sticker-collection.index') }}"><i class="feather icon-list"></i><span class="menu-title"
                        data-i18n="StickerCollections">{{ __('messages.sticker_collection') }}</span></a>
            </li> --}}
            <li class="nav-item"><a href="#"><i class="feather icon-list"></i><span class="menu-title" data-i18n="Sticker">{{ __('messages.sticker') }}</span></a>
                <ul class="menu-content">
                    <li class="{{ Helper::isActiveUrl('sticker-categories') }}"><a href="{{ localized_route('sticker-categories') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="StickerCategories">{{ __('messages.sticker_category') }}</span></a>
                    </li>
                    <li class="{{ Helper::isActiveUrl('sticker-collection') }}"><a href="{{ localized_route('sticker-collection.index') }}"><i class="feather icon-circle"></i><span class="menu-item" data-i18n="StickerCollection">{{ __('messages.sticker_collection') }}</span></a>
                    </li>

                </ul>
            </li>
            {{-- <li class="nav-item {{ Helper::isActiveUrl('units-of-measurement') }}">
                <a href="{{ localized_route('uoms') }}"><i class="feather icon-grid"></i><span
                        class="menu-title"
                        data-i18n="Units of Measurement">{{ __('messages.units_of_measurement') }}</span></a>
            </li>
            <li class="nav-item {{ Helper::isActiveUrl('product') }}">
                <a href="{{ localized_route('products') }}"><i class="feather icon-grid"></i><span
                        class="menu-title"
                        data-i18n="Products">{{ __('messages.products') }}</span></a>
            </li>
            <li class="nav-item {{ Helper::isActiveUrl('trending-offer') }}">
                <a href="{{ localized_route('trending.offers') }}"><i class="feather icon-percent"></i><span
                        class="menu-title" data-i18n="Trending Offers">{{ __('messages.trending_offers') }}</span></a>
            </li>
            <li class="nav-item {{ Helper::isActiveUrl('purchase') }}">
                <a href="{{ localized_route('purchases') }}"><i class="feather icon-grid"></i><span
                        class="menu-title" data-i18n="Purchases">{{ __('messages.purchases') }}</span></a>
            </li>
            <li class="nav-item {{ Helper::isActiveUrl('order') }}">
                <a href="{{ localized_route('orders') }}"><i class="feather icon-grid"></i><span
                        class="menu-title" data-i18n="Trending Offers">{{ __('messages.orders') }}</span></a>
            </li>
            <li class="nav-item {{ Helper::isActiveUrl('delivery-address') }}">
                <a href="{{ localized_route('delivery.address') }}"><i class="feather icon-map-pin"></i><span
                        class="menu-title"
                        data-i18n="Delivery address">{{ __('messages.delivery_address') }}</span></a>
            </li>
            <li class="nav-item {{ Helper::isActiveUrl('available-zipcodes') }}">
                <a href="{{ localized_route('available.zipcodes') }}"><i class="feather icon-map-pin"></i><span
                        class="menu-title"
                        data-i18n="Available Zipcodes">{{ __('messages.available_zipcodes') }}</span></a>
            </li>
            <li class="nav-item {{ Helper::isActiveUrl('contact-form-data') }}">
                <a href="{{localized_route('contact.data')}}"><i class="feather icon-message-square"></i><span
                        class="menu-title"
                        data-i18n="Setting">{{ __('messages.contacts') }}</span></a>
            </li> --}}
            <li class="nav-item {{ Helper::isActiveUrl('setting') }}">
                <a href="{{ localized_route('setting') }}"><i class="feather icon-settings"></i><span
                        class="menu-title"
                        data-i18n="Setting">{{ __('messages.settings') }}</span></a>
            </li>

        </ul>
    </div>
</div>
