<?php

use App\Http\Controllers\Android\Api\Auth\AuthController;
use App\Http\Controllers\Android\Api\Category\CategoryController;
use App\Http\Controllers\Android\Api\Dashboard\DashboardController;
use App\Http\Controllers\Android\Api\Notice\NoticeController;
use App\Http\Controllers\Android\Api\Order\OrderController;
use App\Http\Controllers\Android\Api\Product\ProductController;
use App\Http\Controllers\Android\Api\User\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


/**
 * Public Routes
 */
Route::post('/android/login', [AuthController::class, 'attempt']);

/**
 * Private Routes
 */
Route::group(['prefix' => 'android', 'middleware' => ['jwt-auth']], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('sess_user', [UserController::class, 'getSessionUser']);
    Route::get('latest_notice', [NoticeController::class, 'getLatestNotice']);
    Route::get('categories', [CategoryController::class, 'getCategories']);
    Route::get('products', [ProductController::class, 'getProducts']);
    Route::get('get_orders', [OrderController::class, 'getOrders']);
    Route::post('save_order', [OrderController::class, 'saveOrder']);
    Route::get('get_today_total_sales_amount', [DashboardController::class, 'getTodaySales']);
    Route::get('get_sales_target_amount', [DashboardController::class, 'getSalesTarget']);
});
