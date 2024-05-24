@extends('frontend.layouts.master')

@section('content')
    <!-- Bus Details -->
    <div class="Bus-Details padding-bt">
        <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
            <h5 class="font-weight-normal mb-0 text-white">
                <a class="text-danger mr-3" href="#"
                   onclick="event.preventDefault(); document.getElementById('back-form').submit();"><i
                        class="icofont-rounded-left"></i></a>
                Bus Details
                <form id="back-form" action="{{ route('list-bus-routes') }}" method="POST" style="display: none;">
                    @csrf
                    <!-- Add any necessary hidden inputs here -->
                    <input type="hidden" name="origin" value="{{$busAvailDetail->busRoute->origin}}">
                    <input type="hidden" name="destination" value="{{$busAvailDetail->busRoute->destination}}">
                    <input type="hidden" name="travel_date"
                           value="{{Carbon\Carbon::parse($busAvailDetail->travel_date)->format('Y-m-d')}}">
                </form>
            </h5>
        </div>
        <!-- Details -->
        <div class="list_item m-0 bg-white">
            <div class="px-3 py-3 tic-div border-bottom d-flex">
                <img src="{{asset('uploads/bus/'.$busAvailDetail->bus->image_url)}}"
                     class="img-fluid border rounded p-1 shape-img mr-3">
                <div class="w-100">
                    <h6 class="my-1 l-hght-18 font-weight-bold">{{$busAvailDetail->bus->bus_name}}</h6>
                    <div class="start-rating f-10">
                        @php
                            $avg = $averageRating ?? null;
                             if ($avg !== null) {
                                 $fullStars = floor($avg);
                                 $halfStar = ($avg - $fullStars) >= 0.5 ? 1 : 0;
                                 $emptyStars = 5 - $fullStars - $halfStar;
                             }
                        @endphp

                        @if ($avg !== null)
                            @for ($i = 0; $i < $fullStars; $i++)
                                <i class="icofont-star text-danger"></i>
                            @endfor
                            @if ($halfStar)
                                <i class="icofont-star-half text-danger"></i>
                            @endif
                            @for ($i = 0; $i < $emptyStars; $i++)
                                <i class="icofont-star text-muted"></i>
                            @endfor
                            <span class="text-dark">{{ number_format($avg, 1) }}</span>
                        @endif
                        <div class="d-flex mt-2">
                            <p class="m-0"><i class="icofont-google-map mr-1 text-danger"></i><span class="small">{{$busAvailDetail->busRoute->origin}} to {{$busAvailDetail->busRoute->destination}}</span>
                            </p>
                            <p class="small ml-auto mb-0"><i class="icofont-bus mr-1 text-danger"></i> St. $5</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-3">
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
        </div>
        <ul class="nav nav-pills mb-0 nav-justified bg-white px-3 py-2 border-top border-bottom" id="pills-tab"
            role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab"
                   aria-controls="pills-home" aria-selected="true"><i class="icofont-info-circle"></i> Info</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab"
                   aria-controls="pills-profile" aria-selected="false"><i class="icofont-star"></i> Review</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab"
                   aria-controls="pills-contact" aria-selected="false"><i class="icofont-history"></i> Pick Up</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="bus-details pt-3 pb-0 px-3">
                    <div class="info" id="info">
                        <h6 class="font-weight-normal">About {{$busAvailDetail->bus->bus_name}}</h6>
                        <p class="text-muted small mb-3">{!! $busAvailDetail->bus->busDetail->about_the_bus !!}</p>
                    </div>
                    {{--Gallery Bus--}}
                    <div class="info" id="info">
                        <h6 class="font-weight-normal">Gallery</h6>
                        <div class="row">
                            @foreach($busAvailDetail->bus->galleryBus as $busGallery)
                                <div class="col-4">
                                    <a href="{{asset('uploads/bus/gallery/'.$busGallery->file_path)}}"
                                       data-fancybox="bus-gallery" data-caption="{{$busGallery->caption}}">
                                        <img src="{{asset('uploads/bus/gallery/'.$busGallery->file_path)}}"
                                             class="img-fluid border rounded p-1 shape-img mr-3 img-gallery"
                                             alt="gallery-bus">
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{--End Gallery Bus--}}
                </div>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div class="bus-details pt-3 pb-0 px-3">
                    <div class="review" id="review">
                        @if($reviewBus->count() > 0)
                            <h6 class="font-weight-normal">Review</h6>
                            <p class="mb-0"><span class="h4 mb-0">{{ round($averageRating, 1) }}</span><span
                                    class="h6">/5</span></p>
                            <span
                                class="f-10">{{ \Illuminate\Support\Str::title(str_replace(['_', 'rating'], ' ', $highestRatingCategory)) }}</span>
                            @php
                                // Initialize the categories
                                $categories = [
                                    '1-2' => [],
                                    '2-3' => [],
                                    '3-4' => [],
                                    '4-5' => [],
                                ];

                                // Categorize the reviews
                                foreach ($reviewBus as $review) {
                                    $averageRating = $review->average_rating;
                                    if ($averageRating >= 1 && $averageRating < 2) {
                                        $categories['1-2'][] = $review;
                                    } elseif ($averageRating >= 2 && $averageRating < 3) {
                                        $categories['2-3'][] = $review;
                                    } elseif ($averageRating >= 3 && $averageRating < 4) {
                                        $categories['3-4'][] = $review;
                                    } elseif ($averageRating >= 4 && $averageRating <= 5) {
                                        $categories['4-5'][] = $review;
                                    }
                                }

                                // Calculate the average rating for each category and display the stars
                                foreach ($categories as $category => $reviews) {
                                    $totalRating = 0;
                                    $count = count($reviews);
                                    foreach ($reviews as $review) {
                                        $totalRating += $review->average_rating;
                                    }
                                    $averageRating = $count > 0 ? $totalRating / $count : 0;
                            @endphp

                            <div class="review-rating row align-items-center">
                                <div class="start-rating f-8 col-3">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= round($averageRating))
                                            <i class="icofont-star text-danger"></i>
                                        @else
                                            <i class="icofont-star text-muted"></i>
                                        @endif
                                    @endfor
                                </div>
                                <div class="progress col-7 p-0">
                                    <div class="progress-bar bg-danger" role="progressbar"
                                         style="width: {{ $averageRating * 20 }}%"
                                         aria-valuenow="{{ $averageRating * 20 }}" aria-valuemin="0"
                                         aria-valuemax="100"></div>
                                </div>
                                <div class="col-2">
                                    <span class="small">{{ round($averageRating, 1) }}</span>
                                </div>
                            </div>
                            @php
                                }
                            @endphp


                            <div class="comments mt-3">
                                @foreach($reviewBus as $review)
                                    <div class="reviews bg-white p-3 shadow-sm rounded-1 mb-3">
                                        <div class="d-flex align-items-center mb-2">
                                            <img src="{{$review->user->avatar}}" class="img-fluid rounded-pill"
                                                 style="width: 30px; height: 30px">
                                            <div class="ml-2">
                                                <p class="mb-0 small font-weight-bold">{{ $review->user->name }}</p>
                                                <div class="start-rating d-flex align-items-center f-8">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= round($review->average_rating))
                                                            <i class="icofont-star text-danger"></i>
                                                        @else
                                                            <i class="icofont-star text-muted"></i>
                                                        @endif
                                                    @endfor
                                                    <span
                                                        class="ml-2 small text-danger">{{ round($review->average_rating, 1) }}</span>
                                                </div>
                                            </div>
                                            <div class="date ml-auto mb-auto small">
                                                <small class="f-10">{{ $review->created_at->format('d/m/Y') }}</small>
                                            </div>
                                        </div>
                                        <p class="small text-muted mb-0">{{ $review->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="alert alert-warning text-center" role="alert">
                                No reviews available for this bus.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                <div class="bus-details pt-3 pb-0 px-3">
                    <!-- Pick Up Point -->
                    <div class="pickpoint" id="pick">
                        <div class="bg-white shadow-sm rounded-1 p-3 mb-3">
                            <h6 class="border-bottom pb-3 mb-3">Boarding Point Selected</h6>
                            @foreach($pickUpService as $pickupPoint)
                                <div class="custom-control custom-radio custom-control-inline mb-3">
                                    <input type="radio" id="customPickuppoint{{$pickupPoint->pickupService->id}}"
                                           name="pickup_point" value="{{$pickupPoint->pickupService->id}}"
                                           class="custom-control-input">
                                    <label class="custom-control-label small d-flex"
                                           for="customPickuppoint{{$pickupPoint->pickupService->id}}">
                                        <div class="mb-0">
                                            <b>{{$pickupPoint->pickupService->pickup_location}}</b> Opp. Bus
                                            Stand
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                        <div class="bg-white shadow-sm rounded-1 p-3 readonly-cursor">
                            <h6 class="border-bottom pb-3 mb-3">Dropping Point Selected</h6>
                            @foreach($pickUpService as $droppingPoint)
                                <div class="custom-control custom-radio custom-control-inline mb-3 readonly-cursor">
                                    <input type="radio"
                                           id="customDroppingpoint{{$droppingPoint->pickupService->id}}"
                                           name="dropping_point" value="{{$droppingPoint->pickupService->id}}"
                                           class="custom-control-input readonly-cursor" disabled>
                                    <label class="custom-control-label small d-flex readonly-cursor"
                                           for="customDroppingpoint{{$droppingPoint->pickupService->id}}">
                                        <div class="mb-0 readonly-cursor">
                                            <b>{{$droppingPoint->pickupService->dropping_point}}</b> Opp. Bus
                                            Stand
                                        </div>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Veiw Seat Button -->
    <div class="fixed-bottom view-seatbt p-3">
        <form method="POST" action="{{ route('book-bus-route', $busAvailDetail->id) }}">
            @csrf
            <button type="submit" class="btn btn-danger btn-block osahanbus-btn rounded-1">Book Your Seats Now
            </button>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $("[data-fancybox]").fancybox({
                buttons: [
                    'slideShow',
                    'share',
                    'zoom',
                    'fullScreen',
                    'close'
                ],
                loop: true,
            });

            // Event handlers for changing pickup and dropping points
            $('input[type=radio][name=pickup_point], input[type=radio][name=dropping_point]').change(function () {
                var newValue = this.value;
                var url = $(this).attr('name') === 'pickup_point' ? '/storePickupPoint' : '/storeDroppingPoint';
                var oppositePointName = $(this).attr('name') === 'pickup_point' ? 'dropping_point' : 'pickup_point';

                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        [$(this).attr('name')]: newValue,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function (response) {
                        $('input[type=radio][name=' + $(this).attr('name') + '][value=' + response[$(this).attr('name')] + ']').prop('checked', true);
                        $('input[type=radio][name=' + oppositePointName + '][value=' + response[$(this).attr('name')] + ']').prop('checked', true);

                        // Call the opposite point's endpoint
                        $.ajax({
                            url: url === '/storePickupPoint' ? '/storeDroppingPoint' : '/storePickupPoint',
                            method: 'POST',
                            data: {
                                [oppositePointName]: newValue,
                                _token: '{{ csrf_token() }}'
                            },
                            success: function (response) {
                                $('input[type=radio][name=' + oppositePointName + '][value=' + response[oppositePointName] + ']').prop('checked', true);
                            }
                        });
                    }
                });
            });

// Change the cursor to "not-allowed" when hovering over the radio button
            $('.readonly-cursor').hover(function () {
                $(this).css('cursor', 'not-allowed');
            }, function () {
                $(this).css('cursor', 'auto');
            });

        });
    </script>
@endpush
