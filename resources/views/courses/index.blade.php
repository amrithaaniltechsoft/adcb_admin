@extends('adminlte::page')

@section('title', 'Courses')

@section('css')
    <style>
        .modal .modal-dialog.modal-right {
            position: fixed;
            top: 0;
            right: 0;
            width: 400px;
            max-width: 100%;
            height: 100%;
            max-height: 100%;
            margin: 0;
            transform: translate(100%, 0);
            -webkit-transition: transform 0.3s ease-out;
            -moz-transition: transform 0.3s ease-out;
            transition: transform 0.3s ease-out;
        }
        .modal.show .modal-dialog.modal-right {
            transform: translate(0, 0);
        }
        .modal .modal-dialog.modal-right .modal-content {
            height: 100%;
            border-radius: 0;
            border: 0;
            overflow-y: auto;
        }
    </style>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="mt-4 mb-0">Course List</h2>
        </div>
    </div>

    @if (session('status'))
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive">
                    <table id="courses-table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>SI NO</th>
                                <th>Course Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewCourseModal" tabindex="-1" role="dialog" aria-labelledby="viewCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="viewCourseModalLabel">View Course</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="font-weight-bold mb-4" id="view-course-name"></h4>

                    <div class="form-group mb-3">
                        <label class="text-muted mb-0">Code</label>
                        <p class="mb-0 font-weight-semibold" id="view-course-code"></p>
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-muted mb-0">Title</label>
                        <p class="mb-0 font-weight-semibold" id="view-course-title"></p>
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-muted mb-0">Description</label>
                        <p class="mb-0 font-weight-semibold" id="view-course-description"></p>
                    </div>

                    <div class="form-group mb-3" id="view-course-image-wrap" style="display:none;">
                        <label class="text-muted mb-1">Image</label>
                        <div>
                            <img id="view-course-image" class="img-fluid border" style="max-height: 200px;" />
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-muted mb-0">Link</label>
                        <p class="mb-0 font-weight-semibold" id="view-course-href"></p>
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-muted mb-0">Sort Order</label>
                        <p class="mb-0 font-weight-semibold" id="view-course-sort-order"></p>
                    </div>

                    <div class="form-group mb-0">
                        <label class="text-muted mb-0">Featured on Homepage</label>
                        <p class="mb-0 font-weight-semibold" id="view-course-featured"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editCourseModal" tabindex="-1" role="dialog" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editCourseForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_name">Course Name</label>
                            <input type="text" class="form-control" id="edit_name" name="name" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_code">Code</label>
                            <input type="text" class="form-control" id="edit_code" name="code">
                        </div>

                        <div class="form-group">
                            <label for="edit_title">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title">
                        </div>

                        <div class="form-group">
                            <label for="edit_description">Description</label>
                            <textarea class="form-control" id="edit_description" name="description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="edit_image" name="image">
                                <label class="custom-file-label" for="edit_image">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group" id="edit_current_image_wrap" style="display:none;">
                            <label>Current Image</label>
                            <div>
                                <img id="edit_current_image" class="img-fluid" style="max-height: 200px;" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_href">Link</label>
                            <input type="text" class="form-control" id="edit_href" name="href" placeholder="/mbbs">
                        </div>

                        <div class="form-group">
                            <label for="edit_sort_order">Sort Order</label>
                            <input type="number" class="form-control" id="edit_sort_order" name="sort_order">
                        </div>

                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="edit_featured" name="featured" value="1">
                                <label class="form-check-label" for="edit_featured">Featured on Homepage</label>
                            </div>
                        </div>

                        <div id="dnbContentFields" style="display:none;">
                            <hr>
                            <h5>DNB Content</h5>
                            <div class="form-group">
                                <label for="edit_dnb_banner_title">Banner Title</label>
                                <input type="text" class="form-control" id="edit_dnb_banner_title" name="banner_title">
                            </div>

                            <div class="form-group">
                                <label for="edit_dnb_banner_description">Banner Description</label>
                                <textarea class="form-control" id="edit_dnb_banner_description" name="banner_description" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="edit_dnb_intro_title">Intro Heading</label>
                                <input type="text" class="form-control" id="edit_dnb_intro_title" name="intro_title">
                            </div>

                            <div class="form-group">
                                <label for="edit_dnb_intro_description">Intro Description</label>
                                <textarea class="form-control" id="edit_dnb_intro_description" name="intro_description" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="edit_dnb_specialties">Specialties (one per line)</label>
                                <textarea class="form-control" id="edit_dnb_specialties" name="specialties" rows="15"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="edit_dnb_meta_title">Meta Title</label>
                                <input type="text" class="form-control" id="edit_dnb_meta_title" name="meta_title">
                            </div>

                            <div class="form-group">
                                <label for="edit_dnb_meta_description">Meta Description</label>
                                <textarea class="form-control" id="edit_dnb_meta_description" name="meta_description" rows="3"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="edit_dnb_meta_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" id="edit_dnb_meta_keywords" name="meta_keywords">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@stop

@section('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var routeDnbIndex = '{{ route('dnb.index') }}';

            $('.alert-success').each(function () {
                var $alert = $(this);
                setTimeout(function () {
                    $alert.fadeOut('slow');
                }, 3000);
            });

            $('.custom-file-input').on('change', function () {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass('selected').html(fileName);
            });

            var table = $('#courses-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('courses.data') }}',
                columns: [
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    {
                        data: 'name',
                        render: function (data, type, row) {
                            if (row.has_dnb_data === 'YES') {
                                return '<a href="' + routeDnbIndex + '">' + data + '</a>';
                            }
                            return data;
                        }
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            $('#courses-table').on('click', '.btn-view', function () {
                var $btn = $(this);

                $('#view-course-name').text($btn.data('name') || '');
                $('#view-course-code').text($btn.data('code') || '');
                $('#view-course-title').text($btn.data('title') || '');
                $('#view-course-description').text($btn.data('description') || '');
                $('#view-course-href').text($btn.data('href') || '');
                $('#view-course-sort-order').text($btn.data('sort-order') || '');
                $('#view-course-featured').text($btn.data('featured') === '1' ? 'Yes' : 'No');

                var image = $btn.data('image');
                if (image) {
                    $('#view-course-image').attr('src', image);
                    $('#view-course-image-wrap').show();
                } else {
                    $('#view-course-image').removeAttr('src');
                    $('#view-course-image-wrap').hide();
                }

                $('#viewCourseModal').modal('show');
            });

            $('#courses-table').on('click', '.btn-edit', function () {
                var courseId = $(this).data('id');
                var courseName = $(this).data('name');

                $('#edit_name').val(courseName);
                $('#editCourseForm').attr('action', '/courses/' + courseId);

                $('#edit_code').val($(this).data('code') || '');
                $('#edit_title').val($(this).data('title') || '');
                $('#edit_description').val($(this).data('description') || '');
                $('#edit_image').val('').next('.custom-file-label').removeClass('selected').html('Choose file');
                var currentImage = $(this).data('image');
                if (currentImage) {
                    $('#edit_current_image').attr('src', currentImage);
                    $('#edit_current_image_wrap').show();
                } else {
                    $('#edit_current_image').removeAttr('src');
                    $('#edit_current_image_wrap').hide();
                }
                $('#edit_href').val($(this).data('href') || '');
                $('#edit_sort_order').val($(this).data('sort-order') || '');
                $('#edit_featured').prop('checked', String($(this).data('featured')) === '1');

                var isDnb = courseName === 'DNB';
                $('#dnbContentFields').toggle(isDnb);

                if (isDnb) {
                    $('#edit_dnb_banner_title').val($(this).data('dnb-banner-title') || '');
                    $('#edit_dnb_banner_description').val($(this).data('dnb-banner-description') || '');
                    $('#edit_dnb_intro_title').val($(this).data('dnb-intro-title') || '');
                    $('#edit_dnb_intro_description').val($(this).data('dnb-intro-description') || '');
                    $('#edit_dnb_specialties').val($(this).data('dnb-specialties') || '');
                    $('#edit_dnb_meta_title').val($(this).data('dnb-meta-title') || '');
                    $('#edit_dnb_meta_description').val($(this).data('dnb-meta-description') || '');
                    $('#edit_dnb_meta_keywords').val($(this).data('dnb-meta-keywords') || '');
                }

                $('#editCourseModal').modal('show');
            });
        });
    </script>
@stop
