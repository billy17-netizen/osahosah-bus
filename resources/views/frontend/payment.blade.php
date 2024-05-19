@extends('frontend.layouts.master')

@section('content')
    <!-- Payment -->
    <div class="payment padding-bt">
        <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
            <h5 class="font-weight-normal mb-0 text-white">
                <a class="text-danger mr-3" href="#"
                   onclick="event.preventDefault(); document.getElementById('back-form').submit();"><i
                        class="icofont-rounded-left"></i></a>
                Payment
                <form id="back-form" action="{{route('book-bus-route',$busAvailDetail->id)}}" method="POST"
                      style="display: none;">
                    @csrf
                </form>
            </h5>
        </div>
        <!-- You Ticket -->
        <div class="your-ticket pt-2">
            <div class="p-3">
                <div class="bg-white rounded-1 shadow-sm p-2 mb-2">
                    <div class="row mx-0 px-1">
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">GOING FROM</small>
                            <p class="small mb-0"> {{$busAvailDetail->busRoute->origin}}</p>
                        </div>
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">GOING TO</small>
                            <p class="small mb-0"> {{$busAvailDetail->busRoute->destination}}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-1 shadow-sm p-2 mb-2 w-100">
                    <div class="row mx-0 px-1">
                        <div class="col-12 p-0 mb-2">
                            <small class="text-danger mb-1 f-10 pr-1">PICKUP FROM</small>
                            <p class="small mb-0 l-hght-14"> {{$pickupPoint->pickupService->pickup_location}}
                                - {{Carbon\Carbon::parse($pickupPoint->pickupService->pickup_time)->format('h:i A')}}
                        </div>
                        <div class="col-12 p-0">
                            <small class="text-danger mb-1 f-10 pr-1">DROPPING AT</small>
                            <p class="small mb-0 l-hght-14">{{$pickupPoint->pickupService->dropping_point}}
                                - {{Carbon\Carbon::parse($pickupPoint->pickupService->dropping_time)->format('h:i A')}}</p>
                        </div>
                    </div>
                </div>

                @php
                    $selectedSeats = session('selected_seats');
                @endphp

                @foreach($selectedSeats as $index => $seat)
                    <div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm mt-2">
                        <div class="d-flex w-100">
                            <div class="bus_details w-100">
                                <p class="mb-2 l-hght-18 font-weight-bold">Traveller’s Info for Seat {{$seat}}</p>
                                <div class="l-hght-10 d-flex align-items-center my-2">
                                    <small class="text-muted mb-0 pr-1">Passenger</small>
                                    <p class="small mb-0 ml-auto l-hght-14">
                                        @if($index == 0)
                                            {{auth()->user()->name}}
                                        @else
                                            <input type="text" name="passenger_name[{{$seat}}]"
                                                   placeholder="Enter name">
                                        @endif
                                    </p>
                                </div>
                                <div class="l-hght-10 d-flex align-items-center my-2">
                                    <small class="text-muted mb-0 pr-1">No HP</small>
                                    <p class="small mb-0 ml-auto l-hght-14">
                                        @if($index == 0)
                                            {{auth()->user()->mobile_number}}
                                        @else
                                            <input type="number" name="passenger_mobile_number[{{$seat}}]"
                                                   placeholder="Enter mobile number">
                                        @endif
                                    </p>
                                </div>
                                <div class="l-hght-10 d-flex align-items-center my-2">
                                    <small class="text-muted mb-0 pr-1">Address</small>
                                    <p class="small mb-0 ml-auto l-hght-14">
                                        @if($index == 0)
                                            {{auth()->user()->address}}
                                        @else
                                            <textarea id="passenger-address-{{$seat}}"
                                                      name="passenger_address[{{$seat}}]"
                                                      placeholder="Enter address" rows="3" maxlength="200"
                                                      required></textarea>
                                        @endif
                                    </p>
                                </div>
                                <div class="l-hght-10 d-flex align-items-center my-2">
                                    <small class="text-muted mb-0 pr-1">Seat No</small>
                                    <p class="small mb-0 ml-auto l-hght-14"> {{$seat}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Select Seat -->
        </div>
    </div>
    <div class="fixed-bottom view-seatbt p-3">
        <a href="#" id="confirm-btn" class="btn btn-danger btn-block d-flex align-items-center osahanbus-btn rounded-1"
           data-amount="{{ number_format(session('total_amount'), 0, ',', '.') }}"
           data-seats-count="{{ count(session('selected_seats')) }}">
           <span class="text-left l-height-14">
              TOTAL Rp {{ number_format(session('total_amount'), 0, ',', '.') }}<br>
              <small class="f-10 text-white-50">Seats Selected : {{ count(session('selected_seats')) }}</small>
           </span>
            <span class="font-weight-bold ml-auto">CONFIRM</span>

        </a>
    </div>

    <!-- Payment Success Modal -->
    <div class="modal fade" id="paymentModal" data-backdrop="static" tabindex="-1" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mx-4 rounded-2">
                <div class="modal-header d-none">
                </div>
                <div class="modal-body text-center py-4">
                    <img src="{{asset('frontend/assets/img/valid.png')}}" class="img-fluid mb-2"
                         alt="Payment Success">
                    <h5 class="font-weight-normal">Payment Success!</h5>
                    <p class="mb-4">The system is waiting for the<br>the ticket</p>
                    <a id="success-paymentURL" href="" class="btn btn-sm btn-danger">Check Your
                        Ticket</a>
                </div>
                <div class="modal-footer d-none">
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Pending Modal -->
    <div class="modal fade" id="paymentPendingModal" data-backdrop="static" tabindex="-1" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mx-4 rounded-2">
                <div class="modal-header d-none">
                </div>
                <div class="modal-body" style="text-align: center;">
                    <img src="{{asset('frontend/assets/img/pending-payment.png')}}" class="img-fluid mb-2"
                         style="width: 64px; height: 64px" alt="Payment Pending">
                    <h5 class="font-weight-normal">Payment Pending!</h5>
                    <p class="mb-4">The system is waiting for the<br>the ticket</p>
                    <a href="#" class="btn btn-sm btn-danger">Check Your Ticket</a>
                </div>
                <div class="modal-footer d-none">
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Error Modal -->
    <div class="modal fade" id="paymentErrorModal" data-backdrop="static" tabindex="-1" data-keyboard="false">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content mx-4 rounded-2">
                <div class="modal-header d-none">
                </div>
                <div class="modal-body" style="text-align: center;">
                    <img src="{{asset('frontend/assets/img/cancel-payment.png')}}" class="img-fluid mb-2"
                         style="width: 64px; height: 64px" alt="Payment Error">
                    <h5 class="font-weight-normal">Payment Error!</h5>
                    <p class="mb-4"> Your payment has been failed. Please try again.</p>
                    <a href="#" class="btn btn-sm btn-danger">Try Again</a>
                </div>
                <div class="modal-footer d-none">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script>
        $('#confirm-btn').on('click', function () {
            let totalAmount = $(this).data('amount');
            let seatsCount = $(this).data('seats-count');
            let busRouteId = "{{$busAvailDetail->busRoute->id}}";
            let busId = "{{$busAvailDetail->bus->id}}";
            let pickupServiceId = "{{$pickupPoint->pickupService->id}}";
            let travelDate = "{{$busAvailDetail->travel_date}}";
            let seatsNumber = "{{ implode(',', session('selected_seats')) }}"
            let passengerDetails = {};
            let isValid = true;
            console.log(seatsNumber);

            @foreach($selectedSeats as $index => $seat)
                passengerDetails['{{$seat}}'] = getPassengerDetails('{{$seat}}', {{$index}});

            if (!passengerDetails['{{$seat}}'].name || !passengerDetails['{{$seat}}'].mobileNumber || !passengerDetails['{{$seat}}'].address) {
                toastr.error('Please fill out all fields for seat ' + '{{$seat}}');
                isValid = false;
            }
            @endforeach

            if (isValid) {
                $.ajax({
                    url: '{{route('payment.store')}}',
                    method: 'POST',
                    data: {
                        _token: '{{csrf_token()}}',
                        total_amount: totalAmount,
                    },
                    beforeSend: function () {
                        $('#confirm-btn').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...').prop('disabled', true);
                    },
                    success: function (response) {
                        if (response.success === true) {
                            window.snap.show();
                            window.snap.pay(response.snap_token, {
                                onSuccess: function (result) {
                                    $.ajax({
                                        url: '{{route('update.payment.status')}}',
                                        type: 'POST',
                                        data: {
                                            total_amount: totalAmount,
                                            seats_count: seatsCount,
                                            passenger_names: Object.values(passengerDetails).map(detail => detail.name),
                                            passenger_mobile_numbers: Object.values(passengerDetails).map(detail => detail.mobileNumber),
                                            passenger_addresses: Object.values(passengerDetails).map(detail => detail.address),
                                            busId: busId,
                                            busRouteId: busRouteId,
                                            pickupServiceId: pickupServiceId,
                                            seatsNumber: seatsNumber,
                                            seatsCount: seatsCount,
                                            travelDate: travelDate,
                                            booking_id: result.order_id,
                                            transaction_id: result.transaction_id,
                                            payment_status: result.transaction_status,
                                            payment_approve_date: result
                                                .transaction_time,
                                            payment_type: result.payment_type,
                                            va_number: result.va_numbers[0].va_number,
                                            bank: result.va_numbers[0].bank,
                                            amount: result.gross_amount,
                                            _token: '{{ csrf_token() }}',
                                        },
                                        success: function (response) {
                                            window.snap.hide();
                                            window.onbeforeunload = function () {
                                                if ($('#paymentModal').is(':visible')) {
                                                    window.location.href = "{{route('home')}}";
                                                }
                                            };
                                            $('#success-paymentURL').attr('href', response.ticket_url);
                                            $('#paymentModal').modal('show');
                                        },
                                        error: function (error) {
                                            toastr.error('An error occurred: ' + error);
                                        }
                                    });
                                },
                                onPending: function (result) {
                                    $.ajax({
                                        url: '{{route('update.payment.status')}}',
                                        type: 'POST',
                                        data: {
                                            total_amount: totalAmount,
                                            seats_count: seatsCount,
                                            passenger_names: Object.values(passengerDetails).map(detail => detail.name),
                                            passenger_mobile_numbers: Object.values(passengerDetails).map(detail => detail.mobileNumber),
                                            passenger_addresses: Object.values(passengerDetails).map(detail => detail.address),
                                            busId: busId,
                                            busRouteId: busRouteId,
                                            pickupServiceId: pickupServiceId,
                                            seatsNumber: seatsNumber,
                                            seatsCount: seatsCount,
                                            travelDate: travelDate,
                                            booking_id: result.order_id,
                                            transaction_id: result.transaction_id,
                                            payment_status: result.transaction_status,
                                            payment_approve_date: result
                                                .transaction_time,
                                            payment_type: result.payment_type,
                                            va_number: result.va_numbers[0].va_number,
                                            bank: result.va_numbers[0].bank,
                                            amount: result.gross_amount,
                                            _token: '{{ csrf_token() }}',
                                        },
                                        success: function (response) {
                                            window.snap.hide();
                                            window.onbeforeunload = function () {
                                                if ($('#paymentPendingModal').is(':visible')) {
                                                    window.location.href = "{{route('home')}}";
                                                }
                                            };
                                            $('#paymentPendingModal').modal('show');
                                        },
                                        error: function (error) {
                                            toastr.error('An error occurred: ' + error);
                                        }
                                    });
                                },
                                onError: function (result) {
                                    $.ajax({
                                        url: '{{route('update.payment.status')}}',
                                        type: 'POST',
                                        data: {
                                            total_amount: totalAmount,
                                            seats_count: seatsCount,
                                            passenger_names: Object.values(passengerDetails).map(detail => detail.name),
                                            passenger_mobile_numbers: Object.values(passengerDetails).map(detail => detail.mobileNumber),
                                            passenger_addresses: Object.values(passengerDetails).map(detail => detail.address),
                                            busId: busId,
                                            busRouteId: busRouteId,
                                            pickupServiceId: pickupServiceId,
                                            seatsNumber: seatsNumber,
                                            seatsCount: seatsCount,
                                            travelDate: travelDate,
                                            booking_id: result.order_id,
                                            transaction_id: result.transaction_id,
                                            payment_status: result.transaction_status,
                                            payment_approve_date: result
                                                .transaction_time,
                                            payment_type: result.payment_type,
                                            va_number: result.va_numbers[0].va_number,
                                            bank: result.va_numbers[0].bank,
                                            amount: result.gross_amount,
                                            _token: '{{ csrf_token() }}',
                                        },
                                        success: function (response) {
                                            window.snap.hide();
                                            $('#paymentErrorModal').modal('show');
                                        },
                                        error: function (error) {
                                            toastr.error('An error occurred: ' + error);
                                        }
                                    });

                                },
                                onClose: function () {
                                    window.snap.hide();
                                    toastr.error('You have closed the payment form');
                                }
                            });
                        } else {
                            toastr.error('Error: ' + response.message);
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        toastr.error('An error occurred: ' + errorThrown);
                    },
                    complete: function () {
                        $('#confirm-btn').html('<span class="text-left l-height-14">TOTAL Rp ' + totalAmount + '<br><small class="f-10 text-white-50">Seats Selected: ' + seatsCount + '</small></span><span class="font-weight-bold ml-auto">CONFIRM</span>').prop('disabled', false);
                    }
                });
            }
        });

        function getPassengerDetails(seat, index) {
            let name, mobileNumber, address;

            if (index == 0) {
                name = '{{auth()->user()->name}}';
                mobileNumber = '{{auth()->user()->mobile_number}}';
                address = '{{auth()->user()->address}}';
            } else {
                name = $('input[name="passenger_name[' + seat + ']"]').val();
                mobileNumber = $('input[name="passenger_mobile_number[' + seat + ']"]').val();
                address = $('textarea[name="passenger_address[' + seat + ']"]').val();
            }

            return {
                name: name,
                mobileNumber: mobileNumber,
                address: address,
            };
        }
    </script>
@endpush
