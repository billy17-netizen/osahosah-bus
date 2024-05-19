@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Bus Details</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.bus.index')}}">List Bus</a></li>
                        <li class="breadcrumb-item active">Bus Details</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-xxl-4">
            <div class="card">
                <div class="card-body p-4">
                    <div>
                        <div class="flex-shrink-0 avatar-md mx-auto">
                            <div class="avatar-title bg-light rounded">
                                <img src="{{asset('uploads/bus/'.$bus->image_url)}}" alt="" height="50" width="51"/>
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <h5 class="mb-1">{{$bus->bus_name}}</h5>
                            <p class="text-muted">Manufacture Year {{$bus->busDetail->manufacturing_year}}</p>
                        </div>
                        <div class="table-responsive">
                            <table class="table mb-0 table-borderless">
                                <tbody>
                                <tr>
                                    <th><span class="fw-medium">Bus Number</span></th>
                                    <td>{{$bus->bus_number}}</td>
                                </tr>
                                <tr>
                                    <th><span class="fw-medium">Bus Name</span></th>
                                    <td>{{$bus->bus_name}}</td>
                                </tr>
                                <tr>
                                    <th><span class="fw-medium">Capacity</span></th>
                                    <td>{{$bus->capacity}} Penumpang</td>
                                </tr>
                                <tr>
                                    <th><span class="fw-medium">Model</span></th>
                                    <td>
                                        {{$bus->busDetail->model}}
                                    </td>
                                </tr>
                                <tr>
                                    <th><span class="fw-medium">Color</span></th>
                                    <td>{{$bus->busDetail->color}}</td>
                                </tr>
                                <tr>
                                    <th><span class="fw-medium">WIFI</span></th>
                                    <td>
                                        @if($bus->busDetail->wifi)
                                            <span class="badge bg-success-subtle text-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th><span class="fw-medium">AC</span></th>
                                    <td>
                                        @if($bus->busDetail->ac)
                                            <span class="badge bg-success-subtle text-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th><span class="fw-medium">Dinner</span></th>
                                    <td>
                                        @if($bus->busDetail->dinner)
                                            <span class="badge bg-success-subtle text-success">Yes</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">No</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th><span class="fw-medium">Status</span></th>
                                    <td>
                                        @if($bus->status)
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->

        <div class="col-xxl-8">
            <div class="card">
                <div class="card-body p-4">
                    <h6 class="fw-semibold text-uppercase mb-3">About the Bus</h6>
                    <p class="text-muted">{!! $bus->busDetail->about_the_bus !!}</p>
                    <h6 class="fw-semibold text-uppercase mb-3">Essentials</h6>
                    <p class="text-muted">{!! $bus->busDetail->essentials !!}</p>
                    <h6 class="fw-semibold text-uppercase mb-3">Snacks</h6>
                    <p class="text-muted">{!! $bus->busDetail->snacks !!}</p>
                    <h6 class="fw-semibold text-uppercase mb-3">Safety Features</h6>
                    <p class="text-muted">{!! $bus->busDetail->safety_features !!}</p>
                    {{--Image Galery Bus--}}
                    <h6 class="fw-semibold text-uppercase mb-2">Gallery Bus</h6>
                    <div class="row">
                        @forelse($bus->galleryBus as $gallery)
                            <div class="col-lg-3">
                                <div class="mt-3">
                                    <img src="{{asset('uploads/bus/gallery/'.$gallery->file_path)}}" alt=""
                                         class="img-fluid rounded">
                                </div>
                            </div>
                        @empty
                            <div class="col-lg-12">
                                <div class="mt-2">
                                    <p class="text-muted">No Image Gallery</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
                <!--end card-body-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
    <!--end row-->

@endsection