@extends('layouts.sleek.main')
@section('activeexpenses', 'active')
@section('expandexpenses', 'expand')
@section('showexpenses', 'show')
@section('reportexpenses', 'active')

@section('scriptheader')
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.css" rel="stylesheet">
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/responsive.datatables.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="breadcrumb-wrapper">
    <h1>Expenses Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}"><span class="mdi mdi-home"></span></a>
            </li>
            <li class="breadcrumb-item">expenses</li>
            <li class="breadcrumb-item" aria-current="page">list report expenses</li>
        </ol>
    </nav>
</div>   

<div class="row">
    <div class="col-12">
      <div class="card card-default">
          <div class="card-body">
            <a href="{{ route('expenses.create.report') }}" class="btn btn-outline-primary btn-sm text-uppercase float-right">
                <i class=" mdi mdi-plus"></i> Create Report
            </a>
            <table id="report-table" class="table dt-responsive table-hover nowrap" style="width:100%;">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Month</th>
                        <th>Year</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ( $expenses as $er )
                        <tr>
                            <td>{{ $er->title }}</td>
                            <td>{{ $er->monthno }}</td>
                            <td>{{ $er->year }}</td>
                            <td>
                                <a class="btn btn-sm btn-success" href="{{ route('expenses.report.show', $er->id) }}"><i class="mdi mdi-eye"></i></a>
                            </td>
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
        jQuery('#report-table').DataTable({
            order: [[0, 'desc']],
        });
    });
</script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/jquery.datatables.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.responsive.min.js"></script>
@endsection