<?php

use App\Http\Controllers\NoticeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LogoutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::group(['middleware' => ['my-auth']], function () {
    Route::get('/logout', [LogoutController::class, 'index']);
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //Categories
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/category/edit/{id}', [CategoryController::class, 'form']);
    Route::get('/category/new', [CategoryController::class, 'form']);
    Route::post('/category/save', [CategoryController::class, 'save']);
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete']);

    //Units
    Route::get('/units', [UnitController::class, 'index']);
    Route::get('/unit/edit/{id}', [UnitController::class, 'form']);
    Route::get('/unit/new', [UnitController::class, 'form']);
    Route::post('/unit/save', [UnitController::class, 'save']);
    Route::get('/unit/delete/{id}', [UnitController::class, 'delete']);

    //Products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/product/edit/{id}', [ProductController::class, 'form']);
    Route::get('/product/new', [ProductController::class, 'form']);
    Route::post('/product/save', [ProductController::class, 'save']);
    Route::get('/product/delete/{id}', [ProductController::class, 'delete']);

    //Notices
    Route::get('/notices', [NoticeController::class, 'index']);
    Route::get('/notice/edit/{id}', [NoticeController::class, 'form']);
    Route::get('/notice/new', [NoticeController::class, 'form']);
    Route::post('/notice/save', [NoticeController::class, 'save']);
    Route::get('/notice/delete/{id}', [NoticeController::class, 'delete']);

    //Orders
    Route::get('/orders', [OrderController::class, 'index']);
    Route::get('/order/edit/{id}', [OrderController::class, 'form']);
    Route::get('/order/view/{id}', [OrderController::class, 'view']);
    Route::get('/order/new', [OrderController::class, 'form']);
    Route::post('/order/save', [OrderController::class, 'save']);
    Route::get('/order/delete/{id}', [OrderController::class, 'delete']);

    //Users
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/user/edit/{id}', [UserController::class, 'form']);
    Route::get('/user/view/{id}', [UserController::class, 'view']);
    Route::get('/user/new', [UserController::class, 'form']);
    Route::post('/user/save', [UserController::class, 'save']);
    Route::post('/user/assign_sales_target', [UserController::class, 'assignSalesTarget']);
    Route::get('/user/delete/{id}', [UserController::class, 'delete']);

    Route::get('/tables', function () {
        return view('pages.tables');
    });
});

Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'attempt']);
