@extends('frontend.layouts.master')

@section('content')
    <!-- My Ticket -->
    <div class="my-ticket padding-bt">
        <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
            <h5 class="font-weight-normal mb-0 text-white">
                <a class="text-danger mr-3" href="{{route('home')}}"><i class="icofont-rounded-left"></i></a>
                Your Bookings
            </h5>
        </div>
        <!-- You Ticket -->
        {{--Info Date Book--}}
        @forelse($bookings as $booking)
            <div class="your-ticket border-top row m-0 p-3">
                <!-- My Ticket Item -->
                <p class="mb-2 l-hght-18 font-weight-bold">{{Carbon\Carbon::parse($booking->created_at)->format('d M Y, H:i:s A')}}</p>
                <div class="bg-white rounded-1 shadow-sm p-3 mb-3 w-100">
                    <a href="{{route('your-ticket',$booking->id)}}">
                        <div class="d-flex align-items-center mb-2">
                            <small class="text-muted">Booking ID : {{$booking->id}}</small>
                            @if($booking->status === 'pending')
                                <small class="text-warning ml-auto f-10">{{strtoupper($booking->status)}}</small>
                            @elseif($booking->status === 'expired')
                                <small class="text-danger ml-auto f-10">{{strtoupper($booking->status)}}</small>
                            @else
                                <small class="text-success ml-auto f-10">{{strtoupper($booking->status)}}</small>
                            @endif
                        </div>
                        <h6 class="mb-3 l-hght-18 font-weight-bold text-dark">Osahan-Bus Travellers ISO 9002- 2009
                            Certified</h6>
                    </a>
                    <div class="row mx-0 mb-3">
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">GOING FROM</small>
                            <p class="small mb-0 l-hght-14"> {{$booking->mergedDetails['bus_route']['origin']}}</p>
                        </div>
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">GOING TO</small>
                            <p class="small mb-0 l-hght-14"> {{$booking->mergedDetails['bus_route']['destination']}}</p>
                        </div>
                    </div>
                    <div class="row mx-0 mb-3">
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">BUS</small>
                            <p class="small mb-0 l-hght-14"> {{$booking->mergedDetails['bus']['bus_name']}}</p>
                        </div>
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">TOTAL PASSENGER</small>
                            <p class="small mb-0 l-hght-14"> {{$booking->mergedDetails['total_seats']}}</p>
                        </div>
                    </div>
                    <div class="row mx-0">
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">DATE OF JOURNEY</small>
                            <p class="small mb-0 l-hght-14"> {{Carbon\Carbon::parse($booking->mergedDetails['travel_date'])->format('d M Y')}}</p>
                        </div>
                        <div class="col-6 p-0">
                            <small class="text-muted mb-1 f-10 pr-1">YOU RATED</small>
                            @if($review === null)
                                <p class="small mb-0 l-hght-14"><a class="text-success font-weight-bold"
                                                                   href="{{route('review.index',$booking->id)}}">RATE
                                        NOW</a></p>
                            @else
                                <p class="small mb-0 l-hght-14"><span
                                        class="icofont-star text-warning"></span> {{ round(@$review->average_rating, 1) }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center">
                <img src="{{asset('frontend/assets/img/not-found.svg')}}" class="img-fluid" alt="empty">
                <h5 class="font-weight-bold mt-3">No Bookings Found</h5>
            </div>
        @endforelse
    </div>
@endsection
