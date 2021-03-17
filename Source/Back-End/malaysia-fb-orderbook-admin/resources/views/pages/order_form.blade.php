@extends('layouts.app')

@section('page_title', 'Orders')

@section('body_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $editMode ? 'Edit' : 'New' }} Order</h6>
        </div>
        <div class="card-body">
            <form name="EntryForm" method="post" action="/order/save" onsubmit="return validateForm();">
                @csrf
                <input type="hidden" name="id" value="{{ $editMode ? $data->id : 0 }}"/>
                <div class="form-group">
                    <label>Order Name</label>
                    <input type="text" class="form-control" name="order_name" placeholder="Order Name"
                           value="{{ $editMode ? $data->name : '' }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const name = document.forms['EntryForm']['order_name'].value;

            if (name.trim() === '') {
                alert("Please enter order name!");
                return false;
            }

            return true;
        }
    </script>
@endsection
