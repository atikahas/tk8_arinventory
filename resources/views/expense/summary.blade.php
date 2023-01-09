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
      <div class="col-12">
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
<script src="https://unpkg.com/popper.js/dist/umd/popper.min.js"></script>
<script src="https://unpkg.com/tooltip.js/dist/umd/tooltip.min.js"></script>

<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/jquery.datatables.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.responsive.min.js"></script>
<script src='{{url('')}}/sleek/theme/assets/plugins/charts/Chart.min.js'></script>
@endsection