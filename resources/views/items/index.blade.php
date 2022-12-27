@extends('layouts.sleek.main')
@section('activeitems', 'active')
@section('expanditems', 'expand')
@section('showitems', 'show')
@section('listitems', 'active')

@section('scriptheader')
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.css" rel="stylesheet">
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/responsive.datatables.min.css" rel="stylesheet">
<link href="https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css">
@endsection

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Items Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/home') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">items</li>
                <li class="breadcrumb-item" aria-current="page">list items</li>
            </ol>
        </nav>
    </div>  

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-body">
                    <a href="{{ route('users.create') }}" class="btn btn-outline-primary btn-sm text-uppercase float-right">
                        <i class=" mdi mdi-plus"></i> Add New Item
                    </a>
                    <table id="items-table" class="table dt-responsive table-hover nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Quantity</th>
                                <th width="5%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $i)
                                <tr>
                                    <td>{{ $i->item_name }}</td>
                                    <td>{{ $i->category }}</td>
                                    <td>{{ $i->location }}</td>
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
                                    </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-sm btn-primary" href="#" target=_blank><i class="mdi mdi-eye"></i></a>
                                        <a class="btn btn-sm btn-secondary" href="#"><i class="mdi mdi-square-edit-outline"></i></a>
                                        <button class="btn btn-sm btn-danger" onclick="deleteItem('{{$i->id}}')"><i class="mdi mdi-trash-can-outline"></i></button> 
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
        jQuery('#items-table').DataTable();
    });
</script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/jquery.datatables.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.responsive.min.js"></script>
@endsection