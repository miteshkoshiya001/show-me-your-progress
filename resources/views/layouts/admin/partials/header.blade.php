@php
    
    use App\Helpers\Helper;
    
@endphp
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    <ul class="nav navbar-nav">
                        <li class="nav-item mobile-menu d-xl-none mr-auto"><a
                                class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i
                                    class="ficon feather icon-menu"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav bookmark-icons">
                        @yield('title')
                        @if (Helper::isActiveUrl('category/sorting'))
                            <button type="button" class="btn btn-icon rounded-circle btn-outline-primary waves-effect waves-light ml-3"
                                id="btn-save"><i
                                class="feather icon-check"></i></button>
                        @endif
                    </ul>
                </div>
                <ul class="nav navbar-nav float-right">
                    <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link"
                            id="dropdown-flag" href="javascript:void(0)" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"><i class="{{ __('messages.flag') }}"></i><span
                                class="selected-language"> {{ __('messages.language') }}</span></a>
                        <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item"
                                href="{{ url('admin/dashboard') }}" data-language="en"><i
                                    class="feather icon-globe"></i> English</a><a class="dropdown-item"
                                href="{{ url('gu/admin/dashboard') }}" data-language="gu"><i
                                    class="flag-icon flag-icon-in"></i> ગુજરાતી</a></div>
                    </li>
                    <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link"
                            href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span
                                    class="user-name text-bold-600">{{ Auth::user()->name }}</span><span
                                    class="user-status">Online</span></div><span><img class="round"
                                    src="{{ asset('app-assets/images/portrait/small/avatar-s-11.jpg') }}" alt="avatar"
                                    height="40" width="40"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="page-user-profile.html"><i class="feather icon-user"></i>
                                Edit Profile</a>
                            <div class="dropdown-divider"></div>
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="dropdown-item" href="javascript:void(0);"
                                    onclick="event.preventDefault();
                                this.closest('form').submit();"><i
                                        class="feather icon-power"></i>
                                    Logout</a>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@include('layouts.admin.partials.search')
