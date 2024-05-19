@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">List Bus</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Bus</a></li>
                        <li class="breadcrumb-item active">List Bus</li>
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
                    <h5 class="card-title mb-0 flex-grow-1">List Bus</h5>
                    <div>
                        {{--                        <a href="{{route('admin.pickup-dropping.create')}}" class="btn btn-primary">Add New Pickup</a>--}}
                        <a href="{{route('admin.bus.create')}}" class="btn btn-success add-btn"
                           id="create-btn"><i
                                    class="ri-add-line align-bottom me-1"></i> Add new bus
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
                            <th>Bus Number</th>
                            <th>Bus Name</th>
                            <th data-ordering="false">Model</th>
                            <th data-ordering="false">Year</th>
                            <th data-ordering="false">Capacity</th>
                            <th data-ordering="false">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($listBuses as $key => $listbus)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                               value="option1">
                                    </div>
                                </th>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$listbus->bus_number}}</td>
                                <td>{{$listbus->bus_name}}</td>
                                <td>{{$listbus->busDetail->model}}</td>
                                <td>{{$listbus->busDetail->manufacturing_year}}</td>
                                <td>{{$listbus->capacity}}</td>
                                <td>{!! $listbus->status ? '<span class="badge bg-success-subtle text-success">Active</span>' : '<span class="badge bg-danger-subtle text-danger">Inactive</span>' !!}</td>
                                <td>
                                    <a href="{{route('admin.bus.edit', $listbus->id)}}"
                                       class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{route('admin.bus.show', $listbus->id)}}"
                                       class="btn btn-info btn-sm">Show</a>
                                    <a href="{{route('admin.bus.destroy', $listbus->id)}}"
                                       class="btn btn-danger btn-sm delete">Delete</a>
                                    {{--Gallery foto bus--}}
                                    <a href="{{route('admin.list-bus.gallery', $listbus->id)}}"
                                       class="btn btn-info btn-sm">Gallery</a>
                                    {{--Seat bus config--}}
                                    <a href="{{route('admin.seat-configuration', $listbus->id)}}"
                                       class="btn btn-secondary btn-sm">Seat Config</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@push('scripts')
    <script>
        $('#example').DataTable();
    </script>
@endpush