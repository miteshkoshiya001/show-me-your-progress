@include('frontend.layouts.head')


<!-- Header -->
<header id="header" class="ex-header">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>{{ __('messages.privacy_policy') }}
                </h1>
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
                        class="fa fa-angle-double-right"></i><span>{{ __('messages.privacy_policy') }}
                    </span>
                </div> <!-- end of breadcrumbs -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of ex-basic-1 -->
<!-- end of breadcrumbs -->


<!-- Privacy Content -->
<div class="ex-basic-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="text-container">
                    <h3>
                        {{ __('messages.privacy_policy') }}
                    </h3>
                    <p>
                        {{ __('messages.this_privacy_policy_describes_how_we_collect') }}
                    </p>
                    
                    <h5>
                        {{ __('messages.1_information_we_Collect') }}
                        
                    </h5>
                    <p>
                        {{ __('messages.1_1_personal_information') }}
                    </p>
                    <p>
                        {{ __('messages.1_2_order_information') }}
                    </p>
                    <p>
                        {{ __('messages.1_3_website_usage_data') }}
                        
                    </p>
                    
                    <h5>
                        {{ __('messages.2_use_of_information') }}
                        
                    </h5>
                    <p>
                        {{ __('messages.2_1_order_processing') }}
                    </p>
                    <p>
                        {{ __('messages.2_2_communication') }}
                    </p>
                    <p>
                        {{ __('messages.2_3_marketing_communications') }}
                    </p>
                    
                    <h5>
                        {{ __('messages.3_data_sharing') }}
                        
                    </h5>
                    <p>
                        
                        {{ __('messages.3_1_service_providers') }}
                    </p>
                    <p>
                        
                        {{ __('messages.3_2_legal_compliance_and_protection') }}
                    </p>
                    
                    <h5>
                        {{ __('messages.4_data_security') }}
                        
                    </h5>
                    <p>
                        {{ __('messages.we_take_appropriate_security_measures_to') }}
                        
                    </p>
                    
                    <h5>
                        {{ __('messages.5_user_rights') }}
                        
                    </h5>
                    <p>
                        
                        {{ __('messages.you_have_the_right_to_access') }}
                        
                    </p>
                    
                    <h5>
                        {{ __('messages.6_cookies_and_tracking_technologies') }}
                        
                    </h5>
                    <p>
                        {{ __('messages.we_use_cookies_and_similar_tracking_technologies_to') }}
                    </p>
                    
                    <h5>
                        {{ __('messages.7_updates_to_this_privacy_policy') }}
                    </h5>
                    <p>
                        {{ __('messages.we_may_update_this_privacy_policy') }}
                        
                    </p>
                    
                    <h5>
                        {{ __('messages.8_contact_us') }}
                        
                    </h5>
                    <p>
                        {{ __('messages.if_you_have_any_questions_concerns') }}
                        
                    </p>
                </div> <!-- end of text-container-->


                <a class="btn-outline-reg back" href="{{ localized_route('landing.page') }}">{{ __('messages.back') }}</a>
            </div> <!-- end of col-->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of ex-basic-2 -->
<!-- end of privacy content -->


<!-- Breadcrumbs -->
<div class="ex-basic-1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumbs">
                    <a href="{{ localized_route('landing.page') }}">{{ __('messages.home') }}</a><i
                        class="fa fa-angle-double-right"></i><span>{{ __('messages.privacy_policy') }}</span>
                </div> <!-- end of breadcrumbs -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of ex-basic-1 -->
<!-- end of breadcrumbs -->
@include('frontend.layouts.footer')
