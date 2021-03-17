<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('pages.dashboard')->with([
            'totalCategories' => Category::count(),
            'totalProducts' => Product::count(),
            'totalUsers' => User::count(),
            'totalSalesToday' => Order::where('created_at', '>=', Carbon::today())->sum('total_price'),

            'categories' => Category::with('products')->get(),
        ]);
    }
}
