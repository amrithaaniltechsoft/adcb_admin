@extends('adminlte::page')

@section('title', 'MD/MS Content')

@section('css')
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
        .section-card {
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
        }
    </style>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="mt-4 mb-0">MD/MS Content</h2>
            <button type="button" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;" data-toggle="modal" data-target="#mdmsModal">
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
                    <table id="mdms-table" class="table table-bordered table-striped" style="width:100%">
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

    <div class="modal fade" id="viewMdmsModal" tabindex="-1" role="dialog" aria-labelledby="viewMdmsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="viewMdmsModalLabel">View MD/MS Content</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 id="view-mdms-state"></h4>
                    <p><strong>Banner Title:</strong> <span id="view-mdms-banner-title"></span></p>
                    <p><strong>Banner Description:</strong> <span id="view-mdms-banner-description"></span></p>
                    <p><strong>Meta Title:</strong> <span id="view-mdms-meta-title"></span></p>
                    <p><strong>Meta Description:</strong> <span id="view-mdms-meta-description"></span></p>
                    <p><strong>Meta Keywords:</strong> <span id="view-mdms-meta-keywords"></span></p>
                    <p><strong>Title:</strong> <span id="view-mdms-title"></span></p>
                    <p><strong>Subtitle:</strong> <span id="view-mdms-subtitle"></span></p>
                    <p><strong>Intro:</strong> <span id="view-mdms-intro"></span></p>
                    <hr>
                    <div id="view-mdms-sections"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdmsModal" tabindex="-1" role="dialog" aria-labelledby="mdmsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="mdmsModalLabel">Add MD/MS Content</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('mdms.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="state_slug">Select State</label>
                            <select class="form-control @error('state_slug') is-invalid @enderror" id="state_slug" name="state_slug" required>
                                <option value="">Select State</option>
                                @foreach ($states as $slug => $stateName)
                                    <option value="{{ $slug }}" {{ old('state_slug') === $slug ? 'selected' : '' }}>{{ $stateName }}</option>
                                @endforeach
                            </select>
                            @error('state_slug')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="add_banner_title">Banner Title</label>
                            <input type="text" class="form-control" id="add_banner_title" name="banner_title" value="{{ old('banner_title') }}">
                        </div>

                        <div class="form-group">
                            <label for="add_banner_description">Banner Description</label>
                            <textarea class="form-control" id="add_banner_description" name="banner_description" rows="3">{{ old('banner_description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="add_meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="add_meta_title" name="meta_title" value="{{ old('meta_title') }}">
                        </div>

                        <div class="form-group">
                            <label for="add_meta_description">Meta Description</label>
                            <textarea class="form-control" id="add_meta_description" name="meta_description" rows="3">{{ old('meta_description') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="add_meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" id="add_meta_keywords" name="meta_keywords" rows="2">{{ old('meta_keywords') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="add_title">Title</label>
                            <input type="text" class="form-control" id="add_title" name="title" value="{{ old('title') }}">
                        </div>

                        <div class="form-group">
                            <label for="add_subtitle">Subtitle / Heading</label>
                            <input type="text" class="form-control" id="add_subtitle" name="subtitle" value="{{ old('subtitle') }}">
                        </div>

                        <div class="form-group">
                            <label for="add_intro">Intro Paragraph</label>
                            <textarea class="form-control" id="add_intro" name="intro" rows="3">{{ old('intro') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Sections</h6>
                            <button type="button" class="btn btn-sm btn-success add-section-btn" data-target="#add-section-cards">
                                <i class="fas fa-plus"></i> Add Section
                            </button>
                        </div>
                        <div id="add-section-cards"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editMdmsModal" tabindex="-1" role="dialog" aria-labelledby="editMdmsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="editMdmsModalLabel">Edit MD/MS Content</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editMdmsForm">
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
                            <label for="edit_meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="edit_meta_title" name="meta_title">
                        </div>

                        <div class="form-group">
                            <label for="edit_meta_description">Meta Description</label>
                            <textarea class="form-control" id="edit_meta_description" name="meta_description" rows="3"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_meta_keywords">Meta Keywords</label>
                            <textarea class="form-control" id="edit_meta_keywords" name="meta_keywords" rows="2"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_title">Title</label>
                            <input type="text" class="form-control" id="edit_title" name="title">
                        </div>

                        <div class="form-group">
                            <label for="edit_subtitle">Subtitle / Heading</label>
                            <input type="text" class="form-control" id="edit_subtitle" name="subtitle">
                        </div>

                        <div class="form-group">
                            <label for="edit_intro">Intro Paragraph</label>
                            <textarea class="form-control" id="edit_intro" name="intro" rows="3"></textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0">Sections</h6>
                            <button type="button" class="btn btn-sm btn-success add-section-btn" data-target="#edit-section-cards">
                                <i class="fas fa-plus"></i> Add Section
                            </button>
                        </div>
                        <div id="edit-section-cards"></div>
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

            function escapeHtml(value) {
                return $('<div>').text(value == null ? '' : value).html().replace(/"/g, '&quot;');
            }

            function questionsToText(questions) {
                return Array.isArray(questions) ? questions.join('\n') : (questions || '');
            }

            function sectionCardHtml(index, section) {
                var id = (section && section.id) || '';
                var label = (section && section.label) || '';
                var questions = questionsToText(section && section.questions);

                return '<div class="card section-card mb-3">' +
                    '<div class="card-body">' +
                    '<div class="form-group"><label>Section ID</label>' +
                    '<input type="text" class="form-control" name="sections[' + index + '][id]" value="' + escapeHtml(id) + '"></div>' +
                    '<div class="form-group"><label>Section Label</label>' +
                    '<input type="text" class="form-control" name="sections[' + index + '][label]" value="' + escapeHtml(label) + '"></div>' +
                    '<div class="form-group"><label>Questions (one per line)</label>' +
                    '<textarea class="form-control" rows="6" name="sections[' + index + '][questions]">' + escapeHtml(questions) + '</textarea></div>' +
                    '<button type="button" class="btn btn-sm btn-danger remove-section-btn"><i class="fas fa-trash"></i> Remove Section</button>' +
                    '</div></div>';
            }

            function renderSections(container, sections) {
                var list = (sections && Array.isArray(sections)) ? sections : [];
                if (list.length === 0) {
                    list = [{}];
                }
                container.empty();
                list.forEach(function (section, i) {
                    container.append(sectionCardHtml(i, section));
                });
            }

            $(document).on('click', '.add-section-btn', function () {
                var target = $($(this).data('target'));
                var index = target.children().length;
                target.append(sectionCardHtml(index, {}));
            });

            $(document).on('click', '.remove-section-btn', function () {
                $(this).closest('.section-card').remove();
            });

            var table = $('#mdms-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('mdms.data') }}',
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

            $('#mdms-table').on('click', '.btn-view', function () {
                var row = table.row($(this).closest('tr')).data();

                $('#view-mdms-state').text(row.state);
                $('#view-mdms-banner-title').text(row.banner_title || '');
                $('#view-mdms-banner-description').text(row.banner_description || '');
                $('#view-mdms-meta-title').text(row.meta_title || '');
                $('#view-mdms-meta-description').text(row.meta_description || '');
                $('#view-mdms-meta-keywords').text(row.meta_keywords || '');
                $('#view-mdms-title').text(row.title || '');
                $('#view-mdms-subtitle').text(row.subtitle || '');
                $('#view-mdms-intro').text(row.intro || '');

                $('#view-mdms-sections').empty();
                (row.sections || []).forEach(function (section) {
                    var heading = $('<h5 class="mt-3" style="color:#dc3545;">').text(section.label || '');
                    var list = $('<ul>');
                    (section.questions || []).forEach(function (question) {
                        list.append($('<li>').text(question));
                    });
                    $('#view-mdms-sections').append(heading).append(list);
                });

                $('#viewMdmsModal').modal('show');
            });

            $('#mdms-table').on('click', '.btn-edit', function () {
                var mdmsId = $(this).data('id');

                $('#edit_state').val($(this).data('state'));
                $('#edit_banner_title').val($(this).data('banner-title') || '');
                $('#edit_banner_description').val($(this).data('banner-description') || '');
                $('#edit_meta_title').val($(this).data('meta-title') || '');
                $('#edit_meta_description').val($(this).data('meta-description') || '');
                $('#edit_meta_keywords').val($(this).data('meta-keywords') || '');
                $('#edit_title').val($(this).data('title') || '');
                $('#edit_subtitle').val($(this).data('subtitle') || '');
                $('#edit_intro').val($(this).data('intro') || '');

                var sections = $(this).data('sections') || [];
                if (typeof sections === 'string') {
                    try {
                        sections = JSON.parse(sections);
                    } catch (e) {
                        sections = [];
                    }
                }
                renderSections($('#edit-section-cards'), sections);
                $('#editMdmsForm').attr('action', '/mdms/' + mdmsId);

                $('#editMdmsModal').modal('show');
            });

            $('#mdms-table').on('click', '.btn-delete', function () {
                var mdmsId = $(this).data('id');
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    alert('CSRF token not found.');
                    return;
                }

                if (!confirm('Are you sure you want to delete this MD/MS content?')) {
                    return;
                }

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/mdms/' + mdmsId;

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
