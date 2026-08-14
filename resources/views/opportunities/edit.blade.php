@extends('adminlte::page')

@section('title', 'Edit Opportunity')

@section('content_header')
    <h1>Edit Opportunity</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Opportunity</h3>
                </div>
                <form method="POST" action="{{ route('opportunities.update', $opportunity) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $opportunity->title) }}">
                            @error('title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="4">{{ old('description', $opportunity->description) }}</textarea>
                            @error('description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="image">Image</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input @error('image') is-invalid @enderror" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                            @error('image')
                                <span class="invalid-feedback d-block" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        @if ($opportunity->image)
                            <div class="form-group">
                                <label>Current Image</label>
                                <div>
                                    <img src="{{ asset('storage/' . $opportunity->image) }}" class="img-fluid" style="max-height: 200px;" alt="{{ $opportunity->title }}">
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('opportunities.index') }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
