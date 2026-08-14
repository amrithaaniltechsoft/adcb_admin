@extends('adminlte::page')

@section('title', 'Opportunity Details')

@section('content_header')
    <h1>Opportunity Details</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3>{{ $opportunity->title }}</h3>
                    <p>{{ $opportunity->description }}</p>
                    @if ($opportunity->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $opportunity->image) }}" class="img-fluid" alt="{{ $opportunity->title }}">
                        </div>
                    @endif
                    <a href="{{ route('opportunities.index') }}" class="btn btn-secondary">Back</a>
                    <a href="{{ route('opportunities.edit', $opportunity) }}" class="btn btn-warning">Edit</a>
                </div>
            </div>
        </div>
    </div>
@stop
