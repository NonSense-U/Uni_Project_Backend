<?php

use App\Http\Controllers\LocationController;
use Illuminate\Support\Facades\Route;



Route::get('/location',[LocationController::class , 'show'])
->middleware('auth'); //! To be Updated

Route::post('/location',[LocationController::class , 'store'])
->middleware('auth');
