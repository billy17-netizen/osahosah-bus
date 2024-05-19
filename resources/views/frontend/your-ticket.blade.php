@extends('frontend.layouts.master')

@section('content')
    <!-- Ticket -->
    <div class="ticket padding-bt">
        <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
            <h5 class="font-weight-normal mb-0 text-white">
                <a class="text-danger mr-3" href="{{route('my-tickets')}}"><i class="icofont-rounded-left"></i></a>
                Your Ticket
            </h5>
        </div>
        <!-- You Ticket -->
        <div class="your-ticket p-3">
            <h5 class="mb-3 font-weight-bold text-dark">Osahan-bus Travellers ISO 9002- 2009 Certified</h5>
            <p class="mb-3 font-weight-bold">
                @if($booking->status === 'approved')
                    <span class="text-success">{{strtoupper($booking->status)}}</span>
                @elseif($booking->status === 'pending')
                    <span class="text-warning"> {{strtoupper($booking->status)}}</span>
                @else
                    <span class="text-danger"> {{strtoupper($booking->status)}}</span>
                @endif
            </p>
            <div class="bg-white border border-warning rounded-1 shadow-sm p-3 mb-3">
                <div class="row mx-0 mb-3">
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">GOING FROM</small>
                        <p class="small mb-0 l-hght-14"> {{$mergedDetails['bus_route']['origin']}}</p>
                    </div>
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">GOING TO</small>
                        <p class="small mb-0 l-hght-14">{{$mergedDetails['bus_route']['destination']}}</p>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">DATE OF JOURNEY</small>
                        <p class="small mb-0 l-hght-14"> {{Carbon\Carbon::parse($mergedDetails['travel_date'])->format('d M Y')}}</p>
                    </div>
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">YOU RATED</small>
                        <p class="small mb-0 l-hght-14"><span class="icofont-star text-warning"></span> 3.5</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
                <div class="row mx-0">
                    <div class="col-12 p-0 mb-3">
                        <small class="text-danger mb-1 f-10 pr-1">PICKUP FROM</small>
                        <p class="small mb-0 l-hght-14"> {{$mergedDetails['pickup_service']['pickup_location']}}
                            - {{Carbon\Carbon::parse($mergedDetails['pickup_service']['pickup_time'])->format('h:i A')}}
                    </div>
                    <div class="col-12 p-0">
                        <small class="text-danger mb-1 f-10 pr-1">DROPPING AT</small>
                        <p class="small mb-0 l-hght-14"> {{$mergedDetails['pickup_service']['dropping_point']}}
                            - {{Carbon\Carbon::parse($mergedDetails['pickup_service']['dropping_time'])->format('h:i A')}}
                    </div>
                </div>
            </div>
            <div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm mb-3">
                <div class="d-flex w-100">
                    <div class="bus_details w-100">
                        <p class="mb-2 l-hght-18 font-weight-bold">View
                            Boarding Location on Map<span class="icofont-location-pin h4"></span></p>
                        {{--iframe maps--}}
                        @php
                            // Split the latlong field into latitude and longitude
                            $latlong = explode(',', $mergedDetails['pickup_service']['latlong']);
                            $latitude = trim($latlong[0]);
                            $longitude = trim($latlong[1]);
                        @endphp
                        <iframe src="https://maps.google.com/maps?q={{$latitude}},{{$longitude}}&z=15&output=embed"
                                width="100%" height="200" frameborder="0" style="border:0"></iframe>
                    </div>
                </div>
            </div>
            <p class="mb-2 l-hght-18 font-weight-bold">Info: <code>Pay if ticket number is missing !</code></p>
            <div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm mt-2">
                <div class="d-flex w-100 justify-content-center align-items-center">
                    <button id="pay-modal" class="btn btn-sm btn-danger mb-0 l-hght-14 mx-auto">Continue Pay</button>
                </div>
            </div>
            @foreach($customerDetails as $customerDetail)
                <div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm mt-2">
                    <div class="d-flex w-100">
                        <div class="bus_details w-100">
                            <div class="l-hght-10 d-flex align-items-center my-2">
                                <small class="text-muted mb-0 pr-1">Passenger</small>
                                <p class="small mb-0 ml-auto l-hght-14"> {{$customerDetail['name']}}</p>
                            </div>
                            <div class="l-hght-10 d-flex align-items-center my-2">
                                <small class="text-muted mb-0 pr-1">Mobile Number</small>
                                <p class="small mb-0 ml-auto l-hght-14"> {{$customerDetail['mobile_number']}}</p>
                            </div>
                            <div class="l-hght-10 d-flex align-items-center my-2">
                                <small class="text-muted mb-0 pr-1">Ticket Number</small>
                                @if(($customerDetail['ticket_number'] === ""))
                                    <p class="small mb-0 ml-auto l-hght-14">-</p>
                                @else
                                    <p class="small mb-0 ml-auto l-hght-14"> {{$customerDetail['ticket_number']}}</p>
                                @endif
                            </div>

                            @if($booking->status === 'approved')
                                <div class="l-hght-10 d-flex align-items-center my-2">
                                    <small class="text-muted mb-0 pr-1">Ticket Status</small>
                                    @if($customerDetail['ticket_status'] === 'unused')
                                        <p class="small mb-0 ml-auto l-hght-14 text-warning"> UN-USED</p>
                                    @elseIf($customerDetail['ticket_status'] === 'boarded')
                                        <p class="small mb-0 ml-auto l-hght-14 text-info"> BOARDED</p>
                                    @elseif(!empty($customerDetail['ticket_status']))
                                        <p class="small mb-0 ml-auto l-hght-14 text-success">-</p>
                                    @else
                                        <p class="small mb-0 ml-auto l-hght-14 text-success"> DROPPED</p>
                                    @endif
                                </div>
                            @endif
                            <div class="l-hght-10 d-flex align-items-center my-2">
                                <small class="text-muted">Seat Number</small>
                                <p class="small mb-0 ml-auto l-hght-14"> {{$customerDetail['seat_number']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{--Total Pay--}}
            <div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm mt-2">
                <div class="d-flex w-100">
                    <div class="bus_details w-100">
                        <div class="l-hght-10 d-flex align-items-center my-2">
                            <p class="mb-0 pr-1 font-weight-bold">Total Pay</p>
                            <p class="font-weight-bold mb-0 ml-auto l-hght-14">
                                Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Download Ticket -->
    <div class="fixed-bottom p-3">
        <div class="footer-menu row m-0 px-1 bg-white shadow rounded-2">
            <div class="col-6 p-0 text-center">
                <a href="profile.html" class="home text-danger py-3">
                    <span class="icofont-file-pdf h5"></span>
                    <p class="mb-0 small">Download Pdf</p>
                </a>
            </div>
            <div class="col-6 p-0 text-center">
                <a href="profile.html" class="home text-danger">
                    <span class="icofont-share h5"></span>
                    <p class="mb-0 small">Share Ticket</p>
                </a>
            </div>
        </div>
    </div>
    <!-- Pay-Modal -->
    <div class="modal fade" id="continue-modal" tabindex="-1" aria-labelledby="pay-modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-0 bg-light">
                    <div class="d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="pay-modalLabel">Payment Required!</h5>
                    </div>
                    <button type="button" id="close-modal" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info " role="alert">
                        <p>You need to pay for this ticket. Please click the button below if you successfully pay this
                            ticket.</p>
                        <hr>
                        <p class="mb-0">Total Pay :
                            <strong>Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</strong>
                        </p>
                        <p class="mb-0">Payment Method :
                            <strong>{{strtoupper(str_replace(['_'], ' ', $booking->payment->payment_method))}}</strong>
                        <p class="mb-0">VA NUMBER :
                            <strong>{{$booking->payment->va_number}}</strong>
                        </p>
                    </div>
                    <button id="continue-pay" data-id="{{$booking->id}}" class="btn btn-danger w-100">DONE</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        //open modal
        $('#pay-modal').click(function () {
            $('#continue-modal').modal('show');
        });

        //close modal
        $('#close-modal').click(function () {
            $('#continue-modal').modal('hide');
            ``
        });
        {{--var payButton = document.getElementById('continue-pay');--}}
        {{--payButton.addEventListener('click', function () {--}}
        {{--    // Replace TRANSACTION_TOKEN_HERE with your actual transaction token--}}
        {{--    var transactionToken = '{{session('snap_token')}}';--}}
        {{--    window.open('https://app.sandbox.midtrans.com/snap/v2/vtweb/' + transactionToken, '_blank');--}}
        {{--});--}}
        var polling; // Declare polling at a higher scope

        $('#continue-pay').click(function () {
            Swal.fire({
                title: 'Please Wait',
                html: 'Processing Payment',
                allowOutsideClick: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
            $(this).prop('disabled', true)
                .html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...');
            var id = $(this).data('id');
            polling = setInterval(function () { // Assign setInterval to polling
                $.ajax({
                    url: '{{ route('check-payment-status') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        booking_id: id
                    },
                    success: function (response) {
                        var remainingTime = getRemainingTime(response.expiry_time);
                        console.log(response);
                        if (response.transaction_status === 'settlement') {
                            // Payment is successful, stop polling
                            clearInterval(polling);
                            $.ajax({
                                url: '{{ route('done.payment') }}',
                                type: 'POST',
                                data: {
                                    _token: '{{ csrf_token() }}',
                                    booking_id: id
                                },
                                success: function (response) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Payment Success',
                                        text: response.message,
                                        showConfirmButton: true,
                                        allowOutsideClick: false,
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            $('#continue-modal').modal('hide');
                                            window.location.reload();
                                        }
                                    });
                                }, error: function (xhr) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Payment Failed',
                                        text: xhr.responseJSON.message,
                                        showConfirmButton: false,
                                        allowOutsideClick: false,
                                        timer: 1500
                                    });
                                }
                            });
                        } else if (response.transaction_status === 'pending') {
                            // Payment is still pending, do nothing and let the polling continue
                            Swal.fire({
                                icon: 'warning',
                                title: 'Payment Pending',
                                text: 'You need to pay into this account: ' + response.va_numbers[0].bank.toUpperCase() + ' ' + response.va_numbers[0].va_number + ', before the time runs out.' + ' Remaining time: ' + remainingTime,
                                showConfirmButton: true,
                                allowOutsideClick: false,
                            });
                            Swal.hideLoading();
                            clearInterval(polling);
                            //close modal
                            $('#continue-modal').modal('hide');
                        } else {
                            // Payment failed, stop polling
                            clearInterval(polling);
                            Swal.fire({
                                icon: 'error',
                                title: 'Payment Failed',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                        // Enable the button after the request is complete
                    }, complete: function () {
                        $('#continue-pay').prop('disabled', false)
                            .html('DONE');
                    }
                });
            }, 10000); // Poll every 5 seconds
        });

        function getRemainingTime(expiryTime) {
            // Parse the expiry time string into a Date object
            var expiryDate = new Date(expiryTime);

            // Get the current date and time
            var now = new Date();

            // Calculate the difference in milliseconds
            var diffMs = expiryDate.getTime() - now.getTime();

            // Convert the difference to hours, minutes, and seconds
            var diffHrs = Math.floor((diffMs % 86400000) / 3600000); // hours
            var diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes
            var diffSecs = Math.round((((diffMs % 86400000) % 3600000) % 60000) / 1000); // seconds

            // Return the remaining time
            return diffHrs + " hours, " + diffMins + " minutes, and " + diffSecs + " seconds";
        }
    </script>
@endpush
