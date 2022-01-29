<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\OrdersController;


Route::get('/', [PagesController::class, 'index'])->name('index');
Route::post('/orders', [OrdersController::class, 'create'])->name('order.create');
