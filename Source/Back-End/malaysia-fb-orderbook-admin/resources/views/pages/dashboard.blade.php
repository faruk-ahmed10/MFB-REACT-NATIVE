@extends('layouts.app')
@section('page_title', 'Dashboard')
@section('body_content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-3 px-3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Categories
                            </div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalCategories }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-3 px-3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Products
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h3 mb-0 mr-3 font-weight-bold text-gray-800">{{ $totalProducts }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-3 px-3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Users
                            </div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-3 px-3">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Sales Today
                            </div>
                            <div class="h3 mb-0 font-weight-bold text-gray-800">{{ $totalSalesToday }} /-</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>




    @foreach($categories as $category)
        <div class="d-sm-flex align-items-center justify-content-between mb-3">
            <h1 class="h5 mb-0 font-weight-bold text-gray-800">{{ $category->name }} (Sales Today)</h1>
        </div>

        <div class="row mt-2 mb-2">
            @foreach($category->products as $product)
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card shadow h-100 py-1">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        {{ $product->name }}
                                    </div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        Qty: {{ \App\Models\OrderDetail::where('product_id', '=', $product->id)->where('created_at', '>=', \Carbon\Carbon::today())->sum('qty') }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <img src="/uploads/products/{{ $product->image }}" style="width: 50px"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
