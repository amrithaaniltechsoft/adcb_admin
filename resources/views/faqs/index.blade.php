@extends('adminlte::page')

@section('title', 'FAQs')

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
            <h2 class="mt-4 mb-0">FAQ List</h2>
            <button type="button" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;" data-toggle="modal" data-target="#faqModal">
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
                    <table id="faqs-table" class="table table-bordered table-striped" style="width:100%">
                        <thead>
                            <tr>
                                <th>SI NO</th>
                                <th>Category</th>
                                <th>Question</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewFaqModal" tabindex="-1" role="dialog" aria-labelledby="viewFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="viewFaqModalLabel">View FAQ</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 id="view-faq-question"></h5>
                    <p id="view-faq-answer"></p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="faqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="faqModalLabel">Add FAQ</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('faqs.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" id="category" name="category">
                                <option value="" {{ old('category') === null ? 'selected' : '' }}>Select Category</option>
                                <option value="Kochi" {{ old('category') === 'Kochi' ? 'selected' : '' }}>Kochi</option>
                                <option value="Calicut" {{ old('category') === 'Calicut' ? 'selected' : '' }}>Calicut</option>
                            </select>
                            @error('category')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="question">Question</label>
                            <input type="text" class="form-control @error('question') is-invalid @enderror" id="question" name="question" value="{{ old('question') }}" required>
                            @error('question')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="answer">Answer</label>
                            <textarea class="form-control @error('answer') is-invalid @enderror" id="answer" name="answer" rows="6" required>{{ old('answer') }}</textarea>
                            @error('answer')
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

    <div class="modal fade" id="editFaqModal" tabindex="-1" role="dialog" aria-labelledby="editFaqModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-right" role="document">
            <div class="modal-content">
                <div class="modal-header text-white" style="background-color: #dc3545;">
                    <h5 class="modal-title" id="editFaqModalLabel">Edit FAQ</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="" id="editFaqForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="edit_category">Category</label>
                            <select class="form-control" id="edit_category" name="category">
                                <option value="">Select Category</option>
                                <option value="Kochi">Kochi</option>
                                <option value="Calicut">Calicut</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="edit_question">Question</label>
                            <input type="text" class="form-control" id="edit_question" name="question" required>
                        </div>

                        <div class="form-group">
                            <label for="edit_answer">Answer</label>
                            <textarea class="form-control" id="edit_answer" name="answer" rows="6" required></textarea>
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

            var table = $('#faqs-table').DataTable({
                processing: true,
                serverSide: false,
                ajax: '{{ route('faqs.data') }}',
                columns: [
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row, meta) {
                            return meta.row + 1;
                        }
                    },
                    { data: 'category' },
                    { data: 'question' },
                    { data: 'answer' },
                    {
                        data: 'action',
                        orderable: false,
                        searchable: false,
                    },
                ],
            });

            $('#faqs-table').on('click', '.btn-view', function () {
                var row = table.row($(this).closest('tr')).data();

                $('#view-faq-question').text(row.question);
                $('#view-faq-answer').text(row.answer);

                $('#viewFaqModal').modal('show');
            });

            $('#faqs-table').on('click', '.btn-edit', function () {
                var faqId = $(this).data('id');

                $('#edit_category').val($(this).data('category') || '');
                $('#edit_question').val($(this).data('question'));
                $('#edit_answer').val($(this).data('answer'));
                $('#editFaqForm').attr('action', '/faqs/' + faqId);

                $('#editFaqModal').modal('show');
            });

            $('#faqs-table').on('click', '.btn-delete', function () {
                var faqId = $(this).data('id');
                var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');

                if (!csrfToken) {
                    alert('CSRF token not found.');
                    return;
                }

                if (!confirm('Are you sure you want to delete this FAQ?')) {
                    return;
                }

                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/faqs/' + faqId;

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
