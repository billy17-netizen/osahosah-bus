@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">List Pickup-Dropping</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bus</a></li>
                        <li class="breadcrumb-item active">List Pickup-Dropping</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">List Pickup-Dropping</h5>
                    <div>
                        <a href="{{route('admin.pickup-dropping.create')}}" class="btn btn-success add-btn"
                           id="create-btn"><i
                                class="ri-add-line align-bottom me-1"></i> Add new pickup
                        </a>
                        <button type="button" class="btn btn-info"><i
                                class="ri-file-download-line align-bottom me-1"></i> Import
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll" value="option">
                                </div>
                            </th>
                            <th>SR No.</th>
                            <th>Pickup Location</th>
                            <th>Dropping Point</th>
                            <th data-ordering="false">Latlong</th>
                            <th data-ordering="false">Pickup Fee</th>
                            <th data-ordering="false">Pickup Time</th>
                            <th data-ordering="false">Dropping Time</th>
                            <th data-ordering="false">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pickupDroppings as $key => $pickupDropping)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                               value="option1">
                                    </div>
                                </th>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$pickupDropping->pickup_location}}</td>
                                <td>{{$pickupDropping->dropping_point}}</td>
                                <td>{{$pickupDropping->latlong}}</td>
                                <td>Rp {{number_format($pickupDropping->pickup_fee, 0, ',', '.')}}</td>
                                <td>{{Carbon\Carbon::parse($pickupDropping->pickup_time)->format('h:i A')}}</td>
                                <td>{{Carbon\Carbon::parse($pickupDropping->dropping_time)->format('h:i A')}}</td>
                                <td>{!! $pickupDropping->status ? '<span class="badge bg-success-subtle text-success">Active</span>' : '<span class="badge bg-danger-subtle text-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="{{route('admin.pickup-dropping.edit', $pickupDropping->id)}}"
                                       class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{route('admin.pickup-dropping.destroy', $pickupDropping->id)}}"
                                       class="btn btn-danger btn-sm delete">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--end col-->
    </div><!--end row-->
@endsection
