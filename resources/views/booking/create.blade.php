@extends('layouts.sleek.main')
@section('activebooking', 'active')
@section('activebooking', 'active')
@section('expandbooking', 'expand')
@section('showbooking', 'show')
@section('addbooking', 'active')

@section('content')
    <div class="row">
        <div class="col-12">
          <div class="card card-default">
              <div class="card-body">
                <form method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-8 mb-3 form-group">
                            <label for="name">Guest Name</label>
                            <input type="text" class="form-control expenses-name" name="item_name" placeholder="Enter guest name">
                        </div>
                        <div class="col-4 mb-3 form-group">
                            <label for="name">No Pax</label>
                            <input type="text" class="form-control expenses-shop" name="item_shop" placeholder="2,5,7,...">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3 form-group">
                            <label for="name">Check In</label>
                            <input type="date" class="form-control expenses-shop" name="item_shop" placeholder="Enter shop name">
                        </div>
                        <div class="col-6 mb-3 form-group">
                            <label for="name">Check Out</label>
                            <input type="date" class="form-control expenses-date" name="purchase_date">
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save-outline"></i> SAVE INFO</button>
                    </div>
                </form>
              </div>
            </div>
          </div>
    </div>
@endsection

@section('scriptfooter')
@endsection