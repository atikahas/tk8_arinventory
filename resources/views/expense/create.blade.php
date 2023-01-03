@extends('layouts.sleek.main')
@section('activeexpenses', 'active')
@section('expandexpenses', 'expand')
@section('showexpenses', 'show')
@section('addexpenses', 'active')

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Expenses Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">expenses</li>
                <li class="breadcrumb-item" aria-current="page">add expenses</li>
            </ol>
        </nav>
    </div> 

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-body">
                    <form method="POST" action="" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-5 mb-3 form-group">
                                <label for="name">Item Name</label>
                                <input type="text" class="form-control expenses-name" name="item_name" placeholder="Enter item name">
                            </div>
                            <div class="col-5 mb-3 form-group">
                                <label for="name">Shop Name</label>
                                <input type="text" class="form-control expenses-shop" name="item_shop" placeholder="Enter shop name">
                            </div>
                            <div class="col-2 mb-3 form-group">
                                <label for="name">Date Purchased</label>
                                <input type="date" class="form-control expenses-date" name="purchase_date">
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>Description</label>
                            <textarea class="form-control expenses-description" name="item_description" rows="2" placeholder="Enter item description"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3 form-group">
                                <label>Category</label>
                                <select class="form-control expenses-category" name="category_id"></select>
                            </div>
                            <div class="col-6 mb-3 form-group">
                                <label>SubCategory</label>
                                <select class="form-control expenses-subcategory" name="subcategory_id"></select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3 form-group">
                                <label>Size / Weight</label>
                                <input type="text" class="form-control expenses-size" name="size" placeholder="00.00">
                            </div>
                            <div class="col-6 mb-3 form-group">
                                <label>Unit</label>
                                <input type="text" class="form-control expenses-unit" name="unit" placeholder="g, kg, sachet, pcs, pack, l, ml, ...">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3 form-group">
                                <label>Quantity</label>
                                <input type="number" class="form-control expenses-qty" name="quantity" placeholder="0">
                            </div>
                            <div class="col-6 mb-3 form-group">
                                <label>Total Price (RM)</label>
                                <input type="text" class="form-control expenses-price" name="total_price" placeholder="00.00">
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <button type="button" class="btn btn-primary" onclick="addExpenses();"><i class="mdi mdi-plus"></i> ADD INFO</button>
                        </div>
                        <div class="mb-3 form-group">
                            <table class="table table-responsive table-bordered table-expenses">
                                <tr style="background-color:#ececec;">
                                    <td width="15%">Name</td>
                                    <td width="20%">Description</td>
                                    <td width="10%">Category</td>
                                    <td width="10%">SubCategory</td>
                                    <td width="10%">Date</td>
                                    <td width="15%">Shop Name</td>
                                    <td width="5%">Size/Weight(Unit)</td>
                                    <td width="5%">Quantity</td>
                                    <td width="5%">Price (RM)</td>
                                    <td width="5%">Option</td>
                                </tr>
                            </table>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary"><i class="mdi mdi-content-save-outline"></i> SAVE INFO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptfooter')
    <script>
        $(document).ready(function() {
            getCategoryExpenses();
        });

        $(document).on("change", "select[name=category_id]", function() {
            var category_id = $(this).val();
            getSubCategory(category_id);
        });

        function getCategoryExpenses() {
            $.ajax({
                url: "{{url('data/getCategoryExpenses')}}",
                type: "GET",
                success: function(response) {
                    var category_id = '';
                    $.each(response, function(index,value) {
                        category_id += '<option value="'+value.id+'">'+value.name+'</option>'
                    });
                    $("select[name=category_id]").html('<option value="">-- Select Category --</option>' + category_id);
                }
            });
        }

        function getSubCategory(category_id) {
            $.ajax({
                url: "{{url('data/getSubCategory')}}",
                type: "GET",
                data: "category_id=" + category_id,
                success: function(response) {
                    var subcategory_id = '';
                    $.each(response, function(index,value) {
                        subcategory_id += '<option value="'+value.id+'">'+value.name+'</option>'
                    });
                    $("select[name=subcategory_id]").html('<option value="">-- Select SubCategory --</option>' + subcategory_id);
                }
            });
        }
    </script>
    <script>
        var count_expenses = 0;
    
        $(document).on("click", ".btn-delete-expenses", function() {
            $(this).parents("tr").remove();
        });
    
        function addExpenses() {
            var expenses_name = $(".expenses-name").val();
            var expenses_description = $(".expenses-description").val();
            var expenses_category = $(".expenses-category").val();
            var expenses_subcategory = $(".expenses-subcategory").val();
            var expenses_shop = $(".expenses-shop").val();
            var expenses_size = $(".expenses-size").val();
            var expenses_unit = $(".expenses-unit").val();
            var expenses_qty = $(".expenses-qty").val();
            var expenses_price = $(".expenses-price").val();
            var expenses_date = $(".expenses-date").val();
    
            count_expenses++;
    
            $(".table-expenses").find("tbody").append(
                '<tr>'+
                    '<td>'+expenses_name+'</td>'+
                    '<td>'+expenses_description+'</td>'+
                    '<td>'+expenses_category+'</td>'+
                    '<td>'+expenses_subcategory+'</td>'+
                    '<td>'+expenses_date+'</td>'+
                    '<td>'+expenses_shop+'</td>'+
                    '<td>'+expenses_size+' ('+expenses_unit+')'+'</td>'+
                    '<td>'+expenses_qty+'</td>'+
                    '<td>'+expenses_price+'</td>'+
                    '<td>'+
                        '<div class="text-center">'+
                        '<button class="btn btn-danger btn-xs btn-delete-expenses"><i class="mdi mdi-trash-can"></i></button>'+
                        '<input type="hidden" name="expenses['+count_expenses+'][item_name]" value="'+expenses_name+'">'+
                        '<input type="hidden" name="expenses['+count_expenses+'][item_description]" value="'+expenses_description+'">'+
                        '<input type="hidden" name="expenses['+count_expenses+'][category_id]" value="'+expenses_category+'">'+
                        '<input type="hidden" name="expenses['+count_expenses+'][subcategory_id]" value="'+expenses_subcategory+'">'+
                        '<input type="hidden" name="expenses['+count_expenses+'][purchase_date]" value="'+expenses_date+'">'+
                        '<input type="hidden" name="expenses['+count_expenses+'][item_shop]" value="'+expenses_shop+'">'+
                        '<input type="hidden" name="expenses['+count_expenses+'][size]" value="'+expenses_size+'">'+
                        '<input type="hidden" name="expenses['+count_expenses+'][unit]" value="'+expenses_unit+'">'+
                        '<input type="hidden" name="expenses['+count_expenses+'][quantity]" value="'+expenses_qty+'">'+
                        '<input type="hidden" name="expenses['+count_expenses+'][total_price]" value="'+expenses_price+'">'+
                        '</div>'+
                    '</td>'+
                '</tr>'
            )
        }
    </script>
@endsection