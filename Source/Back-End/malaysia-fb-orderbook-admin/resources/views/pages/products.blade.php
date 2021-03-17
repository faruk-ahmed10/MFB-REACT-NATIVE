@extends('layouts.app')

@section('page_title', 'Products')

@section('body_content')
    <script>
        let targetDataId = 0;
    </script>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Products</h1>
        <a href="/product/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> New</a>
    </div>

    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Category</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th style="text-align: center;">Image</th>
                        <th style="text-align: center;">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->category->name }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->price }}</td>
                            <td style="text-align: center;">
                                <img alt="Product" src="{{ asset('/uploads/products') . '/' . $product->image }}" style="width: 30px" />
                            </td>
                            <td style="text-align: center;">
                                <a href="/product/edit/{{ $product->id }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a data-toggle="modal" data-target="#deleteModal" style="cursor: pointer"
                                   class="btn btn-danger btn-sm" onclick="targetDataId = {{ $product->id }}">
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
                    <a class="btn btn-danger" onclick="window.location = '/product/delete/' + targetDataId;">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection
