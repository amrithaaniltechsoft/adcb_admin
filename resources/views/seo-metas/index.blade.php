@extends('adminlte::page')

@section('title', 'SEO')

@section('css')
    <style>
        .modal .modal-dialog.modal-right {
            position: fixed;
            top: 0;
            right: 0;
            width: 400px;
            max-width: 100%;
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
            overflow-y: auto;
        }
    </style>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="mt-4 mb-0">SEO Meta List</h2>
            <button type="button" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;" data-toggle="modal" data-target="#seoMetaModal">
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
                    <table id="seo-metas-table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>SI NO</th>
                                <th>Page Name</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th>Meta Keywords</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewSeoMetaModal" tabindex="-1" role="dialog" aria-labelledby="viewSeoMetaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="viewSeoMetaModalLabel">View SEO Meta</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="view-seo-page-name"></h5>
                    <p><strong>Meta Title:</strong><br><span id="view-seo-meta-title"></span></p>
                    <p><strong>Meta Description:</strong><br><span id="view-seo-meta-description"></span></p>
                    <p><strong>Meta Keywords:</strong><br><span id="view-seo-meta-keywords"></span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="seoMetaModal" tabindex="-1" role="dialog" aria-labelledby="seoMetaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="seoMetaModalLabel">Add SEO Meta</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('seo-metas.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="page_name">Page Name</label>
                            <input type="text" class="form-control @error('page_name') is-invalid @enderror" id="page_name" name="page_name" value="{{ old('page_name') }}" placeholder="e.g. home, about, contact" required>
                            @error('page_name')
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
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="4">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <textarea class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" rows="3" placeholder="comma separated">{{ old('meta_keywords') }}</textarea>
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

    <div class="modal fade" id="editSeoMetaModal" tabindex="-1" role="dialog" aria-labelledby="editSeoMetaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="editSeoMetaModalLabel">Edit SEO Meta</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editSeoMetaForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_page_name">Page Name</label>
                            <input type="text" class="form-control" id="edit_page_name" name="page_name" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="edit_meta_title" name="meta_title">
                        </div>

                        <div class="form-group">
                            <label for="edit_meta_description">Meta Description</label>
                            <textarea class="form-control" id="edit_meta_description" name="meta_description" rows="4"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" id="edit_meta_keywords" name="meta_keywords" rows="3"></textarea>
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

            var table = $('#seo-metas-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '{{ route('seo-metas.data') }}',
                    cache: false,
                },
                columns: [
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'page_name' },
                    {
                        data: 'meta_title',
                        render: function (data) {
                            return data && data.length > 30 ? data.substring(0, 30) + '...' : data;
                        }
                    },
                    {
                        data: 'meta_description',
                        render: function (data) {
                            return data && data.length > 30 ? data.substring(0, 30) + '...' : data;
                        }
                    },
                    {
                        data: 'meta_keywords',
                        render: function (data) {
                            return data && data.length > 30 ? data.substring(0, 30) + '...' : data;
                        }
                    },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    table.ajax.reload(null, false);
                }
            });

            $('#seo-metas-table').on('click', '.btn-view', function () {
                var row = table.row($(this).closest('tr')).data();

                $('#view-seo-page-name').text(row.page_name);
                $('#view-seo-meta-title').text(row.meta_title);
                $('#view-seo-meta-description').text(row.meta_description);
                $('#view-seo-meta-keywords').text(row.meta_keywords);

                $('#viewSeoMetaModal').modal('show');
            });

            $('#seo-metas-table').on('click', '.btn-edit', function () {
                var seoMetaId = $(this).data('id');
                var row = table.row($(this).closest('tr')).data();

                $('#edit_page_name').val(row.page_name);
                $('#edit_meta_title').val(row.meta_title);
                $('#edit_meta_description').val(row.meta_description);
                $('#edit_meta_keywords').val(row.meta_keywords);
                $('#editSeoMetaForm').attr('action', '/seo-metas/' + seoMetaId);

                $('#editSeoMetaModal').modal('show');
            });

            $('#seo-metas-table').on('click', '.btn-delete', function () {
                var seoMetaId = $(this).data('id');
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    alert('CSRF token not found.');
                    return;
                }

                if (!confirm('Are you sure you want to delete this SEO meta?')) {
                    return;
                }

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/seo-metas/' + seoMetaId;

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
