@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Edit Bus</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.bus.index')}}">List Bus</a></li>
                        <li class=" breadcrumb-item active">Edit Bus
                        </li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Edit Bus</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="live-preview">
                        <form action="{{route('admin.bus.update',$bus->id)}}" method="post" class="needs-validation"
                              novalidate
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Bus Number</label>
                                        <input type="text" name="bus_number" class="form-control"
                                               placeholder="Enter Bus Number" value="{{$bus->bus_number}}"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Capacity</label>
                                        <input type="number" name="capacity" class="form-control"
                                               placeholder="Enter Capacity" value="{{$bus->capacity}}"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Bus Name</label>
                                        <input type="text" name="bus_name" class="form-control"
                                               placeholder="Enter Bus name" value="{{$bus->bus_name}}"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Model</label>
                                        <input type="text" name="model" class="form-control"
                                               placeholder="Enter Model" value="{{$bus->busDetail->model}}"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Color</label>
                                        <input type="text" name="color" class="form-control"
                                               placeholder="Enter Color" value="{{$bus->busDetail->color}}"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Manufacturing Year</label>
                                        <input type="text" name="manufacturing_year" class="form-control"
                                               placeholder="Enter Manufacturing Year"
                                               value="{{$bus->busDetail->manufacturing_year}}"
                                               required>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Wifi</label>
                                        <select class="form-select" name="wifi" data-choices
                                                data-choices-search-false required>
                                            <option value="">Select Wifi</option>
                                            <option @selected($bus->busDetail->wifi === 1) value="1">Yes</option>
                                            <option @selected($bus->busDetail->wifi === 0) value="0">No</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Ac</label>
                                        <select class="form-select" name="ac" data-choices
                                                data-choices-search-false required>
                                            <option value="">Select Ac</option>
                                            <option @selected($bus->busDetail->ac === 1) value="1">Yes</option>
                                            <option @selected($bus->busDetail->ac === 0) value="0">No</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-select" name="status" data-choices
                                                data-choices-search-false required>
                                            <option value="">Select Status</option>
                                            <option @selected($bus->status === 1) value="1">Active</option>
                                            <option @selected($bus->status === 0) value="0">Inactive</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">Dinner</label>
                                        <select class="form-select" name="dinner" data-choices
                                                data-choices-search-false required>
                                            <option value="">Select Dinner</option>
                                            <option @selected($bus->busDetail->dinner === 1) value="1">Yes</option>
                                            <option @selected($bus->busDetail->dinner === 0) value="0">No</option>
                                        </select>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">About the Bus</label>
                                        <textarea class="form-control ckeditor-classic" name="about_the_bus" rows="3"
                                                  placeholder="Enter About the Bus"
                                                  required>{!! $bus->busDetail->about_the_bus !!}</textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Essentials</label>
                                        <textarea class="form-control ckeditor-classic" name="essentials" rows="3"
                                                  placeholder="Enter Essentials"
                                                  required>{!! $bus->busDetail->essentials !!}</textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Snacks</label>
                                        <textarea class="form-control ckeditor-classic" name="snacks" rows="3"
                                                  placeholder="Enter Snacks"
                                                  required>{!! $bus->busDetail->snacks !!}</textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Safety Features</label>
                                        <textarea class="form-control ckeditor-classic" name="safety_features" rows="3"
                                                  placeholder="Enter Safety Features"
                                                  required>{!! $bus->busDetail->safety_features !!}</textarea>
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Bus Image</label>
                                        <input type="file" name="image_url" class="form-control bus-image">
                                        <div class="valid-feedback">
                                            Looks good!
                                        </div>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <img src="{{asset('uploads/bus/'.$bus->image_url)}}" id="bus-image-preview"
                                             alt="Bus Image Preview"
                                             style="height:360px; width: 640px; object-fit: cover;"
                                             class="img-fluid">
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-lg-12">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    <!--end row-->
@endsection
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.bus-image').change(function () {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#bus-image-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush