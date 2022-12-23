@extends('layouts.sleek.admin')
@section('activeuser', 'active')
@section('expanduser', 'expand')
@section('showuser', 'show')
@section('listuser', 'active')

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Users Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">users</li>
                <li class="breadcrumb-item" aria-current="page">edit users</li>
            </ol>
        </nav>
    </div> 

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom d-flex justify-content-between">
                    <h2>Edit user.</h2>
                </div>

                <div class="card-body">
                    <form method="post" action="{{ route('users.update', $user->id) }}">
                        @method('patch')
                        @csrf
                        <div class="mb-3 form-group">
                            <label>Name</label>
                            <input value="{{ $user->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 form-group">
                            <label>Email</label>
                            <input value="{{ $user->email }}"type="email" class="form-control" name="email" placeholder="Email address" required>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 form-group">
                            <label>Username</label>
                            <input value="{{ $user->username }}"type="text" class="form-control" name="username" placeholder="Username" required>
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div>
                        <div class="mb-3 form-group">
                            <label>Role</label>
                            <select class="form-control" 
                                name="role" required>
                                <option value="">Select role</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ in_array($role->name, $userRole) 
                                            ? 'selected'
                                            : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Update user</button>
                        <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection