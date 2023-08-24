@if ($message = Session::get('success'))    
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p class="mb-0">
            <strong>{{ $message }}</strong>
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <p class="mb-0">
            <strong>{{ $message }}</strong>
        </p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @foreach ($errors->all() as $error)
        <p class="mb-0">
                <strong>{{ $error }}</strong><br />
            </p>
        @endforeach
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    
<div class="alert alert-success alert-dismissible hidden ajax-success" role="alert">
    <p class="mb-0">
        <strong id="message">22</strong>
    </p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<div class="alert alert-danger alert-dismissible hidden ajax-error" role="alert">
    <p class="mb-0">
        <strong id="message"></strong>
    </p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>