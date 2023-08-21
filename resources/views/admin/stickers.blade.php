@extends('admin.main-template.main-template')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Add New Sticker</h5>
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
                <form action="{{ route('admin.stickers.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="driver_id" class="form-label">Driver</label>
                            <select class="form-select" id="driver_id" name="driver_id" required>
                                <option value="">Select Driver</option>
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sticker_template" class="form-label">Sticker Template (Image)</label>
                            <input type="file" class="form-control" id="sticker_template" name="sticker_template"
                                accept="image/*" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="template_x" class="form-label">Template X</label>
                            <input type="number" class="form-control" min="1" id="template_x" name="template_x"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="template_y" class="form-label">Template Y</label>
                            <input type="number" class="form-control" min="1" id="template_y" name="template_y"
                                required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="template_width" class="form-label">Template Width</label>
                            <input type="number" class="form-control" min="1" id="template_width"
                                name="template_width" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="template_height" class="form-label">Template Height</label>
                            <input type="number" class="form-control" min="1" id="template_height"
                                name="template_height" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Sticker</button>
                </form>
            </div>
        </div>
    </div>


    <div class="container-xxl flex-grow-1 container-p-y pt-0">
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-stickers table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Driver ID</th>
                            <th>Sticker Template</th>
                            <th>Template X</th>
                            <th>Template Y</th>
                            <th>Template Width</th>
                            <th>Template Height</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stickers as $sticker)
                            <tr>
                                <td>{{ $sticker->id }}</td>
                                <td>{{ $sticker->driver->name }}</td>
                                <td><img src="{{ asset('storage/' . $sticker->sticker_template) }}" alt="Sticker Template"
                                        class="img-thumbnail" width="100" loading="lazy"></td>
                                <td>{{ $sticker->template_x }}</td>
                                <td>{{ $sticker->template_y }}</td>
                                <td>{{ $sticker->template_width }}</td>
                                <td>{{ $sticker->template_height }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary waves-effect"
                                        data-bs-toggle="modal" data-bs-target="#basicModal{{ $sticker->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <form action="{{ route('admin.stickers.destroy', $sticker->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger waves-effect delete-btn"
                                            data-id="{{ $sticker->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="basicModal{{ $sticker->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $sticker->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $sticker->id }}">Edit Sticker
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.stickers.update', $sticker->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')

                                                <div class="mb-3">
                                                    <label for="editDriver" class="form-label">Driver</label>
                                                    <select class="form-select" id="editDriver" name="driver_id"
                                                        required>
                                                        @foreach ($drivers as $driver)
                                                            <option value="{{ $driver->id }}"
                                                                {{ $driver->id == $sticker->driver_id ? 'selected' : '' }}>
                                                                {{ $driver->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="editTemplateX" class="form-label">Template X</label>
                                                        <input type="number" class="form-control" id="editTemplateX"
                                                            name="template_x" value="{{ $sticker->template_x }}"
                                                            min="0" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="editTemplateY" class="form-label">Template Y</label>
                                                        <input type="number" class="form-control" id="editTemplateY"
                                                            name="template_y" value="{{ $sticker->template_y }}"
                                                            min="0" required>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label for="editTemplateWidth" class="form-label">Template
                                                            Width</label>
                                                        <input type="number" class="form-control" id="editTemplateWidth"
                                                            name="template_width" value="{{ $sticker->template_width }}"
                                                            min="0" required>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="editTemplateHeight" class="form-label">Template
                                                            Height</label>
                                                        <input type="number" class="form-control"
                                                            id="editTemplateHeight" name="template_height"
                                                            value="{{ $sticker->template_height }}" min="0"
                                                            required>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="editStickerTemplate" class="form-label">Sticker Template</label>
                                                    <input type="file" class="form-control" id="editStickerTemplate" name="sticker_template">
                                                </div>

                                                <div class="mb-3">
                                                    <label>Current Sticker Template</label>
                                                    @if ($sticker->sticker_template)
                                                        <div>
                                                            <img src="{{ asset('storage/' . $sticker->sticker_template) }}" alt="Current Sticker Template" class="img-thumbnail" width="100">
                                                        </div>
                                                    @else
                                                        <p>No sticker template available.</p>
                                                    @endif
                                                </div>


                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script src="{{ asset('assets/js/extended-ui-sweetalert2.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
    <script>
        $(document).ready(function() {
            var dataTable = $('.datatables-stickers').DataTable({
                "order": [
                    [0, "desc"]
                ],
            });
            $('.table').on('click', '.delete-btn', function(event) {
                event.preventDefault();
                var form = $(this).closest('form');

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endsection
