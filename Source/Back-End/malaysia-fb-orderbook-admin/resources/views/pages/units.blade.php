@extends('layouts.app')

@section('page_title', 'Units')

@section('body_content')
    <script>
        let targetDataId = 0;
    </script>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Units</h1>
        <a href="/unit/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> New</a>
    </div>

    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Unit List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($units as $unit)
                        <tr>
                            <td>{{ $unit->id }}</td>
                            <td>{{ $unit->name }}</td>
                            <td>
                                <a href="/unit/edit/{{ $unit->id }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a data-toggle="modal" data-target="#deleteModal" style="cursor: pointer"
                                   class="btn btn-danger btn-sm" onclick="targetDataId = {{ $unit->id }}">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Logout Modal-->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">This action can not be undone!</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" onclick="window.location = '/unit/delete/' + targetDataId;">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection
