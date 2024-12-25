<?php

use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;

foreach(glob(dirname(__FILE__).'/*/*', GLOB_NOSORT) as $route_file){
    include $route_file;
}

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';

Route::get('/test',function()
{
dd('2!');
});
