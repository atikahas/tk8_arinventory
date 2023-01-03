@extends('layouts.sleek.main')
@section('activeexpenses', 'active')
@section('expandexpenses', 'expand')
@section('showexpenses', 'show')
@section('summaryexpenses', 'active')

@section('scriptheader')
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.css" rel="stylesheet">
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/responsive.datatables.min.css" rel="stylesheet">
<link href="https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css">
@endsection

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Expenses Summary</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/home') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">expenses</li>
                <li class="breadcrumb-item" aria-current="page">summary expenses</li>
            </ol>
        </nav>
    </div>  

    <div class="row">
        <div class="col-4">
            <div class="card card-default">
                <div class="card-body" style="height: 428px;">
                    <canvas id="polar-category"></canvas>
                </div>
            </div>
        </div>

        <div class="col-8">
            <div class="card card-default">
                <div class="card-body">
                    <table id="ecategory-table" class="table table-sm table-bordered dt-responsive table-hover nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <td width="1%">#</td>
                                <td width="74%">Category</td>
                                <td width="25%">Total Expensed (RM)</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; ?>
                            @foreach ($ecategory as $ec)
                            <?php $count++; ?>
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $ec->category }}</td>
                                <td style="text-align: right;">{{ number_format($ec->sumprice, 2) }}</td>
                            </tr>  
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-12">
          <div class="card card-default">
              <div class="card-body" style="height: 400px;">
                  <canvas id="bar-monthly-category"></canvas>
                  <div id='customLegend' class='customLegend'></div>
              </div>
          </div>
      </div>
    </div>
@endsection

@section('scriptfooter')
<script>
    jQuery(document).ready(function() {
        jQuery('#ecategory-table').DataTable({
            order: [[0, 'asc']],
        });
    });
</script>
<script>
$(document).ready(function() {
    var polar = document.getElementById("polar-category");
    if (polar !== null) {
      var configPolar = {
        data: {
          datasets: [
            {
              data: {!!json_encode($polarcategory->dataset)!!} ,
              backgroundColor: [
                "rgba(41,204,151,0.5)",
                "rgba(254,88,101,0.5)",
                "rgba(128,97,239,0.5)",
                "rgba(254,196,0,0.5)",
                "rgba(76,132,255,0.5)",
              ],
              label: "" // for legend
            }
          ],
          labels: {!!json_encode($polarcategory->labels)!!} 
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          legend: {
            position: "right",
            display: false
          },
          layout: {
            padding: {
              top: 10,
              bottom: 10,
              right: 10,
              left: 10
            }
          },
          title: {
            display: false,
            text: "Chart.js Polar Area Chart"
          },
          scale: {
            ticks: {
              beginAtZero: true,
              fontColor: "#1b223c",
              fontSize: 12,
              stepSize: {!!json_encode( $polarcategory->stepsize )!!},
              max: {!!json_encode( $polarcategory->max )!!} 
            },
            reverse: false
          },
          animation: {
            animateRotate: false,
            animateScale: true
          },
          tooltips: {
            titleFontColor: "#888",
            bodyFontColor: "#555",
            titleFontSize: 12,
            bodyFontSize: 14,
            backgroundColor: "rgba(256,256,256,0.95)",
            displayColors: true,
            borderColor: "rgba(220, 220, 220, 0.9)",
            borderWidth: 2
          }
        }
      };
      window.myPolarArea = Chart.PolarArea(polar, configPolar);
    }

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
            label: "Cutleries",
            backgroundColor: "rgb(76, 132, 255)",
            borderColor: "rgba(76, 132, 255,0)",
            data: {!!json_encode($barmonthdata->cutleries)!!},
            pointBackgroundColor: "rgba(76, 132, 255,0)",
            pointHoverBackgroundColor: "rgba(76, 132, 255,1)",
            pointHoverRadius: 3,
            pointHitRadius: 30
          },
          {
            label: "Maintenance",
            backgroundColor: "rgb(254, 196, 0)",
            borderColor: "rgba(254, 196, 0,0)",
            data: {!!json_encode($barmonthdata->maintenance)!!},
            pointBackgroundColor: "rgba(254, 196, 0,0)",
            pointHoverBackgroundColor: "rgba(254, 196, 0,1)",
            pointHoverRadius: 3,
            pointHitRadius: 30
          },
          // {
          //   label: "Social",
          //   backgroundColor: "rgb(41, 204, 151)",
          //   borderColor: "rgba(41, 204, 151,0)",
          //   data: [103, 135, 102, 116, 83, 97, 55],
          //   pointBackgroundColor: "rgba(41, 204, 151,0)",
          //   pointHoverBackgroundColor: "rgba(41, 204, 151,1)",
          //   pointHoverRadius: 3,
          //   pointHitRadius: 30
          // }
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
                stepSize: {!!json_encode( $polarcategory->stepsize )!!},
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                max: {!!json_encode( $polarcategory->max )!!} 
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
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/jquery.datatables.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.responsive.min.js"></script>
<script src='{{url('')}}/sleek/theme/assets/plugins/charts/Chart.min.js'></script>
@endsection