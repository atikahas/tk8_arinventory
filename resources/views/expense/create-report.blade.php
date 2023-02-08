@extends('layouts.sleek.main')
@section('activeexpenses', 'active')
@section('expandexpenses', 'expand')
@section('showexpenses', 'show')
@section('reportexpenses', 'active')

@section('content')
<div class="breadcrumb-wrapper">
    <h1>Expenses Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/') }}"><span class="mdi mdi-home"></span></a>
            </li>
            <li class="breadcrumb-item">expenses</li>
            <li class="breadcrumb-item" aria-current="page">add report expenses</li>
        </ol>
    </nav>
</div> 

<div class="row">
    <div class="col-12">
      <div class="card card-default">
          <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-8 mb-3 form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter report title ...">
                    </div>
                    <div class="col-4 mb-3 form-group">
                        <label for="name">Month</label>
                        <input type="month" class="form-control" name="monthyear">
                    </div>
                </div>
                <div class="float-right">
                    <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save-outline"></i> Save</button>
                </div>
            </form>
          </div>
        </div>
      </div>
</div>
@endsection
