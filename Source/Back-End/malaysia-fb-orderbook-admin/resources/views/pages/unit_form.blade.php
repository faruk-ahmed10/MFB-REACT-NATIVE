@extends('layouts.app')

@section('page_title', 'Units')

@section('body_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $editMode ? 'Edit' : 'New' }} Unit</h6>
        </div>
        <div class="card-body">
            <form name="EntryForm" method="post" action="/unit/save" onsubmit="return validateForm();">
                @csrf
                <input type="hidden" name="id" value="{{ $editMode ? $data->id : 0 }}"/>
                <div class="form-group">
                    <label>Unit Name</label>
                    <input type="text" class="form-control" name="unit_name" placeholder="Unit Name"
                           value="{{ $editMode ? $data->name : '' }}"/>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const name = document.forms['EntryForm']['unit_name'].value;

            if (name.trim() === '') {
                alert("Please enter unit name!");
                return false;
            }

            return true;
        }
    </script>
@endsection
