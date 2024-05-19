@extends('frontend.layouts.master')

@section('content')
    <!-- Bus Seat Select -->
    <div class="seat-select padding-bt">
        <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
            <h5 class="font-weight-normal mb-0 text-white">
                <a class="text-danger mr-3" href="{{route('bus-route-details',$busAvailDetail->id)}}"><i
                        class="icofont-rounded-left"></i></a>
                Bus Seat Select
            </h5>
        </div>
        <!-- Ticket -->
        <div class="ticket p-3">
            <h6 class="mb-1 font-weight-bold text-dark">Travellers ISO 9002- 2009 Certified</h6>
            <div class="start-rating f-10 mb-3">
                <i class="icofont-star text-danger"></i>
                <i class="icofont-star text-danger"></i>
                <i class="icofont-star text-danger"></i>
                <i class="icofont-star text-danger"></i>
                <i class="icofont-star text-muted"></i>
                <span class="text-dark">4.0</span>
            </div>
            <div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
                <div class="row mx-0 mb-3">
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">Wifi</small>
                        @if($busAvailDetail->bus->busDetail->wifi === 1)
                            <p class="small mb-0 l-hght-14"> Access in the bus</p>
                        @else
                            <p class="small mb-0 l-hght-14"> No wifi</p>
                        @endif
                    </div>
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">AC</small>
                        @if($busAvailDetail->bus->busDetail->ac === 1)
                            <p class="small mb-0 l-hght-14"> Ac is available</p>
                        @else
                            <p class="small mb-0 l-hght-14"> Ac is not available</p>
                        @endif
                    </div>
                </div>
                <div class="row mx-0 mb-3">
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">Dinner / Lunch</small>
                        @if($busAvailDetail->bus->busDetail->dinner === 1)
                            <p class="small mb-0 l-hght-14"> Yes</p>
                        @else
                            <p class="small mb-0 l-hght-14"> No</p>
                        @endif
                    </div>
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">Safety Features</small>
                        <p class="small mb-0 l-hght-14"> {!! $busAvailDetail->bus->busDetail->safety_features !!}</p>
                    </div>
                </div>
                <div class="row mx-0">
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">Essentials</small>
                        <p class="small mb-0 l-hght-14"> {!! $busAvailDetail->bus->busDetail->essentials !!} </p>
                    </div>
                    <div class="col-6 p-0">
                        <small class="text-muted mb-1 f-10 pr-1">Snacks</small>
                        <p class="small mb-0 l-hght-14"> {!! $busAvailDetail->bus->busDetail->snacks !!} </p>
                    </div>
                </div>
            </div>
            <!-- Select Seat -->
            <div class="select-seat row bg-white mx-0 px-3 pt-3 pb-1 mb-3 rounded-1 shadow-sm">
                <div class="col-8 pl-0">
                    <div class="d-flex">
                        <div class="sold text-center">
                            <img src="{{asset('frontend/assets/img/sold-seat.png')}}" class="img-fluid mb-1">
                            <p class="small f-10">Sold Out</p>
                        </div>
                        <div class="sold text-center mx-3">
                            <img src="{{asset('frontend/assets/img/available-seat.png')}}" class="img-fluid mb-1">
                            <p class="small f-10">Available</p>
                        </div>
                        <div class="sold text-center">
                            <img src="{{asset('frontend/assets/img/selected-seat.png')}}" class="img-fluid mb-1">
                            <p class="small f-10">Selected</p>
                        </div>
                    </div>
                    <!-- Select Seats -->
                    @php
                        $totalSeats = count($seatConfig->toArray());
                        $firstSectionSeatsCount = (int)($totalSeats * 0.7);
                        $secondSectionSeatsCount = $totalSeats - $firstSectionSeatsCount;

                        $firstSectionSeats = array_slice($seatConfig->toArray(), 0, $firstSectionSeatsCount);
                        $secondSectionSeats = array_slice($seatConfig->toArray(), $firstSectionSeatsCount);
                    @endphp
                    <div class="select-seat">
                        <div class="checkboxes-seat mt-4">
                            <div class="row">
                                @foreach($firstSectionSeats as $index => $seat)
                                    <div class="col-2 px-1">
                                        <div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">
                                            <label
                                                class="btn check-seat {{ $seat['status'] === 'sold_out' ? 'btn-danger' : 'btn-success' }} small btn-sm rounded mr-2 mb-2">
                                                <input type="checkbox" name="{{$seat['code']}}"
                                                       autocomplete="off" {{ $seat['status'] === 'sold_out' ? 'checked disabled' : '' }}>
                                                {{$seat['code']}}
                                            </label>
                                        </div>
                                    </div>
                                    @if (($index + 1) % 5 == 0)
                            </div>
                            <div class="row">
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 text-right pr-0">
                    <img src="{{asset('frontend/assets/img/driver.png')}}" class="img-fluid mb-4">
                    <div class="checkboxes-seat mt-4">
                        <div class="row">
                            @foreach($secondSectionSeats as $seat)
                                <div class="btn-group btn-group-toggle d-block mb-1" data-toggle="buttons">
                                    <label
                                        class="btn check-seat {{ $seat['status'] === 'sold_out' ? 'btn-danger' : 'btn-success' }} small btn-sm rounded mb-2">
                                        <input type="checkbox" name="{{$seat['code']}}"
                                               autocomplete="off" {{ $seat['status'] === 'sold_out' ? 'checked disabled' : '' }}>
                                        {{$seat['code']}}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="list_item d-flex col-12 m-0 p-3 bg-white shadow-sm rounded-1 shadow-sm">
                <div class="d-flex w-100">
                    <div class="bus_details w-100">
                        <p class="mb-2 l-hght-18 font-weight-bold">More info.</p>
                        <div class="l-hght-10 d-flex align-items-center my-2">
                            <small class="text-muted mb-0 pr-1">Passenger</small>
                            <p class="small mb-0 ml-auto l-hght-14"> {{auth()->user()->name}}</p>
                        </div>
                        <div class="l-hght-10 d-flex align-items-center my-2">
                            <small class="text-muted mb-0 pr-1">No HP</small>
                            <p class="small mb-0 ml-auto l-hght-14"> {{auth()->user()->mobile_number}}</p>
                        </div>
                        <div class="l-hght-10 d-flex align-items-center my-2">
                            <small class="text-muted mb-0 pr-1">Address</small>
                            <p class="small mb-0 ml-auto l-hght-14"> {{auth()->user()->address}}</p>
                        </div>
                        <div class="l-hght-10 d-flex align-items-center my-2">
                            <small class="text-muted mb-0 pr-1">Price per seat</small>
                            <p class="small mb-0 ml-auto l-hght-14">
                                Rp {{number_format($busAvailDetail->bus->price_per_seat, 0, ',', '.')}}</p>
                        </div>
                        <div class="l-hght-10 d-flex align-items-center mt-3">
                            <p class="mb-0 pr-1 font-weight-bold">Amount Paid</p>
                            <p class="mb-0 ml-auto l-hght-14 text-danger font-weight-bold total-amount-info">Rp 0</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Continue Booking -->
    <div class="fixed-bottom view-seatbt p-3">
        <a href="payment.html" class="btn btn-danger btn-block d-flex align-items-center osahanbus-btn rounded-1">
            <span class="text-left l-hght-14">
            TOTAL <span class="total-amount">0</span><br>
      <small class="f-10 text-white-50 selected-seats">Seats Selected : 0</small>
         </span>
            <span class="font-weight-bold ml-auto">NEXT</span>
        </a>
    </div>
@endsection
@push('scripts')
    <script>
        // book-bus-route.blade.php
        $(document).ready(function () {
            // Initial calculation
            calculateSeatsAndPrice();

            // // Listen for changes on the checkboxes
            // $('input[type="checkbox"]').change(function () {
            //     calculateSeatsAndPrice();
            //
            //     // Add or remove 'focus' class based on checkbox state
            //     if ($(this).is(':checked')) {
            //         $(this).parent().addClass('focus');
            //     } else {
            //         $(this).parent().removeClass('focus');
            //         $(this).blur();
            //     }
            // });

            // Listen for changes on the checkboxes
            $('input[type="checkbox"]').change(function (e) {
                if ($(this).is(':disabled')) {
                    e.preventDefault();
                } else {
                    calculateSeatsAndPrice();

                    // Add or remove 'focus' class based on checkbox state
                    if ($(this).is(':checked')) {
                        $(this).parent().addClass('focus');
                    } else {
                        $(this).parent().removeClass('focus');
                        $(this).blur();
                    }
                }
            });

            // Listen for click on the "NEXT" button
            $('.osahanbus-btn').click(function (e) {
                e.preventDefault(); // Prevent the default action

                // Store selected seats and total amount in session
                $.ajax({
                    url: '{{ route('storeSelectedSeatsAndTotalAmount') }}',
                    method: 'POST',
                    data: {
                        selected_seats: $('input[type="checkbox"]:checked:not(:disabled)').map(function () {
                            return this.name;
                        }).get(),
                        total_amount: $('.total-amount').text().replace('Rp ', '').replace('.', ''),
                        _token: '{{ csrf_token() }}',
                        bus_avail_id: '{{ $busAvailDetail->id }}'
                    },
                    success: function (response) {
                        window.location.href = response.redirect_url;
                    },
                    error: function (error) {
                        toastr.error(error.responseJSON.message);
                    }
                });
            });
        });

        function calculateSeatsAndPrice() {
            var selectedSeats = $('input[type="checkbox"]:checked:not(:disabled)').length;
            var pricePerSeat = {{ $busAvailDetail->bus->price_per_seat }};
            var totalAmount = selectedSeats * pricePerSeat;

            // Update the total amount info and the number of selected seats
            $('.total-amount').text('Rp ' + totalAmount.toLocaleString('id-ID'));
            $('.total-amount-info').text('Rp ' + totalAmount.toLocaleString('id-ID'));
            $('.selected-seats').text('Seats Selected : ' + selectedSeats);
        }

        @if ($errors->any())
        @foreach ($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
    </script>
@endpush
