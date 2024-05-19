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
            <p class="text-success mb-3 font-weight-bold">{{strtoupper($booking->status)}}</p>
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
            <p class="mb-2 l-hght-18 font-weight-bold">More info.</p>
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
                                <p class="small mb-0 ml-auto l-hght-14"> {{$customerDetail['ticket_number']}}</p>
                            </div>
                            <div class="l-hght-10 d-flex align-items-center my-2">
                                <small class="text-muted mb-0 pr-1">Ticket Status</small>
                                @if($customerDetail['ticket_status'] === 'unused')
                                    <p class="small mb-0 ml-auto l-hght-14 text-warning"> UN-USED</p>
                                @elseIf($customerDetail['ticket_status'] === 'boarded')
                                    <p class="small mb-0 ml-auto l-hght-14 text-info"> BOARDED</p>
                                @else
                                    <p class="small mb-0 ml-auto l-hght-14 text-success"> DROPPED</p>
                                @endif
                            </div>
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
@endsection
