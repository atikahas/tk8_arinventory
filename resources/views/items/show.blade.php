@extends('layouts.sleek.main')
@section('activeitems', 'active')
@section('expanditems', 'expand')
@section('showitems', 'show')
@section('listitems', 'active')

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Items Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">items</li>
                <li class="breadcrumb-item" aria-current="page">view items</li>
            </ol>
        </nav>
    </div> 

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <td width="20%" rowspan="6"></td>
                            <td width="10%" style="color:black;">Item Name</td>
                            <td width="70%">: {{ $item->item_name }}</td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td>: {{ $item->item_description }}</td>
                        </tr> 
                        <tr>
                            <td>Category</td>
                            <td>: {{ $item->Category->name }}</td>
                        </tr>
                        <tr>
                            <td>SubCategory</td>
                            <td>: {{ $item->SubCategory->name }}</td>
                        </tr>
                        <tr>
                            <td>Location</td>
                            <td>: {{ $item->Location->name }}</td>
                        </tr>
                        <tr>
                            <td>Quantity</td>
                            <td>: 
                                {{ $item->current_stock }} / {{ $item->initial_stock }}
                                <div class="progress my-2" style="height: 5px;">
                                @if((($item->current_stock /  $item->initial_stock)*100 ) > 50)
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($item->current_stock /  $item->initial_stock)*100  }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                @elseif ((($item->current_stock /  $item->initial_stock)*100 ) < 50 and (($item->current_stock /  $item->initial_stock)*100 ) > 0)
                                <div class="progress-bar bg-danger" role="progressbar" style="width: {{ ($item->current_stock /  $item->initial_stock)*100  }}%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                @elseif ((($item->current_stock /  $item->initial_stock)*100 ) == 0)
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 2%;" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                                @endif
                                </div>
                            
                            </td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptfooter')
@endsection