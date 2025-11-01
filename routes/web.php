<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home');

Route::get('/home', [CustomerController::class, 'showAllCustomers']);

// === ADDED: CRUD routes ===
Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
Route::put('/customers/{customer}', [CustomerController::class, 'update'])->name('customers.update');
Route::delete('/customers/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
