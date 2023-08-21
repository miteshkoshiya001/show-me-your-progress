@extends('admin.main-template.main-template')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Add Rider Category</h5>
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

                <form method="POST" action="{{ route('admin.race_types.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Rider Type</label>
                        <input type="text" class="form-control" id="name" name="name"
                            placeholder="Enter Rider type name" value="{{ old('name') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Rider Type</button>
                </form>
            </div>
        </div>
    </div>

    <div class="container-xxl flex-grow-1 container-p-y pt-0">
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-race table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($raceTypes as $raceType)
                            <tr>
                                <td>{{ $raceType->race_name }}</td>
                                <td>
                                    <button type="button" class="btn btn-outline-primary waves-effect"
                                        data-bs-toggle="modal" data-bs-target="#basicModal{{ $raceType->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>

                                    <form action="{{ route('admin.race_types.destroy', $raceType->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger waves-effect delete-btn"
                                            data-id="{{ $raceType->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="basicModal{{ $raceType->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel1">Modal title</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.race_types.update', $raceType->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="nameBasic" class="form-label">Name</label>
                                                        <input type="text" class="form-control" id="editName"
                                                            name="editname" value="{{ $raceType->race_name }}" required>
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
            var dataTable = $('.datatables-race').DataTable({
                "order": [
                    [0, "desc"]
                ],
            });

            // Handle delete button click
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
