<?php
$url = 'https://dev.minimall.store/api/total-user-coupons-order'; // Replace with the actual API endpoint URL

$curl = curl_init();

// Set the cURL options
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

// Execute the cURL request
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    $error_message = curl_error($curl);
    // Handle the error accordingly
    echo 'cURL Error: ' . $error_message;
}

// Close the cURL session
curl_close($curl);

// Process the response
if (!empty($response)) {
    $data = json_decode($response, true);

    if (isset($data['status']) && $data['status'] === true) {
        $happyUsersCount = $data['data']['total_app_user'];
        $totalScractchedCoupon = $data['data']['total_scractched_coupon'];

        $dileveredOrderCount = $data['data']['total_delivered_order'];

        // HTML code with the fetched counts
    } else {
        // Handle the API response error
        echo 'API Error: ' . $data['message'];
    }
} else {
    // Handle empty response or other errors
    echo 'Empty response or other error occurred.';
}
?>
@include('frontend.layouts.head')


<!-- Header -->
<header id="header" class="header">
    <div class="header-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="text-container">
                        <h1>{{__('messages.shop_online')}}<br>{{__('messages.for')}}  <span id="js-rotating" class="text-uppercase">{{$categoriesNames}}</span></h1>
                        <p class="p-large">{{__('messages.minimall_is_your_go')}}</p>
                        <!-- <a class="btn-solid-lg page-scroll" href="#your-link"><i class="fab fa-apple"></i>APP
                                STORE</a> -->
                        <a class="btn-solid-lg page-scroll" href="#your-link"><i class="fab fa-google-play"></i>{{__('messages.play_store')}}
                        </a>
                    </div>
                </div> <!-- end of col -->
                <div class="col-lg-6">
                    <div class="image-container">
                        <img class="img-fluid" src="{{ asset('front/images/header-iphone.png') }}" alt="alternative">
                    </div> <!-- end of image-container -->
                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of header-content -->
</header> <!-- end of header -->
<!-- end of header -->





<!-- Features -->
<div id="features" class="tabs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{__('messages.features')}}</h2>
                <div class="p-heading p-large">{{__('messages.discover_a_range_of_powerful_features_designed_to_enhance_your')}}
                </div>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">

            <!-- Tabs Links -->
            <ul class="nav nav-tabs" id="lenoTabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab"
                        aria-controls="tab-1" aria-selected="true"><i class="fas fa-edit"></i>{{__('messages.features')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tab-2" role="tab"
                        aria-controls="tab-2" aria-selected="false"><i class="fas fa-binoculars"></i>{{__('messages.tracking')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab"
                        aria-controls="tab-3" aria-selected="false"><i class="fas fa-cog"></i>{{__('messages.setting')}}</a>
                </li>
            </ul>
            <!-- end of tabs links -->


            <!-- Tabs Content-->
            <div class="tab-content" id="lenoTabsContent">

                <!-- Tab -->
                <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab-1">
                    <div class="container">
                        <div class="row">

                            <!-- Icon Cards Pane -->
                            <div class="col-lg-4">
                                <div class="card left-pane first">
                                    <div class="card-body">
                                        <div class="text-wrapper">
                                            <h4 class="card-title">{{__('messages.customize_category')}}</h4>
                                            <p>{{__('messages.create_your_unique_style_with')}}
                                            </p>
                                        </div>
                                        <div class="card-icon">
                                            <i class="far fa-list-alt"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="card left-pane">
                                    <div class="card-body">
                                        <div class="text-wrapper">
                                            <h4 class="card-title">{{__('messages.trending_offers')}}</h4>
                                            <p>{{__('messages.discover_the_hottest_deals')}}</p>
                                        </div>
                                        <div class="card-icon">
                                            <i class="fas fa-gift"></i>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- end of icon cards pane -->

                            <!-- Image Pane -->
                            <div class="col-lg-4">
                                <img class="img-fluid" src="{{ asset('front/images/features-iphone-1.png') }}"
                                    alt="alternative">
                            </div>
                            <!-- end of image pane -->

                            <!-- Icon Cards Pane -->
                            <div class="col-lg-4">
                                <div class="card right-pane first">
                                    <div class="card-body">
                                        <div class="card-icon">
                                            <i class="fas fa-tag"></i>
                                        </div>
                                        <div class="text-wrapper">
                                            <h4 class="card-title">{{__('messages.discounts')}}</h4>
                                            <p>{{__('messages.unlock_unbeatable_discounts_on_your')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card right-pane">
                                    <div class="card-body">
                                        <div class="card-icon">
                                            <i class="fas fa-language"></i>
                                        </div>
                                        <div class="text-wrapper">
                                            <h4 class="card-title">{{__('messages.multi_languages')}}</h4>
                                            <p>{{__('messages.experience_our_app_in_your_preferred')}}</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="card right-pane">
                                        <div class="card-body">
                                            <div class="card-icon">
                                                <i class="fas fa-cube"></i>
                                            </div>
                                            <div class="text-wrapper">
                                                <h4 class="card-title">Good Foundation</h4>
                                                <p>Get a solid foundation for your self development efforts. Try Leno
                                                    mobile app for any mobile platform</p>
                                            </div>
                                        </div>
                                    </div> -->
                            </div>
                            <!-- end of icon cards pane -->

                        </div> <!-- end of row -->
                    </div> <!-- end of container -->
                </div> <!-- end of tab-pane -->
                <!-- end of tab -->

                <!-- Tab -->
                <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab-2">
                    <div class="container">
                        <div class="row">

                            <!-- Image Pane -->
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('front/images/features-iphone-2.png') }}"
                                    alt="alternative">
                            </div>
                            <!-- end of image pane -->

                            <!-- Text And Icon Cards Area -->
                            <div class="col-md-8">
                                <div class="text-area">
                                    <h3>{{__('messages.track_result_based_on_your')}}</h3>
                                    <p>{{__('messages.track_your_desired_results_effortlessly')}}

                                    </p>
                                </div> <!-- end of text-area -->

                                <div class="icon-cards-area">
                                    <div class="card">
                                        <div class="card-icon">
                                            <i class="fas fa-road"></i>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{__('messages.track_order_from_app')}}</h4>
                                            <p>{{__('messages.stay_informed_and_effortlessly')}}</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-icon">
                                            <i class="fas fa-thumbs-up"></i>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{__('messages.easy_tracking')}}</h4>
                                            <p>{{__('messages.experience_effortless_tracking')}}</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-icon">
                                            <i class="fas fa-shipping-fast"></i>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{__('messages.fast_delivery')}}</h4>
                                            <p>{{__('messages.experience_lightning_fast')}}</p>
                                        </div>
                                    </div>
                                    <!-- <div class="card">
                                            <div class="card-icon">
                                                <i class="far fa-file-code"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Visual Editor</h4>
                                                <p>Leno provides a well designed and ergonomic visual editor for you to
                                                    edit your notes and input data</p>
                                            </div>
                                        </div> -->
                                </div> <!-- end of icon cards area -->
                            </div> <!-- end of col-md-8 -->
                            <!-- end of text and icon cards area -->

                        </div> <!-- end of row -->
                    </div> <!-- end of container -->
                </div> <!-- end of tab-pane -->
                <!-- end of tab -->

                <!-- Tab -->
                <div class="tab-pane fade" id="tab-3" role="tabpanel" aria-labelledby="tab-3">
                    <div class="container">
                        <div class="row">

                            <!-- Text And Icon Cards Area -->
                            <div class="col-md-8">
                                <div class="icon-cards-area">
                                    <div class="card">
                                        <div class="card-icon">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{__('messages.profile')}}</h4>
                                            <p>{{__('messages.create_and_manage_your')}}</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-icon">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{__('messages.change_password')}}</h4>
                                            <p>{{__('messages.secure_your_account')}}</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-icon">
                                            <i class="fas fa-gift"></i>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{__('messages.coupons_wallet')}}</h4>
                                            <p>{{__('messages.unlock_exclusive_savings')}}</p>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-icon">
                                            <i class="fas fa-question"></i>
                                        </div>
                                        <div class="card-body">
                                            <h4 class="card-title">{{__('messages.help')}}</h4>
                                            <p>{{__('messages.enjoy_round_the_clock')}}</p>
                                        </div>
                                    </div>
                                </div> <!-- end of icon cards area -->

                                <div class="text-area">
                                    <h3>{{__('messages.monitoring_tools_evaluation')}}</h3>
                                    <p>{{__('messages.monitor_the_evolution')}} <a class="turquoise" href="#your-link">{{__('messages.desired_criteria')}}</a>.</p>
                                </div> <!-- end of text-area -->
                            </div> <!-- end of col-md-8 -->
                            <!-- end of text and icon cards area -->

                            <!-- Image Pane -->
                            <div class="col-md-4">
                                <img class="img-fluid" src="{{ asset('front/images/features-iphone-3.png') }}"
                                    alt="alternative">
                            </div>
                            <!-- end of image pane -->

                        </div> <!-- end of row -->
                    </div> <!-- end of container -->
                </div><!-- end of tab-pane -->
                <!-- end of tab -->

            </div> <!-- end of tab-content -->
            <!-- end of tabs content -->

        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of tabs -->
<!-- end of features -->





<!-- Screenshots -->
<div class="slider-2">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Image Slider -->
                <div class="slider-container">
                    <div class="swiper-container image-slider">
                        <div class="swiper-wrapper">

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <a href="{{ asset('front/images/screenshot-1.png') }}" class="popup-link"
                                    data-effect="fadeIn">
                                    <img class="img-fluid" src="{{ asset('front/images/screenshot-1.png') }}"
                                        alt="alternative">
                                </a>
                            </div>
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <a href="{{ asset('front/images/screenshot-2.png') }}" class="popup-link"
                                    data-effect="fadeIn">
                                    <img class="img-fluid" src="{{ asset('front/images/screenshot-2.png') }}"
                                        alt="alternative">
                                </a>
                            </div>
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <a href="{{ asset('front/images/screenshot-3.png') }}" class="popup-link"
                                    data-effect="fadeIn">
                                    <img class="img-fluid" src="{{ asset('front/images/screenshot-3.png') }}"
                                        alt="alternative">
                                </a>
                            </div>
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <a href="{{ asset('front/images/screenshot-4.png') }}" class="popup-link"
                                    data-effect="fadeIn">
                                    <img class="img-fluid" src="{{ asset('front/images/screenshot-4.png') }}"
                                        alt="alternative">
                                </a>
                            </div>
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <a href="{{ asset('front/images/screenshot-5.png') }}" class="popup-link"
                                    data-effect="fadeIn">
                                    <img class="img-fluid" src="{{ asset('front/images/screenshot-5.png') }}"
                                        alt="alternative">
                                </a>
                            </div>
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <a href="{{ asset('front/images/screenshot-6.png') }}" class="popup-link"
                                    data-effect="fadeIn">
                                    <img class="img-fluid" src="{{ asset('front/images/screenshot-6.png') }}"
                                        alt="alternative">
                                </a>
                            </div>
                            <!-- end of slide -->

                            <!-- Slide -->
                            <!-- <div class="swiper-slide">
                                    <a href="{{ asset('front/images/screenshot-7.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-7.png') }}" alt="alternative">
                                    </a>
                                </div> -->
                            <!-- end of slide -->

                            <!-- Slide -->
                            <div class="swiper-slide">
                                <a href="{{ asset('front/images/screenshot-8.png') }}" class="popup-link"
                                    data-effect="fadeIn">
                                    <img class="img-fluid" src="{{ asset('front/images/screenshot-8.png') }}"
                                        alt="alternative">
                                </a>
                            </div>
                            <!-- end of slide -->

                            <!-- Slide -->
                            <!-- <div class="swiper-slide">
                                    <a href="{{ asset('front/images/screenshot-9.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-9.png') }}" alt="alternative">
                                    </a>
                                </div> -->
                            <!-- end of slide -->

                            <!-- Slide -->
                            <!-- <div class="swiper-slide">
                                    <a href="{{ asset('front/images/screenshot-10.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-10.png') }}" alt="alternative">
                                    </a>
                                </div> -->
                            <!-- end of slide -->

                        </div> <!-- end of swiper-wrapper -->

                        <!-- Add Arrows -->
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <!-- end of add arrows -->

                    </div> <!-- end of swiper-container -->
                </div> <!-- end of slider-container -->
                <!-- end of image slider -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of slider-2 -->
<!-- end of screenshots -->


<!-- Download -->
<div class="basic-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xl-5">
                <div class="text-container">
                    <h2>{{__('messages.download')}} <span class="blue">{{__('messages.minimall')}}</span></h2>
                    <p class="p-large"{{__('messages.download_minimall_the_ultimate')}}>
                    </p>
                    <!-- <a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>APP STORE</a> -->
                    <a class="btn-solid-lg" href="#your-link"><i class="fab fa-google-play"></i>{{__('messages.play_store')}}</a>
                </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6 col-xl-7">
                <div class="image-container">
                    <img class="img-fluid" src="{{ asset('front/images/download.png') }}" alt="alternative">
                </div> <!-- end of img-container -->
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of basic-4 -->
<!-- end of download -->


<!-- Statistics -->
<div class="counter">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <!-- Counter -->
                <div id="counter">
                    <div class="cell">
                        <div class="counter-value number-count" id="happy-users" data-count="<?php echo $happyUsersCount; ?>">0
                        </div>
                        <p class="counter-info">{{__('messages.happy_users')}}</p>
                    </div>
                    <div class="cell">
                        <div class="counter-value number-count" id="scratched-coupons"
                            data-count="<?php echo $totalScractchedCoupon; ?>">0</div>
                        <p class="counter-info">{{__('messages.scratched_coupons')}}</p>
                    </div>
                    <!-- <div class="cell">
                            <div class="counter-value number-count" id="#delivered-orders"></div>
                            <p class="counter-info">Deliverd Orders</p>
                        </div> -->
                    <div class="cell">
                        <div class="counter-value number-count" id="delivered_orders"
                            data-count="<?php echo $dileveredOrderCount; ?>">0</div>
                        <p class="counter-info">{{__('messages.deliverd_orders')}}</p>
                    </div>
                </div>
                <!-- end of counter -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of counter -->
<!-- end of statistics -->


<!-- Contact -->
<div id="contact" class="form">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2>{{__('messages.contact')}}</h2>
                <ul class="list-unstyled li-space-lg">
                    <li class="address">{{__('messages.dont_hesitate_to_give_us')}}</li>
                    <li><i class="fas fa-map-marker-alt"></i>{{__('messages.441_jivandhara_society_kathodra_surat_394326')}}</li>
                    <li><i class="fas fa-phone"></i><a class="blue" href="tel:6353931731">+91 63539 31731</a></li>
                    <li><i class="fas fa-envelope"></i><a class="blue"
                            href="mailto:minimallstore23@gmail.com">minimallstore23@gmail.com</a></li>
                </ul>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
        <div class="row">
            <div class="col-lg-6 offset-lg-3">

                <!-- Contact Form -->
                <form id="contactForm" data-toggle="validator" data-focus="false">
                    <div class="form-group">
                        <input type="text" class="form-control-input notEmpty" id="cname" required>
                        <label class="label-control" for="cname">{{__('messages.name')}}</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control-input notEmpty" id="cemail" required>
                        <label class="label-control" for="cemail">{{__('messages.email')}}</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control-input notEmpty" id="cphone" required>
                        <label class="label-control" for="cphone">{{__('messages.phone')}}</label>
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control-textarea notEmpty" id="cmessage" required></textarea>
                        <label class="label-control" for="cmessage">{{__('messages.your_message')}}</label>
                        <div class="help-block with-errors"></div>
                    </div>
                   
                    <div class="form-group">
                        <button type="submit" class="form-control-submit-button">{{__('messages.submit_message')}}</button>
                    </div>
                    <div class="form-message">
                        <div id="cmsgSubmit" class="h3 text-center"></div>
                    </div>
                </form>
                


                <!-- end of contact form -->

            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of form -->
<!-- end of contact -->


@include('frontend.layouts.footer')



