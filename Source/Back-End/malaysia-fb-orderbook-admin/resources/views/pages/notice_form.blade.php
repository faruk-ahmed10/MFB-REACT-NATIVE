@extends('layouts.app')

@section('page_title', 'Notices')

@section('body_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $editMode ? 'Edit' : 'New' }} Notice</h6>
        </div>
        <div class="card-body">
            <form name="EntryForm" method="post" action="/notice/save" onsubmit="return validateForm();">
                @csrf
                <input type="hidden" name="id" value="{{ $editMode ? $data->id : 0 }}"/>
                <div class="form-group">
                    <label>Notice Text</label>
                    <textarea type="text" class="form-control" name="notice_text" placeholder="Notice Text">{{ $editMode ? $data->text : '' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const name = document.forms['EntryForm']['notice_name'].value;

            if (name.trim() === '') {
                alert("Please enter notice name!");
                return false;
            }

            return true;
        }
    </script>
@endsection
