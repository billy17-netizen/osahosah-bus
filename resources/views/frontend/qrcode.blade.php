@extends('frontend.layouts.master')

@section('content')
    <div class="ticket padding-bt">
        <div class="osahan-header-nav shadow-sm p-3 d-flex align-items-center bg-danger">
            <h5 class="font-weight-normal mb-0 text-white">
                <a class="text-danger mr-3" href="{{route('your-ticket',$bookingDetails->booking_id)}}"><i
                        class="icofont-rounded-left"></i></a>
                Your Qr Code
            </h5>
        </div>
        <div class="your-ticket p-3">
            <div class="bg-white border border-warning rounded-1 shadow-sm p-3 mb-3">
                <div class="card-body">
                    <div class="text-center">
                        <img src="data:image/png;base64,{{ $qrCodeString }}" alt="qr-code"/>
                        {{--a href to scan a ticket simulation--}}
                        <a href="{{route('board',$bookingDetails->ticket_number)}}"
                           class="btn btn-danger mt-3 loading-scan">Scan
                            Ticket</a>
                    </div>
                </div>
            </div>
            <p class="mb-2 l-hght-18 font-weight-bold">Info.</p>
            {{--Instructions--}}
            <div class="bg-white border border-warning rounded-1 shadow-sm p-3 mb-3">
                <div class="card-body">
                    <strong class="mb-2 l-hght-18">Please scan this QR code at the bus station to confirm your boarding.
                        Ensure your device's brightness is high enough for the scanner to read the code.</strong>
                </div>
            </div>
        </div>
    </div>
    <style>
        @keyframes fadeOut {
            from {
                opacity: 1;
            }
            to {
                opacity: 0.5;
            }
        }

        .disabled {
            animation: fadeOut 1s infinite alternate;
        }
    </style>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.loading-scan').click(function (event) {
                var href = $(this).attr('href'); // get the href attribute
                console.log('Scanning...');
                $(this).html('<i class="fa fa-spinner fa-spin"></i> Scanning...');
                $(this).off('click'); // remove the click event handler
                $(this).addClass('disabled'); // add the disabled class

                setTimeout(function () {
                    window.location.href = href; // navigate to the URL after a delay
                }, 2000); // delay in milliseconds

                return false; // prevent the default action
            });
        });
    </script>
@endpush
