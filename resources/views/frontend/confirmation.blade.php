@extends('frontend.layouts.master')

@section('content')
    <div class="ticket padding-bt">
        <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
            <h5 class="font-weight-normal mb-0 text-white">
                <a class="text-danger mr-3" href="{{route('home')}}"><i class="icofont-rounded-left"></i></a>
                Confirmation Boarding
            </h5>
        </div>
        <div class="your-ticket p-3 d-flex align-items-center justify-content-center flex-column"
             style="height: 80vh;">
            <p class="mb-2 l-hght-18 font-weight-bold text-center">Info.</p>
            <div class="bg-white border border-warning rounded-1 shadow-sm p-3 mb-3 text-center">
                <div class="card-body">
                    <strong class="mb-2 l-hght-18">You have successfully boarded the bus. Please wait for the bus to
                        depart.</strong>
                </div>
            </div>
            <div class="text-center">
                <img src="{{asset('uploads/wait a bus.jpg')}}" alt="Boarding Confirmation"
                     style="max-width: 100%;">
            </div>
        </div>
@endsection
