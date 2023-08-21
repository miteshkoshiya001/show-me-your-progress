@extends('admin.main-template.main-template')
@section('main-content')
    <!-- Content wrapper -->
    <div class="content-wrapper">


        <!-- Statistics -->
        <div class="container-xxl flex-grow-1 container-p-y">

            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between mb-3">
                        <h5 class="card-title mb-0">Statistics</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row gy-3">
                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-primary me-3 p-3">
                                    <i class="fa fa-users fa-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $totalUsers }}</h5>
                                    <small>Users</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-info me-3 p-3">
                                    <i class="fa fa-car fa-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $totalDrivers }}</h5>
                                    <small>Drivers</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-danger me-3 p-3">
                                    <i class="fa fa-solid fa-list fa-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $totalRiderCategories }}</h5>
                                    <small>Rider Categories</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-success me-3 p-3">
                                    <i class="fa fa-solid fa-note-sticky fa-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $totalCounts }}</h5>
                                    <small>Generated Stickers</small>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2 col-6">
                            <div class="d-flex align-items-center">
                                <div class="badge rounded-pill bg-label-success me-3 p-3">
                                    <i class="fa fa-comments fa-lg"></i>
                                </div>
                                <div class="card-info">
                                    <h5 class="mb-0">{{ $totalFeedbacks }}</h5>
                                    <small>Feedbacks</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
        <!--/ Statistics -->
    </div>
    <!-- / Content wrapper-->
@endsection
