@extends('adminlte::page')

@section('title', 'MBBS Content')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.css">
    <style>
        .modal .modal-dialog.modal-right {
            position: fixed;
            top: 0;
            right: 0;
            width: 800px;
            max-width: 100%;
            height: 100%;
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
            border-radius: 0;
            border: 0;
            height: 100%;
            overflow-y: auto;
        }
    </style>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="mt-4 mb-0">MBBS Content</h2>
            <button type="button" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;" data-toggle="modal" data-target="#mbbsModal">
                Add
            </button>
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
                    <table id="mbbs-table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>SI NO</th>
                                <th>State</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewMbbsModal" tabindex="-1" role="dialog" aria-labelledby="viewMbbsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="viewMbbsModalLabel">View MBBS Content</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 id="view-mbbs-state"></h4>
                    <p><strong>Banner Title:</strong> <span id="view-mbbs-banner-title"></span></p>
                    <p><strong>Banner Description:</strong> <span id="view-mbbs-banner-description"></span></p>
                    <p><strong>Preview Title:</strong> <span id="view-mbbs-preview-title"></span></p>
                    <p><strong>Preview Points:</strong> <span id="view-mbbs-preview-points"></span></p>
                    <p><strong>Meta Title:</strong> <span id="view-mbbs-meta-title"></span></p>
                    <p><strong>Meta Description:</strong> <span id="view-mbbs-meta-description"></span></p>
                    <p><strong>Meta Keywords:</strong> <span id="view-mbbs-meta-keywords"></span></p>
                    <hr>
                    <div id="view-mbbs-content"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mbbsModal" tabindex="-1" role="dialog" aria-labelledby="mbbsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="mbbsModalLabel">Add MBBS Content</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('mbbs.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="slug">Select State</label>
                            <select class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required>
                                <option value="">Select State</option>
                                @foreach ($states as $slug => $stateName)
                                    <option value="{{ $slug }}" {{ old('slug') === $slug ? 'selected' : '' }}>{{ $stateName }}</option>
                                @endforeach
                            </select>
                            @error('slug')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="banner_title">Banner Title</label>
                            <input type="text" class="form-control @error('banner_title') is-invalid @enderror" id="banner_title" name="banner_title" value="{{ old('banner_title') }}">
                            @error('banner_title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="banner_description">Banner Description</label>
                            <textarea class="form-control @error('banner_description') is-invalid @enderror" id="banner_description" name="banner_description" rows="3">{{ old('banner_description') }}</textarea>
                            @error('banner_description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="preview_title">Preview Title</label>
                            <input type="text" class="form-control @error('preview_title') is-invalid @enderror" id="preview_title" name="preview_title" value="{{ old('preview_title') }}">
                            @error('preview_title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="preview_points">Preview Points (one per line)</label>
                            <textarea class="form-control @error('preview_points') is-invalid @enderror" id="preview_points" name="preview_points" rows="5">{{ old('preview_points') }}</textarea>
                            @error('preview_points')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control summernote @error('content') is-invalid @enderror" id="content" name="content" rows="12">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                            @error('meta_title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">
                            @error('meta_keywords')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editMbbsModal" tabindex="-1" role="dialog" aria-labelledby="editMbbsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="editMbbsModalLabel">Edit MBBS Content</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editMbbsForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_state">State</label>
                            <input type="text" class="form-control" id="edit_state" name="state" disabled>
                        </div>

                        <div class="form-group">
                            <label for="edit_banner_title">Banner Title</label>
                            <input type="text" class="form-control" id="edit_banner_title" name="banner_title">
                        </div>

                        <div class="form-group">
                            <label for="edit_banner_description">Banner Description</label>
                            <textarea class="form-control" id="edit_banner_description" name="banner_description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_preview_title">Preview Title</label>
                            <input type="text" class="form-control" id="edit_preview_title" name="preview_title">
                        </div>

                        <div class="form-group">
                            <label for="edit_preview_points">Preview Points (one per line)</label>
                            <textarea class="form-control" id="edit_preview_points" name="preview_points" rows="5"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_content">Content</label>
                            <textarea class="form-control summernote" id="edit_content" name="content" rows="12"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="edit_meta_title" name="meta_title">
                        </div>

                        <div class="form-group">
                            <label for="edit_meta_description">Meta Description</label>
                            <textarea class="form-control" id="edit_meta_description" name="meta_description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control" id="edit_meta_keywords" name="meta_keywords">
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
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs4.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.alert-success').each(function () {
                var $alert = $(this);
                setTimeout(function () {
                    $alert.fadeOut('slow');
                }, 3000);
            });

            $('.summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['undo', 'redo']],
                ],
            });

            $('form').on('submit', function () {
                $(this).find('.summernote').each(function () {
                    $(this).summernote('sync');
                });
            });

            var table = $('#mbbs-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('mbbs.data') }}',
                columns: [
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'state' },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            $('#mbbs-table').on('click', '.btn-view', function () {
                var row = table.row($(this).closest('tr')).data();

                $('#view-mbbs-state').text(row.state);
                $('#view-mbbs-banner-title').text(row.banner_title || '');
                $('#view-mbbs-banner-description').text(row.banner_description || '');
                $('#view-mbbs-preview-title').text(row.preview_title || '');
                $('#view-mbbs-preview-points').text(row.preview_points || '');
                $('#view-mbbs-meta-title').text(row.meta_title || '');
                $('#view-mbbs-meta-description').text(row.meta_description || '');
                $('#view-mbbs-meta-keywords').text(row.meta_keywords || '');
                $('#view-mbbs-content').html(row.content || 'No content added yet.');

                $('#viewMbbsModal').modal('show');
            });

            $('#mbbs-table').on('click', '.btn-edit', function () {
                var mbbsId = $(this).data('id');

                $('#edit_state').val($(this).data('state'));
                $('#edit_banner_title').val($(this).data('banner-title') || '');
                $('#edit_banner_description').val($(this).data('banner-description') || '');
                $('#edit_preview_title').val($(this).data('preview-title') || '');
                $('#edit_preview_points').val($(this).data('preview-points') || '');
                $('#edit_content').summernote('code', $(this).data('content') || '');
                $('#edit_meta_title').val($(this).data('meta-title') || '');
                $('#edit_meta_description').val($(this).data('meta-description') || '');
                $('#edit_meta_keywords').val($(this).data('meta-keywords') || '');
                $('#editMbbsForm').attr('action', '/mbbs/' + mbbsId);

                $('#editMbbsModal').modal('show');
            });

            $('#mbbs-table').on('click', '.btn-delete', function () {
                var mbbsId = $(this).data('id');
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    alert('CSRF token not found.');
                    return;
                }

                if (!confirm('Are you sure you want to delete this MBBS content?')) {
                    return;
                }

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/mbbs/' + mbbsId;

                var tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_token';
                tokenInput.value = csrfToken;
                form.appendChild(tokenInput);

                var methodInput = document.createElement('input');
                methodInput.type = 'hidden';
                methodInput.name = '_method';
                methodInput.value = 'DELETE';
                form.appendChild(methodInput);

                document.body.appendChild(form);
                form.submit();
            });
        });
    </script>
@stop
