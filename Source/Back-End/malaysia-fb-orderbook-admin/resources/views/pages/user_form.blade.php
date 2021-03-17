@extends('layouts.app')

@section('page_title', 'Users')

@section('body_content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">{{ $editMode ? 'Edit' : 'New' }} User</h6>
        </div>
        <div class="card-body">
            <form name="EntryForm" method="post" action="/user/save" onsubmit="return validateForm();">
                @csrf
                <input type="hidden" name="id" value="{{ $editMode ? $data->id : 0 }}"/>

                <div class="form-group">
                    <label>User Type</label>
                    <select type="text" class="form-control" name="user_type">
                        <option value="">-- Select User Type --</option>
                        @foreach($user_types as $user_type)
                            <option
                                value="{{ $user_type }}" {{ $editMode ? $user_type == $data->type ? 'selected' : '' : '' }}>{{ $user_type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select type="text" class="form-control" name="user_status">
                        <option value="">-- Select Status --</option>
                        @foreach($statusList as $status)
                            <option
                                value="{{ $status }}" {{ $editMode ? $status == $data->status ? 'selected' : '' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>User Name</label>
                    <input type="text" class="form-control" name="user_name" placeholder="User Name" value="{{ $editMode ? $data->name : '' }}" />
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" name="user_email" placeholder="Email" value="{{ $editMode ? $data->email : '' }}" />
                </div>

                <div class="form-group">
                    <label>User Phone</label>
                    <input type="text" class="form-control" name="user_phone" placeholder="User Phone" value="{{ $editMode ? $data->phone : '' }}" />
                </div>

                <div class="form-group">
                    <label>User Password</label>
                    <input type="password" class="form-control" name="user_password" placeholder="User Password" />
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>

    <script>
        function validateForm() {
            const name = document.forms['EntryForm']['user_name'].value;
            const email = document.forms['EntryForm']['user_email'].value;
            const phone = document.forms['EntryForm']['user_phone'].value;
            const password = document.forms['EntryForm']['user_password'].value;
            const type = document.forms['EntryForm']['user_type'].value;
            const status = document.forms['EntryForm']['user_status'].value;

            if (type.trim() === '') {
                alert("Please select user type!");
                return false;
            }

            if (status.trim() === '') {
                alert("Please select user status!");
                return false;
            }

            if (name.trim() === '') {
                alert("Please enter user name!");
                return false;
            }

            if (email.trim() === '') {
                alert("Please enter email!");
                return false;
            }

            if (phone.trim() === '') {
                alert("Please enter phone!");
                return false;
            }

            @if(!$editMode)
            if (password.trim() === '') {
                alert("Please enter a password!");
                return false;
            }
            @endif

            return true;
        }
    </script>
@endsection
