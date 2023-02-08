@extends('layouts.sleek.main')
@section('activebooking', 'active')
@section('activebooking', 'active')
@section('expandbooking', 'expand')
@section('showbooking', 'show')
@section('listbooking', 'active')

@section('scriptheader')
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.css" rel="stylesheet">
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/responsive.datatables.min.css" rel="stylesheet">
<link href="https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css">
<link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/core-4.3.1/main.css" rel="stylesheet">
<link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/daygrid-4.3.0/main.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Booking Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">booking</li>
                <li class="breadcrumb-item" aria-current="page">list booking</li>
            </ol>
        </nav>
    </div> 
    <div class="row">
        <div class="col-12">
          <div class="card card-default">
              <div class="card-body">
                <a href="{{ route('booking.create') }}" class="btn btn-outline-primary btn-sm text-uppercase ">
                    <i class=" mdi mdi-plus"></i> Add Booking
                </a>
                  <div id="calendar"></div>
              </div>
            </div>
          </div>
    </div>
@endsection

@section('scriptfooter')
<script src="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/core-4.3.1/main.min.js"></script>
<script src="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/daygrid-4.3.0/main.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/jquery.datatables.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.responsive.min.js"></script>
<script src='{{url('')}}/sleek/theme/assets/plugins/charts/Chart.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var year = new Date().getFullYear()
        var month = new Date().getMonth() + 1
        function n(n){
            return n > 9 ? "" + n: "0" + n;
        }
        var month = n(month)

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid' ],
            defaultView: 'dayGridMonth',
            displayEventTime: false,
            events: {!!json_encode($arrbooking)!!},
        });

        calendar.render();
    });
</script>

@endsection