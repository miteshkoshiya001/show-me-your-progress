@extends('admin.main-template.main-template')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Add Driver</h5>
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
                <form method="POST" action="{{ route('admin.drivers.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Driver Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter driver name" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="race_type_id" class="form-label">Race Type</label>
                        <select class="form-select" id="defaultSelect" name="race_type_id" required>
                            <option value="">Select Rider Category</option>

                            @foreach ($raceTypes as $raceType)
                                <option value="{{ $raceType->id }}">{{ $raceType->race_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Driver</button>
                </form>
            </div>
        </div>
    </div>


    <div class="container-xxl flex-grow-1 container-p-y pt-0">
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-driver table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Rider Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drivers as $driver)
                            <tr>
                                <td>{{ $driver->name }}</td>
                                <td>{{ $driver->race->race_name }}</td>

                                <td>

                                    <button type="button" class="btn btn-outline-primary waves-effect"
                                        data-bs-toggle="modal" data-bs-target="#basicModal{{ $driver->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('admin.drivers.destroy', $driver->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger waves-effect delete-btn"
                                            data-id="{{ $driver->id}}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="basicModal{{ $driver->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Edit Driver</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.drivers.update', $driver->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="editName" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="editName"
                                                            name="name" value="{{ $driver->name }}" required>
                                                    </div>
                                                    <div class="col mb-3">
                                                        <label for="editRaceType" class="form-label">Race Type</label>
                                                        <select class="form-select" id="editRaceType" name="race_type_id"
                                                            required>
                                                            <option value="" disabled
                                                                {{ !$driver->race_type_id ? 'selected' : '' }}>Select Race
                                                                Type</option>
                                                            @foreach ($raceTypes as $raceType)
                                                                <option value="{{ $raceType->id }}"
                                                                    {{ $driver->race_type_id == $raceType->id ? 'selected' : '' }}>
                                                                    {{ $raceType->race_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
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
            var dataTable = $('.datatables-driver').DataTable({
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
