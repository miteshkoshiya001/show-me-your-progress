<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness-app</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('frt-assets/images/sticker1.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('frt-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frt-assets/css/slick.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frt-assets/css/slick-theme.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frt-assets/css/animate.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frt-assets/css/sweetalert2.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('frt-assets/css/contact-us.css') }}">
    <link rel="stylesheet" href="{{ asset('frt-assets/css/swiper-bundle.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frt-assets/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('frt-assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frt-assets/css/modal.css') }}">
    <link rel="stylesheet" href="{{ asset('frt-assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('frt-assets/css/fa-icon.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/cropme@latest/dist/cropme.min.css">
    <link rel="stylesheet" href="{{ asset('css/loader.css') }}">
    <link rel='stylesheet'
        href='https://fonts.googleapis.com/css2?family=Pacifico&amp;family=Quicksand&amp;display=swap'>


    <script>
        var assetPath = "{{ asset('') }}";
        var apiUrl = "{{ url('/') }}";
    </script>
</head>
