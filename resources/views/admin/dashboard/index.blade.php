@php use Carbon\Carbon; @endphp
@extends('admin.layouts.master')

@section('content')
    @php
        $hour = Carbon::now('Asia/Jakarta')->format('H');
        $greeting = '';

        if ($hour >= 5 && $hour < 12) {
            $greeting = 'Good Morning';
        } else if ($hour >= 12 && $hour < 17) {
            $greeting = 'Good Afternoon';
        } else if ($hour >= 17 && $hour < 20) {
            $greeting = 'Good Evening';
        } else {
            $greeting = 'Good Night';
        }
    @endphp
    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1">{{ $greeting }}, {{ auth()->user()->name }}!</h4>
                                <p class="text-muted mb-0">Here's what's happening with your Web Application
                                    today.</p>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Total Earnings</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">Rp <span
                                                class="counter-value" data-target="{{$totalEarnings}}"></span>
                                        </h4>
                                        <a href="" class="text-decoration-underline">View net earnings</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                                            <i class="bx bx-dollar-circle text-success"></i>
                                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Booking</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                class="counter-value" data-target="{{  $totalBooking }}">0</span></h4>
                                        <a href="{{route('admin.booking.index')}}" class="text-decoration-underline">View
                                            all booking</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-info-subtle rounded fs-3">
                                                            <i class="bx bx-shopping-bag text-info"></i>
                                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Customers</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                class="counter-value" data-target="{{$totalCustomers}}">0</span>
                                        </h4>
                                        <a href="" class="text-decoration-underline">View all customer</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                                            <i class="bx bx-user-circle text-warning"></i>
                                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Total Bus</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span
                                                class="counter-value" data-target="{{$totalBus}}">0</span>
                                        </h4>
                                        <a href="{{route('admin.bus.index')}}" class="text-decoration-underline">View
                                            all bus</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                                            <i class="bx bx-bus text-primary"></i>
                                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->

                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header border-0 align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Revenue</h4>
                                <div>
                                    <button type="button"
                                            class="btn btn-soft-secondary material-shadow-none btn-sm">
                                        ALL
                                    </button>
                                    <button type="button"
                                            class="btn btn-soft-secondary material-shadow-none btn-sm">
                                        1M
                                    </button>
                                    <button type="button"
                                            class="btn btn-soft-secondary material-shadow-none btn-sm">
                                        6M
                                    </button>
                                    <button type="button"
                                            class="btn btn-soft-primary material-shadow-none btn-sm">
                                        1Y
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-header p-0 border-0 bg-light-subtle">
                                <div class="row g-0 text-center">
                                    <div class="col-6 col-sm-6">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1"><span class="counter-value"
                                                                   data-target="{{  $totalBooking }}">0</span>
                                            </h5>
                                            <p class="text-muted mb-0">Booking</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-6 col-sm-6">
                                        <div class="p-3 border border-dashed border-start-0">
                                            <h5 class="mb-1">Rp <span class="counter-value"
                                                                      data-target="{{  $totalEarnings }}">0</span></h5>
                                            <p class="text-muted mb-0">Total Earnings</p>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body p-0 pb-2">
                                <div class="w-100">
                                    <div id="customer_impression_charts"
                                         data-colors='["--vz-primary", "--vz-success", "--vz-danger"]'
                                         data-colors-minimal='["--vz-light", "--vz-primary", "--vz-info"]'
                                         data-colors-saas='["--vz-success", "--vz-info", "--vz-danger"]'
                                         data-colors-modern='["--vz-warning", "--vz-primary", "--vz-success"]'
                                         data-colors-interactive='["--vz-info", "--vz-primary", "--vz-danger"]'
                                         data-colors-creative='["--vz-warning", "--vz-primary", "--vz-danger"]'
                                         data-colors-corporate='["--vz-light", "--vz-primary", "--vz-secondary"]'
                                         data-colors-galaxy='["--vz-secondary", "--vz-primary", "--vz-primary-rgb, 0.50"]'
                                         data-colors-classic='["--vz-light", "--vz-primary", "--vz-secondary"]'
                                         data-colors-vintage='["--vz-success", "--vz-primary", "--vz-secondary"]'
                                         class="apex-charts" dir="ltr"></div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>


                <div class="row">

                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Recent Pending Bookings</h4>
                                <div class="flex-shrink-0">
                                    <button type="button"
                                            class="btn btn-soft-info btn-sm material-shadow-none">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Booking ID</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Booking Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Rating</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($pendingBookings as  $pendingBooking)
                                            <tr>
                                                <td>
                                                    <a href="{{route('admin.booking.show', $pendingBooking->id)}}"
                                                       class="fw-medium link-primary">#{{$pendingBooking->id}}</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{$pendingBooking->user->avatar}}" alt=""
                                                                 class="avatar-xs rounded-circle material-shadow"/>
                                                        </div>
                                                        <div class="flex-grow-1">{{$pendingBooking->user->name}}</div>
                                                    </div>
                                                </td>
                                                <td>{{Carbon::parse($pendingBooking->booking_date)->format('d M Y')}}</td>
                                                <td>
                                                    <span
                                                        class="text-success">Rp {{number_format($pendingBooking->total_amount, 0, ',', '.')}}</span>
                                                </td>
                                                <td> {{ ucwords(str_replace('_', ' ', substr($pendingBooking->payment->payment_method, 0, strrpos($pendingBooking->payment->payment_method, ' - ')))) }}
                                                    -
                                                    {{ strtoupper(substr($pendingBooking->payment->payment_method, strrpos($pendingBooking->payment->payment_method, ' - ') + 3)) }}
                                                </td>
                                                <td>
                                                    @if($pendingBooking->payment->payment_status === 'settlement')
                                                        <span
                                                            class="badge bg-success-subtle text-success">Settlement</span>
                                                    @elseif($pendingBooking->payment->payment_status === 'pending')
                                                        <span class="badge bg-danger-subtle text-warning">Pending</span>
                                                    @elseif($pendingBooking->payment->payment_status === 'cancel')
                                                        <span class="badge bg-danger-subtle text-danger">Cancel</span>
                                                    @elseif($pendingBooking->payment->payment_status === 'expire')
                                                        <span class="badge bg-danger-subtle text-danger">Expire</span>
                                                    @else
                                                        <span class="badge bg-warning-subtle text-danger">Failure</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">5.0</h5>
                                                </td>
                                            </tr><!-- end tr -->
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No pending booking found</td>
                                            </tr>
                                        @endforelse
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                    <div class="col-xl-6">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Recent Approved Booking</h4>
                                <div class="flex-shrink-0">
                                    <button type="button"
                                            class="btn btn-soft-info btn-sm material-shadow-none">
                                        <i class="ri-file-list-3-line align-middle"></i> Generate Report
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Booking ID</th>
                                            <th scope="col">Customer</th>
                                            <th scope="col">Booking Date</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Payment Method</th>
                                            <th scope="col">Payment Status</th>
                                            <th scope="col">Rating</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($approvedBookings as $approvedBooking)
                                            <tr>
                                                <td>
                                                    <a href="{{route('admin.booking.show', $approvedBooking->id)}}"
                                                       class="fw-medium link-primary">#{{$approvedBooking->id}}</a>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-shrink-0 me-2">
                                                            <img src="{{$approvedBooking->user->avatar}}" alt=""
                                                                 class="avatar-xs rounded-circle material-shadow"/>
                                                        </div>
                                                        <div class="flex-grow-1">{{$approvedBooking->user->name}}</div>
                                                    </div>
                                                </td>
                                                <td>{{Carbon::parse($approvedBooking->booking_date)->format('d M Y')}}</td>
                                                <td>
                                                    <span
                                                        class="text-success">Rp {{number_format($approvedBooking->total_amount, 0, ',', '.')}}</span>
                                                </td>
                                                <td> {{ ucwords(str_replace('_', ' ', substr($approvedBooking->payment->payment_method, 0, strrpos($approvedBooking->payment->payment_method, ' - ')))) }}
                                                    -
                                                    {{ strtoupper(substr($approvedBooking->payment->payment_method, strrpos($approvedBooking->payment->payment_method, ' - ') + 3)) }}
                                                </td>
                                                <td>
                                                    @if($approvedBooking->payment->payment_status === 'settlement')
                                                        <span
                                                            class="badge bg-success-subtle text-success">Settlement</span>
                                                    @elseif($approvedBooking->payment->payment_status === 'pending')
                                                        <span class="badge bg-danger-subtle text-warning">Pending</span>
                                                    @elseif($approvedBooking->payment->payment_status === 'cancel')
                                                        <span class="badge bg-danger-subtle text-danger">Cancel</span>
                                                    @elseif($approvedBooking->payment->payment_status === 'expire')
                                                        <span class="badge bg-danger-subtle text-danger">Expire</span>
                                                    @else
                                                        <span class="badge bg-warning-subtle text-danger">Failure</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <h5 class="fs-14 fw-medium mb-0">5.0</h5>
                                                </td>
                                            </tr><!-- end tr -->
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center">No approved booking found</td>
                                            </tr>
                                        @endforelse
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                </div> <!-- end row-->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
@endsection
@push('scripts')
    <script>
        var monthlyBookings = @json($monthlyBookings);
        var monthlyBookingsMonths = @json($monthlyBookingMonths);
        var $monthlyEarnings = @json($monthlyEarnings);
        console.log(monthlyBookings);
        var
            options = {
                chart: {height: 370, type: "line", toolbar: {show: !1}},
                series: [
                    {
                        name: "Booking",
                        type: "area",
                        data: monthlyBookings,
                    },
                    {
                        name: "Earnings",
                        type: "bar",
                        data: $monthlyEarnings,
                    },
                ],
                stroke: {
                    curve: "straight",
                    dashArray: [0, 0, 8],
                    width: [2, 0, 2.2],
                },
                fill: {opacity: [0.1, 0.9, 1]},
                markers: {
                    size: [0, 0, 0],
                    strokeWidth: 2,
                    hover: {size: 4},
                },
                xaxis: {
                    categories: monthlyBookingsMonths,
                    axisTicks: {show: !1},
                    axisBorder: {show: !1},
                },
                grid: {
                    show: !0,
                    xaxis: {lines: {show: !0}},
                    yaxis: {lines: {show: !1}},
                    padding: {top: 0, right: -2, bottom: 15, left: 10},
                },
                legend: {
                    show: !0,
                    horizontalAlign: "center",
                    offsetX: 0,
                    offsetY: -5,
                    markers: {width: 9, height: 9, radius: 6},
                    itemMargin: {horizontal: 10, vertical: 0},
                },
                plotOptions: {bar: {columnWidth: "30%", barHeight: "70%"}},
                tooltip: {
                    shared: !0,
                    y: [
                        {
                            formatter: function (e) {
                                return void 0 !== e ? e.toFixed(0) : e;
                            },
                        },
                        {
                            formatter: function (e) {
                                return void 0 !== e
                                    ? "Rp " + e.toFixed(2)
                                    : e;
                            },
                        },
                    ],
                },
            }

        "" !== customerImpressionChart && customerImpressionChart.destroy(),
            (customerImpressionChart = new ApexCharts(
                document.querySelector("#customer_impression_charts"),
                options,
            )).render();

    </script>
@endpush
