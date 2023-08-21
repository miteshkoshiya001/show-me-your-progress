<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav"
    aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
</button>

<div class="area">
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
</div>

<header>
    <nav class="navbar navbar-expand-lg" style="margin-top: 20px;">
        <div class="container">
            <a class="navbar-brand" href="{{ route('index.show') }}"><img src="{{ asset('./assets/logo.png') }}"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end button" id="navbarNav">
                <div class="d-flex align-items-center">
                    @if (auth()->user() == null)
                        <button class="btn"><a href="{{ route('login.show') }}">Login</a></button>
                    @else
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn" type="submit">Logout</button>
                        </form>
                        @if (Route::currentRouteName() === 'show.profile')
                            <!-- Your content specific to the profile route -->
                            <button class="btn btn-profile"><a href="{{ route('index.show') }}">Home</a></button>
                        @else
                            <button class="btn btn-profile"><a href="{{ route('show.profile') }}">My
                                    Profile</a></button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </nav>
</header>
