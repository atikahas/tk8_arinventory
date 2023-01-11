@extends('layouts.sleek.main')
@section('activedash', 'active')

@section('scriptheader')
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.css" rel="stylesheet">
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/responsive.datatables.min.css" rel="stylesheet">
<link href="https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css">
<link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/core-4.3.1/main.css" rel="stylesheet">
<link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/daygrid-4.3.0/main.min.css" rel="stylesheet">
@endsection

@section('content')
    
    <div class="row">
        <div class="col-12 text-center p-3">
            <p style="background-color: #6a8f39; color:white;">SUMMARY ITEMS (ASSET)</p>
        </div>
        @foreach ( $ttlitemtype as $itemtype)
            <div class="col-6">
                <div class="card card-mini mb-4">
                    <div class="card-body">
                        <h2 class="mb-1">{{ $itemtype->ttl }}</h2>
                        <p style="text-transform: uppercase;">{{ $itemtype->category }}</p>
                    </div>
                </div>
            </div> 
        @endforeach

        <div class="col-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <table id="cutleries-table" class="table table-hover nowrap" >
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($summarycutleries as $sc)
                            <tr>
                                <td>{{ $sc->item_name }}</td>
                                <td>{{ $sc->current_stock }} / {{ $sc->initial_stock }}
                                    <div class="progress my-2" style="height: 5px;">
                                        @if($sc->percent_stock > 50)
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $sc->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        @elseif ($sc->percent_stock < 50 and $sc->percent_stock > 0)
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $sc->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        @elseif ($sc->percent_stock == 0)
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 2%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 

        <div class="col-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <table id="housekeeping-table" class="table table-hover nowrap" >
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($summaryhousekeeping as $sc)
                            <tr>
                                <td>{{ $sc->item_name }}</td>
                                <td>{{ $sc->current_stock }} / {{ $sc->initial_stock }}
                                    <div class="progress my-2" style="height: 5px;">
                                        @if($sc->percent_stock > 50)
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $sc->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        @elseif ($sc->percent_stock < 50 and $sc->percent_stock > 0)
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $sc->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        @elseif ($sc->percent_stock == 0)
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 2%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> 
        
    </div>

    <div class="row">
        <div class="col-12 text-center p-3">
            <p style="background-color: #6a8f39; color:white; text-transform: uppercase;">SUMMARY BOOKING <b>({{ now()->format('F Y') }})</b></p>
        </div>
        <div class="col-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1">{{ $ttlcurrentbooking }}</h2>
                    {{-- <p>TOTAL BOOKING ({{ now()->format('F Y') }})</p> --}}
                    <p>TOTAL BOOKING</p>
                </div>
            </div>
        </div> 
        <div class="col-6">
            <div class="card card-mini mb-4">
                <div class="card-body">
                    <h2 class="mb-1">{{ $ttlcurrentpax }}</h2>
                    <p>TOTAL PAX </p>
                </div>
            </div>
        </div> 
        <div class="col-12">
            <div class="card card-default">
                <div class="card-body">
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
<script>
    jQuery(document).ready(function() {
        jQuery('#cutleries-table').DataTable({
                pageLength: 4,
        });

        jQuery('#housekeeping-table').DataTable({
                pageLength: 4,
        });
    });
</script>
@endsection