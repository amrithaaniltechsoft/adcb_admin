@extends('adminlte::page')

@section('title', 'Blogs')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.css">
    <style>
        .modal .modal-dialog.modal-right {
            position: fixed;
            top: 0;
            right: 0;
            width: 520px;
            max-width: 100%;
            height: 100vh;
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
            height: 100vh;
            overflow-y: auto;
        }
    </style>
@stop

@section('content')
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h2 class="mt-4 mb-0">Blog List</h2>
            <button type="button" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;" data-toggle="modal" data-target="#blogModal">
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
                    <table id="blogs-table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>SI NO</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- View Modal --}}
    <div class="modal fade" id="viewBlogModal" tabindex="-1" role="dialog" aria-labelledby="viewBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="viewBlogModalLabel">View Blog</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="font-weight-bold text-muted">Title</label>
                    <h5 id="view-blog-title" class="mb-4"></h5>
                    <label class="font-weight-bold text-muted">Excerpt</label>
                    <p id="view-blog-excerpt"></p>
                    <label class="font-weight-bold text-muted">Content</label>
                    <div id="view-blog-content" style="max-height: 400px; overflow-y: auto;"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Add Modal --}}
    <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="blogModalLabel">Add Blog</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('blogs.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        @include('blogs._form_fields', ['prefix' => ''])
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Edit Modal --}}
    <div class="modal fade" id="editBlogModal" tabindex="-1" role="dialog" aria-labelledby="editBlogModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="editBlogModalLabel">Edit Blog</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editBlogForm" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        @include('blogs._form_fields', ['prefix' => 'edit_', 'blog' => null])
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.13/dist/flatpickr.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof flatpickr === 'function') {
                flatpickr('#date, #edit_date', {
                    dateFormat: 'M d, Y',
                    allowInput: true,
                });
            }

            $('.alert-success').each(function () {
                var $alert = $(this);
                setTimeout(function () {
                    $alert.fadeOut('slow');
                }, 3000);
            });

            var table = $('#blogs-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('blogs.data') }}',
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
                        data: 'title',
                        render: function (data) {
                            var truncated = data.length > 50 ? data.substring(0, 50) + '...' : data;
                            return $('<div>').text(truncated).html();
                        }
                    },
                    { data: 'slug' },
                    { data: 'date', defaultContent: '&mdash;' },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            var storeRows = {};
            table.on('draw', function () {
                storeRows = {};
                table.rows().every(function (rowIdx) {
                    var d = this.data();
                    storeRows[d.id] = d;
                });
            });
            // cache initial rows too
            table.rows().every(function () {
                var d = this.data();
                storeRows[d.id] = d;
            });

            function getRow(id) {
                return storeRows[id];
            }

            $('#image, #edit_image').on('change', function () {
                var input = this;
                var preview = $('#' + input.id + '_preview');
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        preview.attr('src', e.target.result).removeClass('d-none');
                    };
                    reader.readAsDataURL(input.files[0]);
                } else {
                    preview.addClass('d-none');
                }
            });

            $('#blogs-table').on('click', '.btn-view', function () {
                var row = getRow($(this).data('id'));

                $('#view-blog-title').text(row.title);

                $.ajax({
                    url: '/api/v1/blogs/' + row.slug,
                    method: 'GET',
                    success: function (res) {
                        $('#view-blog-excerpt').text(res.data.excerpt || '');
                        $('#view-blog-content').html(res.data.content || '');
                    }
                });

                $('#viewBlogModal').modal('show');
            });

            $('#blogs-table').on('click', '.btn-edit', function () {
                var id = $(this).data('id');

                $.ajax({
                    url: '/api/v1/blogs',
                    method: 'GET',
                    success: function (res) {
                        var blog = res.data.find(function (b) { return b.id === id; });
                        if (!blog) return;

                        $('#edit_title').val(blog.title || '');
                        $('#edit_slug').val(blog.slug || '');
                        $('#edit_category').val(blog.category || '');
                        $('#edit_date').val(blog.date || '');
                        $('#edit_read_time').val(blog.read_time || '');
                        $('#edit_author').val(blog.author || '');
                        $('#edit_image').val('');
                        if (blog.image) {
                            $('#edit_image_preview').attr('src', blog.image).removeClass('d-none');
                        } else {
                            $('#edit_image_preview').addClass('d-none');
                        }
                        $('#edit_tags').val((blog.tags || []).join('\n'));
                        $('#edit_excerpt').val(blog.excerpt || '');
                        $('#edit_content').val(blog.content || '');

                        $('#editBlogForm').attr('action', '/admin/blog/' + blog.id);
                        $('#editBlogModal').modal('show');
                    }
                });
            });

            $('#blogs-table').on('click', '.btn-delete', function () {
                var blogId = $(this).data('id');
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    alert('CSRF token not found.');
                    return;
                }

                if (!confirm('Are you sure you want to delete this blog?')) {
                    return;
                }

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/blog/' + blogId;

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
