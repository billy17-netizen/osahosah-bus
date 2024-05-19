@extends('frontend.layouts.master')

@section('content')
    <div class="osahan-profile">
        <div class="osahan-header-nav shadow-sm bg-danger p-3 d-flex align-items-center">
            <h5 class="font-weight-normal mb-0 text-white">
                <a class="text-danger mr-3" href="{{route('home')}}"><i class="icofont-rounded-left"></i></a>
                My Profile
            </h5>
        </div>
        <!-- Profile -->
        <div class="px-3 pt-3 pb-5">
            <form action="{{route('profiles.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="d-flex justify-content-center rounded-2 mb-4">
                    <div class="form-profile w-100">
                        <div class="text-center mb-3 position-relative">
                            <div class="position-absolute edit-bt">
                                <label for="upload-photo" class="mb-0"><span
                                        class="icofont-pencil-alt-5 text-white"></span></label>
                                <input type="file" name="profile-photo" id="upload-photo" alt="image" class="d-none">
                            </div>
                            <img src="{{auth()->user()->avatar}}" class="rounded-pill"
                                 style="width: 70px; height: 70px;"
                                 alt="image">
                        </div>
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">User Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Enter User Name"
                                   value="{{auth()->user()->name}}">
                        </div>
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">Mobile Number</label>
                            <input type="number" class="form-control" name="mobile_number"
                                   placeholder="Enter Mobile Number"
                                   value="{{auth()->user()->mobile_number}}">
                        </div>
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">Your Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter Your Email"
                                   value="{{auth()->user()->email}}">
                        </div>
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">City</label>
                            <input type="text" class="form-control" name="city" placeholder="Enter City"
                                   value="{{auth()->user()->city}}">
                        </div>
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">State</label>
                            <input type="text" class="form-control" name="state" placeholder="Enter State"
                                   value="{{auth()->user()->state}}">
                        </div>
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">Address</label>
                            <textarea class="form-control" name="address"
                                      placeholder="Enter Address">{!! auth()->user()->address !!}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">Life Insurance</label>
                            <div class="mt-1">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="yes" value="1" name="life_insuranse"
                                           class="custom-control-input"
                                        {{ auth()->user()->life_insuranse == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label small" for="yes">Yes</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="no" value="0" name="life_insuranse"
                                           class="custom-control-input"
                                        {{ auth()->user()->life_insuranse == 0 ? 'checked' : '' }}>
                                    <label class="custom-control-label small" for="no">No</label>
                                </div>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-danger btn-block osahanbus-btn rounded-1 loading">
                                UPDATE
                                PROFILE
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="mb-5">
                <a href="{{ route('logout') }}" class="btn btn-logout btn-block osahanbus-btn rounded-1 loading"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    LOGOUT
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#upload-photo').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('.form-profile img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            $('.loading').click(function () {
                $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> LOADING...');
                $(this).attr('disabled', true);
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush
