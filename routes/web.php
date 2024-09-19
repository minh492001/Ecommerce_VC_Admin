<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group(['middleware' => 'company'], function () {
    Route::group(['middleware' => 'admin'], function () {
        // Admin permission
        Route::get('admin/list', [AdminController::class, 'list']);
        Route::get('admin/add', [AdminController::class, 'add']);
        Route::post('admin/add', [AdminController::class, 'insert']);
        Route::get('admin/edit/{id}', [AdminController::class, 'edit']);
        Route::post('admin/edit/{id}', [AdminController::class, 'update']);
        Route::get('admin/delete/{id}', [AdminController::class, 'delete']);

        Route::get('company/delete/{id}', [CompanyController::class, 'delete']);

        Route::get('product/delete/{id}', [ProductController::class, 'delete']);

        Route::get('orders/list', [OrderController::class, 'list']);

        Route::get('orders/add', [OrderController::class, 'add']);
        Route::post('orders/add', [OrderController::class, 'insert']);
        Route::get('orders/edit/{id}', [OrderController::class, 'edit']);
        Route::post('orders/edit/{id}', [OrderController::class, 'update']);


    });
    // Company permission
    Route::get('company/add', [CompanyController::class, 'add']);
    Route::post('company/add', [CompanyController::class, 'insert']);
    Route::get('company/edit/{id}', [CompanyController::class, 'edit']);
    Route::post('company/edit/{id}', [CompanyController::class, 'update']);

    Route::get('user/add', [UserController::class, 'add']);
    Route::post('user/add', [UserController::class, 'insert']);
    Route::get('user/edit/{id}', [UserController::class, 'edit']);
    Route::post('user/edit/{id}', [UserController::class, 'update']);

    Route::get('product/add', [ProductController::class, 'add']);
    Route::post('product/add', [ProductController::class, 'insert']);
    Route::get('product/edit/{id}', [ProductController::class, 'edit']);
    Route::post('product/edit/{id}', [ProductController::class, 'update']);

});

// User permission
Route::group(['middleware' => 'user'], function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('dashboard', [DashboardController::class, 'dashboard']);

    Route::get('company/list', [CompanyController::class, 'list']);

    Route::get('user/list', [UserController::class, 'list']);

    Route::get('product/list', [ProductController::class, 'list']);

    Route::get('profile', [ProfileController::class, 'view_profile']);

    Route::get('profile/edit', [ProfileController::class, 'edit']);
    Route::post('profile/edit', [ProfileController::class, 'update']);
});

// Viewer permission
Route::get('/', [AuthController::class, 'login']);
Route::post('/', [AuthController::class, 'auth_login']);

Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'auth_register']);


