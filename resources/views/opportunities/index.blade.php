@extends('adminlte::page')

@section('title', 'Opportunities')

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
            <h2 class="mt-4 mb-0">Opportunity List</h2>
            <button type="button" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;" data-toggle="modal" data-target="#opportunityModal">
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
                    <table id="opportunities-table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>SI NO</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Flag</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewOpportunityModal" tabindex="-1" role="dialog" aria-labelledby="viewOpportunityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="viewOpportunityModalLabel">View Opportunity</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 id="view-opportunity-title"></h4>
                    <div id="view-opportunity-image" class="mb-3"></div>
                    <p id="view-opportunity-description"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="opportunityModal" tabindex="-1" role="dialog" aria-labelledby="opportunityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="opportunityModalLabel">Add Opportunity</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('opportunities.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="e.g. United Kingdom" required>
                            @error('title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description <small class="text-muted">(one highlight per line)</small></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image" required>
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                            @error('image')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="flag">Flag</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('flag') is-invalid @enderror" id="flag" name="flag">
                                <label class="custom-file-label" for="flag">Choose file</label>
                            </div>
                            @error('flag')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
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

    <div class="modal fade" id="editOpportunityModal" tabindex="-1" role="dialog" aria-labelledby="editOpportunityModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="editOpportunityModalLabel">Edit Opportunity</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editOpportunityForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_title">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_description">Description <small class="text-muted">(one highlight per line)</small></label>
                            <textarea class="form-control" id="edit_description" name="description" rows="5" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="edit_image" name="image">
                                <label class="custom-file-label" for="edit_image">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group" id="edit_current_image_wrap">
                            <label>Current Image</label>
                            <div>
                                <img id="edit_current_image" class="img-fluid" style="max-height: 200px;" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="edit_flag">Flag</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="edit_flag" name="flag">
                                <label class="custom-file-label" for="edit_flag">Choose file</label>
                            </div>
                        </div>

                        <div class="form-group" id="edit_current_flag_wrap">
                            <label>Current Flag</label>
                            <div>
                                <img id="edit_current_flag" class="img-fluid" style="max-height: 100px;" />
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

            var table = $('#opportunities-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('opportunities.data') }}',
                columns: [
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'title' },
                    { data: 'description' },
                    {
                        data: 'image_url',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            if (!data) {
                                return '&mdash;';
                            }
                            return '<img src="' + data + '" class="img-fluid" style="width: 50px; height: 50px; object-fit: cover;" />';
                        }
                    },
                    {
                        data: 'flag_url',
                        orderable: false,
                        searchable: false,
                        render: function (data) {
                            if (!data) {
                                return '&mdash;';
                            }
                            return '<img src="' + data + '" class="img-fluid" style="width: 50px; height: 35px; object-fit: cover;" />';
                        }
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            $('#opportunities-table').on('click', '.btn-view', function () {
                var row = table.row($(this).closest('tr')).data();

                $('#view-opportunity-title').text(row.title);
                $('#view-opportunity-description').text(row.description);

                if (row.image_url) {
                    $('#view-opportunity-image').html('<img src="' + row.image_url + '" class="img-fluid" style="max-height: 300px;" />');
                } else {
                    $('#view-opportunity-image').html('');
                }

                $('#viewOpportunityModal').modal('show');
            });

            $('#opportunities-table').on('click', '.btn-edit', function () {
                var opportunityId = $(this).data('id');

                $('#edit_title').val($(this).data('title'));
                $('#edit_description').val($(this).data('description'));
                $('#editOpportunityForm').attr('action', '/opportunities/' + opportunityId);
                $('#edit_image').val('').next('.custom-file-label').removeClass('selected').html('Choose file');
                $('#edit_flag').val('').next('.custom-file-label').removeClass('selected').html('Choose file');

                var currentImage = $(this).data('image');
                if (currentImage) {
                    $('#edit_current_image').attr('src', currentImage);
                    $('#edit_current_image_wrap').show();
                    $('#edit_image').removeAttr('required');
                } else {
                    $('#edit_current_image').removeAttr('src');
                    $('#edit_current_image_wrap').hide();
                    $('#edit_image').attr('required', 'required');
                }

                var currentFlag = $(this).data('flag');
                if (currentFlag) {
                    $('#edit_current_flag').attr('src', currentFlag);
                    $('#edit_current_flag_wrap').show();
                } else {
                    $('#edit_current_flag').removeAttr('src');
                    $('#edit_current_flag_wrap').hide();
                }

                $('#editOpportunityModal').modal('show');
            });

            $('#opportunities-table').on('click', '.btn-delete', function () {
                var opportunityId = $(this).data('id');
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    alert('CSRF token not found.');
                    return;
                }

                if (!confirm('Are you sure you want to delete this opportunity?')) {
                    return;
                }

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/opportunities/' + opportunityId;

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
