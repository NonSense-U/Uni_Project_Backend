<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;


Route::get('/',[StoreController::class, 'index']);

Route::get('/search',[StoreController::class, 'searchByName']);

Route::post('/add',[StoreController::class,'store'])
->middleware('auth','role:store_owner');

