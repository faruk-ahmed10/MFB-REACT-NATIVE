@extends('layouts.app')

@section('page_title', 'Orders')

@section('body_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">User Info</h6>
        </div>
        <div class="card-body">
            <div><b>Id:</b> {{ $data->id }}</div>
            <div><b>Type:</b> {{ $data->type }}</div>
            <div><b>Name:</b> {{ $data->name }}</div>
            <div><b>Phone:</b> {{ $data->phone }}</div>
            <div><b>Email:</b> {{ $data->email }}</div>

            <a class="btn btn-primary btn-sm" href="/user/edit/{{ $data->id }}"><i class="fa fa-edit"></i>&nbsp; Edit</a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Sales Target List</h6>
        </div>
        <div class="card-body">
            <form name="EntryForm" method="post" action="/user/assign_sales_target" onsubmit="return validateForm();">
                @csrf
                <input type="hidden" name="user_id" value="{{ $data->id }}"/>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Target Month</label>
                            <input readonly type="text" class="form-control" placeholder="Current Month"
                                   value="{{ date('M - Y', time()) }}"/>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Amount</label>
                            <input type="text" class="form-control" name="amount" placeholder="Amount"
                                   value=""/>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label style="visibility: hidden;">Save</label>
                            <button type="submit" class="btn btn-primary form-control">Save</button>
                        </div>
                    </div>
                </div>
            </form>

            <br/>

            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Month</th>
                    <th>Target Amount</th>
                    <th>Completed Amount</th>
                    <th>Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data->sales_target_assignments as $sales_target_assignment)
                    <tr>
                        <td>{{ $sales_target_assignment->target_month }}
                            - {{ $sales_target_assignment->target_year }}</td>
                        <td>{{ $sales_target_assignment->amount }}</td>
                        <td>{{ \App\Models\Order::where('created_by', '=', auth()->user()->id)->whereMonth('created_at', date('m', strtotime($sales_target_assignment->target_month)))->
whereYear('created_at', date('Y', strtotime($sales_target_assignment->target_year)))->sum('total_price')}}</td>
                        <td>{{ $sales_target_assignment->created_at !== null ? date('d/m/Y', strtotime($sales_target_assignment->created_at)): '' }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order List</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>id</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Phone</th>
                    <th>Customer Address</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data->orders as $order)
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

    {{--<div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Change Status</h6>
        </div>
        <div class="card-body">
            <form name="StatusForm" method="post" action="/order/save" onsubmit="return validateForm();">
                @csrf
                <input type="hidden" name="id" value="{{ $data->id }}"/>
                <div class="form-group">
                    <label>Status</label>
                    <select type="text" class="form-control" name="status">
                        <option value="">-- Select Status --</option>
                        @foreach($statusList as $status)
                            <option
                                value="{{ $status }}" {{$status == $data->status ? 'selected' : ''}}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>--}}

    <script>
        const validateForm = () => {
            const status = document.forms['StatusForm']['status'].value;

            if (status.trim() === '') {
                alert("Please select a status!");
                return false;
            }

            return true;
        };
    </script>
@endsection
