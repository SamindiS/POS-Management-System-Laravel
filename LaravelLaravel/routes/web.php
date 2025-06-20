<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Fixing the resource routes
Route::resource('/orders', OrderController::class);
Route::resource('/products', ProductController::class);


// Supplier Routes
Route::resource('suppliers', SupplierController::class)->except(['show']);
Route::get('suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');
Route::patch('suppliers/{supplier}/toggle-status', [SupplierController::class, 'toggleStatus'])
    ->name('suppliers.toggle-status');

    
Route::resource('/users', UserController::class);
Route::resource('/companies', CompanyController::class);
//Route::resource('/transactions', TransactionController::class);
Route::resource('transactions', TransactionController::class)->except(['show']);
Route::get('transactions/{transaction}', [TransactionController::class, 'show'])->name('transactions.show');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');