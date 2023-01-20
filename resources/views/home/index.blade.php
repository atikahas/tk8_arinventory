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
    
    <div id="accordion2" class="accordion accordion-shadow">

        <div class="row">
            <div class="col-12 text-center p-3">
                <p style="background-color: #6a8f39; color:white;">SUMMARY BOOKING</p>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-6">
                <div class="widget-block rounded bg-primary  d-flex">
                    <div class="widget-info align-self-center">
                        <h3 class="text-white mb-2">{{ $ttlcurrybooking }}</h3>
                        <p class="text-white">Total Booking <b>{{ now()->year }}</b></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 col-xl-6">
                <div class="widget-block rounded bg-warning  d-flex">
                    <div class="widget-info align-self-center">
                        <h3 class="text-white mb-2">{{ $ttlcurrmbooking }}</h3>
                        <p class="text-white">Total Booking <b>{{ now()->format('F') }}</b></p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 text-center p-3">
                <p style="background-color: #6a8f39; color:white;">SUMMARY ITEMS (ASSET)</p>
            </div>
            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-header" id="ttlitem">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsettlitem" aria-expanded="false" aria-controls="collapsettlitem">
                            <div class="media-body align-self-center">
                                <h4 class="text-primary mb-2"><i class="mdi mdi-checkbox-blank-circle text-success"></i> {{ $ttlitems }}</h4>
                                <p>Total Items</p>
                            </div>
                        </button>
                    </div>

                    <div id="collapsettlitem" class="collapse" aria-labelledby="ttlitem">
                        <div class="card-body">
                            <table id="items-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="90%">Items</th>
                                        <th width="10%">Stock Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $i)
                                    <tr>
                                        <td>{{ $i->item_name }}</td>
                                        <td>{{ $i->current_stock }} / {{ $i->initial_stock }}
                                            <div class="progress my-2" style="height: 5px;">
                                                @if($i->percent_stock > 50)
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $i->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                @elseif ($i->percent_stock < 50 and $i->percent_stock > 0)
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $i->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                @elseif ($i->percent_stock == 0)
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

            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-header" id="ttllowitems">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsettllowitems" aria-expanded="false" aria-controls="collapsettllowitems">
                            <div class="media-body align-self-center">
                                <h4 class="text-primary mb-2"><i class="mdi mdi-alert-circle text-warning"></i> {{ $ttllowitems }}</h4>
                                <p>Low Stock Items</p>
                            </div>
                        </button>
                    </div>

                    <div id="collapsettllowitems" class="collapse" aria-labelledby="ttllowitems">
                        <div class="card-body">
                            <table id="lowitems-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="90%">Items</th>
                                        <th width="10%">Stock Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lowitems as $i)
                                    <tr>
                                        <td>{{ $i->item_name }}</td>
                                        <td>{{ $i->current_stock }} / {{ $i->initial_stock }}
                                            <div class="progress my-2" style="height: 5px;">
                                                @if($i->percent_stock > 50)
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $i->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                @elseif ($i->percent_stock < 50 and $i->percent_stock > 0)
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $i->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                @elseif ($i->percent_stock == 0)
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

            <div class="col-md-6 col-lg-6 col-xl-4">
                <div class="card">
                    <div class="card-header" id="ttlnoitems">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapsettlnoitems" aria-expanded="false" aria-controls="collapsettlnoitems">
                            <div class="media-body align-self-center">
                                <h4 class="text-primary mb-2"><i class="mdi mdi-alert-circle text-danger"></i> {{ $ttlnoitems }}</h4>
                                <p>Out of Stock Items</p>
                            </div>
                        </button>
                    </div>

                    <div id="collapsettlnoitems" class="collapse" aria-labelledby="ttlnoitems" >
                        <div class="card-body">
                            <table id="noitems-table" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="90%">Items</th>
                                        <th width="10%">Stock Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($noitems as $i)
                                    <tr>
                                        <td>{{ $i->item_name }}</td>
                                        <td>{{ $i->current_stock }} / {{ $i->initial_stock }}
                                            <div class="progress my-2" style="height: 5px;">
                                                @if($i->percent_stock > 50)
                                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $i->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                @elseif ($i->percent_stock < 50 and $i->percent_stock > 0)
                                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ $i->percent_stock }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                                @elseif ($i->percent_stock == 0)
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
        </div>
    </div>

    <div class="row">
        <div class="col-12 text-center p-3">
            <p style="background-color: #6a8f39; color:white;">SUMMARY EXPENSES</p>
        </div>
        <div class="col-md-6 col-lg-6 col-xl-12">
            <div class="card pb-5">
                <div class="card-body" style="height: 300px;">
                    <canvas id="bar-monthly-category"></canvas>
                    <div id='customLegend' class='customLegend'></div>
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
{{-- <script src='{{url('')}}/sleek/theme/assets/js/chart.js'></script> --}}
<script>
    jQuery(document).ready(function() {
        jQuery('#items-table').DataTable({
                pageLength: 4,
                dom: '<"top"f>rt<"bottom"p><"clear">',
        });

        jQuery('#lowitems-table').DataTable({
                pageLength: 4,
                dom: '<"top"f>rt<"bottom"p><"clear">',
        });

        jQuery('#noitems-table').DataTable({
                pageLength: 4,
                dom: '<"top"f>rt<"bottom"p><"clear">',
        });
    });
</script>
<script>
    $(document).ready(function() {

        var acquisition3 = document.getElementById("bar-monthly-category");
        if (acquisition3 !== null) {
        var acChart3 = new Chart(acquisition3, {
            // The type of chart we want to create
            type: "bar",

            // The data for our dataset
            data: {
            labels: @json($barmonthlabel->labels) ,
            datasets: [
                {
                label: "F&B",
                backgroundColor: "rgb(76, 132, 255)",
                borderColor: "rgba(76, 132, 255,0)",
                data: {!!json_encode($barmonthdata->fnb)!!},
                pointBackgroundColor: "rgba(76, 132, 255,0)",
                pointHoverBackgroundColor: "rgba(76, 132, 255,1)",
                pointHoverRadius: 3,
                pointHitRadius: 30
                },
                {
                label: "Housekeeping",
                backgroundColor: "rgb(254, 196, 0)",
                borderColor: "rgba(254, 196, 0,0)",
                data: {!!json_encode($barmonthdata->hk)!!},
                pointBackgroundColor: "rgba(254, 196, 0,0)",
                pointHoverBackgroundColor: "rgba(254, 196, 0,1)",
                pointHoverRadius: 3,
                pointHitRadius: 30
                },
                {
                  label: "Maintenance",
                  backgroundColor: "rgb(41, 204, 151)",
                  borderColor: "rgba(41, 204, 151,0)",
                  data: {!!json_encode($barmonthdata->maintenance)!!},
                  pointBackgroundColor: "rgba(41, 204, 151,0)",
                  pointHoverBackgroundColor: "rgba(41, 204, 151,1)",
                  pointHoverRadius: 3,
                  pointHitRadius: 30
                },
                {
                  label: "Landscape",
                  backgroundColor: "#896def",
                  borderColor: "#8062ed",
                  data: {!!json_encode($barmonthdata->landscape)!!},
                  pointBackgroundColor: "#896def",
                  pointHoverBackgroundColor: "#8062ed",
                  pointHoverRadius: 3,
                  pointHitRadius: 30
                },
                // {
                //   label: "Staff",
                //   backgroundColor: "#fe5461",
                //   borderColor: "#ff3848",
                //   data: {!!json_encode($barmonthdata->staff)!!},
                //   pointBackgroundColor: "#fe5461",
                //   pointHoverBackgroundColor: "#ff3848",
                //   pointHoverRadius: 3,
                //   pointHitRadius: 30
                // },
                // {
                //   label: "Lain-lain",
                //   backgroundColor: "#8a909d",
                //   borderColor: "#6c757d",
                //   data: {!!json_encode($barmonthdata->lain)!!},
                //   pointBackgroundColor: "#8a909d",
                //   pointHoverBackgroundColor: "#6c757d",
                //   pointHoverRadius: 3,
                //   pointHitRadius: 30
                // },
            ]
            },

            // Configuration options go here
            options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                xAxes: [
                {
                    gridLines: {
                    display: false
                    }
                }
                ],
                yAxes: [
                {
                    gridLines: {
                    display: true
                    },
                    ticks: {
                    beginAtZero: true,
                    stepSize: {!!json_encode( $barcategory->stepsize )!!},
                    fontColor: "#8a909d",
                    fontFamily: "Roboto, sans-serif",
                    max: {!!json_encode( $barcategory->max )!!} 
                    }
                }
                ]
            },
            tooltips: {}
            }
        });
        document.getElementById("customLegend").innerHTML = acChart3.generateLegend();
        }
    });
</script>
@endsection