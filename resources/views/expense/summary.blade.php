@extends('layouts.sleek.main')
@section('activeexpenses', 'active')
@section('expandexpenses', 'expand')
@section('showexpenses', 'show')
@section('summaryexpenses', 'active')

@section('scriptheader')
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.css" rel="stylesheet">
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/responsive.datatables.min.css" rel="stylesheet">
<link href="https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css">
<link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/core-4.3.1/main.min.css" rel="stylesheet">
<link href="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/daygrid-4.3.0/main.min.css" rel="stylesheet">
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
        <div class="col-8">
          <div class="card card-default">
              <div class="card-body">
                  <div id="calendar"></div>
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
<script src="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/core-4.3.1/main.min.js"></script>
<script src="{{url('')}}/sleek/theme/assets/plugins/fullcalendar/daygrid-4.3.0/main.min.js"></script>
{{-- <script src="{{url('')}}/sleek/source/js/app.calendar.js"></script> --}}
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>

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

    eventRender: function(info) {
      var tooltip = new Tooltip(info.el, {
        title: info.event.extendedProps.description,
        placement: 'top',
        trigger: 'hover',
        container: 'body'
      });
    },

    events: [
        {
          title: 'All Day Event',
          description: 'description for All Day Event',
          start: year+'-'+month+'-01'
        },
        {
          title: 'All Day Event',
          description: 'description for All Day Event',
          start: year+'-'+month+'-03'
        },
        {
          title: 'All Day Event',
          description: 'description for All Day Event',
          start: year+'-'+month+'-05'
        },
        {
          title: 'Long Event',
          description: 'description for Long Event',
          start: year+'-'+month+'-07',
          end: year+'-'+month+'-10'
        },
        {
          groupId: '999',
          title: 'Repeating Event',
          description: 'description for Repeating Event',
          start: year+'-'+month+'-09T16:00:00'
        },
        {
          groupId: '999',
          title: 'Repeating Event',
          description: 'description for Repeating Event',
          start: year+'-'+month+'-16T16:00:00',
          end: year+'-'+month+'-16T16:00:00'
        },
        {
          title: 'Conference',
          description: 'description for Conference',
          start: year+'-'+month+'-11',
          end: year+'-'+month+'-13'
        },
        {
          title: 'Meeting',
          description: 'description for Meeting',
          start: year+'-'+month+'-12T10:30:00',
          end: year+'-'+month+'-12T12:30:00'
        },
        {
          title: 'Lunch',
          description: 'description for Lunch',
          start: year+'-'+month+'-12T12:00:00',
          end: year+'-'+month+'-12T12:00:00'
        },
        {
          title: 'Meeting',
          description: 'description for Meeting',
          start: year+'-'+month+'-12T14:30:00',
          end: year+'-'+month+'-12T14:30:00'
        },
        {
          title: 'Birthday Party',
          description: 'description for Birthday Party',
          start: year+'-'+month+'-13T24:00:00',
          end: year+'-'+month+'-13T24:00:00'
        },
        {
          title: 'Long Event',
          description: 'description for Long Event',
          start: year+'-'+month+'-20',
          end: year+'-'+month+'-23'
        },
        {
          groupId: '999',
          title: 'Repeating Event',
          description: 'description for Repeating Event',
          start: year+'-'+month+'-22T16:00:00'
        },
        {
          title: 'Conference',
          description: 'description for Conference',
          start: year+'-'+month+'-24',
          end: year+'-'+month+'-27'
        },
        {
          title: 'Meeting',
          description: 'description for Meeting',
          start: year+'-'+month+'-26T10:30:00',
          end: year+'-'+month+'-26T12:30:00'
        },
        {
          title: 'Lunch',
          description: 'description for Lunch',
          start: year+'-'+month+'-26T12:00:00',
          end: year+'-'+month+'-26T12:00:00'
        },
        {
          title: 'Meeting',
          description: 'description for Meeting',
          start: year+'-'+month+'-26T14:30:00',
          end: year+'-'+month+'-26T14:30:00'
        },
        {
          title: 'Click for Google',
          description: 'description for Click for Google',
          url: 'http://google.com/',
          start: year+'-'+month+'-28',
          end: year+'-'+month+'-28'
        },
        {
          title: 'Lunch',
          description: 'description for Lunch',
          start: year+'-'+month+'-30T12:00:00',
          end: year+'-'+month+'-31T12:00:00'
        },
        {
          title: 'Meeting',
          description: 'description for Meeting',
          start: year+'-'+month+'-31T14:30:00',
          end: year+'-'+month+'-31T14:30:00'
        }
      ]
  });

  calendar.render();
});
</script>
@endsection