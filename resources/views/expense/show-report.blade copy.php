@extends('layouts.sleek.main')
@section('activeexpenses', 'active')
@section('expandexpenses', 'expand')
@section('showexpenses', 'show')
@section('reportexpenses', 'active')

@section('content')
<div class="breadcrumb-wrapper">
    <h1>Expenses Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-0">
            <li class="breadcrumb-item">
                <a href="{{ url('/home') }}"><span class="mdi mdi-home"></span></a>
            </li>
            <li class="breadcrumb-item">expenses</li>
            <li class="breadcrumb-item" aria-current="page">report expenses</li>
        </ol>
    </nav>
</div>  

<div class="row">
    <div class="col-12">
      <div class="card card-default">
          <div class="card-body">
            {{ $expenses->title }}
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td>Category</td>
                    <td>SubCategory</td>
                    <td>Item</td>
                    <td>Total Price</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $expenseslist as $el )
                  <tr>
                    <td>{{ $el->category }}</td>
                    <td>{{ $el->subcategory }}</td>
                    <td>
                      {{ $el->item_name }}
                      <br>
                      {{ $el->item_description }}
                    </td>
                    <td>{{ $el->total_price }}</td>
                  </tr>
                  @endforeach
                </tbody>
                
              </table>
          </div>
        </div>
      </div>
</div>
@endsection