<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/upload-pic',[ProfileController::class, 'upload_pic'])
->middleware('auth');

Route::post('/delete-pic',[ProfileController::class, 'delete_pic'])
->middleware('auth');
