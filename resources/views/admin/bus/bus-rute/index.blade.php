@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">List Bus-Rute</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bus</a></li>
                        <li class="breadcrumb-item active">List Bus-Rute</li>
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
                    <h5 class="card-title mb-0 flex-grow-1">List Bus-Rute</h5>
                    <div>
                        <a href="{{route('admin.bus-rute.create')}}" class="btn btn-success add-btn"
                           id="create-btn"><i
                                    class="ri-add-line align-bottom me-1"></i> Add Rute
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
                            <th>Origin</th>
                            <th>Destination</th>
                            <th data-ordering="false">Distance</th>
                            <th data-ordering="false">Duration</th>
                            <th data-ordering="false">Pickup Location</th>
                            <th data-ordering="false">Dropping Point</th>
                            <th data-ordering="false">Start Date</th>{{-- start operation time--}}
                            <th data-ordering="false">End Date</th>{{--end operation time--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listBusRoutes as $key => $listBusRute)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                               value="option1">
                                    </div>
                                </th>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$listBusRute->origin}}</td>
                                <td>{{$listBusRute->destination}}</td>
                                <td>{{$listBusRute->distance}} KM</td>
                                <td>{{$listBusRute->duration}} Hours</td>
                                <td>{{$listBusRute->pickupService->pickup_location}}</td>
                                <td>{{$listBusRute->pickupService->dropping_point}}</td>
                                <td>{{$listBusRute->start_date}}</td>
                                <td>{{$listBusRute->end_date}}</td>
                                <td>
                                    <a href="{{route('admin.bus-rute.edit', $listBusRute->id)}}"
                                       class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{route('admin.bus-rute.destroy', $listBusRute->id)}}"
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