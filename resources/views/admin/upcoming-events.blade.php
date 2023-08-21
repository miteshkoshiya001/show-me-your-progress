@extends('admin.main-template.main-template')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <h5 class="card-header">Add Upcoming Event</h5>
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
                <form method="POST" action="{{ route('upcoming_events.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label for="title" class="form-label">Event Title</label>
                        <input type="text" class="form-control" id="title" name="title"
                            placeholder="Enter event title" value="{{ old('title') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Event Image</label>
                        <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                    </div>

                    <div class="mb-3">
                        <label for="event_date" class="form-label">Event Date</label>
                        <input type="date" class="form-control" id="event_date" name="event_date"
                            value="{{ old('event_date') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" id="location" name="location"
                            placeholder="Enter event location" value="{{ old('location') }}" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Event</button>
                </form>
            </div>
        </div>
    </div>
    <div class="container-xxl flex-grow-1 container-p-y pt-0">
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-events table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Event Date</th>
                            <th>Location</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($upcomingEvents as $event)
                            <tr>
                                <td>{{ $event->title }}</td>
                                <td>{{ $event->event_date }}</td>
                                <td>{{ $event->location }}</td>
                                <td><img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}"
                                        width="100"></td>
                                <td>

                                    <button type="button" class="btn btn-outline-primary waves-effect"
                                        data-bs-toggle="modal" data-bs-target="#editModal{{ $event->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <form action="{{ route('admin.upcoming_events.destroy', $event->id) }}" method="POST"
                                        class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-outline-danger waves-effect delete-btn"
                                            data-id="{{ $event->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <div class="modal fade" id="editModal{{ $event->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel{{ $event->id }}">Edit Event
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.upcoming_events.update', $event->id) }}"
                                                method="POST" enctype="multipart/form-data">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="editTitle" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="editTitle"
                                                        name="title" value="{{ $event->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editEventDate" class="form-label">Event Date</label>
                                                    <input type="date" class="form-control" id="editEventDate"
                                                        name="event_date"
                                                        value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d') }}"
                                                        required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editLocation" class="form-label">Location</label>
                                                    <input type="text" class="form-control" id="editLocation"
                                                        name="location" value="{{ $event->location }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="editImage" class="form-label">Image</label>
                                                    <input type="file" class="form-control" id="editImage"
                                                        name="image">
                                                    <img src="{{ asset('storage/' . $event->image) }}"
                                                        alt="{{ $event->title }}" width="100">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
            var dataTable = $('.datatables-events').DataTable({
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
