@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Edit Pickup</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.pickup-dropping.index')}}">Pickup
                                - Dropping</a></li>
                        <li class="breadcrumb-item active">Edit Pickup</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Pickup</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('admin.pickup-dropping.update',$pickupDropping->id)}}" method="post"
                              class="needs-validation"
                              novalidate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Pickup Location</label>
                                        <input type="text" name="pickup_location" class="form-control"
                                               placeholder="Enter Pickup Location"
                                               value="{{ $pickupDropping->pickup_location }}"
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
                                               value="{{ $pickupDropping->dropping_point }}"
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
                                               value="{{ $pickupDropping->latlong }}"
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
                                               placeholder="Enter Pickup Fee" value="{{ $pickupDropping->pickup_fee }}"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Pickup Time</label>
                                        <input type="text" name="pickup_time" class="form-control flatpickr-input"
                                               data-provider="timepickr" data-time-inline
                                               placeholder=" Enter Pickup Time"
                                               value="{{ $pickupDropping->pickup_time }}"
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
                                               data-provider="timepickr" data-time-inline
                                               placeholder=" Enter Dropping Time"
                                               value="{{ $pickupDropping->dropping_time }}"
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
                                            <option @selected($pickupDropping->status === 1) value="1">Active</option>
                                            <option @selected($pickupDropping->status === 0) value="0">Inactive</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
