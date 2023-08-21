@extends('admin.main-template.main-template')

@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Add Hero Images</h5>

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
                <form action="{{ route('admin.hero_images.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image1" class="form-label">Image 1</label>
                            <input type="file" class="form-control" id="image1" name="images[]" accept="image/*" />
                            @if ($existingImages[0] ?? false)
                                <img src="{{ asset('storage/' . $existingImages[0]->image_path) }}" alt="Image 1" class="mt-2" width="100">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image2" class="form-label">Image 2</label>
                            <input type="file" class="form-control" id="image2" name="images[]" accept="image/*" />
                            @if ($existingImages[1] ?? false)
                                <img src="{{ asset('storage/' . $existingImages[1]->image_path) }}" alt="Image 2" class="mt-2" width="100">
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="image3" class="form-label">Image 3</label>
                            <input type="file" class="form-control" id="image3" name="images[]" accept="image/*" />
                            @if ($existingImages[2] ?? false)
                                <img src="{{ asset('storage/' . $existingImages[2]->image_path) }}" alt="Image 3" class="mt-2" width="100">
                            @endif
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="image4" class="form-label">Image 4</label>
                            <input type="file" class="form-control" id="image4" name="images[]" accept="image/*" />
                            @if ($existingImages[3] ?? false)
                                <img src="{{ asset('storage/' . $existingImages[3]->image_path) }}" alt="Image 4" class="mt-2" width="100">
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Images</button>
                </form>
            </div>
        </div>
    </div>
@endsection
