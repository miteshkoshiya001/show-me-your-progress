<!DOCTYPE html>
<html lang="en">

@include('front.partials.head')

<body>
    <div class="container">

        @include('front.partials.nav')

        @yield('content')

    </div>

    @include('front.partials.footer')

    @include('front.partials.footer-scripts')
</body>

</html>
