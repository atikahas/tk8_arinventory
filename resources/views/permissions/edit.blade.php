@extends('layouts.sleek.admin')
@section('activepermission', 'active')
@section('expandpermission', 'expand')
@section('showpermission', 'show')
@section('listpermission', 'active')

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
                    <h2>Edit permission.</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                        @method('patch')
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="name" class="form-label">Name</label>
                            <input value="{{ $permission->name }}" type="text" class="form-control" name="name" placeholder="Name" required>
                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary">Save permission</button>
                        <a href="{{ route('permissions.index') }}" class="btn btn-default">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection