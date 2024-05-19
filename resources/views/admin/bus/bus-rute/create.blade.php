@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Add Rute</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.bus-rute.index')}}">Bus-Rute</a></li>
                        <li class="breadcrumb-item active">Add Rute</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Add Rute</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('admin.bus-rute.store')}}" method="post" class="needs-validation"
                              novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Origin</label>
                                        <input type="text" name="origin" class="form-control"
                                               placeholder="Enter Origin"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Destination</label>
                                        <input type="text" name="destination" class="form-control"
                                               placeholder="Enter Destination"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Distance</label>
                                        <input type="text" name="distance" class="form-control"
                                               placeholder="Enter Distance"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Duration</label>
                                        <input type="text" name="duration" class="form-control"
                                               placeholder="Enter Duration"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Pickup - Service</label>
                                        <input type="text" name="pickup_service_id" id="pickup_service"
                                               class="form-control"
                                               placeholder="Click this to show Modal" data-bs-toggle="modal"
                                               data-bs-target="#pickupServiceModal"
                                               required readonly>
                                        <input type="hidden" name="pickup_service_id" id="pickup_service_id">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Start Date Operation</label>
                                        <input type="text" name="start_date" class="form-control flatpickr-input active"
                                               placeholder="Enter Start Date Operation" data-provider="flatpickr"
                                               data-date-format="m/d/Y" readonly="readonly" required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">End Date Operation</label>
                                        <input type="text" name="end_date" class="form-control flatpickr-input active"
                                               placeholder="Enter End Date Operation" data-provider="flatpickr"
                                               data-date-format="m/d/Y" readonly="readonly" required>
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
    <!--Modal List Pickup Service-->
    <div class="modal zoomIn" id="pickupServiceModal" tabindex="-1" aria-labelledby="pickupServiceModalLabel"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pickupServiceModalLabel">List Pickup Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle example"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>SR No.</th>
                            <th>Pickup Location</th>
                            <th>Dropping Point</th>
                            <th data-ordering="false">Pickup Fee</th>
                            <th data-ordering="false">Pickup Time</th>
                            <th data-ordering="false">Dropping Time</th>
                            <th data-ordering="false">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pickupService as $key => $listPickupService)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$listPickupService->pickup_location}}</td>
                                <td>{{$listPickupService->dropping_point}}</td>
                                <td>Rp {{number_format($listPickupService->pickup_fee, 0, ',', '.')}}</td>
                                <td>{{Carbon\Carbon::parse($listPickupService->pickup_time)->format('H:i A')}}</td>
                                <td>{{Carbon\Carbon::parse($listPickupService->dropping_time)->format('H:i A')}}</td>
                                <td>{!! $listPickupService->status ? '<span class="badge bg-success-subtle text-success">Active</span>' : '<span class="badge bg-danger-subtle text-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="#"
                                       class="btn btn-primary btn-sm select"
                                       data-id="{{$listPickupService->id}}">Select</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end modal-body -->
            </div> <!-- end modal-content -->
        </div> <!-- end modal-dialog -->
    </div> <!-- end modal -->
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.example').on('click', '.select', function (event) {
                event.preventDefault();

                var row = $(this).closest('tr');
                var pickupLocation = row.find('td:nth-child(2)').text();
                var droppingPoint = row.find('td:nth-child(3)').text();
                var pickupFee = row.find('td:nth-child(4)').text();
                var pickupServiceId = $(this).data('id'); // Get the id

                var formattedValue = pickupLocation + ' - ' + droppingPoint + ' (' + pickupFee + ')';

                $('#pickup_service').val(formattedValue);
                $('#pickup_service_id').val(pickupServiceId);
                $('#pickupServiceModal').modal('hide');
            });
        });
    </script>
@endpush