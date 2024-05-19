@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">List Bus Availability</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bus</a></li>
                        <li class="breadcrumb-item active">List Bus Availability</li>
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
                    <h5 class="card-title mb-0 flex-grow-1">List Bus Availability</h5>
                    <div>
                        <a href="{{route('admin.bus-availability.create')}}" class="btn btn-success add-btn"
                           id="create-btn"><i
                                    class="ri-add-line align-bottom me-1"></i> Add Bus Availability
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
                            <th>Bus Number</th>
                            <th>Bus Name</th>
                            <th data-ordering="false">Travel Date</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($availabilityBuses as $key => $availabilityBus)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                               value="option1">
                                    </div>
                                </th>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$availabilityBus->busRoute->origin}}</td>
                                <td>{{$availabilityBus->busRoute->destination}}</td>
                                <td>{{$availabilityBus->bus->bus_number}}</td>
                                <td>{{$availabilityBus->bus->bus_name}}</td>
                                <td>{{Carbon\Carbon::parse($availabilityBus->travel_date)->format('Y-m-d h:i A')}}</td>
                                <td>
                                    <a href="{{route('admin.bus-availability.edit', $availabilityBus->id)}}"
                                       class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{route('admin.bus-availability.destroy', $availabilityBus->id)}}"
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