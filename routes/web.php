<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

foreach(glob(dirname(__FILE__).'/*/*', GLOB_NOSORT) as $route_file){
    include $route_file;
}

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';

Route::get('/test',function()
{
    try {
        $files = Storage::disk('google')->allFiles();
        return response()->json($files);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()]);
    }
})->middleware('auth');

Route::post('/upload',function(Request $request)
{
    $request->validate([
        'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
    ]);

    // Get the uploaded file
    $file = $request->file('file');

    // Set the Google Drive path
    // $googleDrivePath = 'uploads/' . $file->getClientOriginalName();

    // Upload the file
    if (Storage::disk('google')->put('pic.jpg', file_get_contents($file))) {
         dd("File uploaded successfully!");
    } else {
        dd ("Failed to upload file.");
    }
});
