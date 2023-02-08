@extends('layouts.sleek.main')
@section('activebooking', 'active')
@section('activebooking', 'active')
@section('expandbooking', 'expand')
@section('showbooking', 'show')
@section('addbooking', 'active')

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Booking Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">booking</li>
                <li class="breadcrumb-item" aria-current="page">add booking</li>
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
                            <label for="name">Guest Name</label>
                            <input type="text" class="form-control expenses-name" name="guest_name" placeholder="Enter guest name">
                        </div>
                        <div class="col-4 mb-3 form-group">
                            <label for="name">No Pax</label>
                            <input type="text" class="form-control expenses-shop" name="guest_pax" placeholder="2,5,7,...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3 form-group">
                            <label for="name">Check In</label>
                            <input type="date" class="form-control expenses-shop" name="check_in">
                        </div>
                        <div class="col-6 mb-3 form-group">
                            <label for="name">Check Out</label>
                            <input type="date" class="form-control expenses-date" name="check_out">
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

@section('scriptfooter')
@endsection