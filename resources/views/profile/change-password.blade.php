@extends('adminlte::page')

@section('title', 'Change Password')

@section('content')
    <div class="row mb-3">
        <div class="col-12">
            <h2 class="mt-4 mb-0">Change Password</h2>
        </div>
    </div>

    @if (session('status') === 'password-updated')
        <div class="row mb-3">
            <div class="col-12">
                <div class="alert alert-success">
                    Password updated successfully.
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="card card-primary">
                <div class="card-header" style="background-color: #dc3545;">
                    <h3 class="card-title">Update Your Password</h3>
                </div>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        @if ($errors->updatePassword->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->updatePassword->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required autocomplete="current-password">
                        </div>

                        <div class="form-group">
                            <label for="password">New Password</label>
                            <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password">
                        </div>

                        <div class="form-group">
                            <label for="password_confirmation">Confirm New Password</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success" style="background-color: #dc3545; border-color: #dc3545;">Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
