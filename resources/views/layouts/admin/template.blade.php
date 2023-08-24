<!DOCTYPE html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<!-- BEGIN: Head-->

@include('layouts.admin.partials.head')
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 2-columns  navbar-floating footer-static" data-open="click"
    data-menu="vertical-menu-modern" data-col="2-columns">

    <!-- PRE LOADER -->
    @include('layouts.admin.partials.preloader')
    <!-- PRE LOADER -->
    <!-- BEGIN: Header-->
    @include('layouts.admin.partials.header')
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    @include('layouts.admin.partials.main-menu')
    <!-- END: Main Menu-->

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <!-- BEGIN : Flash Messages -->
            @include('layouts.admin.partials.flash-message')
            <!-- END : Flash Messages -->
            <!-- BEGIN: Content-->
            @yield('content')
            <!-- END: Content-->
        </div>
    </div>


    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    @include('layouts.admin.partials.footer')
    <!-- END: Footer-->


    <!-- BEGIN: Footer JS-->
    @include('layouts.admin.partials.footer-scripts')
    <!-- END: Footer JS-->

</body>
<!-- END: Body-->

</html>
