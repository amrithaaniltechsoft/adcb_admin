@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>AdminLite Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Welcome</h3>
                </div>
                <div class="card-body">
                    <p>{{ __("You're logged in!") }}</p>
                    <p>This is the AdminLTE dashboard view.</p>
                </div>
            </div>
        </div>
    </div>
@stop
