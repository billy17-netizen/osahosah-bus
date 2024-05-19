@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Gallery Bus</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{route('admin.bus.index')}}">List Bus</a></li>
                        <li class="breadcrumb-item active">Gallery Bus</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row mt-2">
        <div class="col-lg-12">

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Multiple File Upload for Gallery Bus</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <p class="text-muted">You can upload multiple files by selecting them below or by
                                dragging and dropping images onto the dashed region</p>
                            <input type="file" class="filepond filepond-input-multiple" multiple name="filepond"
                                   data-allow-reorder="true" data-max-file-size="3MB" data-max-files="20">
                            <div class="row mt-3">
                                @foreach($uploadedImages as $uploadedImage)
                                    <div class="col-lg-2">
                                        <div class="mt-3">
                                            <img src="{{ route('admin.show.gallery', ['path' => $uploadedImage->file_path]) }}"
                                                 class="img-fluid img-thumbnail" alt="gallery">
                                            {{--delete--}}
                                            <a href="javascript:void(0)"
                                               class="text-danger delete-gallery"
                                               data-id="{{ $uploadedImage->id }}"
                                               data-url="{{ route('admin.delete.gallery-bus', ['id' => $uploadedImage->id]) }}">
                                                <i class="ri-delete-bin-line"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection
@push('scripts')
    <script>
        var previewTemplate,
            inputMultipleElements;
        var busId = "{{ $bus->id }}"
        var imageId = "{{$bus->galleryBus->pluck('id')->implode(',')}}"

        FilePond.registerPlugin(
            FilePondPluginFileEncode,
            FilePondPluginFileValidateSize,
            FilePondPluginImageExifOrientation,
            FilePondPluginImagePreview,
        );
        FilePond.setOptions({
                server: {
                    process: {
                        url: '/admin/upload/gallery-bus',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}' // Laravel's CSRF token
                        },
                        ondata: (formData) => {
                            formData.append('bus_id', busId);
                            return formData;
                        },
                    },
                    revert: (uniqueFileId, load, error, progress, abort, headers, file) => {
                        var imageId = uniqueFileId;
                        // Do whatever you need to do to revert the file upload
                        $.ajax({
                            url: '/admin/delete/gallery-bus/' + imageId,
                            type: 'DELETE',
                            data: {
                                _token: '{{ csrf_token() }}',
                                id: imageId
                            },
                            success: function (response) {
                                console.log(response);
                                load();
                            },
                            error: function (error) {
                                console.log(error);
                            }
                        });
                    },
                },
                onprocessfiles: function (error, file) {
                    if (!error) {
                        location.reload();
                    }
                },
                allowReorder: true,
                maxFiles: 20,
                maxFileSize: '3MB',
                allowMultiple: true,
                allowImagePreview: true,
                imagePreviewHeight: 100,
                imagePreviewWidth: 100,
                imageCropAspectRatio: '1:1',
                imageResizeTargetWidth: 100,
                imageResizeTargetHeight: 100,
                imageResizeMode: 'contain',
                imageTransformOutputMimeType: 'image/jpeg',
                imageTransformOutputQuality: 50,
                imageTransformOutputQualityMode: 'always',
            },
        );


        inputMultipleElements = document.querySelectorAll("input.filepond-input-multiple");

        if (inputMultipleElements) {
            Array.from(inputMultipleElements).forEach(function (e) {
                FilePond.create(e);
            });
        }

        $(document).on('click', '.delete-gallery', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var url = $(this).data('url');
            var $this = $(this);

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}',
                            id: id
                        },
                        success: function (response) {
                            console.log(response);
                            $this.parent().remove();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        },
                        error: function (error) {
                            console.log(error);
                            Swal.fire(
                                'Error!',
                                'There was an error deleting your file.',
                                'error'
                            )
                        }
                    });
                }
            })
        });
    </script>
@endpush