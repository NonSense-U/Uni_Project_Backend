<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::post('/uplaod-pic',[ProfileController::class, 'upload-pic'])
->middleware('auth');
