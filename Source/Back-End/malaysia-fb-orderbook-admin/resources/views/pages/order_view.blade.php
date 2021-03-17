@extends('layouts.app')

@section('page_title', 'Orders')

@section('body_content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Order Info</h6>
        </div>
        <div class="card-body">
            <div><b>Id:</b> {{ $data->id }}</div>
            <div>
                <b>Status:</b>
                @if($data->status == 'PENDING')
                    <span
                        class="badge badge-warning">{{ $data->status }}</span>
                @endif

                @if($data->status == 'APPROVED')
                    <span
                        class="badge badge-info">{{ $data->status }}</span>
                @endif

                @if($data->status == 'REJECTED')
                    <span
                        class="badge badge-danger">{{ $data->status }}</span>
                @endif

                @if($data->status == 'COMPLETED')
                    <span
                        class="badge badge-success">{{ $data->status }}</span>
                @endif
            </div>
            <div><b>Comment:</b> {{ $data->comment }}</div>
            <div><b>Total Amount:</b> {{ $data->total_price }}</div>
            <div><b>Date - Time:</b> {{ date('d/m/Y - h:ia', strtotime($data->created_at)) }}</div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Customer Info</h6>
        </div>
        <div class="card-body">
            <div><b>Name:</b> {{ $data->customer_name }}</div>
            <div><b>Phone:</b> {{ $data->customer_phone }}</div>
            <div><b>Address:</b> {{ $data->customer_address }}</div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Products Info</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Unit Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data->order_details as $order_detail)
                    <tr>
                        <td>{{ $order_detail->product->id }}</td>
                        <td>{{ $order_detail->product->name }}</td>
                        <td>{{ $order_detail->unit_price }}</td>
                        <td>{{ $order_detail->qty }}</td>
                        <td>{{ $order_detail->total_amount }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="card shadow mb-4">
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
    </div>

    <script>
        const validateForm = () => {
            const status = document.forms['StatusForm']['status'].value;

            if(status.trim() === '') {
                alert("Please select a status!");
                return false;
            }

            return true;
        };
    </script>
@endsection
