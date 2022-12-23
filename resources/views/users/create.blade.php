@extends('layouts.sleek.admin')
@section('activeuser', 'active')
@section('expanduser', 'expand')
@section('showuser', 'show')
@section('adduser', 'active')

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Users Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">users</li>
                <li class="breadcrumb-item" aria-current="page">add users</li>
            </ol>
        </nav>
    </div> 

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Add new user.</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="name">Name</label>
                            <input value="{{ old('name') }}" type="text" class="form-control" name="name" placeholder="Name" required>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 form-group">
                            <label for="email">Email</label>
                            <input value="{{ old('email') }}" type="email" class="form-control" name="email" placeholder="Email address" required>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 form-group">
                            <label for="username">Username</label>
                            <input value="{{ old('username') }}" type="text" class="form-control" name="username" placeholder="Username" required>
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 form-group">
                            <label for="role">Password</label>
                            <input type="password" class="form-control input-lg" name="password" value="{{ old('password') }}" placeholder="Password" required="required" autocomplete="on">
                            @if ($errors->has('password'))
                            <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 form-group">
                            <label for="role">Confirm Password</label>
                            <input type="password" class="form-control input-lg" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required="required" autocomplete="on">
                            @if ($errors->has('password_confirmation'))
                            <span class="text-danger text-left">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Save User</button>
                        <a href="{{ route('users.index') }}" class="btn btn-default">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection