@extends('admin.main-template.main-template')
@section('custom-css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('main-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-datatable table-responsive pt-0">
                <table class="datatables-users table">
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
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Avatar</th>
                            <th>User Type</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->username ?: '-' }}</td>
                                @if ($user->avatar)
                                    <td><img src="{{ asset('storage/' . $user->avatar) }}" alt="User Avatar" width="50" loading="lazy"></td>
                                @else
                                    <td>--</td>
                                @endif
                                <td>{{ $user->user_type }}</td>
                                <td>{{ $user->email }}</td>
                            </tr>
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
            var dataTable = $('.datatables-users').DataTable({
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
