@extends('layouts.sleek.main')
@section('activeitems', 'active')
@section('expanditems', 'expand')
@section('showitems', 'show')
@section('additems', 'active')

@section('content')
    <div class="breadcrumb-wrapper">
        <h1>Items Management</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb p-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/') }}"><span class="mdi mdi-home"></span></a>
                </li>
                <li class="breadcrumb-item">items</li>
                <li class="breadcrumb-item" aria-current="page">add items</li>
            </ol>
        </nav>
    </div> 

    <div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-body">
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3 form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="item_name" placeholder="Enter item name" required>
                        </div>
                        <div class="mb-3 form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="item_description" rows="3" placeholder="Enter item description"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-4 mb-3 form-group">
                                <label>Category</label>
                                <select class="form-control" name="category_id" required></select>
                            </div>
                            <div class="col-4 mb-3 form-group">
                                <label>SubCategory</label>
                                <select class="form-control" name="subcategory_id" required></select>
                            </div>
                            <div class="col-4 mb-3 form-group">
                                <label>Location</label>
                                <select class="form-control" name="location_id" required></select>
                            </div>
                        </div>
                        <div class="mb-3 form-group">
                            <label>Image</label>
                            <input type="file" class="form-control form-control-file" name="item_image">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3 form-group">
                                <label>Current Stock</label>
                                <input type="number" min="0" class="form-control" name="current_stock" placeholder="Enter current quantity" required>
                            </div>
                            <div class="col-6 mb-3 form-group">
                                <label>Initial Stock</label>
                                <input type="number" min="0" class="form-control" name="initial_stock" placeholder="Enter initial quantity" required>
                            </div>
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Save Item</button>
                        <a href="{{ route('items.index') }}" class="btn btn-default">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scriptfooter')
    <script>
        $(document).ready(function() {
            getCategory();
            getLocation();
        });

        $(document).on("change", "select[name=category_id]", function() {
            var category_id = $(this).val();
            getSubCategory(category_id);
        });

        function getCategory() {
            $.ajax({
                url: "{{url('data/getCategory')}}",
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

        function getLocation() {
            $.ajax({
                url: "{{url('data/getLocation')}}",
                type: "GET",
                success: function(response) {
                    console.log(response);
                    var location_id = '';
                    $.each(response, function(index,value) {
                        location_id += '<option value="'+value.id+'">'+value.name+'</option>'
                    });
                    $("select[name=location_id]").html('<option value="">-- Select Location --</option>' + location_id);
                }
            });
        }
    
    </script>
@endsection