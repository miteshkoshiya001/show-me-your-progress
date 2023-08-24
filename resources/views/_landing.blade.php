<?php
$url = "https://dev.minimall.store/api/total-user-coupons-order"; // Replace with the actual API endpoint URL

$curl = curl_init();

// Set the cURL options
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

// Execute the cURL request
$response = curl_exec($curl);

// Check for cURL errors
if (curl_errno($curl)) {
    $error_message = curl_error($curl);
    // Handle the error accordingly
    echo "cURL Error: " . $error_message;
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
        echo "API Error: " . $data['message'];
    }
} else {
    // Handle empty response or other errors
    echo "Empty response or other error occurred.";
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
                            <h1>MOBILE APP <br>FOR <span id="js-rotating">DESIGNERS, MARKETERS, DEVELOPERS</span></h1>
                            <p class="p-large">Leno is one of the easiest and feature packed marketing automation apps
                                in the market. Download it today!</p>
                            <!-- <a class="btn-solid-lg page-scroll" href="#your-link"><i class="fab fa-apple"></i>APP
                                STORE</a> -->
                            <a class="btn-solid-lg page-scroll" href="#your-link"><i class="fab fa-google-play"></i>PLAY
                                STORE</a>
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
                    <h2>FEATURES</h2>
                    <div class="p-heading p-large">"Discover a range of powerful features designed to enhance your
                        shopping experience, including personalized recommendations, effortless navigation, and secure
                        payment options, all in one user-friendly app."
                    </div>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">

                <!-- Tabs Links -->
                <ul class="nav nav-tabs" id="lenoTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="nav-tab-1" data-toggle="tab" href="#tab-1" role="tab"
                            aria-controls="tab-1" aria-selected="true"><i class="fas fa-edit"></i>CUSTOMIZATION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-tab-2" data-toggle="tab" href="#tab-2" role="tab"
                            aria-controls="tab-2" aria-selected="false"><i class="fas fa-binoculars"></i>TRACKING</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="nav-tab-3" data-toggle="tab" href="#tab-3" role="tab"
                            aria-controls="tab-3" aria-selected="false"><i class="fas fa-cog"></i>SETTING</a>
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
                                                <h4 class="card-title">Customize Category</h4>
                                                <p>"Create your unique style with our customizable category, where you
                                                    can personalize every aspect of your shopping experience."
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
                                                <h4 class="card-title">Trending offers</h4>
                                                <p>"Discover the hottest deals and trending offers, bringing you the
                                                    best savings and must-have products in one place."</p>
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
                                    <img class="img-fluid" src="{{ asset('front/images/features-iphone-1.png') }}" alt="alternative">
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
                                                <h4 class="card-title">Discounts</h4>
                                                <p>"Unlock unbeatable discounts on your favorite products and enjoy
                                                    incredible savings with our exclusive discount offers."</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card right-pane">
                                        <div class="card-body">
                                            <div class="card-icon">
                                                <i class="fas fa-language"></i>
                                            </div>
                                            <div class="text-wrapper">
                                                <h4 class="card-title">Multi Languages</h4>
                                                <p>"Experience our app in your preferred language with our seamless
                                                    multi-language support, ensuring a user-friendly experience for
                                                    customers worldwide."</p>
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
                                    <img class="img-fluid" src="{{ asset('front/images/features-iphone-2.png') }}" alt="alternative">
                                </div>
                                <!-- end of image pane -->

                                <!-- Text And Icon Cards Area -->
                                <div class="col-md-8">
                                    <div class="text-area">
                                        <h3>Track Result Based On Your</h3>
                                        <p>"Track your desired results effortlessly with our advanced tracking system,
                                            providing real-time updates and insightful analytics. Stay on top of your
                                            progress, make informed decisions, and achieve your goals efficiently with
                                            our intuitive tracking features."

                                        </p>
                                    </div> <!-- end of text-area -->

                                    <div class="icon-cards-area">
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="fas fa-road"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Track Order From App</h4>
                                                <p>"Stay informed and effortlessly track your orders in real-time
                                                    directly from our user-friendly app, ensuring peace of mind and
                                                    hassle-free shopping."</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="fas fa-thumbs-up"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Easy Tracking</h4>
                                                <p>"Experience effortless tracking of your orders with our intuitive app
                                                    interface, providing you with real-time updates and seamless
                                                    navigation."</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="fas fa-shipping-fast"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Fast Delivery</h4>
                                                <p>"Experience lightning-fast delivery with our efficient logistics
                                                    network, ensuring your orders are delivered to your doorstep in
                                                    record time."</p>
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
                                                <h4 class="card-title">Profile</h4>
                                                <p>"Create and manage your personalized profile with our app, allowing
                                                    you to easily track orders, view purchase history, and customize
                                                    your shopping preferences."</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Change Password</h4>
                                                <p>"Secure your account with ease by changing your password conveniently
                                                    within our app, ensuring the protection of your personal information
                                                    and maintaining peace of mind."</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="fas fa-gift"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Coupons & Wallet</h4>
                                                <p>"Unlock exclusive savings with our wide range of coupons and
                                                    conveniently manage your digital wallet within our app, making your
                                                    shopping experience even more rewarding and hassle-free."</p>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-icon">
                                                <i class="fas fa-question"></i>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title">Help</h4>
                                                <p>"Enjoy round-the-clock support with our 24/7 assistance, ensuring
                                                    that help is always just a click away whenever you need it, making
                                                    your shopping experience seamless and worry-free."</p>
                                            </div>
                                        </div>
                                    </div> <!-- end of icon cards area -->

                                    <div class="text-area">
                                        <h3>Monitoring Tools Evaluation</h3>
                                        <p>Monitor the evolution of your finances and health state using tools
                                            integrated in Leno. The generated real time reports can be filtered based on
                                            any <a class="turquoise" href="#your-link">desired criteria</a>.</p>
                                    </div> <!-- end of text-area -->
                                </div> <!-- end of col-md-8 -->
                                <!-- end of text and icon cards area -->

                                <!-- Image Pane -->
                                <div class="col-md-4">
                                    <img class="img-fluid" src="{{ asset('front/images/features-iphone-3.png') }}" alt="alternative">
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
                                    <a href="{{ asset('front/images/screenshot-1.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-1.png') }}" alt="alternative">
                                    </a>
                                </div>
                                <!-- end of slide -->

                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <a href="{{ asset('front/images/screenshot-2.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-2.png') }}" alt="alternative">
                                    </a>
                                </div>
                                <!-- end of slide -->

                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <a href="{{ asset('front/images/screenshot-3.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-3.png') }}" alt="alternative">
                                    </a>
                                </div>
                                <!-- end of slide -->

                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <a href="{{ asset('front/images/screenshot-4.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-4.png') }}" alt="alternative">
                                    </a>
                                </div>
                                <!-- end of slide -->

                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <a href="{{ asset('front/images/screenshot-5.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-5.png') }}" alt="alternative">
                                    </a>
                                </div>
                                <!-- end of slide -->

                                <!-- Slide -->
                                <div class="swiper-slide">
                                    <a href="{{ asset('front/images/screenshot-6.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-6.png') }}" alt="alternative">
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
                                    <a href="{{ asset('front/images/screenshot-8.png') }}" class="popup-link" data-effect="fadeIn">
                                        <img class="img-fluid" src="{{ asset('front/images/screenshot-8.png') }}" alt="alternative">
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
                        <h2>Download <span class="blue">Minimall</span></h2>
                        <p class="p-large">"Download Minimall, the ultimate shopping companion, from the Google Play
                            Store today and enjoy a seamless shopping experience right at your fingertips. Browse
                            through a vast selection of products, track orders, and access exclusive deals, all with
                            just a few taps. With a user-friendly interface, secure transactions, and fast delivery,
                            Minimall makes shopping convenient and enjoyable. Experience personalized recommendations
                            and stay updated with the latest trends. Don't miss out – get the Minimall app now and start
                            shopping smarter!"
                        </p>
                        <!-- <a class="btn-solid-lg" href="#your-link"><i class="fab fa-apple"></i>APP STORE</a> -->
                        <a class="btn-solid-lg" href="#your-link"><i class="fab fa-google-play"></i>PLAY STORE</a>
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
                            <div class="counter-value number-count" id="happy-users" data-count="<?php echo $happyUsersCount?>">0</div>
                            <p class="counter-info">Happy Users</p>
                        </div>
                        <div class="cell">
                            <div class="counter-value number-count" id="scratched-coupons"  data-count="<?php echo $totalScractchedCoupon?>">0</div>
                            <p class="counter-info">Scratched Coupons</p>
                        </div>
                        <!-- <div class="cell">
                            <div class="counter-value number-count" id="#delivered-orders"></div>
                            <p class="counter-info">Deliverd Orders</p>
                        </div> -->
                        <div class="cell">
                            <div class="counter-value number-count" id="delivered_orders"  data-count="<?php echo $dileveredOrderCount?>">0</div>
                            <p class="counter-info">Deliverd Orders</p>
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
                    <h2>CONTACT</h2>
                    <ul class="list-unstyled li-space-lg">
                        <li class="address">Don't hesitate to give us a call or just use the contact form below</li>
                        <li><i class="fas fa-map-marker-alt"></i>22 Innovative, San Francisco, CA 94043, US</li>
                        <li><i class="fas fa-phone"></i><a class="blue" href="tel:003024630820">+81 720 2212</a></li>
                        <li><i class="fas fa-envelope"></i><a class="blue"
                                href="mailto:office@leno.com">office@leno.com</a></li>
                    </ul>
                </div> <!-- end of col -->
            </div> <!-- end of row -->
            <div class="row">
                <div class="col-lg-6 offset-lg-3">

                    <!-- Contact Form -->
                    <form id="contactForm" data-toggle="validator" data-focus="false">
                        <div class="form-group">
                            <input type="text" class="form-control-input" id="cname" required>
                            <label class="label-control" for="cname">Name</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control-input" id="cemail" required>
                            <label class="label-control" for="cemail">Email</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <textarea class="form-control-textarea" id="cmessage" required></textarea>
                            <label class="label-control" for="cmessage">Your message</label>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group checkbox">
                            <input type="checkbox" id="cterms" value="Agreed-to-Terms" required>I have read and agree to
                            Leno's stated conditions in <a href="privacy-policy.html">Privacy Policy</a> and <a
                                href="terms-conditions.html">Terms Conditions</a>
                            <div class="help-block with-errors"></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control-submit-button">SUBMIT MESSAGE</button>
                        </div>
                        <div class="form-message">
                            <div id="cmsgSubmit" class="h3 text-center hidden"></div>
                        </div>
                    </form>
                    <!-- end of contact form -->

                </div> <!-- end of col -->
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </div> <!-- end of form -->
    <!-- end of contact -->


    @include('frontend.layouts.footer')


