<section class="fifth_section mt-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 pt-5">
                <img src="{{ asset('frt-assets/images/sticker6.png') }}" alt="" class="rounded-5" width="100%"
                    height="auto">
            </div>

            <div class="col-lg-6 col-md-12 pt-5">
                <form class="contact-us mt-5" id="feedbackForm">
                    <h1 class="title text-center mb-4">Share Feedback</h1>
                    <div class="form-group position-relative">
                        <label for="formEmail" class="d-block">
                            <i class="icon" data-feather="mail"></i>
                        </label>
                        <input type="email" name="email" id="formEmail" class="form-control form-control-lg thick"
                            placeholder="E-mail">
                    </div>
                    <div class="form-group message mt-3">
                        <textarea id="formMessage" name="feedback" class="form-control form-control-lg" rows="7"
                            placeholder="Enter Your Message"></textarea>
                    </div>
                    <div class="feeback-loader d-none text-center mt-2 mb-2">
                        <i class="fa-2x fa-circle-notch fa-spin fas text-primary"></i>
                    </div>
                    <div class="text-center mt-3">
                        <button type="submit" class="btn btn-primary" tabIndex="-1">Send message</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<footer class="new_footer_area bg_color mt-5">
    <div class="new_footer_top">
        <div class="footer_bg">
            <div class="footer_bg_one"></div>
            <div class="footer_bg_two"></div>
        </div>
    </div>
</footer>

<div class="container1">
    <div class="social-icons">
        <a href="#" class="fab fa-facebook-f"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="fab fa-instagram"><i class="fab fa-instagram"></i></a>
        <a href="#" class="fab fa-twitter"><i class="fab fa-twitter"></i></a>
        <a href="#" class="fab fa-youtube"><i class="fab fa-youtube"></i></a>
    </div>
    <div class="footer">
        <p>&copy; {{ date('Y') }} SportFanStickers. All rights reserved.</p>
    </div>
</div>
