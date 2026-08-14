@extends('adminlte::page')

@section('title', 'MDS Content')

@section('css')
    <style>
        .modal .modal-dialog.modal-right {
            position: fixed;
            top: 0;
            right: 0;
            width: 900px;
            height: 100vh;
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
            height: 100vh;
            border-radius: 0;
            border: 0;
            overflow-y: auto;
        }
        .json-hint {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
    </style>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="mt-4 mb-0">MDS Content</h2>
            <button type="button" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;" data-toggle="modal" data-target="#mdsModal">
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
                    <table id="mds-table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>SI NO</th>
                                <th>Specialty</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewMdsModal" tabindex="-1" role="dialog" aria-labelledby="viewMdsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="viewMdsModalLabel">View MDS Content</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 id="view-mds-title"></h4>
                    <p><strong>Banner Title:</strong> <span id="view-mds-banner-title"></span></p>
                    <p><strong>Banner Description:</strong> <span id="view-mds-banner-description"></span></p>
                    <p><strong>Banner Image:</strong> <span id="view-mds-banner-image"></span></p>
                    <p><strong>Overview Title:</strong> <span id="view-mds-overview-title"></span></p>
                    <p><strong>Overview Content:</strong> <span id="view-mds-overview-content"></span></p>
                    <p><strong>Meta Title:</strong> <span id="view-mds-meta-title"></span></p>
                    <p><strong>Meta Description:</strong> <span id="view-mds-meta-description"></span></p>
                    <p><strong>Meta Keywords:</strong> <span id="view-mds-meta-keywords"></span></p>
                    <hr>
                    <h6><strong>Middle Banner</strong></h6>
                    <div id="view-mds-middle-banner"></div>
                    <hr>
                    <h6><strong>Clinical Areas / Specialties</strong></h6>
                    <div id="view-mds-specialties"></div>
                    <hr>
                    <h6><strong>Countries</strong></h6>
                    <div id="view-mds-countries"></div>
                    <hr>
                    <h6><strong>Best Country Recommendation</strong></h6>
                    <div id="view-mds-recommendation"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdsModal" tabindex="-1" role="dialog" aria-labelledby="mdsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="mdsModalLabel">Add MDS Content</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('mds.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="slug">Select Specialty</label>
                            <select class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" required>
                                <option value="">Select Specialty</option>
                                @foreach ($specialties as $slug => $specialtyName)
                                    <option value="{{ $slug }}" {{ old('slug') === $slug ? 'selected' : '' }}>{{ $specialtyName }}</option>
                                @endforeach
                            </select>
                            @error('slug')
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
                            <label for="add_overview_title">Overview Title</label>
                            <input type="text" class="form-control" id="add_overview_title" name="overview_title" value="{{ old('overview_title') }}">
                        </div>

                        <div class="form-group">
                            <label for="add_overview_content">Overview Content</label>
                            <textarea class="form-control" id="add_overview_content" name="overview_content" rows="6">{{ old('overview_content') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="add_middle_banner">Middle Banner (JSON)</label>
                            <textarea class="form-control" id="add_middle_banner" name="middle_banner" rows="4" placeholder='{"title":"International Scope","description":"...","points":["..."],"descriptionAfter":"..."}'>{{ old('middle_banner') }}</textarea>
                            <p class="json-hint">Paste valid JSON. Fields: title, description, points (array), descriptionAfter.</p>
                        </div>

                        <div class="form-group">
                            <label for="add_specialties">Clinical Areas / Specialties (JSON)</label>
                            <textarea class="form-control" id="add_specialties" name="specialties" rows="5" placeholder='[{"title":"...","image":"/path.jpg","highlights":["..."]}]'>{{ old('specialties') }}</textarea>
                            <p class="json-hint">Paste valid JSON array. Each item: title, image, highlights (array).</p>
                        </div>

                        <div class="form-group">
                            <label for="add_countries">Countries (JSON)</label>
                            <textarea class="form-control" id="add_countries" name="countries" rows="5" placeholder='[{"name":"United Arab Emirates","flag":"/c-flag/uae.png","image":"/path.jpg","highlights":["..."]}]'>{{ old('countries') }}</textarea>
                            <p class="json-hint">Paste valid JSON array. Each item: name, flag, image, highlights (array).</p>
                        </div>

                        <div class="form-group">
                            <label for="add_recommendation">Best Country Recommendation (JSON)</label>
                            <textarea class="form-control" id="add_recommendation" name="recommendation" rows="5" placeholder='{"title":"Best Country Recommendation","description":"...","bullets":["..."],"buttonText":"Contact Us","buttonHref":"/contact","backgroundImageSrc":"/page-banner/uae-banner.jpg","descriptionAfter":"..."}'>{{ old('recommendation') }}</textarea>
                            <p class="json-hint">Paste valid JSON. Fields: title, description, bullets (array), buttonText, buttonHref, backgroundImageSrc, descriptionAfter.</p>
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
                            <input type="text" class="form-control" id="add_meta_keywords" name="meta_keywords" value="{{ old('meta_keywords') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editMdsModal" tabindex="-1" role="dialog" aria-labelledby="editMdsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="editMdsModalLabel">Edit MDS Content</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editMdsForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_title">Specialty</label>
                            <input type="text" class="form-control" id="edit_title" name="title" disabled>
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
                            <label for="edit_overview_title">Overview Title</label>
                            <input type="text" class="form-control" id="edit_overview_title" name="overview_title">
                        </div>

                        <div class="form-group">
                            <label for="edit_overview_content">Overview Content</label>
                            <textarea class="form-control" id="edit_overview_content" name="overview_content" rows="6"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_middle_banner">Middle Banner (JSON)</label>
                            <textarea class="form-control" id="edit_middle_banner" name="middle_banner" rows="4"></textarea>
                            <p class="json-hint">Paste valid JSON. Fields: title, description, points (array), descriptionAfter.</p>
                        </div>

                        <div class="form-group">
                            <label for="edit_specialties">Clinical Areas / Specialties (JSON)</label>
                            <textarea class="form-control" id="edit_specialties" name="specialties" rows="5"></textarea>
                            <p class="json-hint">Paste valid JSON array. Each item: title, image, highlights (array).</p>
                        </div>

                        <div class="form-group">
                            <label for="edit_countries">Countries (JSON)</label>
                            <textarea class="form-control" id="edit_countries" name="countries" rows="5"></textarea>
                            <p class="json-hint">Paste valid JSON array. Each item: name, flag, image, highlights (array).</p>
                        </div>

                        <div class="form-group">
                            <label for="edit_recommendation">Best Country Recommendation (JSON)</label>
                            <textarea class="form-control" id="edit_recommendation" name="recommendation" rows="5"></textarea>
                            <p class="json-hint">Paste valid JSON. Fields: title, description, bullets (array), buttonText, buttonHref, backgroundImageSrc, descriptionAfter.</p>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            $('.alert-success').each(function () {
                var $alert = $(this);
                setTimeout(function () {
                    $alert.fadeOut('slow');
                }, 3000);
            });

            function prettyJson(value, fallback) {
                try {
                    var parsed = typeof value === 'string' ? JSON.parse(value) : value;
                    return parsed ? JSON.stringify(parsed, null, 2) : fallback;
                } catch (e) {
                    return value || fallback;
                }
            }

            function renderJsonList($target, items, titleKey, subtitleKey) {
                $target.empty();
                if (!items || items.length === 0) {
                    $target.append($('<p class="text-muted">').text('No data added yet.'));
                    return;
                }
                items.forEach(function (item) {
                    var heading = item[titleKey] || item.name || item.title || 'Item';
                    var block = $('<div class="mb-3">');
                    var strong = $('<strong>').text(heading);
                    if (item[subtitleKey]) {
                        strong.append(' <span class="text-muted">(' + item[subtitleKey] + ')</span>');
                    }
                    block.append(strong);
                    var list = $('<ul>');
                    (item.highlights || item.bullets || []).forEach(function (point) {
                        list.append($('<li>').text(point));
                    });
                    block.append(list);
                    $target.append(block);
                });
            }

            var table = $('#mds-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('mds.data') }}',
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
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            $('#mds-table').on('click', '.btn-view', function () {
                var row = table.row($(this).closest('tr')).data();

                $('#view-mds-title').text(row.title);
                $('#view-mds-banner-title').text(row.banner_title || '');
                $('#view-mds-banner-description').text(row.banner_description || '');
                $('#view-mds-banner-image').text(row.banner_image || '');
                $('#view-mds-overview-title').text(row.overview_title || '');
                $('#view-mds-overview-content').text(row.overview_content || '');
                $('#view-mds-meta-title').text(row.meta_title || '');
                $('#view-mds-meta-description').text(row.meta_description || '');
                $('#view-mds-meta-keywords').text(row.meta_keywords || '');

                var middle = row.middle_banner;
                if (middle && (middle.description || middle.points)) {
                    var middleHtml = '<p>' + (middle.description || '') + '</p>';
                    if (middle.points && middle.points.length > 0) {
                        middleHtml += '<ul>';
                        middle.points.forEach(function (point) {
                            middleHtml += '<li>' + point + '</li>';
                        });
                        middleHtml += '</ul>';
                    }
                    $('#view-mds-middle-banner').html(middleHtml);
                } else {
                    $('#view-mds-middle-banner').html('<p class="text-muted">No data added yet.</p>');
                }

                renderJsonList($('#view-mds-specialties'), row.specialties, 'title');
                renderJsonList($('#view-mds-countries'), row.countries, 'name', 'flag');

                var rec = row.recommendation;
                if (rec && rec.title) {
                    var recHtml = '<p><strong>' + rec.title + '</strong></p><p>' + (rec.description || '') + '</p>';
                    if (rec.bullets && rec.bullets.length > 0) {
                        recHtml += '<ul>';
                        rec.bullets.forEach(function (bullet) {
                            recHtml += '<li>' + bullet + '</li>';
                        });
                        recHtml += '</ul>';
                    }
                    $('#view-mds-recommendation').html(recHtml);
                } else {
                    $('#view-mds-recommendation').html('<p class="text-muted">No data added yet.</p>');
                }

                $('#viewMdsModal').modal('show');
            });

            $('#mds-table').on('click', '.btn-edit', function () {
                var mdsId = $(this).data('id');

                $('#edit_title').val($(this).data('title'));
                $('#edit_banner_title').val($(this).data('banner-title') || '');
                $('#edit_banner_description').val($(this).data('banner-description') || '');
                $('#edit_overview_title').val($(this).data('overview-title') || '');
                $('#edit_overview_content').val($(this).data('overview-content') || '');
                $('#edit_middle_banner').val(prettyJson($(this).data('middle-banner'), ''));
                $('#edit_specialties').val(prettyJson($(this).data('specialties'), ''));
                $('#edit_countries').val(prettyJson($(this).data('countries'), ''));
                $('#edit_recommendation').val(prettyJson($(this).data('recommendation'), ''));
                $('#edit_meta_title').val($(this).data('meta-title') || '');
                $('#edit_meta_description').val($(this).data('meta-description') || '');
                $('#edit_meta_keywords').val($(this).data('meta-keywords') || '');
                $('#editMdsForm').attr('action', '/mds/' + mdsId);

                $('#editMdsModal').modal('show');
            });

            $('#mds-table').on('click', '.btn-delete', function () {
                var mdsId = $(this).data('id');
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    alert('CSRF token not found.');
                    return;
                }

                if (!confirm('Are you sure you want to delete this MDS content?')) {
                    return;
                }

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/mds/' + mdsId;

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
