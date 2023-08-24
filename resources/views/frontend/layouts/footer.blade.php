<!-- Footer -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="footer-col">
                    <h4>{{__('messages.about_minimall')}}</h4>
                    <p>{{__('messages.minimall_is_your_go')}}</p>
                </div>
            </div> <!-- end of col -->
            <div class="col-md-4">
                <div class="footer-col middle">
                    <h4>{{__('messages.important_links')}}</h4>
                    <ul class="list-unstyled li-space-lg">
                        <li class="media">
                            <i class="fas fa-square"></i>
                            <div class="media-body">{{__('messages.read_our')}} <a class="turquoise"
                                    href="{{ localized_route('tnc') }}">{{__('messages.terms_and_conditions')}}</a>, <a class="turquoise"
                                    href="{{ localized_route('privacy.policy') }}">{{__('messages.privacy_policy')}}</a></div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- end of col -->
            <div class="col-md-4">
                <div class="footer-col last">
                    <h4>{{__('messages.social_media')}}</h4>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-facebook-f fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-twitter fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-google-plus-g fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-instagram fa-stack-1x"></i>
                        </a>
                    </span>
                    <span class="fa-stack">
                        <a href="#your-link">
                            <i class="fas fa-circle fa-stack-2x"></i>
                            <i class="fab fa-linkedin-in fa-stack-1x"></i>
                        </a>
                    </span>
                </div>
            </div> <!-- end of col -->
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</div> <!-- end of footer -->
<!-- end of footer -->


<!-- Copyright -->
<div class="copyright">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <p class="p-small">{{__('messages.copyright')}} © {{ config('app.name') }} - {{__('messages.made_by')}} <a href="http://www.softxsolution.com"
                        target="_blank">SoftX Solution</a></p>
            </div> <!-- end of col -->
        </div> <!-- enf of row -->
    </div> <!-- end of container -->
</div> <!-- end of copyright -->
<!-- end of copyright -->


<!-- Scripts -->
<script src="{{ asset('front/js/jquery.min.js') }}"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
<script src="{{ asset('front/js/popper.min.js') }}"></script> <!-- Popper tooltip library for Bootstrap -->
<script src="{{ asset('front/js/bootstrap.min.js') }}"></script> <!-- Bootstrap framework -->
<script src="{{ asset('front/js/jquery.easing.min.js') }}"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
<script src="{{ asset('front/js/swiper.min.js') }}"></script> <!-- Swiper for image and text sliders -->
<script src="{{ asset('front/js/jquery.magnific-popup.js') }}"></script> <!-- Magnific Popup for lightboxes -->
<script src="{{ asset('front/js/morphext.min.js') }}"></script> <!-- Morphtext rotating text in the header -->
<script src="{{ asset('front/js/validator.min.js') }}"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
<script src="{{ asset('front/js/scripts.js') }}"></script> <!-- Custom scripts -->
<script>
    $("#contactForm").validator().on("submit", function(event) {
        // alert('yes');
        // return;
        if (event.isDefaultPrevented()) {
            // handle the invalid form...
            cformError();
            csubmitMSG(false, "Please fill all fields!");
        } else {
            // everything looks good!
            event.preventDefault();
            csubmitForm();
        }
    });

    function csubmitForm() {
        // Initiate variables with form content
        var name = $("#cname").val();
        var email = $("#cemail").val();
        var message = $("#cmessage").val();
        var phone = $("#cphone").val();;

        $.ajax({
            type: "POST",
            url: "{{ localized_route('contact.submit') }}", // Update with the correct Laravel route
            data: {
                cname: name,
                cemail: email,
                cmessage: message,
                cphone: phone
            },
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                if (response.success) {
                    cformSuccess();
                } else {
                    cformError();
                    csubmitMSG(false, response.message);
                }
            },
            error: function(xhr, status, error) {
                cformError();
                csubmitMSG(false, xhr.responseText);
            }
        });
    }

    function cformSuccess() {
        $("#contactForm")[0].reset();
        csubmitMSG(true, "Message Submitted!");
        $("input").removeClass('notEmpty'); // resets the field label after submission
        $("textarea").removeClass('notEmpty'); // resets the field label after submission
    }

    function cformError() {
        $("#contactForm").removeClass().addClass('shake animated').one(
            'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend',
            function() {
                $(this).removeClass();
            });
    }

    function csubmitMSG(valid, msg) {
        if (valid) {
            var msgClasses = "h3 text-center tada animated";
        } else {
            var msgClasses = "h3 text-center";
        }
        $("#cmsgSubmit").removeClass().addClass(msgClasses).text(msg);
    }
</script>

</body>

</html>
