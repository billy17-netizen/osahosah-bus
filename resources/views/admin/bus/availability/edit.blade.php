@php use Carbon\Carbon; @endphp
@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Edit Bus Availability</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.bus-availability.index')}}">List Bus
                                Availability</a></li>
                        <li class="breadcrumb-item active">Edit Bus Availability</li>
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
                    <h4 class="card-title mb-0 flex-grow-1">Edit Bus Availability</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('admin.bus-availability.update',$busAvailability->id)}}" method="post"
                              class="needs-validation"
                              novalidate>
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">List Bus-Rute</label>
                                        <input type="text" name="bus_route" id="bus_route"
                                               class="form-control"
                                               placeholder="Click this to show Modal" data-bs-toggle="modal"
                                               data-bs-target="#busRouteModal"
                                               value="{{$busAvailability->busRoute->origin}} - {{$busAvailability->busRoute->destination}}"
                                               required readonly>
                                        <input type="hidden" name="bus_route_id" id="bus_route_id"
                                               value="{{$busAvailability->bus_route_id}}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">List Bus</label>
                                        <input type="text" name="bus" id="bus" class="form-control"
                                               placeholder="Click this to show Modal" data-bs-toggle="modal"
                                               data-bs-target="#busModal"
                                               value="{{$busAvailability->bus->bus_number}} - {{$busAvailability->bus->bus_name}}"
                                               required readonly>
                                        <input type="hidden" name="bus_id" id="bus_id"
                                               value="{{$busAvailability->bus_id}}">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Travel Date</label>
                                        <input type="text" name="travel_date" id="my-input"
                                               class="form-control flatpickr-input active" data-provider="flatpickr"
                                               placeholder="Enter Travel Date " data-time-basic="true"
                                               data-date-format="Y-m-d" data-enable-time="true" data-time_24hr="true"
                                               value="{{$busAvailability->travel_date}}"
                                               readonly required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Available Seats</label>
                                        <input type="number" name="available_seats" class="form-control"
                                               value="{{$busAvailability->available_seats}}"
                                               placeholder="Enter Available Seats" required>
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
    <!--Modal List Bus Rute-->
    <div class="modal zoomIn" id="busRouteModal" tabindex="-1" aria-labelledby="busRouteModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pickupServiceModalLabel">List Bus Rute</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle example"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>SR No.</th>
                            <th>Origin</th>
                            <th>Destination</th>
                            <th>Distance</th>
                            <th>Duration</th>
                            <th>Pickup Location</th>
                            <th>Dropping Location</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($busRoutes as $key => $busRute)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$busRute->origin}}</td>
                                <td>{{$busRute->destination}}</td>
                                <td>{{$busRute->distance}} KM</td>
                                <td>{{$busRute->duration}} Hour</td>
                                <td>{{$busRute->pickupService->pickup_location}}</td>
                                <td>{{$busRute->pickupService->dropping_point}}</td>
                                <td>
                                    <a href="#"
                                       class="btn btn-primary btn-sm select-rute"
                                       data-id="{{$busRute->id}}">Select</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div> <!-- end modal-body -->
            </div> <!-- end modal-content -->
        </div> <!-- end modal-dialog -->
    </div> <!-- end modal -->
    <!--Modal List Bus-->
    <div class="modal zoomIn" id="busModal" tabindex="-1" aria-labelledby="busModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="pickupServiceModalLabel">List Bus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered dt-responsive nowrap table-striped align-middle example"
                           style="width:100%">
                        <thead>
                        <tr>
                            <th>SR No.</th>
                            <th>Bus Number</th>
                            <th>Bus Name</th>
                            <th>Capacity</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($buses as $key => $bus)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$bus->bus_number}}</td>
                                <td>{{$bus->bus_name}}</td>
                                <td>{{$bus->capacity}}</td>
                                <td>
                                    <img src="{{asset('uploads/bus/'.$bus->image_url)}}" alt="Bus Image"
                                         class="avatar-sm">
                                <td>
                                    <a href="#"
                                       class="btn btn-primary btn-sm select-bus"
                                       data-id="{{$bus->id}}">Select</a>
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
        // // Select the input element
        // var inputElement = document.querySelector('#my-input');
        //
        // // Initialize flatpickr
        // flatpickr(inputElement, {
        //     enableTime: true, // Enable time selection
        //     time_24hr: true, // Use 24-hour time format
        //     dateFormat: "Y-m-d H:i", // Set the format of the date that will be displayed in the input
        // });
        $(document).ready(function () {
            $('.example').on('click', '.select-rute', function (event) {
                event.preventDefault();

                var row = $(this).closest('tr');
                var busRouteId = $(this).data('id');
                var origin = row.find('td:eq(1)').text();
                var destination = row.find('td:eq(2)').text();

                var formattedValue = origin + ' - ' + destination;

                $('#bus_route').val(formattedValue);
                $('#bus_route_id').val(busRouteId);
                $('#busRouteModal').modal('hide');
            });


            $('.example').on('click', '.select-bus', function (event) {
                event.preventDefault();

                var row = $(this).closest('tr');
                var busId = $(this).data('id');
                var busNumber = row.find('td:eq(1)').text();
                var busName = row.find('td:eq(2)').text();

                var formattedValue = busNumber + ' - ' + busName;

                $('#bus').val(formattedValue);
                $('#bus_id').val(busId);
                $('#busModal').modal('hide');
            });
        });
    </script>
@endpush
