@extends('front.front-template')

@section('content')
    <section class="first_section">
        <div class="container mt-5 pt-5">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-heading">
                        {{-- <h2><b>{{ explode(' ', $settings['heading1'])[0] }}</b>&nbsp;<b><br>{{ explode(' ', $settings['heading1'])[1] }}</b><br>
                            <span class="Creative">{{ $settings['heading2'] }}</span>
                        </h2>
                        <p>{{ $settings['heading3'] }}
                            <br>
                            {{ $settings['heading4'] }}
                        </p> --}}

                        {{-- <div class="counters-wrapper">
                            <div class="counter-container">
                                <i class="fa-solid fa-user user"></i>
                                <div class="counter fw-bolder" data-target="{{ $userCount }}"></div>
                                <span>Proud Fans</span>
                            </div>
                            <div class="counter-container">
                                <i class="fa-solid fa-image user"></i>
                                <div class="counter fw-bolder" data-target="{{ $totalCounts }}"></div>
                                <span>Generated Stickers</span>
                            </div>
                        </div> --}}

                        @if (auth()->user() == null)
                            <div class="button">
                                <button class="btn"><a href="{{ route('login.show') }}">Get Started</a></button>
                            </div>
                        @else
                            <div class="button">
                                <a href="{{ route('register') }}?referral_code={{ auth()->user()->referral_code }}">Invite Friends</a>

                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Choose Your Rider</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="custom-modal">
                                <div class="plans-model">
                                    <div class="title">Choose Rider Category</div>
                                    <div class="d-flex justify-content-between flex-wrap row">
                                        {{-- @foreach ($raceTypes as $raceType)
                                            <label class="plan basic-plan mb-3 col-sm-4"
                                                for="rider_category_{{ $raceType->id }}">
                                                <input type="radio" name="plan" id="rider_category_{{ $raceType->id }}"
                                                    value="{{ $raceType->id }}" />
                                                <div class="plan-content">
                                                    <div class="plan-details">
                                                        <span>{{ $raceType->race_name }}</span>
                                                    </div>
                                                </div>
                                            </label>
                                        @endforeach --}}
                                    </div>
                                    {{-- Loader --}}
                                    <div class="ajax-loading text-center d-none">
                                        <i class="fa-2x fa-circle-notch fa-spin fas text-primary"></i>
                                    </div>
                                    {{-- Loader --}}
                                    <div id="selectedDrivers">
                                        <select class="form-select" id="driversSelect" aria-label="Select Drivers">
                                            <option selected disabled>Select Drivers</option>
                                        </select>
                                    </div>
                                    <div id="driverStickers"></div>


                                    <div id="uploadForm">
                                        <form action="upload_sticker" id="upload-form" method="POST"
                                            enctype="multipart/form-data">
                                            {{-- <input type="file" class="form-control" name="image" id="image"
                                                accept="image/*" required> --}}
                                            <div class="mb-3 mt-3 row">
                                                <div class="col-md-8">
                                                    <label for="formFile" class="form-label">Upload Your Image Here</label>
                                                    <input class="form-control" type="file" name="image" id="image"
                                                        accept="image/*" required>
                                                </div>
                                                {{-- <div class="col-md-4 mt-4">
                                                    <button type="submit" class="btn btn-primary">Upload</button>
                                                </div> --}}

                                            </div>

                                        </form>
                                    </div>

                                    <div class="row mt-4">
                                        {{-- <button id="downloadAllButton">Download All Processed Images</button> --}}
                                        <div class="col-md-12 text-center" id="processed-image-container">
                                            <!-- Processed image will be displayed here -->
                                        </div>
                                    </div>

                                    <!-- The modal that contains the Cropme interface -->
                                    <div class="modal fade" id="cropModal" tabindex="-1" role="dialog"
                                        aria-labelledby="cropModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title cropModalLabel">Crop Image</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="" id="cropme-image">
                                                    <div id="cropme-container-modal"></div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                                                        id="closeCropModal">Close</button>


                                                    <button type="button" id="cropImage" class="btn btn-primary">Crop
                                                        Image</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                                <a href="{{ route('show.profile') }}"><button type="button" id="goToProfileButton"
                                        class="btn btn-primary">Go to Profile</button></a>
                                <button type="button" id="downloadAllButton" class="btn btn-primary"
                                    style="display: none;">Download All</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 image-container">
                    <div class="row mt-5">
                        {{-- @if (!$heroImages->isEmpty())
                            @foreach ($heroImages as $heroImage)
                                <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                    <img src="{{ asset('storage/' . $heroImage->image_path) }}" alt="Hero Image"
                                        class="img-fluid">
                                </div>
                            @endforeach
                        @else --}}
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <img src="{{ asset('frt-assets/images/sticker1.png') }}" alt="Hero Image"
                                    class="img-fluid">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <img src="{{ asset('frt-assets/images/sticker2.png') }}" alt="Hero Image"
                                    class="img-fluid">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <img src="{{ asset('frt-assets/images/sticker3.png') }}" alt="Hero Image"
                                    class="img-fluid">
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
                                <img src="{{ asset('frt-assets/images/sticker4.png') }}" alt="Hero Image"
                                    class="img-fluid">
                            </div>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="second_section pt-5">
        <h1 class="text-center mb-5 mt-4 Creative" style="font-size: 40px"><b>Upcoming Events</b></h1>
        <div class="container swiper">
            <div class="event-slider swiper-wrapper">
                {{-- @if (!$events->isEmpty())
                    @foreach ($events as $event)
                        <div class="col-lg-3 box4 box swiper-slide text-center">
                            <img src="{{ asset('storage/' . $event->image) }}" alt="" width="100%">
                        </div>
                    @endforeach
                @else --}}
                    <div class="col-lg-3 box4 box swiper-slide text-center">
                        <img src="{{ asset('frt-assets/images/sticker6.png') }}" alt="" width="100%">
                    </div>
                    <div class="col-lg-3 box4 box swiper-slide text-center">
                        <img src="{{ asset('frt-assets/images/sticker3.png') }}" alt="" width="100%">
                    </div>
                    <div class="col-lg-3 box4 box swiper-slide text-center">
                        <img src="{{ asset('frt-assets/images/sticker4.png') }}" alt="" width="100%">
                    </div>
                    <div class="col-lg-3 box4 box swiper-slide text-center">
                        <img src="{{ asset('frt-assets/images/sticker9.png') }}" alt="" width="100%">
                    </div>
                    <div class="col-lg-3 box4 box swiper-slide text-center">
                        <img src="{{ asset('frt-assets/images/sticker1.png') }}" alt="" width="100%">
                    </div>
                    <div class="col-lg-3 box4 box swiper-slide text-center">
                        <img src="{{ asset('frt-assets/images/sticker8.png') }}" alt="" width="100%">
                    </div>
                    <div class="col-lg-3 box4 box swiper-slide text-center">
                        <img src="{{ asset('frt-assets/images/sticker4.png') }}" alt="" width="100%">
                    </div>
                {{-- @endif --}}
            </div>
        </div>
        </div>
    </section>

    <section class="third_section d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6  box1">
                    <h1>Free shopping, free Online proofs, fast turnaround.</h1>
                </div>
                <div class="col-lg-6 col-md-6 box2">
                    <div class="wrapper">
                        <ul>
                            <li><img src="{{ asset('frt-assets/images/avtar-1.png') }}" alt=""></li>
                            <li><img src="{{ asset('frt-assets/images/avtar-2.png') }}" alt=""></li>
                            <li><img src="{{ asset('frt-assets/images/avtar-3.avif') }}" alt=""></li>
                            <li><img src="{{ asset('frt-assets/images/avtar-4.png') }}" alt=""></li>
                        </ul>
                    </div>

                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rerum similique aperiam, culpa quis
                        ipsum, nam expedita quisquam illo modi perferendis ab? Unde, dolores laborum saepe non
                        aliquam
                        deserunt quasi vitae.</p>
                </div>
            </div>
        </div>
    </section>


    <section class="fifth_section mt-5 d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 pb-5">
                    <div class="card text-center">

                        <div class="title">
                            <i class="fas fa-euro-sign fa"></i>
                            <h2>Starter</h2>
                        </div>
                        <div class="price">
                            <h5><sup>€</sup>1.49</h5>
                        </div>
                        <div class="option">
                            <ul>
                                <li><i class="fa fa-check" aria-hidden="true"></i> &nbsp; 3 Stickers</li>
                            </ul>
                        </div>
                        <a href="#">Order Now</a>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12">
                    <img src="{{ asset('frt-assets/images/Stickers3.jpg') }}" alt="" class="rounded-5"
                        width="100%" height="auto">
                </div>
            </div>
        </div>
    </section>

    <div id="loading-overlay">

        <svg viewBox="0 0 178 40" width="178" height="40">

            <path class="air" d="M 46 16.5 h -20 a 8 8 0 0 1 0 -16" fill="none" stroke="#E85725" stroke-width="1"
                stroke-linejoin="round" stroke-linecap="round">
            </path>


            <g id="car">

                <svg viewBox="0 0 118 28.125" x="30" y="11.725" width="118" height="28.125">
                    <defs>
                        <!-- circle repeated for the wheel -->
                        <circle id="circle" cx="0" cy="0" r="1">
                        </circle>

                        <g id="wheel">
                            <use href="#circle" fill="#1E191A" transform="scale(10)"></use>
                            <use href="#circle" fill="#fff" transform="scale(5)"></use>
                            <!-- inner shadow -->
                            <path fill="#1E191A" stroke="#1E191A" stroke-width="0.5" stroke-linecap="round"
                                stroke-linejoin="round" opacity="0.2" stroke-dashoffset="0"
                                d="M -3.5 0 a 4 4 0 0 1 7 0 a 3.5 3.5 0 0 0 -7 0">
                            </path>
                            <use href="#circle" fill="#1E191A" transform="scale(1.5)"></use>

                            <path fill="none" stroke="#F9B35C" stroke-width="0.75" stroke-linecap="round"
                                stroke-linejoin="round" stroke-dasharray="20 14 8 5"
                                d="M 0 -7.5 a 7.5 7.5 0 0 1 0 15 a 7.5 7.5 0 0 1 0 -15">
                            </path>
                            <!-- outer glow (from a hypothetical light source) -->
                            <path fill="none" stroke="#fff" stroke-width="1" stroke-linecap="round"
                                stroke-linejoin="round" opacity="0.1" stroke-dashoffset="0"
                                d="M -6.5 -6.25 a 10 10 0 0 1 13 0 a 9 9 0 0 0 -13 0">
                            </path>
                        </g>
                    </defs>

                    <g transform="translate(51.5 11.125)">
                        <path stroke-width="2" stroke="#1E191A" fill="#EF3F33" d="M 0 0 v -2 a 4.5 4.5 0 0 1 9 0 v 2">
                        </path>
                        <rect fill="#1E191A" x="3.25" y="-3" width="5" height="3">
                        </rect>
                    </g>

                    <!-- group describing the car -->
                    <g transform="translate(10 24.125)">

                        <g transform="translate(59 0)">
                            <path id="shadow" opacity="0.7" fill="#1E191A"
                                d="M -64 0 l -4 4 h 9 l 8 -1.5 h 100 l -3.5 -2.5">
                            </path>
                        </g>

                        <path fill="#fff" stroke="#1E191A" stroke-width="2.25" stroke-linecap="round"
                            stroke-linejoin="round" d="M 0 0 v -10 l 35 -13 v 5 l 4 0.5 l 0.5 4.5 h 35.5 l 30 13">
                        </path>

                        <!-- wings -->
                        <g fill="#fff" stroke="#1E191A" stroke-width="2.25" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M -6 0 v -22 h 10 z">
                            </path>
                            <path d="M 105 0 h -3 l -12 -5.2 v 6.2 h 12">
                            </path>
                        </g>

                        <!-- grey areas to create details around the car's dashes -->
                        <g fill="#949699" opacity="0.7">
                            <rect x="16" y="-6" width="55" height="6">
                            </rect>
                            <path d="M 24 -14 l 13 -1.85 v 1.85">
                            </path>
                        </g>

                        <!-- dashes included sparingly on top of the frame -->
                        <g fill="none" stroke="#1E191A" stroke-width="2.25" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke-dasharray="30 7 42" d="M 90 0 h -78">
                            </path>
                            <path d="M 39.5 -13 h -15">
                            </path>
                        </g>

                        <!-- elements describing the side of the car -->
                        <path fill="#fff" stroke="#1E191A" stroke-width="2.25" stroke-linejoin="round"
                            d="M 48.125 -6 h -29 v 6 h 29">
                            <!-- .125 to tuck the path behind the rectangle and avoid a pixel disconnect as the svg is scaled -->
                        </path>

                        <rect x="48" y="-7.125" width="6.125" height="7.125" fill="#1E191A">
                        </rect>

                        <!-- rear view mirror -->
                        <g fill="#1E191A">
                            <rect x="60" y="-15" width="1" height="6">
                            </rect>
                            <rect x="56.5" y="-17.5" width="6" height="2.5">
                            </rect>
                        </g>
                    </g>

                    <!-- group describing the wheels, positioned at the bottom of the graphic and at either end of the frame -->
                    <g class="wheels" transform="translate(0 18.125)">
                        <g transform="translate(10 0)">
                            <use href="#wheel"></use>
                        </g>

                        <g transform="translate(87 0)">
                            <!-- add an offset to rotate the yellow stripe around the center -->
                            <use href="#wheel" stroke-dashoffset="-22"></use>
                        </g>
                    </g>
                </svg>
            </g>


            <g fill="none" stroke-width="1" stroke-linejoin="round" stroke-linecap="round">
                <!-- right side -->
                <path class="air" stroke="#E85725" d="M 177.5 34 h -10 q -16 0 -32 -8">
                </path>

                <path class="air" stroke="#949699" d="M 167 28.5 c -18 -2 -22 -8 -37 -10.75">
                </path>

                <path class="air" stroke="#949699" d="M 153 20 q -4 -1.7 -8 -3">
                </path>

                <path class="air" stroke="#E85725" d="M 117 16.85 c -12 0 -12 16 -24 16 h -8">
                    <!-- around (117 29.85) where the right wheel is centered -->
                </path>

                <!-- left side -->
                <path class="air" stroke="#949699" d="M 65 12 q -5 3 -12 3.8">
                </path>

                <path class="air" stroke="#949699" stroke-dasharray="9 10" d="M 30 13.5 h -2.5 q -5 0 -5 -5">
                </path>

                <path class="air" stroke="#949699" d="M 31 33 h -10">
                </path>

                <path class="air" stroke="#949699" d="M 29.5 23 h -12">
                </path>
                <path class="air" stroke="#949699" d="M 13.5 23 h -6">
                </path>

                <path class="air" stroke="#E85725" d="M 28 28 h -27.5">
                </path>
            </g>
        </svg>
    </div>
@endsection
@section('page-js')
    <script src="{{ asset('js/image_upload.js') }}"></script>

    <script>
        $(document).ready(function() {

            /*  */
            const counters = document.querySelectorAll(".counter");

            counters.forEach((counter) => {
                counter.innerText = "0";
                const updateCounter = () => {
                    const target = +counter.getAttribute("data-target");
                    const count = +counter.innerText;
                    const increment = target / 200;
                    if (count < target) {
                        counter.innerText = `${Math.ceil(count + increment)}`;
                        setTimeout(updateCounter, 1);
                    } else counter.innerText = target;
                };
                updateCounter();
            });

            /*  */
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('auto') === '1') {
                // Trigger the "Generate Now" button click
                $(".generate_sticker").click();
            }
            $('#closeCropModal').on('click', function() {
                $('#cropModal').modal('hide');
            });


            const swiper = new Swiper('.swiper', {
                loop: true,
                slidesPerView: 2,
                mousewheel: true,
                centeredSlides: true,
                autoplay: {
                    enabled: true,
                    delay: 2000
                }
            });


            // Simulate change event on the first radio input
            $('input[name="plan"]').first().prop("checked", true);
            $('input[name="plan"]').first().trigger("change");

            // Load drivers for the selected race type
            var selectedRaceTypeId = $('input[name="plan"]:checked').val();
            loadDrivers(selectedRaceTypeId);
        });

        // Attach change event handler to radio inputs
        $('input[name="plan"]').change(function() {
            var raceTypeId = $(this).val();
            loadDrivers(raceTypeId);
        });

        function loadDrivers(raceTypeId) {
            if (raceTypeId) {
                $('#driversSelect').html('<option selected disabled>Loading...</option>');
                $(".ajax-loading").removeClass("d-none");
                $.ajax({
                    url: apiUrl + '/api/get-drivers?rider_type_id=' + raceTypeId,
                    method: 'GET',
                    success: function(response) {
                        var driversSelect = $('#driversSelect');
                        driversSelect.empty();
                        driversSelect.append('<option selected disabled>Select Drivers</option>');
                        $.each(response.data, function(index, driver) {
                            driversSelect.append('<option value="' + driver.id + '">' + driver.name +
                                '</option>');
                        });
                    },
                    error: function(error) {
                        console.error(error);
                    },
                    complete: function() {
                        $(".ajax-loading").addClass("d-none");
                        $('#driversSelect').find('option:contains("Loading...")').remove();
                    }
                });
            } else {
                $('#driversSelect').empty().append('<option selected disabled>Select Drivers</option>');
            }
            $('#driverStickers').empty();
        }

        $(document).ready(function() {
            $('#driversSelect').change(function() {
                var selectedDriverId = $(this).val();
                if (selectedDriverId) {
                    $(".ajax-loading").removeClass("d-none"); // Show loading spinner
                    $('#driverStickers').empty(); // Clear previous stickers
                    $.ajax({
                        url: apiUrl + '/api/driver/' +
                            selectedDriverId + '/stickers',
                        method: 'GET',
                        success: function(response) {
                            var stickers = response.data;
                            var stickersHtml = '';
                            $('#upload-form').show();

                            if (stickers.length > 0) {
                                stickersHtml += '<div class="row pt-3">';
                                $.each(stickers, function(index, sticker) {
                                    if (sticker.sticker_template) {
                                        var fullImageUrl =
                                            '{{ asset('storage') }}/' +
                                            sticker.sticker_template;

                                        stickersHtml +=
                                            '<div class="col-lg-4 col-md-6 col-sm-6 col-6 d-flex align-items-center">' +
                                            '<img src="' + fullImageUrl +
                                            '" alt="Sticker Image" class="img-fluid sticker-template-img"' +
                                            'data-sticker-id="' + sticker
                                            .id + '" data-driver-id="' +
                                            sticker.driver_id +
                                            '">' +
                                            '</div>';
                                    } else {
                                        stickersHtml =
                                            '<p>No stickers available for this driver.</p>';
                                        $('#driverStickers').html(
                                            '<div class="alert alert-danger alert-dismissible fade show" role="alert">' +
                                            '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                            stickersHtml +
                                            '</div>'
                                        );
                                    }
                                });
                                // add common stickers
                                stickersHtml +=
                                    '<div class="col-lg-4 col-md-6 col-sm-6 col-6 d-flex align-items-center">' +
                                    '<img src="' + assetPath + response.common
                                    .austria.path +
                                    '" alt="Sticker Image" class="img-fluid common-template-img"' +
                                    '</div>';
                                stickersHtml += '</div>';
                            } else {
                                stickersHtml =
                                    '<p>No stickers available for this driver.</p>';
                            }

                            $('#driverStickers').html(stickersHtml);
                        },
                        error: function(error) {
                            $('#driverStickers').html(
                                '<div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">' +
                                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>' +
                                error.responseJSON.message +
                                '</div>'
                            );
                        },
                        complete: function() {
                            $(".ajax-loading").addClass("d-none"); // Hide loading spinner
                        }
                    });
                } else {
                    $('#driverStickers').html('');
                    $('#upload-form').hide();
                }
            });

            $('.sticker-template-img').click(function() {
                var selectedStickerId = $(this).attr('data-sticker-id');
                populateUploadForm(selectedStickerId);
            });
        });
        $('.sticker-template-img').click(function() {
            var selectedStickerId = $(this).attr('data-sticker-id');
            populateUploadForm(selectedStickerId);
        });

        function populateUploadForm(stickerId) {
            // Fetch sticker details using API based on stickerId

            $.ajax({
                // url: 'http://sportfanstickers.test/api/sticker/' + stickerId,
                url: apiUrl + '/api/driver/' + stickerId + '/stickers',
                method: 'GET',

                success: function(response) {
                    var stickerData = response.data;
                    // Populate the form fields with stickerData
                    $('#selectedStickerId').val(stickerData.id);
                    $('#selectedDriverId').val(stickerData.driver_id);
                    $('#templatePath').val(stickerData.sticker_template);
                    $('#positionX').val(stickerData.template_x);
                    $('#positionY').val(stickerData.template_y);
                    $('#width').val(stickerData.template_width);
                    $('#height').val(stickerData.template_height);
                    // Show the upload form and scroll to it
                    $('#upload-form').show();
                    $('html, body').animate({
                        scrollTop: $("#uploadForm").offset().top
                    }, 1000);
                }

            });
        }
        $('#upload-form').hide();


        var url = "{{ route('upload-image') }}";
        handleImageUpload(url);


        $('#driversSelect').select2({
            dropdownParent: $("#staticBackdrop")
        });

        if ("{{ session('success') }}") {
            Swal.fire({
                title: '{{ session('success') }}',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            });
        }
    </script>
@endsection
