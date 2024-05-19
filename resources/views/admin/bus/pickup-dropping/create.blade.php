@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Add Pickup</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.pickup-dropping.index')}}">Pickup -
                                Dropping</a></li>
                        <li class="breadcrumb-item active">Add Pickup</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Add Pickup</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('admin.pickup-dropping.store')}}" method="post" class="needs-validation"
                              novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Pickup Location</label>
                                        <input type="text" name="pickup_location" class="form-control"
                                               placeholder="Enter Pickup Location"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Dropping Point</label>
                                        <input type="text" name="dropping_point" class="form-control"
                                               placeholder="Enter Dropping Point"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Latlong</label>
                                        <input type="text" name="latlong" class="form-control"
                                               placeholder="Enter Latitude,Longitude"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Pickup Fee</label>
                                        <input type="text" name="pickup_fee" class="form-control"
                                               placeholder="Enter Pickup Fee"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Pickup Time</label>
                                        <input type="text" name="pickup_time" class="form-control flatpickr-input"
                                               data-provider="timepickr" data-time-inline="{{now()}}"
                                               placeholder=" Enter Pickup Time"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Dropping Time</label>
                                        <input type="text" name="dropping_time" class="form-control flatpickr-input"
                                               data-provider="timepickr" data-time-inline="{{now()}}"
                                               placeholder=" Enter Dropping Time"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status" data-choices
                                                data-choices-search-false required>
                                            <option value="">Select Status</option>
                                            <option value="1">Active</option>
                                            <option value="0">Inactive</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!--end row-->
@endsection
