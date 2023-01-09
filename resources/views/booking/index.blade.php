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
<link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/core-4.3.1/main.min.css" rel="stylesheet">
<link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/daygrid-4.3.0/main.min.css" rel="stylesheet">
@endsection

@section('content')
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
            events: {!!json_encode($arrbooking)!!}
        });

        calendar.render();
    });
</script>
@endsection