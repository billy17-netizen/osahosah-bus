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
            <div class="text-center mb-3 position-relative">
                <div class="position-absolute edit-bt">
                    <label for="upload-photo" class="mb-0"><span
                            class="icofont-pencil-alt-5 text-white"></span></label>
                    <input type="file" name="profile-photo" id="upload-photo" alt="image"
                           class="d-none">
                </div>
                <img src="{{auth()->user()->avatar}}" class="rounded-pill"
                     style="width: 70px; height: 70px;"
                     alt="image">
            </div>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                       aria-controls="profile" aria-selected="true">Update Profile</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="password-tab" data-toggle="tab" href="#password" role="tab"
                       aria-controls="password" aria-selected="false">Change Password</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <!-- Your profile update form goes here -->
                    <form action="{{route('profiles.update')}}" method="post" enctype="multipart/form-data"
                          class="mt-3">
                        @csrf
                        @method('PUT')
                        <div class="d-flex justify-content-center rounded-2 mb-4">
                            <div class="form-profile w-100">
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
                                    <button type="submit"
                                            class="btn btn-danger btn-block osahanbus-btn rounded-1 loading">
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
                <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                    <!-- Your password change form goes here -->
                    <form action="{{route('change-password')}}" method="post" class="mt-3">
                        @csrf
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">Old Password</label>
                            <input type="password" name="current_password" class="form-control"
                                   placeholder="Enter Your Password"
                            >
                        </div>
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">New Password</label>
                            <input type="password" name="new_password" class="form-control"
                                   placeholder="Enter Your Password"
                            >
                        </div>
                        <div class="form-group">
                            <label class="text-muted f-10 mb-1">Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control"
                                   placeholder="Enter Your Password"
                            >
                        </div>
                        <button type="submit" class="btn btn-danger btn-block osahanbus-btn rounded-1 mt-4">
                            CHANGE PASSWORD
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('#upload-photo').change(function () {
                // Get the selected file
                let file = $(this)[0].files[0];
                // Create a new FormData object
                let formData = new FormData();
                // Append the file to the FormData object
                formData.append('profile-photo', file);
                formData.append('_token', '{{ csrf_token() }}');
                // Send the request to the server
                $.ajax({
                    url: '{{route('profile.update-avatar')}}',
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (response) {
                        toastr.success(response.message);
                        setTimeout(function () {
                            location.reload();
                        }, 100);
                    },
                    error: function (response) {
                        let errors = response.responseJSON.message;
                        for (let key in errors) {
                            toastr.error(errors[key][0]);
                        }
                    }
                });
            });
            $('.loading').click(function () {
                $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> LOADING...');
                $(this).attr('disabled', true);
                $(this).closest('form').submit();
            });
        });
    </script>
@endpush
