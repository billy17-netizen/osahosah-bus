@extends('frontend.layouts.master')

@section('content')
    <!-- Feedback -->
    <div class="osahan-feedback padding-bt">
        <div class="osahan-header-nav shadow-sm bg-danger p-3 d-flex align-items-center">
            <h5 class="font-weight-normal mb-0 text-white">
                <a class="text-danger mr-3" href="{{route('my-tickets')}}"><i class="icofont-rounded-left"></i></a>
                Customer Feedback
            </h5>
        </div>
        <!-- Customer Feedback Form -->
        <form action="{{route('review.store')}}" method="post" class="p-3 feedback">
            @csrf
            <div class="form-group mb-3 w-100 d-flex align-items-center">
                <label for="exampleFormControlFile1" class="mb-0">Punctuality</label><br>
                <div class="rate ml-auto">
                    <input type="radio" id="Punctuality5" name="Punctuality" value="5"/>
                    <label for="Punctuality5" title="text"></label>
                    <input type="radio" id="Punctuality4" name="Punctuality" value="4"/>
                    <label for="Punctuality4" title="text"></label>
                    <input type="radio" id="Punctuality3" name="Punctuality" value="3"/>
                    <label for="Punctuality3" title="text"></label>
                    <input type="radio" id="Punctuality2" name="Punctuality" value="2"/>
                    <label for="Punctuality2" title="text"></label>
                    <input type="radio" id="Punctuality1" name="Punctuality" value="1"/>
                    <label for="Punctuality1" title="text"></label>
                </div>
            </div>
            <div class="form-group mb-3 w-100 d-flex align-items-center">
                <label for="exampleFormControlFile2" class="mb-0">Services & Staff</label><br>
                <div class="rate ml-auto">
                    <input type="radio" id="Services5" name="Services" value="5"/>
                    <label for="Services5" title="text"></label>
                    <input type="radio" id="Services4" name="Services" value="4"/>
                    <label for="Services4" title="text"></label>
                    <input type="radio" id="Services3" name="Services" value="3"/>
                    <label for="Services3" title="text"></label>
                    <input type="radio" id="Services2" name="Services" value="2"/>
                    <label for="Services2" title="text"></label>
                    <input type="radio" id="Services1" name="Services" value="1"/>
                    <label for="Services1" title="text"></label>
                </div>
            </div>
            <div class="form-group mb-3 w-100 d-flex align-items-center">
                <label for="exampleFormControlFile3" class="mb-0">Bus Cleanliness</label><br>
                <div class="rate ml-auto">
                    <input type="radio" id="Cleanliness5" name="Cleanliness" value="5"/>
                    <label for="Cleanliness5" title="text"></label>
                    <input type="radio" id="Cleanliness4" name="Cleanliness" value="4"/>
                    <label for="Cleanliness4" title="text"></label>
                    <input type="radio" id="Cleanliness3" name="Cleanliness" value="3"/>
                    <label for="Cleanliness3" title="text"></label>
                    <input type="radio" id="Cleanliness2" name="Cleanliness" value="2"/>
                    <label for="Cleanliness2" title="text"></label>
                    <input type="radio" id="Cleanliness1" name="Cleanliness" value="1"/>
                    <label for="Cleanliness1" title="text"></label>
                </div>
            </div>
            <div class="form-group mb-3 w-100 d-flex align-items-center">
                <label for="exampleFormControlFile4" class="mb-0">Comfort</label><br>
                <div class="rate ml-auto">
                    <input type="radio" id="Comfort5" name="Comfort" value="5"/>
                    <label for="Comfort5" title="text"></label>
                    <input type="radio" id="Comfort4" name="Comfort" value="4"/>
                    <label for="Comfort4" title="text"></label>
                    <input type="radio" id="Comfort3" name="Comfort" value="3"/>
                    <label for="Comfort3" title="text"></label>
                    <input type="radio" id="Comfort2" name="Comfort" value="2"/>
                    <label for="Comfort2" title="text"></label>
                    <input type="radio" id="Comfort1" name="Comfort" value="1"/>
                    <label for="Comfort1" title="text"></label>
                </div>
            </div>
            <div class="form-group mb-5 w-100">
                <textarea class="form-control form-control-sm p-2 bg-textarea border rounded-1" id="validationTextarea"
                          placeholder="Customer Comment"></textarea>
            </div>
            <div class="submit-btn fixed-bottom m-3">
                <button class="btn btn-danger btn-block osahanbus-btn">SUBMIT FEEDBACK</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.feedback').on('submit', function (e) {
                e.preventDefault();

                var bookingId = '{{ $booking->id }}'; // This should be the booking ID of the current booking
                var busId = '{{ $booking->bookingDetails[0]->bus_id }}'; // This should be the bus ID of the current booking
                var punctuality = $('input[name="Punctuality"]:checked').val();
                var services = $('input[name="Services"]:checked').val();
                var cleanliness = $('input[name="Cleanliness"]:checked').val();
                var comfort = $('input[name="Comfort"]:checked').val();
                var comment = $('#validationTextarea').val();

                $.ajax({
                    url: '/review-store',  // Update this to your actual route
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        booking_id: bookingId,
                        bus_id: busId,
                        punctuality: punctuality,
                        services: services,
                        cleanliness: cleanliness,
                        comfort: comfort,
                        comment: comment
                    },
                    success: function (response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(function () {
                            window.location.href = '{{ route('my-tickets') }}';
                        });
                    }, error: function (xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: xhr.responseJSON.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });
        });
    </script>
@endpush
