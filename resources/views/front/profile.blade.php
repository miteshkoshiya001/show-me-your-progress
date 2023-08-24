<?php
/* $imageUrl = 'http://sportfanstickers.com/public/frt-assets/images/sticker2.png';
$caption = 'Check out this awesome image on Instagram!';

$encodedCaption = urlencode($caption);
$instagramUrl = 'https://www.instagram.com//direct/inbox/?url=' . urlencode($imageUrl) . '&caption=' . $encodedCaption; */
?>

{{-- <a href="<?php echo $instagramUrl; ?>" target="_blank">Share on Instagram</a> --}}


@extends('front.front-template')

@section('content')
    <section class="second_section">
        <div class="container profile">
            <div class="row">
                {{-- @if ($userStickers->isEmpty())
                    <div class="col-md-12">
                        <h1><b>No stickers created yet.</b></h1>
                        <div class="button">
                            <a href="{{ route('index.show') }}?auto=1"><button class="btn">Generate Now</button></a>
                        </div>
                    </div>
                {{-- @else --}}
                {{-- @foreach ($userStickers as $userSticker)
                        @if ($userSticker->stk_path_1)  --}}
                <div class="col-lg-3 col-md-3 box1 box">
                    <img src="{{ asset('frt-assets/images/avtar-1.png') }}" alt="" width="100%" id="imgfb">

                    <nav class="menu lobel-menu">
                        <input class="menu-toggler" type="checkbox">
                        <label for="menu-toggler">
                            <i class="fas fa-share-alt"></i>
                        </label>
                        <ul>
                            <li class="menu-item facebook">
                                <a href="#" data-platform="facebook" onclick="fb()"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="download-button">
                        <a href="" download>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
                {{-- @endif --}}
                {{-- @if ($userSticker->stk_path_2) --}}
                <div class="col-lg-3 col-md-3 box1 box">
                    <img src="{{ asset('frt-assets/images/avtar-1.png') }}" alt="" width="100%" id="imgfb">

                    <nav class="menu lobel-menu">
                        <input class="menu-toggler" type="checkbox">
                        <label for="menu-toggler">
                            <i class="fas fa-share-alt"></i>
                        </label>
                        <ul>
                            <li class="menu-item facebook">
                                <a href="#" data-platform="facebook" onclick="fb()"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="download-button">
                        <a href="" download>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
                {{-- @endif --}}
                {{-- @if ($userSticker->stk_path_3) --}}
                <div class="col-lg-3 col-md-3 box1 box">
                    <img src="{{ asset('frt-assets/images/avtar-1.png') }}" alt="" width="100%" id="imgfb">

                    <nav class="menu lobel-menu">
                        <input class="menu-toggler" type="checkbox">
                        <label for="menu-toggler">
                            <i class="fas fa-share-alt"></i>
                        </label>
                        <ul>
                            <li class="menu-item facebook">
                                <a href="#" data-platform="facebook" onclick="fb()"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="download-button">
                        <a href="{{ asset('frt-assets/images/avtar-1.png') }}" download>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 box1 box">
                    <img src="{{ asset('frt-assets/images/avtar-1.png') }}" alt="" width="100%" id="imgfb">

                    <nav class="menu lobel-menu">
                        <input class="menu-toggler" type="checkbox">
                        <label for="menu-toggler">
                            <i class="fas fa-share-alt"></i>
                        </label>
                        <ul>
                            <li class="menu-item facebook">
                                <a href="#" data-platform="facebook" onclick="fb()"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="download-button">
                        <a href="{{ asset('frt-assets/images/avtar-1.png') }}" download>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 box1 box">
                    <img src="{{ asset('frt-assets/images/avtar-1.png') }}" alt="" width="100%" id="imgfb">

                    <nav class="menu lobel-menu">
                        <input class="menu-toggler" type="checkbox">
                        <label for="menu-toggler">
                            <i class="fas fa-share-alt"></i>
                        </label>
                        <ul>
                            <li class="menu-item facebook">
                                <a href="#" data-platform="facebook" onclick="fb()"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="download-button">
                        <a href="{{ asset('frt-assets/images/avtar-1.png') }}" download>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 box1 box">
                    <img src="{{ asset('frt-assets/images/avtar-1.png') }}" alt="" width="100%" id="imgfb">

                    <nav class="menu lobel-menu">
                        <input class="menu-toggler" type="checkbox">
                        <label for="menu-toggler">
                            <i class="fas fa-share-alt"></i>
                        </label>
                        <ul>
                            <li class="menu-item facebook">
                                <a href="#" data-platform="facebook" onclick="fb()"><i
                                        class="fab fa-facebook-f"></i></a>
                            </li>
                        </ul>
                    </nav>
                    <div class="download-button">
                        <a href="{{ asset('frt-assets/images/avtar-1.png') }}" download>
                            <i class="fas fa-download"></i>
                        </a>
                    </div>
                </div>
                {{-- @endif --}}
                {{-- @endforeach
                @endif --}}
            </div>
        </div>
    </section>
@endsection
@section('page-js')
    @if (session('success'))
        <script src="{{ asset('frt-assets/js/sweetalert2.all.min.js') }}"></script>
        <script>
            Swal.fire({
                title: '{{ session('success') }}',
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                }
            })
        </script>
    @endif

    <script>
        function fb() {
            var imgsrc = document.getElementById("imgfb").src;
            var caption = "Check out this awesome Sticker!";
            var fbpopup = window.open(
                "https://www.facebook.com/sharer/sharer.php?" +
                "u=" + encodeURIComponent(imgsrc) +
                "&caption=" + encodeURIComponent(caption),
                "pop",
                "width=600, height=400, scrollbars=no"
            );
            return false;
        }

        // function tweet() {
        //     var imgsrc = document.getElementById("imgfb").src;
        //     var text = "Check out this awesome Sticker!";
        //     var twitterUrl = "https://twitter.com/intent/tweet?" +
        //         "text=" + encodeURIComponent(text) +
        //         "&url=" + encodeURIComponent(imgsrc);
        //     window.open(twitterUrl, "pop", "width=600, height=400, scrollbars=no");
        //     return false;
        // }

        // function insta() {
        //     var imgsrc = document.getElementById("imgfb").src;
        //     var caption = "Check out this awesome image!";
        //     var fbpopup = window.open(
        //         "https://www.instagram.com//direct/inbox" +
        //         "u=" + encodeURIComponent(imgsrc) +
        //         "&caption=" + encodeURIComponent(caption),
        //         "pop",
        //         "width=600, height=400, scrollbars=no"
        //     );
        //     return false;
        // }

        // function openInstagramMessenger() {
        //     // Redirect the user to their own Instagram profile
        //     window.location.href =
        //         "https://www.instagram.com/index/"; // Replace USERNAME with the user's Instagram username
        // }


        // Get all menu toggler checkboxes
        const menuTogglers = document.querySelectorAll(".menu-toggler");

        // Add event listener to each menu toggler
        menuTogglers.forEach((toggler) => {
            toggler.addEventListener("change", (event) => {
                // Close other share menus
                menuTogglers.forEach((otherToggler) => {
                    if (otherToggler !== toggler) {
                        otherToggler.checked = false;
                    }
                });
            });
        });
    </script>
@endsection
