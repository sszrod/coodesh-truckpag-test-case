<?php

use App\Http\Controllers\InfoController;
use App\Http\Controllers\ProductsController;
use App\Http\Middleware\CheckApiKey;
use Illuminate\Support\Facades\Route;

Route::get('/', InfoController::class)->middleware([CheckApiKey::class]);
Route::get('products',[ProductsController::class, 'getAll'])->middleware([CheckApiKey::class]);
Route::get('products/{code}',[ProductsController::class, 'getByCode'])->middleware([CheckApiKey::class]);
Route::delete('products/{code}',[ProductsController::class, 'deleteByCode'])->middleware([CheckApiKey::class]);
Route::put('products/{code}',[ProductsController::class, 'updateByCode'])->middleware([CheckApiKey::class]);
