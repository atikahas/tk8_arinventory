@extends('layouts.sleek.admin')
@section('activeuser', 'active')
@section('expanduser', 'expand')
@section('showuser', 'show')
@section('listuser', 'active')

@section('content')
<div class="bg-white border rounded">
  <div class="row no-gutters">
    <div class="col-lg-4 col-xl-3">
      <div class="profile-content-left profile-left-spacing pt-5 pb-3 px-3 px-xl-5">
        <div class="card text-center widget-profile px-0 border-0">
          <div class="card-img mx-auto rounded-circle">
            <img src="https://static.alphacoders.com/avatars/21577.jpg">
          </div>

          <div class="card-body">
            <h4 class="py-2 text-dark">{{ $user->name }}</h4>
            <p>{{ $user->email }}</p>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-8 col-xl-9">
      <div class="profile-content-right profile-right-spacing py-5">
        <ul class="nav nav-tabs px-3 px-xl-5 nav-style-border" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
          </li>
        </ul>

        <div class="tab-content px-3 px-xl-5" id="myTabContent">
          <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
            <div class="tab-widget mt-5">
              <div class="row">
                Will update soon ...
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection