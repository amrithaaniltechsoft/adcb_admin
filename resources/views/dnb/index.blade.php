@extends('adminlte::page')

@section('title', 'DNB Content')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <h2 class="mt-4 mb-0">DNB Content</h2>
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
                <div class="card-header">
                    <h3 class="card-title">DNB Specialties Page</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ $dnb ? route('dnb.update', $dnb->id) : route('dnb.store') }}">
                        @csrf
                        @if ($dnb)
                            @method('PUT')
                        @endif

                        <div class="form-group">
                            <label for="banner_title">Banner Title</label>
                            <input type="text" class="form-control @error('banner_title') is-invalid @enderror" id="banner_title" name="banner_title" value="{{ old('banner_title', $dnb->banner_title ?? '') }}">
                            @error('banner_title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="banner_description">Banner Description</label>
                            <textarea class="form-control @error('banner_description') is-invalid @enderror" id="banner_description" name="banner_description" rows="3">{{ old('banner_description', $dnb->banner_description ?? '') }}</textarea>
                            @error('banner_description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="intro_title">Intro Heading</label>
                            <input type="text" class="form-control @error('intro_title') is-invalid @enderror" id="intro_title" name="intro_title" value="{{ old('intro_title', $dnb->intro_title ?? '') }}">
                            @error('intro_title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="intro_description">Intro Description</label>
                            <textarea class="form-control @error('intro_description') is-invalid @enderror" id="intro_description" name="intro_description" rows="3">{{ old('intro_description', $dnb->intro_description ?? '') }}</textarea>
                            @error('intro_description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="specialties">Specialties (one per line)</label>
                            <textarea class="form-control @error('specialties') is-invalid @enderror" id="specialties" name="specialties" rows="20">{{ old('specialties', $dnb->specialties ?? '') }}</textarea>
                            @error('specialties')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title', $dnb->meta_title ?? '') }}">
                            @error('meta_title')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $dnb->meta_description ?? '') }}</textarea>
                            @error('meta_description')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror" id="meta_keywords" name="meta_keywords" value="{{ old('meta_keywords', $dnb->meta_keywords ?? '') }}">
                            @error('meta_keywords')
                                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
