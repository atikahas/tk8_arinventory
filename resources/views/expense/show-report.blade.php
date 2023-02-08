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
  <div class="col-12 pb-2">
  <a class="btn btn-primary float-right" onclick="printDiv('printableArea')">Print <i class="mdi mdi-printer"></i></a>
  </div>
</div>
<div class="row">
    <div class="col-12">
      <div class="card card-default">
          <div class="card-body" id="printableArea">
            <h3>{{ $expenses->title }}</h3>
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td width="15%">Category</td>
                    <td width="70%">Item</td>
                    <td width="15%">Total Price (RM)</td>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $expensescategory as $ec )
                  <tr>
                    <td>{{ $ec->category }}</td>
                    <td>
                        <table class="table table-bordered">
                          <thead>
                            <tr>
                              <td width="15%">SubCategory</td>
                              <td width="62%">Item</td>
                              <td width="10%">Quantity</td>
                              <td width="18%">Price (RM)</td>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ( $expensessubcategory as $es)
                            @if ( $ec->category == $es->category)
                            <tr>
                              <td>{{ $es->subcategory }}</td>
                              <td>
                                  @foreach ( $expensesitem as $el )
                                    @if ($es->subcategory == $el->subcategory)
                                      {{ $el->item_name }}<br>
                                    @endif
                                  @endforeach
                              </td>
                              <td>
                                  @foreach ( $expensesitem as $el )
                                    @if ($es->subcategory == $el->subcategory)
                                      {{ $el->totalquantity }} <br>
                                    @endif
                                  @endforeach
                              </td>
                              <td style="text-align: right">
                                  @foreach ( $expensesitem as $el )
                                    @if ($es->subcategory == $el->subcategory)
                                      {{ number_format($el->sumprice, 2) }}<br>
                                    @endif
                                  @endforeach
                              </td>
                            </tr>
                            @endif
                            @endforeach
                          </tbody>
                        </table>
                    </td>
                    <td style="text-align:right">
                      @foreach ( $expensetotal as $et )
                        @if ($ec->category == $et->category)
                        {{ number_format($et->sumprice, 2) }}
                        @endif
                      @endforeach
                    </td>
                  </tr>
                  @endforeach
                  <tr>
                    <td colspan="2">Total</td>
                    <td style="text-align:right">
                      @foreach ( $expensesum as  $sum)
                      {{ number_format($sum->sumprice, 2) }}
                      @endforeach
                    </td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
      </div>
</div>
@endsection

@section('scriptheader')
<style>
  @media print {
    html, body {
        height: auto;
        font-size: 18px; /* changing to 10pt has no impact */
    }

}
</style>
@endsection


@section('scriptfooter')
<script>
  function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection