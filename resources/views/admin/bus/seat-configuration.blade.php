@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Seat Config</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.bus.index')}}">List Bus</a></li>
                        <li class="breadcrumb-item active">Seat Config</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <form id="innerForm" action="{{route('admin.store-seat-configuration')}}" method="post"
                              class="needs-validation" novalidate>
                            @csrf
                            <input type="hidden" name="bus_id" value="{{$bus->id}}">
                            <div class="row row-cols-lg-auto g-3 align-items-center">
                                <div class="col-12">
                                    <label class="visually-hidden" for="inlineFormInputGroupUsername">Code
                                        Seat</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="code"
                                               id="inlineFormInputGroupUsername" placeholder="Code Seat" required>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-12">
                                    <label class="visually-hidden"
                                           for="inlineFormSelectPref">Status</label>
                                    <select class="form-select" name="status" data-choices
                                            data-choices-search-false required>
                                        <option value="">Select Status</option>
                                        <option value="available">Available</option>
                                        <option value="sold_out">Sold-Out</option>
                                    </select>
                                </div>
                                <!--end col-->
                                @if($bus->busAvailability[0]->available_seats > $seatConfigCount)
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                    {{--import excel--}}
                                    {{--                                    <input type="file" name="your_excel_file" id="your_excel_file" hidden required>--}}
                                    <label for="your_excel_file" class="btn btn-info" style="margin-bottom: 2px"><i
                                                class="ri-file-download-line align-bottom me-1"></i> Import Excel
                                    </label>
                                @else
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary" disabled>Submit</button>
                                    </div>
                                @endif
                            </div>
                            <!--end row-->
                        </form>
                        <form id="importForm" action="{{ route('admin.import-seat-config') }}" method="POST"
                              enctype="multipart/form-data" class="mt-4">
                            @csrf
                            <input type="file" name="your_excel_file" id="your_excel_file" accept=".xls,.xlsx" hidden
                                   required>
                        </form>
                    </div>
                    <!--divider-->
                    <hr class="mt-4">
                    <!-- Tables Seat Config -->
                    <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                        <thead>
                        <tr>
                            <th scope="col" style="width: 10px;">
                                <div class="form-check">
                                    <input class="form-check-input fs-15" type="checkbox" id="checkAll"
                                           value="option">
                                </div>
                            </th>
                            <th>SR No.</th>
                            <th>Bus Name</th>
                            <th>Code Seat</th>
                            <th data-ordering="false">Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($seatConfigs as $key => $seatConfig)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                               value="option1">
                                    </div>
                                </th>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$seatConfig->bus->bus_name}}</td>
                                <td>{{$seatConfig->code}}</td>
                                <td>
                                 <span class="badge {{ $seatConfig->status === 'available' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                    {{ $seatConfig->status === 'available' ? 'Available' : 'Sold-Out' }}
                                </span>
                                </td>
                                <td>
                                    <a href="#" data-bs-toggle="modal"
                                       data-bs-target="#changeStatusModal-{{$seatConfig->id}}"
                                       class="btn btn-primary btn-sm">Change Status</a>
                                    <a href="{{route('admin.delete-seat-config',$seatConfig->id)}}"
                                       class="btn btn-danger btn-sm delete">Delete</a>
                                </td>
                            </tr>
                            {{--modal change status--}}
                            <div class="modal fade" id="changeStatusModal-{{$seatConfig->id}}" tabindex="-1"
                                 role="dialog"
                                 aria-labelledby="changeStatusModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="changeStatusModalLabel">Change Status</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <select class="form-select" name="change-status" data-choices
                                                    data-choices-search-false required>
                                                <option value="">Select Status</option>
                                                <option @if($seatConfig->status === 'available') selected
                                                        @endif value="available">
                                                    Available
                                                </option>
                                                <option @if($seatConfig->status === 'sold_out') selected
                                                        @endif value="sold_out">
                                                    Sold-Out
                                                </option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" class="btn btn-primary save-status">Save changes
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        $(document).ready(function () {
            $('#your_excel_file').on('change', function (e) {
                e.preventDefault();

                // Check if a file is selected
                if ($('#your_excel_file').get(0).files.length === 0) {
                    Swal.fire('Error', 'Please select a file to import.', 'error');
                    return;
                }

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to import this file.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, import it!',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        var formData = new FormData($('#importForm')[0]);

                        $.ajax({
                            type: 'POST',
                            url: $('#importForm').attr('action'),
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                // Handle the response from the server
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    allowOutsideClick: false
                                }).then(() => {
                                    location.reload();
                                });
                                // Clear the file input
                                $('#your_excel_file').val('');
                            },
                            error: function (error) {
                                // Handle any errors
                                Swal.fire({
                                    title: 'Error',
                                    text: error.responseJSON.message,
                                    icon: 'error',
                                    allowOutsideClick: false
                                })
                            }
                        });
                    } else if (result.isDismissed) {
                        // Handle the cancel button click here
                        Swal.fire('Cancelled', 'Your file is safe :)', 'error');
                        // Clear the file input
                        $('#your_excel_file').val('');
                    }
                });
            });

            // Change status
            $('.save-status').on('click', function (e) {
                e.preventDefault();

                // Get the selected status
                var status = $(this).closest('.modal').find('select[name="change-status"]').val();
                var seatId = $(this).closest('.modal').attr('id').split('-')[1];

                // Check if a status is selected
                if (status === '') {
                    Swal.fire('Error', 'Please select a status.', 'error');
                    return;
                }

                // Close the modal
                $('#changeStatusModal').modal('hide');

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to change the status of this seat.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!',
                    allowOutsideClick: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Perform the AJAX request
                        $.ajax({
                            type: 'POST',
                            url: '{{ route('admin.change-seat-status') }}',
                            data: {
                                _token: '{{ csrf_token() }}',
                                seatId: seatId,
                                status: status
                            },
                            success: function (response) {
                                // Handle the response from the server
                                Swal.fire({
                                    title: 'Success',
                                    text: response.message,
                                    icon: 'success',
                                    allowOutsideClick: false
                                }).then(() => {
                                    location.reload();
                                });
                            },
                            error: function (error) {
                                // Handle any errors
                                Swal.fire({
                                    title: 'Error',
                                    text: error.responseJSON.message,
                                    icon: 'error',
                                    allowOutsideClick: false
                                })
                            }
                        });
                    } else if (result.isDismissed) {
                        // Handle the cancel button click here
                        Swal.fire('Cancelled', 'Your status is safe :)', 'error');
                    }
                });
            });

        });
    </script>
@endpush