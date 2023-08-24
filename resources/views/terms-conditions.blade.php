@include('frontend.layouts.head')


<!-- Header -->
<header id="header" class="ex-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>{{ __('messages.terms_and_conditions') }}</h1>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</header> <!-- end of ex-header -->
<!-- end of header -->


<!-- Breadcrumbs -->
<div class="ex-basic-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs">
                    <a href="{{ localized_route('landing.page') }}">{{ __('messages.home') }}</a><i
                        class="fa fa-angle-double-right"></i><span>{{ __('messages.terms_and_conditions') }}</span>
                </div> <!-- end of breadcrumbs -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of ex-basic-1 -->
<!-- end of breadcrumbs -->


<!-- Terms Content -->
<div class="ex-basic-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="text-container">
                    <h3>
                        {{ __('messages.terms_and_conditions') }}
                    </h3>
                    <p>
                        {{ __('messages.welcome_to') }}
                        <a href="{{ localized_route('landing.page') }}"
                            class="term-condition-link text-decoration-none">{{ env('APP_NAME') }}</a>.
                        {{ __('messages.these_terms_and_conditions_govern_your') }}
                    </p>
                    <h5>
                        {{ __('messages.1_product_information') }}
                    </h5>

                    <p>
                        {{ __('messages.1_1_we_strive_to_provide_accurate_and_up_to_date_product_information_on_our_website') }}
                    </p>
                    <h5>
                        {{ __('messages.2_ordering_and_acceptance') }}
                    </h5>
                    <p>
                        {{ __('messages.2_1_by_placing_an_order_on_our') }}
                    </p>
                    <p>
                        {{ __('messages.2_3_order_acceptance_and_the_formation_of_the_contract_between_you_and_us_will_occur') }}
                    </p>

                    <h5>
                        {{ __('messages.3_pricing_and_payment') }}
                    </h5>
                    <p>
                        {{ __('messages.3_1all_prices_displayed_on_our_website_are_in') }}
                    </p>
                    <p>
                        {{ __('messages.3_2_online_payment_is_not_accepted_on_the_website') }}
                    </p>

                    <h5>
                        {{ __('messages.4_shipping_and_delivery') }}
                    </h5>
                    <p>
                        {{ __('messages.4_1_we_strive_to_process_and_ship_orders') }}
                    </p>
                    <p>
                        {{ __('messages.4_2_we_are_not_responsible_for_any_delays_or_failures_in') }}
                    </p>

                    <h5>
                        {{ __('messages.5_returns_and_refunds') }}
                    </h5>
                    <p>
                        {{ __('messages.5_1_we_want_you_to_be_satisfied_with_your') }}
                    </p>

                    <h5>
                        {{ __('messages.6_intellectual_property') }}
                    </h5>
                    <p>
                        {{ __('messages.6_1_all_intellectual_property_rights') }}
                    </p>

                    <h5>
                        {{ __('messages.7_limitation_of_liability') }}
                    </h5>
                    <p>
                        {{ __('messages.7_1_to_the_fullest_extent_permitted') }}
                    </p>

                    <h5>
                        {{ __('messages.8_governing_law_and_jurisdiction') }}
                    </h5>
                    <p>
                        {{ __('messages.8_1_theseTerms_shall_be_governed_by_and_construed') }}
                    </p>

                    <h5>
                        {{ __('messages.9_modifications') }}
                    </h5>
                    <p>
                        {{ __('messages.9_1_we_reserve_the_right_to_modify_these_terms') }}
                    </p>

                </div> <!-- end of text-container -->
            </div>
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of ex-basic -->
<!-- end of terms content -->


<!-- Breadcrumbs -->
<div class="ex-basic-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs">
                    <a href="{{ localized_route('landing.page') }}">{{ __('messages.home') }}</a><i
                        class="fa fa-angle-double-right"></i><span>{{ __('messages.terms_and_conditions') }}</span>
                </div> <!-- end of breadcrumbs -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of ex-basic-1 -->
<!-- end of breadcrumbs -->

@include('frontend.layouts.footer')
