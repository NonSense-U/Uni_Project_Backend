<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

foreach(glob(dirname(__FILE__).'/*/*', GLOB_NOSORT) as $route_file){
    include $route_file;
}

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';


Route::get('/myrole',function()
{
    $user = User::find(Auth::id());
    dd($user->getRoleNames());
})->middleware('auth');


Route::get('/test',function()
{
    try {
        $files = Storage::disk('google')->allFiles();
        return response()->json($files);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
})->middleware('auth');
