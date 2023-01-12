@extends('layouts.sleek.main')
@section('activeexpenses', 'active')
@section('expandexpenses', 'expand')
@section('showexpenses', 'show')
@section('listexpenses', 'active')

@section('scriptheader')
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.css" rel="stylesheet">
<link href="{{url('')}}/sleek/source/assets/plugins/data-tables/responsive.datatables.min.css" rel="stylesheet">
<link href="https://unpkg.com/sleek-dashboard/dist/assets/css/sleek.min.css">
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
                <li class="breadcrumb-item" aria-current="page">list expenses</li>
            </ol>
        </nav>
    </div>  

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-body">
                    <a href="{{ route('expenses.create') }}" class="btn btn-outline-primary btn-sm text-uppercase float-right">
                        <i class=" mdi mdi-plus"></i> Add New Expenses
                    </a>
                    <table id="items-table" class="table dt-responsive table-hover nowrap" style="width:100%;">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Item Details</th>
                                <th>Category</th>
                                <th>Quantity</th>
                                <th>Price(RM)</th>
                                <th width="5%">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($expenses as $e)
                                <tr>
                                    <td>{{ $e->purchase_date }}</td>
                                    <td>
                                        <b style="color: black;">{{ $e->item_name }}</b><br>
                                        @if ($e->size == null)
                                        @else
                                        - {{ $e->size }} {{ $e->unit }}<br>
                                        @endif
                                        - {{ $e->item_description }}<br>
                                    </td>
                                    <td>{{ $e->category }} ( {{ $e->subcategory }} )</td>
                                    <td style="text-align: right;">{{ $e->quantity }}</td>
                                    <td style="text-align: right;">{{ number_format($e->total_price, 2) }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-secondary" href="{{url('expenses/edit/'.$e->id.'?category='.$e->category.'&subcategory='.$e->subcategory.'&item_name='.$e->item_name)}}"><i class="mdi mdi-square-edit-outline"></i></a>
                                        <a href="javascript:;" class="btn btn-sm btn-danger" onclick="deleteItem('{{$e->id}}')"><i class="mdi mdi-trash-can-outline"></i></a>
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
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">  
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script>
    function deleteItem(id) {
        $.confirm({
            title: 'Delete Item',
            content: 'Are you sure want to delete this item?',
            buttons: {
                cancel: function () {
                    
                },
                somethingElse: {
                    text: 'DELETE',
                    btnClass: 'btn-red',
                    keys: ['enter', 'shift'],
                    action: function(){
                        $.ajax({
                            url: "{{url('')}}/expenses/delete/" + id,
                            type: "POST",
                            data: "_token={{csrf_token()}}",
                            success: function(response) {
                                if(response.status == 'success') {
                                    toastr.success('success', response.message);
                                    location.reload();
                                } else {
                                    toastr.danger('danger', response.message);
                                }
                            },
                            error: function(response) {
                                toastr.danger('danger', response.message);
                            }
                        });
                    }
                }
            }
        });
    }
</script>
<script>
    jQuery(document).ready(function() {
        jQuery('#items-table').DataTable({
            order: [[0, 'desc']],
        });
    });
</script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/jquery.datatables.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.bootstrap4.min.js"></script>
<script src="{{url('')}}/sleek/source/assets/plugins/data-tables/datatables.responsive.min.js"></script>
@endsection