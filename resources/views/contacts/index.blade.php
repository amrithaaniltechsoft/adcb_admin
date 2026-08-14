@extends('adminlte::page')

@section('title', 'Contacts')

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
            <h2 class="mt-4 mb-0">Contact List</h2>
            <button type="button" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;" data-toggle="modal" data-target="#contactModal">
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
                    <table id="contacts-table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Branch</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Working Hours</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewContactModal" tabindex="-1" role="dialog" aria-labelledby="viewContactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="viewContactModalLabel">View Contact</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 id="view-contact-branch"></h4>
                    <p><strong>Slug:</strong> <span id="view-contact-slug"></span></p>
                    <p><strong>Office Address</strong><br><span id="view-contact-address"></span></p>
                    <p><strong>Phone Number</strong><br><span id="view-contact-phone"></span></p>
                    <p><strong>Email Address</strong><br><span id="view-contact-email"></span></p>
                    <p><strong>Working Hours</strong><br><span id="view-contact-working-hours"></span></p>
                    <div id="view-contact-map"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="contactModalLabel">Add Contact</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('contacts.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="slug">Slug</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug') }}" placeholder="e.g. kochi" required>
                            @error('slug')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="branch">Branch</label>
                            <input type="text" class="form-control @error('branch') is-invalid @enderror" id="branch" name="branch" value="{{ old('branch') }}" required>
                            @error('branch')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="address">Office Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                            @error('phone')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="working_hours">Working Hours</label>
                            <input type="text" class="form-control @error('working_hours') is-invalid @enderror" id="working_hours" name="working_hours" value="{{ old('working_hours') }}" required>
                            @error('working_hours')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="map_embed_url">Map Embed URL</label>
                            <textarea class="form-control @error('map_embed_url') is-invalid @enderror" id="map_embed_url" name="map_embed_url" rows="3" placeholder="Optional Google Maps embed URL">{{ old('map_embed_url') }}</textarea>
                            @error('map_embed_url')
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

    <div class="modal fade" id="editContactModal" tabindex="-1" role="dialog" aria-labelledby="editContactModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="editContactModalLabel">Edit Contact</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editContactForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_slug">Slug</label>
                            <input type="text" class="form-control" id="edit_slug" name="slug" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_branch">Branch</label>
                            <input type="text" class="form-control" id="edit_branch" name="branch" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_address">Office Address</label>
                            <textarea class="form-control" id="edit_address" name="address" rows="3" required></textarea>
                        </div>

                        <div class="form-group">
                            <label for="edit_phone">Phone Number</label>
                            <input type="text" class="form-control" id="edit_phone" name="phone" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_email">Email Address</label>
                            <input type="email" class="form-control" id="edit_email" name="email" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_working_hours">Working Hours</label>
                            <input type="text" class="form-control" id="edit_working_hours" name="working_hours" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_map_embed_url">Map Embed URL</label>
                            <textarea class="form-control" id="edit_map_embed_url" name="map_embed_url" rows="3"></textarea>
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

            var table = $('#contacts-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: '{{ route('contacts.data') }}',
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
                    { data: 'branch' },
                    { data: 'address' },
                    { data: 'phone' },
                    { data: 'email' },
                    { data: 'working_hours' },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
                order: [[0, 'desc']],
            });

            window.addEventListener('pageshow', function (event) {
                if (event.persisted) {
                    table.ajax.reload(null, false);
                }
            });

            $('#contacts-table').on('click', '.btn-view', function () {
                var row = table.row($(this).closest('tr')).data();

                $('#view-contact-branch').text(row.branch);
                $('#view-contact-slug').text(row.slug);
                $('#view-contact-address').text(row.address);
                $('#view-contact-phone').text(row.phone);
                $('#view-contact-email').text(row.email);
                $('#view-contact-working-hours').text(row.working_hours);
                $('#view-contact-map').html(row.map_embed_url
                    ? '<iframe src="' + row.map_embed_url + '" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>'
                    : '');

                $('#viewContactModal').modal('show');
            });

            $('#contacts-table').on('click', '.btn-edit', function () {
                var contactId = $(this).data('id');
                var row = table.row($(this).closest('tr')).data();

                $('#edit_slug').val(row.slug);
                $('#edit_branch').val(row.branch);
                $('#edit_address').val(row.address);
                $('#edit_phone').val(row.phone);
                $('#edit_email').val(row.email);
                $('#edit_working_hours').val(row.working_hours);
                $('#edit_map_embed_url').val(row.map_embed_url);
                $('#editContactForm').attr('action', '/contacts/' + contactId);

                $('#editContactModal').modal('show');
            });

            $('#contacts-table').on('click', '.btn-delete', function () {
                var contactId = $(this).data('id');
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    alert('CSRF token not found.');
                    return;
                }

                if (!confirm('Are you sure you want to delete this contact?')) {
                    return;
                }

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/contacts/' + contactId;

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
