@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">List Rating Bus</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Rating Bus</a></li>
                        <li class="breadcrumb-item active">List Rating Bus</li>
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
                    <h5 class="card-title mb-0 flex-grow-1">List Rating Bus</h5>
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
                            <th>User Name</th>
                            <th>No Booking</th>
                            <th>Bus</th>
                            <th>Punctuality</th>
                            <th>Services Staff</th>
                            <th>Cleanliness</th>
                            <th>Comfort</th>
                            <th>Comment</th>
                            <th>Is-Approved</th>
                            <th data-ordering="false">Approved At</th>
                            <th data-ordering="false">Rejected At</th>
                            <th data-ordering="false">Rejected Reason</th>
                            <th data-ordering="false">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reviews as $key => $review)
                            <tr>
                                <th scope="row">
                                    <div class="form-check">
                                        <input class="form-check-input fs-15" type="checkbox" name="checkAll"
                                               value="option1">
                                    </div>
                                </th>
                                <td>{{ $key + 1 }}</td>
                                <td>{{$review->user->name}}</td>
                                <td>{{$review->booking->id}}</td>
                                <td>{{$review->bus->bus_name}}</td>
                                <td>{{$review->punctuality_rating}}</td>
                                <td>{{$review->services_staff_rating}}</td>
                                <td>{{$review->cleanliness_rating}}</td>
                                <td>{{$review->comfort_rating}}</td>
                                <td>{{$review->comment}}</td>
                                <td>
                                    @if($review->is_approved == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($review->is_approved == 2)
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>
                                <td>
                                    @if($review->approved_at)
                                        {{Carbon\Carbon::parse($review->approved_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s A')}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($review->rejected_at)
                                        {{Carbon\Carbon::parse($review->rejected_at)->timezone('Asia/Jakarta')->format('Y-m-d H:i:s A')}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($review->rejected_reason != null)
                                        {{$review->rejected_reason}}
                                    @else
                                        {{--call a modal for input text and date for input a rejected at--}}
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    @if($review->is_approved == 2)
                                        <a href="#" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                           data-bs-target="#rejectModal" data-id="{{$review->id}}">
                                            Reject
                                        </a>
                                        <a href="{{route('admin.rating.approved.rating', $review->id)}}"
                                           class="btn btn-info btn-sm">Approve</a>
                                    @endif
                                    <a href="{{route('admin.rating.destroy', $review->id)}}"
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
    <div class="modal fade" id="rejectModal" tabindex="-1" aria-labelledby="rejectModal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyingcontentModalLabel">Reject Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.rating.rejected.rating')}}" method="POST" class="needs-validation"
                          novalidate>
                        @csrf
                        <input type="hidden" name="review_id">
                        <div class="mb-3">
                            <label for="rejected_at">Rejected At</label>
                            <input type="text" name="rejected_at" id="my-input"
                                   class="form-control flatpickr-input active"
                                   data-provider="flatpickr"
                                   placeholder="Enter Rejected At " data-time-basic="true"
                                   data-date-format="Y-m-d" data-enable-time="true"
                                   data-time_24hr="true" value="{{Carbon\Carbon::now()->format('Y-m-d H:i:s')}}"
                                   readonly required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="rejected_reason">Rejected Reason</label>
                            <textarea class="form-control" id="rejected_reason"
                                      name="rejected_reason" rows="4"
                                      required></textarea>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">
                                Back
                            </button>
                            <button type="submit" class="btn btn-primary save-rejected">Save
                                Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $('#rejectModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var id = button.data('id'); // Extract info from data-* attributes

            // Update the modal's content.
            var modal = $(this);
            modal.find('.modal-body input[name="review_id"]').val(id);
        });
    </script>
@endpush
