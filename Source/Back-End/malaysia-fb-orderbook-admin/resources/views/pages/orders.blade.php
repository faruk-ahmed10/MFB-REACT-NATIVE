@extends('layouts.app')

@section('page_title', 'Orders')

@section('body_content')
    <script>
        let targetDataId = 0;
    </script>
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Orders</h1>
        {{--<a href="/order/new" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-plus fa-sm text-white-50"></i> New</a>--}}
    </div>

    @if(Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>User</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Customer Address</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ date('d/m/Y', strtotime($order->created_at)) }}</td>
                            <td style="text-align: center;">

                                @if($order->status == 'PENDING')
                                    <span
                                        class="badge badge-warning">{{ $order->status }}</span>
                                @endif

                                @if($order->status == 'APPROVED')
                                    <span
                                        class="badge badge-info">{{ $order->status }}</span>
                                @endif

                                @if($order->status == 'REJECTED')
                                    <span
                                        class="badge badge-danger">{{ $order->status }}</span>
                                @endif

                                @if($order->status == 'COMPLETED')
                                    <span
                                        class="badge badge-success">{{ $order->status }}</span>
                                @endif
                            </td>
                            <td>{{ $order->user->type . ' - ' . $order->user->name }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td>{{ $order->customer_phone }}</td>
                            <td>{{ $order->customer_address }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td>
                                <a href="/order/view/{{ $order->id }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a data-toggle="modal" data-target="#deleteModal" style="cursor: pointer"
                                   class="btn btn-danger btn-sm" onclick="targetDataId = {{ $order->id }}">
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
                    <a class="btn btn-danger" onclick="window.location = '/order/delete/' + targetDataId;">Delete</a>
                </div>
            </div>
        </div>
    </div>
@endsection
