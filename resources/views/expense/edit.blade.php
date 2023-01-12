@extends('layouts.sleek.main')
@section('activeexpenses', 'active')
@section('expandexpenses', 'expand')
@section('showexpenses', 'show')
@section('listexpenses', 'active')

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Expenses Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">expenses</li>
                <li class="breadcrumb-item" aria-current="page">edit expense</li>
            </ol>
        </nav>
    </div> 

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-body">
                    <form method="POST" action="{{ route('expenses.update', $expense->id) }}" enctype="multipart/form-data">
                        @method('patch')
                        @csrf
                        <div class="row">
                            <div class="col-6 mb-3 form-group">
                                <label>Category</label>
                                <select class="form-control expenses-category" name="category"></select>
                            </div>
                            <div class="col-6 mb-3 form-group">
                                <label>SubCategory</label>
                                <select class="form-control expenses-subcategory" name="subcategory"></select>
                            </div>
                            <div class="col-12 mb-3 form-group">
                                <label>Item Name</label>
                                <select class="form-control expenses-name" name="item_name"></select>
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>Description</label>
                            <textarea class="form-control expenses-description" name="item_description" rows="2" placeholder="Enter item description">{{ $expense->item_description }}</textarea>
                        </div>
                        <div class="row">
                            <div class="col-8 mb-3 form-group">
                                <label for="name">Shop Name</label>
                                <input type="text" class="form-control expenses-shop" name="item_shop" placeholder="Enter shop name" value="{{ $expense->item_shop }}">
                            </div>
                            <div class="col-4 mb-3 form-group">
                                <label for="name">Date Purchased</label>
                                <input type="date" class="form-control expenses-date" name="purchase_date" value="{{date('Y-m-d', strtotime($expense->purchase_date))}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3 form-group">
                                <label>Size / Weight</label>
                                <input type="text" class="form-control expenses-size" name="size" placeholder="00.00" value="{{ $expense->size }}">
                            </div>
                            <div class="col-6 mb-3 form-group">
                                <label>Unit</label>
                                <input type="text" class="form-control expenses-unit" name="unit" placeholder="g, kg, sachet, pcs, pack, l, ml, ..." value="{{ $expense->unit }}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3 form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control expenses-qty" name="quantity" placeholder="0" value="{{ $expense->quantity }}">
                            </div>
                            <div class="col-6 mb-3 form-group">
                                <label>Total Price (RM)</label>
                                <input type="text" class="form-control expenses-price" name="total_price" placeholder="00.00" value="{{ $expense->total_price }}">
                            </div>
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('expenses.index') }}" class="btn btn-default">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptfooter')
<script>
       $(document).ready(function() {
        getExpenseCategory();
        
        @if(isset($_GET['category']))
        getExpenseSubCategory("{{$_GET['category']}}");
        @endif

        @if(isset($_GET['item_name']))
        getExpenseName("{{$_GET['category']}}", "{{$_GET['subcategory']}}");
        @endif
    });
    
    $(document).on("change", "select[name=category]", function() {
        var category = $(this).val();
        getExpenseSubCategory(category);
    });

    $(document).on("change", "select[name=subcategory]", function() {
        var category = $("select[name=category]").val();
        var subcategory = $(this).val();
        getExpenseName(category,subcategory);
    });

    function getExpenseCategory() {
        $.ajax({
            url: "{{url('data/getExpenseCategory')}}",
            type: "GET",
            success: function(response) {
                var category = '';
                $.each(response, function(index,value) {
                    category += '<option value="'+value.name+'">'+value.name+'</option>'
                });
                $("select[name=category]").html('<option value="">-- Select Category --</option>' + category);
                @if(isset($_GET['category']))
                $("select[name=category]").val("{{$_GET['category']}}");
                @endif
            }
        });
    }

    function getExpenseSubCategory(category) {
        $.ajax({
            url: "{{url('data/getExpenseSubCategory')}}",
            type: "GET",
            data: "category=" + category,
            success: function(response) {
                var subcategory = '';
                $.each(response, function(index,value) {
                    subcategory += '<option value="'+value.name+'">'+value.name+'</option>'
                });
                $("select[name=subcategory]").html('<option value="">-- Select SubCategory --</option>' + subcategory);
                @if(isset($_GET['subcategory']))
                $("select[name=subcategory]").val("{{$_GET['subcategory']}}");
                @endif
            }
        });
    }

    function getExpenseName(category, subcategory) {
        $.ajax({
            url: "{{url('data/getExpenseName')}}",
            type: "GET",
            data: "category=" + category + "&subcategory=" + subcategory,
            success: function(response) {
                var item_name = '';
                $.each(response, function(index,value) {
                    item_name += '<option value="'+value.name+'">'+value.name+'</option>'
                });
                $("select[name=item_name]").html('<option value="">-- Select Item --</option>' + item_name);
                @if(isset($_GET['item_name']))
                $("select[name=item_name]").val("{{$_GET['item_name']}}");
                @endif
            }
        });
    }

</script>
@endsection