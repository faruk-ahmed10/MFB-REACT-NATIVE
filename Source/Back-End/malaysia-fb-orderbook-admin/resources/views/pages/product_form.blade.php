@extends('layouts.app')

@section('page_title', 'Products')

@section('body_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $editMode ? 'Edit' : 'New' }} Product</h6>
        </div>
        <div class="card-body">
            <form name="EntryForm" enctype="multipart/form-data" method="post" action="/product/save" onsubmit="return validateForm();">
                @csrf
                <input type="hidden" name="id" value="{{ $editMode ? $data->id : 0 }}"/>
                <div class="form-group">
                    <label>Product Category</label>
                    <select type="text" class="form-control" name="product_category">
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option
                                value="{{ $category->id }}" {{ $editMode ? $category->id == $data->category_id ? 'selected' : '' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name" placeholder="Product Name"
                           value="{{ $editMode ? $data->name : '' }}"/>
                </div>

                <div class="form-group">
                    <label>Product Description</label>
                    <textarea class="form-control" name="product_description"
                              placeholder="Product Description">{{ $editMode ? $data->description : '' }}</textarea>
                </div>

                <div class="form-group">
                    <label>Product Price</label>
                    <input type="text" class="form-control" name="product_price" placeholder="Product Price"
                           value="{{ $editMode ? $data->price : '' }}"/>
                </div>

                <div class="form-group">
                    <label>Product Image</label>
                    <input type="file" class="form-control" name="product_image"/>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const category_id = document.forms['EntryForm']['product_category'].value;
            const name = document.forms['EntryForm']['product_name'].value;
            const description = document.forms['EntryForm']['product_description'].value;
            const price = document.forms['EntryForm']['product_price'].value;

            if (Number(category_id) === 0) {
                alert("Please select a product category!");
                return false;
            }

            if (name.trim() === '') {
                alert("Please enter product name!");
                return false;
            }

            if (Number(price) < 1 || isNaN(Number(price))) {
                alert("Please enter product price!");
                return false;
            }

            return true;
        }
    </script>
@endsection
