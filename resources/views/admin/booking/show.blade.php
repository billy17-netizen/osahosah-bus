@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Booking Details (<code>#{{$booking->id}}</code>)</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.booking.index')}}">All Booking</a></li>
                        <li class="breadcrumb-item active">Booking Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">All Customer</h5>
                        <div class="flex-shrink-0">
                            <a href="apps-invoices-details.html" class="btn btn-success btn-sm"><i
                                    class="ri-download-2-fill align-middle me-1"></i>Invoice</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Mobile Number</th>
                                <th scope="col">Address</th>
                                <th scope="col">Ticket Number</th>
                                <th scope="col">Ticket Status</th>
                                <th scope="col">Seat Number</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($customerDetails as $key => $customer)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $customer['name'] }}</td>
                                    <td>{{ $customer['mobile_number'] }}</td>
                                    <td>{{ $customer['address'] }}</td>
                                    <td>
                                        @if($customer['ticket_number'] === "")
                                            <span class="badge bg-soft-danger text-muted">-</span>
                                    @else
                                        {{ $customer['ticket_number'] }}
                                    @endif
                                    <td>
                                        @if($customer['ticket_status'] === 'unused')
                                            <span class="badge bg-soft-warning text-warning">UN-USED</span>
                                        @elseif($customer['ticket_status'] === 'boarded')
                                            <span class="badge bg-soft-success text-info">BOARDED</span>
                                        @elseif($customer['ticket_status'] === 'expired')
                                            <span class="badge bg-soft-success text-danger">EXPIRED</span>
                                        @elseif($customer['ticket_status'] === "")
                                            <span class="badge bg-soft-success text-muted">-</span>
                                        @else
                                            <span class="badge bg-soft-danger text-success">DROPPED</span>
                                    @endif
                                    <td>{{ $customer['seat_number'] }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <div class="d-sm-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order Status</h5>
                        <div class="flex-shrink-0 mt-2 mt-sm-0">
                            <a href="javascript:void(0);"
                               class="btn btn-soft-info material-shadow-none btn-sm mt-2 mt-sm-0"><i
                                    class="ri-map-pin-line align-middle me-1"></i> Change Address</a>
                            <a href="javascript:void(0);"
                               class="btn btn-soft-danger material-shadow-none btn-sm mt-2 mt-sm-0"><i
                                    class="mdi mdi-archive-remove-outline align-middle me-1"></i> Cancel Order</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="profile-timeline">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingOne">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle material-shadow">
                                                    <i class="ri-shopping-bag-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-0 fw-semibold">Order Placed - <span
                                                        class="fw-normal">Wed, 15 Dec 2021</span></h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseOne" class="accordion-collapse collapse show"
                                     aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">An order has been placed.</h6>
                                        <p class="text-muted">Wed, 15 Dec 2021 - 05:34PM</p>

                                        <h6 class="mb-1">Seller has processed your order.</h6>
                                        <p class="text-muted mb-0">Thu, 16 Dec 2021 - 5:48AM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingTwo">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle material-shadow">
                                                    <i class="mdi mdi-gift-outline"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Packed - <span class="fw-normal">Thu, 16 Dec 2021</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                     aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="mb-1">Your Item has been picked up by courier partner</h6>
                                        <p class="text-muted mb-0">Fri, 17 Dec 2021 - 9:45AM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingThree">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div class="avatar-title bg-success rounded-circle material-shadow">
                                                    <i class="ri-truck-line"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-15 mb-1 fw-semibold">Shipping - <span class="fw-normal">Thu, 16 Dec 2021</span>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                     aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body ms-2 ps-5 pt-0">
                                        <h6 class="fs-14">RQK Logistics - MFDS1400457854</h6>
                                        <h6 class="mb-1">Your item has been shipped.</h6>
                                        <p class="text-muted mb-0">Sat, 18 Dec 2021 - 4.54PM</p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFour">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseFour" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div
                                                    class="avatar-title bg-light text-success rounded-circle material-shadow">
                                                    <i class="ri-takeaway-fill"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Out For Delivery</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="accordion-item border-0">
                                <div class="accordion-header" id="headingFive">
                                    <a class="accordion-button p-2 shadow-none" data-bs-toggle="collapse"
                                       href="#collapseFile" aria-expanded="false">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 avatar-xs">
                                                <div
                                                    class="avatar-title bg-light text-success rounded-circle material-shadow">
                                                    <i class="mdi mdi-package-variant"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-0 fw-semibold">Delivered</h6>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!--end accordion-->
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0"><i
                                class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Detail Bus
                        </h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track
                                Bus</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        {{--                        <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop"--}}
                        {{--                                   colors="primary:#405189,secondary:#0ab39c"--}}
                        {{--                                   style="width:80px;height:80px"></lord-icon>--}}
                        <img src="{{asset('uploads/bus/'.$mergedDetails['bus']['image_url'])}}" alt="bus"
                             style="width:80px;height:80px">
                        <h5 class="fs-16 mt-2"></h5>
                        <p class="text-muted mb-0">BUS Name : {{$mergedDetails['bus']['bus_name']}}</p>
                        <p class="text-muted mb-0">BUS Capacity : {{$mergedDetails['bus']['capacity']}} Seats</p>
                        <p class="text-muted mb-0">BUS Number : {{$mergedDetails['bus']['bus_number']}}</p>
                        <p class="text-muted mb-0">BUS Status :
                            @if($mergedDetails['bus']['status'] === 1)
                                <span class="bg-soft-success text-success">Active</span>
                            @else
                                <span class="bg-soft-danger text-danger">Inactive</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">user Details</h5>
                        <div class="flex-shrink-0">
                            <a href="javascript:void(0);" class="link-secondary">View Profile</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{$booking->user->avatar}}" alt=""
                                         class="avatar-sm rounded material-shadow">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{$booking->user->name}}</h6>
                                    <p class="text-muted mb-0">User</p>
                                </div>
                            </div>
                        </li>
                        <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{$booking->user->email}}
                        </li>
                        <li>
                            <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{$booking->user->mobile_number}}
                        </li>
                    </ul>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Pickup
                        Location</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14">{{$mergedDetails['pickup_service']['pickup_location']}}</li>
                        <li>{{$mergedDetails['bus_route']['origin']}}</li>
                        <li>Rp {{number_format($mergedDetails['pickup_service']['pickup_fee'], 0, ',', '.')}}</li>
                        <li>{{Carbon\Carbon::parse($mergedDetails['pickup_service']['pickup_time'])->format('h:i A')}}</li>
                        <li>
                            @if($mergedDetails['pickup_service']['status'] === 1)
                                <span class="bg-soft-success text-success">Active</span>
                            @else
                                <span class="bg-soft-danger text-danger">Inactive</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i> Dropping
                        Location</h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14">{{$mergedDetails['pickup_service']['dropping_point']}}</li>
                        <li>{{$mergedDetails['bus_route']['destination']}}</li>
                        <li>Rp {{number_format($mergedDetails['pickup_service']['pickup_fee'], 0, ',', '.')}}</li>
                        <li>{{Carbon\Carbon::parse($mergedDetails['pickup_service']['dropping_time'])->format('h:i A')}}</li>
                        <li>
                            @if($mergedDetails['pickup_service']['status'] === 1)
                                <span class="bg-soft-success text-success">Active</span>
                            @else
                                <span class="bg-soft-danger text-danger">Inactive</span>
                            @endif
                        </li>
                    </ul>
                </div>
            </div>
            <!--end card-->

            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i>
                        Payment Details</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Payment Mode:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ ucwords(str_ireplace(['_', ' - BCA'], [' ', ''], $booking->payment->payment_method)) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Payment Method:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{ last(explode(' - ',strtoupper($booking->payment->payment_method) )) }}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">VA Number:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{$booking->payment->va_number}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Total Amount:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">Rp {{number_format($booking->payment->amount, 0, ',', '.')}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Payment Date:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{Carbon\Carbon::parse($booking->payment->payment_date)->format('d M Y H:i A')}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Payment Status:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">
                                @if($booking->payment->payment_status === 'settlement')
                                    <span class=" bg-soft-success text-success">Settlement</span>
                                @elseif($booking->payment->payment_status === 'pending')
                                    <span class=" bg-soft-danger text-warning">Pending</span>
                                @elseif($booking->payment->payment_status === 'cancel')
                                    <span class=" bg-soft-danger text-danger">Cancel</span>
                                @elseif($booking->payment->payment_status === 'expire')
                                    <span class="bg-soft-danger text-danger">Expire</span>
                                @else
                                    <span class=" bg-soft-warning text-danger">Failure</span>
                                @endif
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
