@extends('admin.main-template.main-template')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('main-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
        <h5 class="card-header">Manage Settings</h5>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible" role="alert">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-primary alert-dismissible" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="POST" action="{{ route('admin.settings.update') }}">
                @csrf
                <div class="mb-3">
                    <label for="heading1" class="form-label">Heading 1</label>
                    <input type="text" class="form-control" id="heading1" name="settings[heading1]"
                        value="{{ $settings->where('key', 'heading1')->first()->value ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="heading2" class="form-label">Heading 2</label>
                    <input type="text" class="form-control" id="heading2" name="settings[heading2]"
                        value="{{ $settings->where('key', 'heading2')->first()->value ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="heading3" class="form-label">Subtitle 1</label>
                    <input type="text" class="form-control" id="heading3" name="settings[heading3]"
                        value="{{ $settings->where('key', 'heading3')->first()->value ?? '' }}">
                </div>
                <div class="mb-3">
                    <label for="heading4" class="form-label">Subtitle 2</label>
                    <input type="text" class="form-control" id="heading4" name="settings[heading4]"
                        value="{{ $settings->where('key', 'heading4')->first()->value ?? '' }}">
                </div>
                <!-- Add more settings fields here -->
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </form>
        </div>
    </div>
</div>

@endsection
@section('custom-js')
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
@endsection
