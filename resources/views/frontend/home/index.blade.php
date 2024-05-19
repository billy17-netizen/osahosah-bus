@extends('frontend.layouts.master')

@section('content')
    <div class="osahan-verification padding-bt">
        @include('frontend.layouts.header.home-header')
        <div class="bg-danger px-3 pb-3">
            <div class="bg-white rounded-1 p-3">
                <form action="{{route('list-bus-routes')}}" method="post">
                    @csrf
                    <div class="form-group border-bottom pb-2">
                        <label for="exampleFormControlSelect1" class="mb-2"><span
                                    class="icofont-search-map text-danger"></span> From</label><br>
                        <select class="js-example-basic-single form-control" name="origin">
                            @foreach($busRoutes as $busRute)
                                <option value="{{$busRute->origin}}">{{$busRute->origin}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group border-bottom pb-2">
                        <label for="exampleFormControlSelect1" class="mb-2"><span
                                    class="icofont-google-map text-danger"></span> To</label><br>
                        <select class="js-example-basic-single form-control" name="destination">
                            @foreach($busRoutes as $busRute)
                                <option value="{{$busRute->destination}}">{{$busRute->destination}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group border-bottom pb-1">
                        <label for="exampleFormControlSelect1" class="mb-2"><span
                                    class="icofont-ui-calendar text-danger"></span> Date</label><br>
                        <input name="travel_date" id="travel_date" class="form-control border-0 p-0" type="date">
                    </div>
                    <button type="submit" class="btn btn-danger btn-block osahanbus-btn rounded-1">Search</button>
                </form>
            </div>
        </div>
        <div class="p-3 bg-warning">
            <div class="row m-0">
                <div class="col-6 py-1 pr-1 pl-0">
                    <div class="p-3 bg-white shadow-sm rounded-1">
                        <img class="img-fluid" src="{{asset('frontend/assets/img/safe-vehicles.svg')}}" alt="">
                        <p class="mb-0 mt-4 font-weight-bold">Safe and Hygenic<br>Vehicles</p>
                    </div>
                </div>
                <div class="col-6 py-1 pl-1 pr-0">
                    <div class="p-3 bg-white shadow-sm rounded-1">
                        <img class="img-fluid" src="{{asset('frontend/assets/img/customer-support.svg')}}" alt="">
                        <p class="mb-0 mt-4 font-weight-bold">Best Customer<br>Support</p>
                    </div>
                </div>
                <div class="col-6 py-1 pr-1 pl-0">
                    <div class="p-3 bg-white shadow-sm rounded-1">
                        <img class="img-fluid" src="{{asset('frontend/assets/img/live-tracking.svg')}}" alt="">
                        <p class="mb-0 mt-4 font-weight-bold">Live Track your<br>Journey</p>
                    </div>
                </div>
                <div class="col-6 py-1 pl-1 pr-0">
                    <div class="p-3 bg-white shadow-sm rounded-1">
                        <img class="img-fluid" src="{{asset('frontend/assets/img/verified-drivers.svg')}}" alt="">
                        <p class="mb-0 mt-4 font-weight-bold">Verified Drivers<br>and Vehicles</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-3">
            <h6 class="text-center">Bus Discounts For You</h6>
            <div class="row m-0">
                <div class="col-6 py-1 pr-1 pl-0">
                    <a href="listing.html">
                        <img class="img-fluid rounded-1 shadow-sm" src="{{asset('frontend/assets/img/offer1.jpg')}}"
                             alt="">
                    </a>
                </div>
                <div class="col-6 py-1 pl-1 pr-0">
                    <a href="listing.html">
                        <img class="img-fluid rounded-1 shadow-sm" src="{{asset('frontend/assets/img/offer2.jpg')}}"
                             alt="">
                    </a>
                </div>
                <div class="col-6 py-1 pr-1 pl-0">
                    <a href="listing.html">
                        <img class="img-fluid rounded-1 shadow-sm" src="{{asset('frontend/assets/img/offer3.jpg')}}"
                             alt="">
                    </a>
                </div>
                <div class="col-6 py-1 pl-1 pr-0">
                    <a href="listing.html">
                        <img class="img-fluid rounded-1 shadow-sm" src="{{asset('frontend/assets/img/offer4.jpg')}}"
                             alt="">
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('travel_date').setAttribute('min', today);
    </script>
@endpush